<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Hiển thị danh sách khóa học
     */
    public function index()
    {
        // Lấy ID của học viên đang đăng nhập
        $studentId = Auth::guard('student')->id();

        // Kiểm tra quyền truy cập cho từng khóa học
        $hasAccessToCourse1 = $this->checkCourseAccess(1, $studentId);
        $hasAccessToCourse2 = $this->checkCourseAccess(2, $studentId);
        $hasAccessToCourse3 = $this->checkCourseAccess(3, $studentId);
        $hasAccessToCourse4 = $this->checkCourseAccess(4, $studentId);

        return view('online.classes.index', compact(
            'hasAccessToCourse1',
            'hasAccessToCourse2',
            'hasAccessToCourse3',
            'hasAccessToCourse4'
        ));
    }

    /**
     * Hiển thị chi tiết khóa học 1
     */
    public function show1()
    {
        if (!$this->checkCourseAccess(1, Auth::guard('student')->id())) {
            return redirect()->route('online.courses.index')
                ->with('error', 'Bạn chưa đăng ký khóa học này');
        }

        $stats = $this->getCourseStats(1);
        return view('online.classes.show', compact('stats'));
    }

    /**
     * Hiển thị chi tiết khóa học 2
     */
    public function show2()
    {
        if (!$this->checkCourseAccess(2, Auth::guard('student')->id())) {
            return redirect()->route('online.courses.index')
                ->with('error', 'Bạn chưa đăng ký khóa học này');
        }

        $stats = $this->getCourseStats(2);
        return view('online.classes.show2', compact('stats'));
    }

    /**
     * Hiển thị chi tiết khóa học 3
     */
    public function show3()
    {
        if (!$this->checkCourseAccess(3, Auth::guard('student')->id())) {
            return redirect()->route('online.courses.index')
                ->with('error', 'Bạn chưa đăng ký khóa học này');
        }

        $stats = $this->getCourseStats(3);
        return view('online.classes.show3', compact('stats'));
    }

    /**
     * Hiển thị chi tiết khóa học 4
     */
    public function show4()
    {
        if (!$this->checkCourseAccess(4, Auth::guard('student')->id())) {
            return redirect()->route('online.courses.index')
                ->with('error', 'Bạn chưa đăng ký khóa học này');
        }

        $stats = $this->getCourseStats(4);
        return view('online.classes.show4', compact('stats'));
    }

    /**
     * Kiểm tra quyền truy cập khóa học
     */
    private function checkCourseAccess($courseId, $studentId)
    {
        return CourseRegistration::whereHas('students', function($query) use ($studentId) {
                $query->where('student_id', $studentId);
            })
            ->where('course_id', $courseId)
            ->exists();
    }

    /**
     * Lấy thống kê của khóa học
     */
    private function getCourseStats($courseId)
    {
        // Giả lập dữ liệu thống kê
        // Trong thực tế bạn sẽ lấy từ database
        return [
            'completed_lessons' => rand(0, 24),
            'completion_rate' => rand(0, 100),
            'total_exercises' => rand(10, 30)
        ];
    }
}
