<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Hiển thị danh sách khóa học
     */
    public function index()
    {
        // Kiểm tra quyền truy cập cho từng khóa học
        $hasAccessToCourse1 = true; // Tạm thời set true để test
        $hasAccessToCourse2 = true;
        $hasAccessToCourse3 = true;
        $hasAccessToCourse4 = true;

        return view('online.classes.index', compact(
            'hasAccessToCourse1',
            'hasAccessToCourse2',
            'hasAccessToCourse3',
            'hasAccessToCourse4'
        ));
    }

    /**
     * Hiển thị khóa học 1 - Basic
     */
    public function show1()
    {
        $stats = [
            'completed_lessons' => 5,
            'completion_rate' => 33,
            'total_exercises' => 30
        ];

        $class = (object)[
            'id' => 1, // Thêm id
            'name' => 'Basic IELTS Course',
            'code' => 'IELTS-BASIC',
            'teacher' => (object)[
                'name' => 'John Smith'
            ],
            'students' => collect([1,2,3,4,5]), // Giả lập 5 học viên
            'formatted_schedule' => 'Mon, Wed, Fri',
            'status' => 'active'
        ];

        return view('online.classes.show', compact('stats', 'class'));
    }

    /**
     * Hiển thị khóa học 2 - Intermediate
     */
    public function show2()
    {
        $stats = [
            'completed_lessons' => 3,
            'completion_rate' => 21,
            'total_exercises' => 28
        ];

        $class = (object)[
            'id' => 2, // Thêm id
            'name' => 'Intermediate IELTS Course',
            'code' => 'IELTS-INT',
            'teacher' => (object)[
                'name' => 'Mary Johnson'
            ],
            'students' => collect([1,2,3,4,5,6]), // Giả lập 6 học viên
            'formatted_schedule' => 'Tue, Thu, Sat',
            'status' => 'active'
        ];

        return view('online.classes.show2', compact('stats', 'class'));
    }

    /**
     * Hiển thị khóa học 3 - Advanced
     */
    public function show3()
    {
        $stats = [
            'completed_lessons' => 8,
            'completion_rate' => 40,
            'total_exercises' => 40
        ];

        $class = (object)[
            'id' => 3, // Thêm id
            'name' => 'Advanced IELTS Course',
            'code' => 'IELTS-ADV',
            'teacher' => (object)[
                'name' => 'David Wilson'
            ],
            'students' => collect([1,2,3,4,5,6,7]), // Giả lập 7 học viên
            'formatted_schedule' => 'Mon, Wed, Fri',
            'status' => 'active'
        ];

        return view('online.classes.show3', compact('stats', 'class'));
    }

    /**
     * Hiển thị khóa học 4 - Expert
     */
    public function show4()
    {
        $stats = [
            'completed_lessons' => 10,
            'completion_rate' => 48,
            'total_exercises' => 42
        ];

        $class = (object)[
            'id' => 4, // Thêm id
            'name' => 'Expert IELTS Course',
            'code' => 'IELTS-EXP',
            'teacher' => (object)[
                'name' => 'Sarah Brown'
            ],
            'students' => collect([1,2,3,4,5,6,7,8]), // Giả lập 8 học viên
            'formatted_schedule' => 'Tue, Thu, Sat',
            'status' => 'active'
        ];

        return view('online.classes.show4', compact('stats', 'class'));
    }
}
