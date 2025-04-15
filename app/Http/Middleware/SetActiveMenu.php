<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetActiveMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // Xác định menu nào đang active
        $activeMenu = 'dashboard';
        
        if ($request->is('online/attendance*')) {
            $activeMenu = 'attendance';
        } elseif ($request->is('online/schedule*')) {
            $activeMenu = 'schedule';
        } elseif ($request->is('online/classes*')) {
            $activeMenu = 'classes';
        }
        
        // Đặt biến active menu để sử dụng trong views
        view()->share('activeMenu', $activeMenu);
        
        return $response;
    }
} 