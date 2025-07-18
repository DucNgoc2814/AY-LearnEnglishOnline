<?php

namespace App\Http\Middleware;

use App\Models\CourseRegistration;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckCourseAccess
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
        // Lấy ID khóa học từ route parameter
        $courseId = $request->route('id');

        // Lấy ID học viên đang đăng nhập
        $studentId = Auth::guard('student')->id();

        // Kiểm tra quyền truy cập
        $hasAccess = CourseRegistration::whereHas('students', function($query) use ($studentId) {
                $query->where('student_id', $studentId);
            })
            ->where('course_id', $courseId)
            ->exists();

        if (!$hasAccess) {
            return redirect()->route('online.courses.index')
                ->with('error', 'Bạn chưa đăng ký khóa học này');
        }

        return $next($request);
    }
}
