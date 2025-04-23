<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class DebugRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Ghi log thông tin request
        $routeName = Route::currentRouteName() ?? 'unnamed route';
        $routeAction = Route::currentRouteAction() ?? 'unknown action';
        $session_data = $request->session()->all();
        
        // Log chi tiết
        Log::info('DEBUG REQUEST DETAILS', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'route_name' => $routeName,
            'route_action' => $routeAction,
            'user_id' => session('user_id'),
            'request_path' => $request->path(),
            'request_ip' => $request->ip(),
            'session_data' => json_encode(array_keys($session_data)),
            'middleware' => $request->route()->middleware(),
            'request_parameters' => $request->all()
        ]);
        
        // Nếu là route debug, thêm thông tin để debug
        if (strpos($routeName, 'test') !== false || strpos($request->path(), 'test') !== false) {
            $debug_info = [
                'debug_time' => now()->format('Y-m-d H:i:s'),
                'route_info' => [
                    'name' => $routeName,
                    'action' => $routeAction,
                    'path' => $request->path(),
                    'full_url' => $request->fullUrl()
                ],
                'user_info' => [
                    'user_id' => session('user_id'),
                    'is_logged_in' => session('user_id') ? true : false
                ]
            ];
            
            // Lưu thông tin vào session để có thể truy cập ở view
            session(['debug_info' => $debug_info]);
        }
        
        return $next($request);
    }
} 