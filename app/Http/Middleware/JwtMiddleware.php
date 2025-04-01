<?php

namespace App\Http\Middleware;

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

        try {
            if (!session('jwt_token')) {
                // Create a new token if not exists
                $token = JWTAuth::fromUser(Auth::user());
                session(['jwt_token' => $token]);
            } else {
                // Verify existing token
                JWTAuth::setToken(session('jwt_token'));
                $user = JWTAuth::authenticate();

                if (!$user) {
                    // If token doesn't authenticate a user, create a new one
                    $token = JWTAuth::fromUser(Auth::user());
                    session(['jwt_token' => $token]);
                }
            }
        } catch (TokenExpiredException $e) {
            // If token is expired, refresh it
            try {
                $refreshed = JWTAuth::refresh(session('jwt_token'));
                session(['jwt_token' => $refreshed]);
            } catch (JWTException $e) {
                $token = JWTAuth::fromUser(Auth::user());
                session(['jwt_token' => $token]);
            }
        } catch (TokenInvalidException|JWTException $e) {
            // For any JWT error, generate a new token
            $token = JWTAuth::fromUser(Auth::user());
            session(['jwt_token' => $token]);
        }

        return $next($request);
    }
}
