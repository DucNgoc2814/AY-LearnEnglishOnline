<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Course;
use App\Models\Enrollment;

class CheckCourseAccess
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $courseSlug = $request->route('courseSlug');
        
        // Kiểm tra user đã đăng nhập chưa
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Vui lòng đăng nhập để truy cập khóa học');
        }

        $user = auth()->user();
        
        // Lấy thông tin khóa học
        $course = Course::where('slug', $courseSlug)->first();
        
        if (!$course) {
            abort(404, 'Không tìm thấy khóa học');
        }

        // Kiểm tra xem user đã enrolled khóa học chưa
        $hasEnrolled = Enrollment::where('userId', $user->id)
            ->where('courseId', $course->id)
            ->where('status', 'active') // hoặc trạng thái phù hợp với hệ thống của bạn
            ->exists();
            

        // Nếu là khóa học miễn phí
        if ($course->is_free) {
            return $next($request);
        }

        // Kiểm tra nếu user đã enrolled khóa học
        if (!$hasEnrolled) {
            return redirect()->route('detailCourse', $courseSlug)
            ->with('notification', [
                'message' => 'Bạn cần đăng ký khóa học này để truy cập.',
                'type' => 'error'
            ]);
        }   

        return $next($request);
    }
} 