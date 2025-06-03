<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class RedirectIfNotOnline
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $token = session('jwt_token');

            if (!$token) {
                Log::warning('No JWT token found in session for online access');
                return redirect()->route('online.login')
                    ->with('notification', [
                        'message' => 'Vui lòng đăng nhập để tiếp tục.',
                        'type' => 'error'
                    ]);
            }

            JWTAuth::setToken($token);
            $user = JWTAuth::authenticate();

            if (!$user) {
                Log::warning('Invalid JWT token for online access');
                return redirect()->route('online.login')
                    ->with('notification', [
                        'message' => 'Phiên đăng nhập không hợp lệ. Vui lòng đăng nhập lại.',
                        'type' => 'error'
                    ]);
            }

            return $next($request);

        } catch (\Exception $e) {
            Log::error('Error in RedirectIfNotOnline middleware', [
                'error' => $e->getMessage()
            ]);

            return redirect()->route('online.login')
                ->with('notification', [
                    'message' => 'Có lỗi xảy ra. Vui lòng đăng nhập lại.',
                    'type' => 'error'
                ]);
        }
    }
}
