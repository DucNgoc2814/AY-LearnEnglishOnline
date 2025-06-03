<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtMiddleware extends BaseMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Skip authentication for login routes
            if ($request->routeIs('online.login') || $request->routeIs('online.auth.login')) {
                return $next($request);
            }

            // Check if token exists in session
            $token = session('jwt_token');
            if (!$token) {
                return $this->handleUnauthenticated('Không tìm thấy token xác thực.');
            }

            try {
                // Set token and authenticate
                JWTAuth::setToken($token);
                $user = JWTAuth::authenticate();

                if (!$user) {
                    return $this->handleUnauthenticated('Không tìm thấy thông tin người dùng.');
                }

                // Try to refresh token if it's close to expiring
                $payload = JWTAuth::getPayload();
                $exp = $payload->get('exp');

                // If token will expire in the next 30 minutes, refresh it
                if ($exp - time() < 1800) {
                    try {
                        $newToken = JWTAuth::refresh();
                        session(['jwt_token' => $newToken]);
                    } catch (\Exception $e) {
                    }
                }

                // Get user type from token claims
                $userType = $payload->get('user_type');

                // Add user info to request
                $request->attributes->add([
                    'user' => $user,
                    'user_type' => $userType
                ]);

                return $next($request);

            } catch (TokenExpiredException $e) {
                try {
                    $newToken = JWTAuth::refresh();
                    session(['jwt_token' => $newToken]);

                    // Retry authentication with new token
                    JWTAuth::setToken($newToken);
                    $user = JWTAuth::authenticate();

                    if ($user) {
                        $payload = JWTAuth::getPayload();
                        $request->attributes->add([
                            'user' => $user,
                            'user_type' => $payload->get('user_type')
                        ]);
                        return $next($request);
                    }
                } catch (\Exception $refreshError) {
                    return $this->handleUnauthenticated('Phiên đăng nhập đã hết hạn.');
                }
            }

        } catch (TokenInvalidException $e) {
            return $this->handleUnauthenticated('Token không hợp lệ.');
        } catch (JWTException $e) {
            return $this->handleUnauthenticated('Lỗi xác thực.');
        } catch (\Exception $e) {

            return $this->handleUnauthenticated();
        }

        return $this->handleUnauthenticated('Không thể xác thực người dùng.');
    }

    protected function handleUnauthenticated($message = null)
    {
        session()->forget('jwt_token');

        return redirect()->route('online.login')
            ->with('notification', [
                'message' => 'Vui lòng đăng nhập để tiếp tục.',
                'type' => 'error'
            ]);
    }
}
