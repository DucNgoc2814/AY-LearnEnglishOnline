<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\DeviceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * @package App\Http\Controllers\Client\Auth
 * @author YourName
 * @description Handles user authentication operations
 */
class AuthController extends Controller
{
    protected $deviceService;

    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    /**
     * Show registration form
     *
     * @return View
     */
    public function showRegisterForm(): View
    {
        return view('client.auth.register');
    }

    /**
     * Handle registration request
     *
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phoneNumber' => $request->phoneNumber,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('login')
                ->with('notification', [
                    'message' => 'Đăng ký thành công! Vui lòng đăng nhập.',
                    'type' => 'success'
                ]);
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('notification', [
                    'message' => 'Đăng ký thất bại. Vui lòng thử lại.',
                    'type' => 'error'
                ]);
        }
    }

    /**
     * Show login form
     *
     * @return View
     */
    public function showLoginForm(): View
    {
        return view('client.auth.login');
    }

    /**
     * Handle login request
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        // Try to get user
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withInput(['email' => $request->email])
                ->with('notification', [
                    'message' => 'Email hoặc mật khẩu không chính xác',
                    'type' => 'error'
                ]);
        }

        // Get device identifier
        $deviceId = $this->deviceService->getDeviceIdentifier($request);
        $deviceName = $this->deviceService->getDeviceName($request);

        // Check if user is already logged in on a different device/browser
        if ($user->device_id && $user->device_id !== $deviceId) {
            // Completely block login - no force login option
            return back()->withInput(['email' => $request->email])
                ->with('notification', [
                    'message' => 'Tài khoản này đang được đăng nhập từ một thiết bị khác.
                               Vui lòng đăng xuất khỏi thiết bị đó trước khi đăng nhập ở đây.',
                    'type' => 'error'
                ]);
        }

        // Login the user
        Auth::login($user, $request->boolean('remember'));

        // Generate JWT token
        $token = JWTAuth::fromUser($user);

        // Update user with new device and token
        User::where('id', $user->id)->update([
            'device_id' => $deviceId,
            'active_token' => $token
        ]);

        // Store token in session
        session(['jwt_token' => $token]);
        session(['device_name' => $deviceName]);

        // Store browser ID if provided in header
        $browserId = $request->header('X-Browser-ID');
        if ($browserId) {
            session(['browser_id' => $browserId]);
        }

        return redirect()->intended(route('home'))
            ->with('notification', [
                'message' => 'Đăng nhập thành công!',
                'type' => 'success'
            ]);
    }

    /**
     * Check session status
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sessionStatus(Request $request)
    {
        $user = Auth::user();
        $browserId = $request->header('X-Browser-ID');

        Log::info('Session status check', [
            'user_id' => $user ? $user->id : 'none',
            'browser_id' => $browserId
        ]);

        if (!$user) {
            return response()->json(['active' => false, 'reason' => 'not_authenticated']);
        }

        // Get current device ID
        $deviceId = $this->deviceService->getDeviceIdentifier($request);

        // Check if the device ID matches
        if ($user->device_id && $user->device_id !== $deviceId) {
            Log::warning('Device ID mismatch', [
                'user_id' => $user->id,
                'stored_device' => $user->device_id,
                'current_device' => $deviceId
            ]);

            return response()->json(['active' => false, 'reason' => 'device_mismatch']);
        }

        // Check if token is valid
        if (session('jwt_token') && $user->active_token !== session('jwt_token')) {
            Log::warning('Token mismatch', [
                'user_id' => $user->id
            ]);

            return response()->json(['active' => false, 'reason' => 'token_invalid']);
        }

        return response()->json(['active' => true]);
    }

    /**
     * Log the user out
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $user = Auth::user();

        Log::info('Manual logout requested', [
            'user_id' => $user ? $user->id : 'none',
        ]);

        if ($user) {
            // Clear device and token
            User::where('id', $user->id)->update([
                'device_id' => null,
                'active_token' => null
            ]);
        }

        // Invalidate the JWT token
        if (session('jwt_token')) {
            try {
                JWTAuth::setToken(session('jwt_token'))->invalidate();
            } catch (\Exception $e) {
                Log::error('Error invalidating JWT token', [
                    'error' => $e->getMessage()
                ]);
            }
        }

        // Standard logout
        Auth::logout();
        session()->flush();

        return redirect()->route('login')
            ->with('notification', [
                'message' => 'Bạn đã đăng xuất thành công.',
                'type' => 'success'
            ]);
    }

    /**
     * Show user profile
     *
     * @return View
     */
    public function profile(): View
    {
        return view('client.auth.profile');
    }

