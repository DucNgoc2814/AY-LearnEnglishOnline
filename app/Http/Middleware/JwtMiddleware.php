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
use Illuminate\Support\Facades\Log;

class JwtMiddleware extends BaseMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Skip authentication for login routes
            if ($request->routeIs('online.login') || $request->routeIs('online.login.post')) {
                return $next($request);
            }

            // Check if token exists in session
            $token = session('jwt_token');

            if (!$token) {
                return $this->handleUnauthenticated('Vui lòng đăng nhập để tiếp tục.');
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
                $userType = $payload->get('user_type');

                // If token will expire in the next 30 minutes, refresh it
                if ($exp - time() < 1800) {
                    try {
                        $newToken = JWTAuth::refresh();
                        session(['jwt_token' => $newToken]);
                        Log::info('JWT token refreshed successfully');
                    } catch (\Exception $e) {
                        Log::warning('Failed to refresh token', ['error' => $e->getMessage()]);
                    }
                }

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
                    return $this->handleUnauthenticated('Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại.');
                }
            }

        } catch (TokenInvalidException $e) {
            return $this->handleUnauthenticated('Token không hợp lệ. Vui lòng đăng nhập lại.');
        } catch (JWTException $e) {
            return $this->handleUnauthenticated('Lỗi xác thực. Vui lòng đăng nhập lại.');
        } catch (\Exception $e) {
            return $this->handleUnauthenticated('Có lỗi xảy ra. Vui lòng đăng nhập lại.');
        }

        return $this->handleUnauthenticated('Không thể xác thực người dùng. Vui lòng đăng nhập lại.');
    }

    protected function handleUnauthenticated($message = 'Vui lòng đăng nhập để tiếp tục.')
    {
        session()->forget(['jwt_token', 'user_type', 'user_display_name']);

        if (request()->expectsJson()) {
            return response()->json(['message' => $message], 401);
        }

        return redirect()->route('online.login')
            ->with('notification', [
                'message' => $message,
                'type' => 'error'
            ]);
    }
}
