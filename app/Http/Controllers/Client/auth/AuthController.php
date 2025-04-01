<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\DeviceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        // Check if user is already logged in on a different device/browser
        if ($user->device_id && $user->device_id !== $deviceId) {
            $deviceName = $this->deviceService->getDeviceName($request);

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
        $deviceName = $this->deviceService->getDeviceName($request);

        // Update user with new device and token
        User::where('id', $user->id)->update([
            'device_id' => $deviceId,
            'active_token' => $token
        ]);

        // Store token in session
        session(['jwt_token' => $token]);
        session(['device_name' => $deviceName]);

        return redirect()->intended(route('home'))
            ->with('notification', [
                'message' => 'Đăng nhập thành công!',
                'type' => 'success'
            ]);
    }

    /**
     * Handle logout request
     *
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        $user = Auth::user();

        // Invalidate JWT token
        if (session()->has('jwt_token')) {
            try {
                JWTAuth::setToken(session('jwt_token'))->invalidate();
            } catch (\Exception $e) {
                // Token might be already invalid
            }
            session()->forget('jwt_token');
            session()->forget('device_name');
        }

        // Clear device information
        if ($user) {
            User::where('id', $user->id)->update([
                'device_id' => null,
                'active_token' => null
            ]);
        }

        Auth::logout();

        return redirect()->route('home')
            ->with('notification', [
                'message' => 'Đăng xuất thành công.',
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
}
