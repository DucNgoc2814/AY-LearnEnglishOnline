<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\DeviceService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtMiddleware
{
    protected $deviceService;

    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('notification', [
                    'message' => 'Vui lòng đăng nhập để tiếp tục.',
                    'type' => 'error'
                ]);
        }

        $user = Auth::user();
        $deviceId = $this->deviceService->getDeviceIdentifier($request);

        // Check if user is trying to access from a different browser
        if ($user->device_id && $user->device_id !== $deviceId) {
            // User is trying to access from a different browser - force logout
            Auth::logout();
            session()->flush();

            // Log this event
            \Illuminate\Support\Facades\Log::warning('Session hijacking attempt detected', [
                'user_id' => $user->id,
                'expected_device' => $user->device_id,
                'current_device' => $deviceId,
                'ip' => $request->ip()
            ]);

            return redirect()->route('login')
                ->with('notification', [
                    'message' => 'Tài khoản của bạn đang được đăng nhập từ một thiết bị khác. Vui lòng đăng xuất ở thiết bị đó trước khi đăng nhập ở đây.',
                    'type' => 'error'
                ]);
        }

        // If no JWT token in session, create one
        if (!session('jwt_token')) {
            // Create a new token
            $token = JWTAuth::fromUser($user);
            session(['jwt_token' => $token]);

            // Update device info in database
            User::where('id', $user->id)->update([
                'device_id' => $deviceId,
                'active_token' => $token
            ]);
        } else {
            // Verify existing token
            JWTAuth::setToken(session('jwt_token'));

            try {
                $jwtUser = JWTAuth::authenticate();
                if (!$jwtUser) {
                    throw new JWTException('Invalid token');
                }

                // Ensure device ID is always up to date
                if ($user->device_id !== $deviceId) {
                    User::where('id', $user->id)->update([
                        'device_id' => $deviceId
                    ]);
                }
            } catch (JWTException $e) {
                // Token is invalid, create new one
                $token = JWTAuth::fromUser($user);
                session(['jwt_token' => $token]);

                // Update token in database
                User::where('id', $user->id)->update([
                    'active_token' => $token,
                    'device_id' => $deviceId
                ]);
            }
        }

        return $next($request);
    }
}
