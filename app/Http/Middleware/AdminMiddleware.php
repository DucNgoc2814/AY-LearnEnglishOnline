<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa và có phải là admin không
        if (!Auth::guard('employee')->check() || Auth::guard('employee')->user()->role !== 'admin') {
            return redirect()->route('admin.login')->with('error', 'Bạn không có quyền truy cập trang này.');
        }

        return $next($request);
    }
}