    /**
     * Check if user is still logged in
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAuth(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['authenticated' => false]);
        }

        // Check if current device is still authorized
        $deviceId = $this->deviceService->getDeviceIdentifier($request);

        if ($user->device_id && $user->device_id !== $deviceId) {
            // Someone is trying to access from a different browser
            Auth::logout();
            session()->flush();

            return response()->json([
                'authenticated' => false,
                'message' => 'Có người đang cố gắng đăng nhập vào tài khoản của bạn từ một thiết bị khác.',
                'login_attempt' => true
            ]);
        }

        // Check if token is still valid
        if (session('jwt_token') && $user->active_token !== session('jwt_token')) {
            Auth::logout();
            session()->flush();

            return response()->json([
                'authenticated' => false,
                'message' => 'Phiên đăng nhập của bạn đã hết hạn hoặc không hợp lệ.'
            ]);
        }

        return response()->json(['authenticated' => true]);
    }

    /**
     * Schedule a delayed logout - used when browser is closed
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function scheduleLogout(Request $request)
    {
        $user = Auth::user();
        $browserId = $request->input('browser_id') ?? $request->query('browser_id') ?? $request->header('X-Browser-ID');
        $delay = max(0, intval($request->input('delay', 30))); // Ensure delay is not negative
        $forceLogout = $request->input('force', 0) || $delay === 0;

        Log::info('Schedule logout request received', [
            'user_id' => $user ? $user->id : 'none',
            'browser_id' => $browserId,
            'delay' => $delay,
            'force' => $forceLogout
        ]);

        // For force logout requests, try to find the user by browser ID
        if (!$user && $browserId) {
            // First try direct device_id match
            $user = User::where('device_id', $browserId)->first();

            if (!$user) {
                // Try to find user by browser ID
                $user = User::whereNotNull('device_id')->get()->filter(function($u) use ($browserId) {
                    return $u->device_id === $browserId;
                })->first();
            }
        }

        if (!$user) {
            Log::warning('Failed to find user for scheduled logout', [
                'browser_id' => $browserId
            ]);
            return response('', 204);
        }

        // Use the cache to queue a delayed logout
        $cacheKey = 'scheduled_logout_' . $user->id;

        // Handle immediate logout request
        if ($forceLogout) {
            Log::info("Immediate logout triggered for user {$user->id} with browser {$browserId}");

            // Clear user's session data immediately
            User::where('id', $user->id)->update([
                'device_id' => null,
                'active_token' => null
            ]);

            // Remove any scheduled logout
            cache()->forget($cacheKey);
            cache()->forget($cacheKey . '_browser_id');

            return response('', 204);
        }

        // For short delays or critical requests, process immediately
        if ($delay <= 5) {
            Log::info("Short delay logout processed immediately for user {$user->id}");

            // Clear user's session data now
            User::where('id', $user->id)->update([
                'device_id' => null,
                'active_token' => null
            ]);

            return response('', 204);
        }

        // For longer delays, use the cache system
        $logoutTime = now()->addSeconds($delay);
        cache()->put($cacheKey, $logoutTime, $delay + 10); // Add 10 seconds buffer

        // Add to pending keys list for scheduler to find
        $pendingKeys = cache()->get('pending_logout_keys', []);
        $pendingKeys[] = $cacheKey;
        cache()->put('pending_logout_keys', array_unique($pendingKeys));

        // Store browser ID with the logout request
        if ($browserId) {
            cache()->put($cacheKey . '_browser_id', $browserId, $delay + 10);
        }

        // Schedule the logout without using dispatch
        Log::info("Setting up delayed logout for user {$user->id} with delay {$delay} seconds");

        return response('', 204);
    }

    /**
     * Cancel a previously scheduled logout
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function cancelLogout(Request $request)
    {
        $user = Auth::user();
        $browserId = $request->input('browser_id') ?? $request->query('browser_id') ?? $request->header('X-Browser-ID');

        Log::info('Cancel logout request received', [
            'user_id' => $user ? $user->id : 'none',
            'browser_id' => $browserId
        ]);

        if (!$user && $browserId) {
            // If we have a browser ID, try to find the user by it
            // First try direct device_id match
            $user = User::where('device_id', $browserId)->first();

            if (!$user) {
                // Try to find user by browser ID
                $user = User::whereNotNull('device_id')->get()->filter(function($u) use ($browserId) {
                    return $u->device_id === $browserId;
                })->first();
            }
        }

        if (!$user) {
            Log::warning('Failed to find user for cancel logout', [
                'browser_id' => $browserId
            ]);
            return response('', 204);
        }

        // Identify the cache key for this user's scheduled logout
        $cacheKey = 'scheduled_logout_' . $user->id;

        // Clear the cached logout
        if (cache()->has($cacheKey)) {
            cache()->forget($cacheKey);
            cache()->forget($cacheKey . '_browser_id');

            // Remove from pending keys list
            $pendingKeys = cache()->get('pending_logout_keys', []);
            if (in_array($cacheKey, $pendingKeys)) {
                $pendingKeys = array_diff($pendingKeys, [$cacheKey]);
                cache()->put('pending_logout_keys', $pendingKeys);
            }

            Log::info("Cancelled scheduled logout for user {$user->id}");
        }

        return response('', 204);
    }

    /**
     * Check scheduled logout status for debugging
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkScheduledLogout(Request $request)
    {
        // Get all pending keys
        $pendingKeys = cache()->get('pending_logout_keys', []);
        $result = [];

        foreach ($pendingKeys as $key) {
            $logoutTime = cache()->get($key);
            $browserId = cache()->get("{$key}_browser_id");
            $userId = str_replace('scheduled_logout_', '', $key);

            $user = User::find($userId);

            $result[] = [
                'user_id' => $userId,
                'user_email' => $user ? $user->email : 'Unknown',
                'logout_time' => $logoutTime ? $logoutTime->toDateTimeString() : null,
                'time_left' => $logoutTime ? now()->diffInSeconds($logoutTime, false) : null,
                'browser_id' => $browserId
            ];
        }

        return response()->json([
            'pending_logouts' => $result,
            'time' => now()->toDateTimeString(),
            'total_count' => count($pendingKeys)
        ]);
    }
}
