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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

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
        // Regenerate session ID for security
        $request->session()->regenerate();

        $request = $this->sanitizeRequest($request);

        try {
            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($request->password),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return redirect()->route('login')
                ->with('notification', [
                    'message' => 'Đăng ký thành công! Vui lòng đăng nhập.',
                    'type' => 'success'
                ]);
        } catch (\Exception $e) {
            Log::error('Đăng ký thất bại', ['error' => $e->getMessage()]);
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
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showLoginForm()
    {
        // Nếu đã đăng nhập, chuyển hướng về trang chủ
        if (session('jwt_token')) {
            try {
                // Validate token
                JWTAuth::setToken(session('jwt_token'))->authenticate();
                return redirect()->route('home');
            } catch (\Exception $e) {
                // Token is invalid, clear session and continue
                Session::flush();
            }
        }

        // Trả về view login
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
        // Lưu token CSRF hiện tại
        $currentToken = $request->session()->token();

        // Đặt lại CSRF token mới
        $request->session()->regenerateToken();

        // Nếu đã đăng nhập (có JWT token), chuyển hướng về trang chủ
        if (session('jwt_token')) {
            try {
                // Validate token
                JWTAuth::setToken(session('jwt_token'))->authenticate();
                return redirect()->route('home');
            } catch (\Exception $e) {
                // Token is invalid, clear session and continue
                Session::flush();
            }
        }

        // Reset các khóa hết hạn
        DB::table('users')
            ->whereNotNull('login_lock_expires_at')
            ->where('login_lock_expires_at', '<', now())
            ->update([
                'login_lock' => null,
                'login_lock_expires_at' => null
            ]);

        try {
            // Tìm người dùng theo email
            $userRecord = DB::table('users')->where('email', $request->email)->first();

            // Log thông tin debug
            Log::debug('Login attempt', [
                'email' => $request->email,
                'user_found' => (bool)$userRecord,
                'password_check' => $userRecord ? Hash::check($request->password, $userRecord->password) : false
            ]);

            if (!$userRecord || !Hash::check($request->password, $userRecord->password)) {
                return back()->withInput(['email' => $request->email])
                    ->with('notification', [
                        'message' => 'Email hoặc mật khẩu không chính xác',
                        'type' => 'error'
                    ]);
            }

            // Tạo khóa đăng nhập
            $lockId = Str::uuid()->toString();

            // Kiểm tra xem người dùng có đang đăng nhập ở nơi khác không
            $existingLock = DB::table('users')
                ->where('id', $userRecord->id)
                ->where(function ($query) {
                    $query->whereNotNull('login_lock')
                          ->where('login_lock_expires_at', '>', now());
                })
                ->first();

            if ($existingLock) {
                return back()->withInput(['email' => $request->email])
                    ->with('notification', [
                        'message' => 'Có một yêu cầu đăng nhập khác đang được xử lý. Vui lòng thử lại sau.',
                        'type' => 'warning'
                    ]);
            }

            // Check for force logout option
            $forceLogout = $request->boolean('force_logout');
            $forceLogoutToken = $request->input('force_logout_token');

            // If has force logout token from session but not from request
            if (session('force_logout_token') && !$forceLogoutToken) {
                $forceLogoutToken = session('force_logout_token');
            }

            // Đặt khóa đăng nhập trong 10 giây
            DB::table('users')
                ->where('id', $userRecord->id)
                ->update([
                    'login_lock' => $lockId,
                    'login_lock_expires_at' => now()->addSeconds(10)
                ]);

            try {
                // Lấy device identifier
                $deviceId = $this->deviceService->getDeviceIdentifier($request);

                // Kiểm tra lại xem người dùng có đang đăng nhập ở nơi khác không
                $latestUser = DB::table('users')->where('id', $userRecord->id)->first();
                if ($latestUser->login_lock !== $lockId) {
                    // Khóa đã bị thay đổi, có thể có người đang đăng nhập cùng lúc
                    return back()->withInput(['email' => $request->email])
                        ->with('notification', [
                            'message' => 'Có một yêu cầu đăng nhập khác đang được xử lý. Vui lòng thử lại sau.',
                            'type' => 'warning'
                        ]);
                }

                // Kiểm tra thiết bị hiện tại với thiết bị đã đăng nhập
                if (!$forceLogout && $latestUser->device_id && $latestUser->device_id !== $deviceId) {
                    // Xác thực token hiện tại
                    try {
                        $tokenValid = $latestUser->active_token ?
                            JWTAuth::setToken($latestUser->active_token)->check() : false;

                        if ($tokenValid) {
                            // Provide option for force logout
                            $forceLogoutToken = Str::random(40);
                            session(['force_logout_token' => $forceLogoutToken]);
                            session(['temp_password' => $request->password]);

                            return back()->withInput(['email' => $request->email])
                                ->with('force_logout_option', true)
                                ->with('notification', [
                                    'message' => 'Tài khoản này đang được đăng nhập trên thiết bị khác.',
                                    'type' => 'warning'
                                ]);
                        }
                    } catch (\Exception $e) {
                        // Token không hợp lệ, tiếp tục đăng nhập
                        Log::info('Token không hợp lệ, tiếp tục đăng nhập mới', [
                            'user_id' => $latestUser->id,
                            'error' => $e->getMessage()
                        ]);
                    }
                }

                // Vô hiệu hóa token cũ nếu có
                if ($latestUser->active_token) {
                    try {
                        JWTAuth::setToken($latestUser->active_token)->invalidate();
                    } catch (\Exception $e) {
                        Log::error('Lỗi vô hiệu hóa token cũ', ['error' => $e->getMessage()]);
                    }
                }

                // Lấy đối tượng User cho JWT
                $user = User::find($latestUser->id);
                if (!$user) {
                    throw new \Exception("Không tìm thấy người dùng id: {$latestUser->id}");
                }

                // Tạo JWT token mới
                $token = JWTAuth::fromUser($user);

                // Cập nhật thông tin thiết bị và token
                DB::table('users')
                    ->where('id', $latestUser->id)
                    ->update([
                        'device_id' => $deviceId,
                        'login_lock' => null,
                        'login_lock_expires_at' => null,
                        'active_token' => $token,
                        'last_login_at' => now()
                    ]);

                // Lưu token vào session
                session(['jwt_token' => $token]);

                // Xóa khóa phiên cũ
                session()->forget([
                    'force_logout_option',
                    'force_logout_token',
                    'temp_password'
                ]);

                // Kiểm tra xem có URL dự định không
                $intendedUrl = session('intended_url');
                if ($intendedUrl) {
                    session()->forget('intended_url');
                    return redirect()->to($intendedUrl);
                }

                return redirect()->route('home')
                    ->with('notification', [
                        'message' => 'Đăng nhập thành công!',
                        'type' => 'success'
                    ]);

            } catch (\Exception $e) {
                // Xóa khóa trong trường hợp có lỗi
                DB::table('users')
                    ->where('id', $userRecord->id)
                    ->where('login_lock', $lockId)
                    ->update([
                        'login_lock' => null,
                        'login_lock_expires_at' => null
                    ]);

                throw $e;
            }

        } catch (\Exception $e) {
            Log::error('Đăng nhập thất bại', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->withInput(['email' => $request->email])
                ->with('notification', [
                    'message' => 'Đăng nhập thất bại. Vui lòng thử lại.',
                    'type' => 'error'
                ]);
        }
    }

    /**
     * Log the user out
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        try {
            // Get user from JWT token
            $token = session('jwt_token');
            $user = null;

            if ($token) {
                try {
                    $user = JWTAuth::setToken($token)->authenticate();
                } catch (\Exception $e) {
                    // Token is invalid, continue with logout
                    Log::info('Invalid token during logout', ['error' => $e->getMessage()]);
                }
            }

            if ($user) {
                // Đảm bảo xóa khóa đăng nhập cùng lúc với thông tin thiết bị
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'device_id' => null,
                        'active_token' => null,
                        'login_lock' => null,
                        'login_lock_expires_at' => null
                    ]);

                // Vô hiệu hóa JWT token nếu có
                if ($token) {
                    try {
                        JWTAuth::setToken($token)->invalidate();
                    } catch (\Exception $e) {
                        Log::error('Lỗi vô hiệu hóa JWT token', ['error' => $e->getMessage()]);
                    }
                }
            }

            // Xóa cookie nếu có
            if (Cookie::has('remember_token')) {
                Cookie::queue(Cookie::forget('remember_token'));
            }

            // Xóa tất cả dữ liệu session
            Session::flush();

            // Xóa dữ liệu trình duyệt và chuyển hướng đến URL tuyệt đối
            $loginUrl = route('login');
            $script = "
                <script nonce=\"".csrf_token()."\">
                    localStorage.clear();
                    sessionStorage.clear();
                    sessionStorage.setItem('auto_logout', '1');
                    window.location.replace('".e($loginUrl)."');
                </script>
            ";

            return redirect()->route('login')
                ->with('notification', [
                    'message' => 'Đăng xuất thành công.',
                    'type' => 'success'
                ])
                ->with('clear_storage_script', $script);

        } catch (\Exception $e) {
            Log::error('Lỗi khi đăng xuất', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->route('login')
                ->with('notification', [
                    'message' => 'Đã có lỗi xảy ra khi đăng xuất.',
                    'type' => 'error'
                ]);
        }
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
     * Check session status
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sessionStatus(Request $request): JsonResponse
    {
        $request = $this->sanitizeRequest($request);

        try {
            $token = session('jwt_token');

            if (!$token) {
                return response()->json([
                    'active' => false,
                    'reason' => 'not_authenticated'
                ]);
            }

            try {
                JWTAuth::setToken($token);
                $user = JWTAuth::authenticate();

                if (!$user) {
                    return response()->json([
                        'active' => false,
                        'reason' => 'invalid_token'
                    ]);
                }
            } catch (TokenExpiredException $e) {
                Session::flush();
                return response()->json([
                    'active' => false,
                    'reason' => 'token_expired'
                ]);
            } catch (TokenInvalidException $e) {
                Session::flush();
                return response()->json([
                    'active' => false,
                    'reason' => 'token_invalid'
                ]);
            } catch (JWTException $e) {
                Session::flush();
                return response()->json([
                    'active' => false,
                    'reason' => 'token_error'
                ]);
            }

            // Kiểm tra thông tin người dùng từ database
            $userRecord = DB::table('users')->find($user->id);
            if (!$userRecord) {
                Session::flush();
                return response()->json([
                    'active' => false,
                    'reason' => 'user_not_found'
                ]);
            }

            $currentDeviceId = $this->deviceService->getDeviceIdentifier($request);

            // Kiểm tra nếu thiết bị hiện tại không khớp với thiết bị đã đăng nhập
            if ($userRecord->device_id !== $currentDeviceId) {
                // Đăng xuất phiên hiện tại
                Session::flush();

                // Tạo script để xóa dữ liệu và chuyển hướng
                $loginUrl = route('login');
                $script = "
                    <script>
                        localStorage.clear();
                        sessionStorage.clear();
                        sessionStorage.setItem('auto_logout', '1');
                        window.location.replace('{$loginUrl}');
                    </script>
                ";

                return response()->json([
                    'active' => false,
                    'reason' => 'device_mismatch',
                    'message' => 'Phiên đăng nhập của bạn đã kết thúc do có người đăng nhập từ thiết bị khác.',
                    'script' => $script
                ]);
            }

            // Kiểm tra token
            if ($userRecord->active_token !== $token) {
                Session::flush();

                return response()->json([
                    'active' => false,
                    'reason' => 'token_mismatch',
                    'message' => 'Phiên đăng nhập không hợp lệ.',
                    'reload' => true
                ]);
            }

            return response()->json(['active' => true]);

        } catch (\Exception $e) {
            Log::error('Lỗi khi kiểm tra phiên', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'active' => false,
                'reason' => 'error',
                'message' => 'Đã có lỗi xảy ra khi kiểm tra phiên.'
            ]);
        }
    }

    /**
     * Check if user is still authenticated
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAuth(Request $request): JsonResponse
    {
        $request = $this->sanitizeRequest($request);

        try {
            $token = session('jwt_token');

            if (!$token) {
                return response()->json(['authenticated' => false]);
            }

            try {
                JWTAuth::setToken($token);
                $user = JWTAuth::authenticate();

                if (!$user) {
                    return response()->json(['authenticated' => false]);
                }
            } catch (TokenExpiredException $e) {
                Session::flush();
                return response()->json(['authenticated' => false]);
            } catch (TokenInvalidException $e) {
                Session::flush();
                return response()->json(['authenticated' => false]);
            } catch (JWTException $e) {
                Session::flush();
                return response()->json(['authenticated' => false]);
            }

            // Kiểm tra thiết bị
            $deviceId = $this->deviceService->getDeviceIdentifier($request);
            $userRecord = DB::table('users')->find($user->id);

            if (!$userRecord) {
                Session::flush();
                return response()->json([
                    'authenticated' => false,
                    'message' => 'Không tìm thấy thông tin người dùng.'
                ]);
            }

            // Kiểm tra nếu có phiên đăng nhập đang được xử lý
            if ($userRecord->login_lock && $userRecord->login_lock_expires_at && $userRecord->login_lock_expires_at > now()) {
                Session::flush();

                $loginUrl = route('login');
                $script = "
                    <script>
                        localStorage.clear();
                        sessionStorage.clear();
                        sessionStorage.setItem('auto_logout', '1');
                        window.location.replace('{$loginUrl}');
                    </script>
                ";

                return response()->json([
                    'authenticated' => false,
                    'message' => 'Có một phiên đăng nhập mới đang được xử lý.',
                    'script' => $script
                ]);
            }

            // Kiểm tra nếu thiết bị hiện tại không khớp với thiết bị đã đăng nhập
            if ($userRecord->device_id !== $deviceId) {
                Session::flush();

                $loginUrl = route('login');
                $script = "
                    <script>
                        localStorage.clear();
                        sessionStorage.clear();
                        sessionStorage.setItem('auto_logout', '1');
                        window.location.replace('{$loginUrl}');
                    </script>
                ";

                return response()->json([
                    'authenticated' => false,
                    'message' => 'Phiên đăng nhập của bạn đã kết thúc do có người đăng nhập từ thiết bị khác.',
                    'script' => $script
                ]);
            }

            // Kiểm tra token
            if ($userRecord->active_token !== $token) {
                Session::flush();

                $loginUrl = route('login');
                $script = "
                    <script>
                        localStorage.clear();
                        sessionStorage.clear();
                        sessionStorage.setItem('auto_logout', '1');
                        window.location.replace('{$loginUrl}');
                    </script>
                ";

                return response()->json([
                    'authenticated' => false,
                    'message' => 'Phiên đăng nhập không hợp lệ hoặc đã hết hạn.',
                    'script' => $script
                ]);
            }

            return response()->json(['authenticated' => true]);
        } catch (\Exception $e) {
            Log::error('Lỗi kiểm tra xác thực', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                'authenticated' => false,
                'message' => 'Đã có lỗi xảy ra khi kiểm tra xác thực.'
            ]);
        }
    }

    /**
     * Schedule a delayed logout - used when browser is closed
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function scheduleLogout(Request $request)
    {
        $request = $this->sanitizeRequest($request);

        $token = session('jwt_token');
        $user = null;

        if ($token) {
            try {
                $user = JWTAuth::setToken($token)->authenticate();
            } catch (\Exception $e) {
                // Token is invalid
                Log::warning('Invalid token in scheduleLogout', ['error' => $e->getMessage()]);
            }
        }

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
        $request = $this->sanitizeRequest($request);

        $token = session('jwt_token');
        $user = null;

        if ($token) {
            try {
                $user = JWTAuth::setToken($token)->authenticate();
            } catch (\Exception $e) {
                // Token is invalid
                Log::warning('Invalid token in cancelLogout', ['error' => $e->getMessage()]);
            }
        }

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
        $request = $this->sanitizeRequest($request);

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

    private function logoutOtherDevices(int $userId): void
    {
        try {
            $user = User::find($userId);

            if ($user && $user->active_token) {
                try {
                    JWTAuth::setToken($user->active_token)->invalidate();
                } catch (\Exception $e) {
                    Log::error('Error invalidating JWT token', ['error' => $e->getMessage()]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error logging out other devices', ['error' => $e->getMessage()]);
        }
    }

    private function forceLogout(): void
    {
        try {
            // Get user from JWT token
            $token = session('jwt_token');
            $user = null;

            if ($token) {
                try {
                    $user = JWTAuth::setToken($token)->authenticate();
                } catch (\Exception $e) {
                    // Token is invalid
                    Log::warning('Invalid token in forceLogout', ['error' => $e->getMessage()]);
                }
            }

            if ($user) {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update([
                        'device_id' => null,
                        'active_token' => null
                    ]);
            }

            Session::flush();
        } catch (\Exception $e) {
            Log::error('Force logout failed', ['error' => $e->getMessage()]);
        }
    }

    /**
     * Làm sạch dữ liệu đầu vào để ngăn chặn XSS
     *
     * @param mixed $data
     * @return mixed
     */
    private function sanitizeInput($data)
    {
        if (is_string($data)) {
            // Loại bỏ các script tag và các thuộc tính nguy hiểm
            $data = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $data);
            $data = preg_replace('/on\w+="[^"]*"/i', '', $data);
            $data = preg_replace('/on\w+=\'[^\']*\'/i', '', $data);

            // HTML encode các ký tự đặc biệt để tránh XSS
            return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        } elseif (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = $this->sanitizeInput($value);
            }
        }

        return $data;
    }

    /**
     * Xử lý dữ liệu đầu vào từ request
     *
     * @param Request $request
     * @return Request
     */
    private function sanitizeRequest(Request $request): Request
    {
        // Lấy tất cả tham số từ request
        $inputs = $request->all();

        // Làm sạch từng tham số
        $sanitizedInputs = $this->sanitizeInput($inputs);

        // Áp dụng lại các tham số đã làm sạch vào request
        $request->replace($sanitizedInputs);

        return $request;
    }

    /**
     * Refresh JWT token
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        try {
            $token = JWTAuth::parseToken()->refresh();
            session(['jwt_token' => $token]);

            return response()->json([
                'status' => 'success',
                'token' => $token
            ]);
        } catch (TokenExpiredException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token đã hết hạn'
            ], 401);
        } catch (TokenInvalidException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token không hợp lệ'
            ], 401);
        } catch (JWTException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token không tồn tại'
            ], 401);
        }
    }
}
