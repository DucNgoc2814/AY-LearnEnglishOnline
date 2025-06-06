<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class OnlineClassLessonController extends Controller
{
    /**
     * Hiển thị danh sách bài học của lớp học
     */
    public function index(Request $request, $id)
    {
        // Lấy thông tin lớp học
        $class = Classes::findOrFail($id);

        // Lấy khóa học tương ứng với lớp học
        $course = Course::findOrFail($class->course_id);

        // Lấy danh sách bài học của khóa học, sắp xếp theo order_number
        $lessons = Lesson::where('course_id', $course->id)
            ->orderBy('order_number', 'asc')
            ->get();

        return view('online.classes.partials.materials', [
            'class' => $class,
            'course' => $course,
            'lessons' => $lessons
        ]);
    }
}
