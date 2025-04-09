<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\DeviceService;
use Closure;
use Illuminate\Http\Request;
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
        try {
            // Check if token exists in session
            $token = session('jwt_token');
            if (!$token) {
                session()->flush();
                return redirect()->route('login')
                    ->with('notification', [
                        'message' => 'Vui lòng đăng nhập để tiếp tục.',
                        'type' => 'error'
                    ]);
            }

            // Set and validate the token
            JWTAuth::setToken($token);
            $user = JWTAuth::authenticate();

            if (!$user) {
                throw new JWTException('User not found for token');
            }

            // Device check
            $deviceId = $this->deviceService->getDeviceIdentifier($request);

            // Check if user is trying to access from a different browser
            if ($user->device_id && $user->device_id !== $deviceId) {
                // User is trying to access from a different browser - force logout
                session()->flush();

                try {
                    JWTAuth::invalidate();
                } catch (\Exception $e) {
                    // Token might already be invalid
                }

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

            // Ensure device ID is always up to date
            if ($user->device_id !== $deviceId) {
                User::where('id', $user->id)->update([
                    'device_id' => $deviceId
                ]);
            }

            // Set user in request for easy access
            $request->attributes->add(['user' => $user]);

            return $next($request);

        } catch (TokenExpiredException $e) {
            // Token expired
            session()->flush();

            return redirect()->route('login')
                ->with('notification', [
                    'message' => 'Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại.',
                    'type' => 'warning'
                ]);

        } catch (TokenInvalidException $e) {
            // Invalid token
            session()->flush();

            return redirect()->route('login')
                ->with('notification', [
                    'message' => 'Phiên đăng nhập không hợp lệ. Vui lòng đăng nhập lại.',
                    'type' => 'warning'
                ]);

        } catch (JWTException $e) {
            // Token could not be parsed
            session()->flush();

            return redirect()->route('login')
                ->with('notification', [
                    'message' => 'Có lỗi xảy ra với phiên đăng nhập. Vui lòng đăng nhập lại.',
                    'type' => 'error'
                ]);
        }
    }
}
