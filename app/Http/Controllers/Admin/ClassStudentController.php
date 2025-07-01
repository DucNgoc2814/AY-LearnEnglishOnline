<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClassStudent;
use App\Models\Classes;
use App\Models\CourseRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ClassStudentController extends BaseController
{
    protected $pageTitle = 'Danh sách học viên';
    public function __construct()
    {
        $this->model = ClassStudent::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.class-students';
        parent::__construct();
    }

    /**
     * Get students for a class
     */
    public function getStudents(Request $request)
    {
        try {
            $classId = $request->input('class_id');
            if (!$classId) {
                return response()->json(['error' => 'Vui lòng chọn lớp học'], 400);
            }

            $class = Classes::findOrFail($classId);

            // Get all registrations for this course that don't have a class assignment
            $availableStudents = DB::table('course_registrations as cr')
                ->join('course_registration_student as crs', 'cr.id', '=', 'crs.course_registration_id')
                ->join('students as s', 's.id', '=', 'crs.student_id')
                ->leftJoin('class_students as cs', function($join) {
                    $join->on('cr.id', '=', 'cs.registration_id')
                         ->whereNull('cs.deleted_at');
                })
                ->where('cr.course_id', $class->course_id)
                ->whereNull('s.deleted_at')
                ->whereNull('cs.id')
                ->select(
                    DB::raw("CONCAT(cr.id, '-', s.id) as id"),
                    's.full_name'
                )
                ->distinct()
                ->get();

            $options = [];
            foreach ($availableStudents as $student) {
                // Create display text with just the student name
                $options[$student->id] = $student->full_name;
            }

            return response()->json($options);
        } catch (\Exception $e) {
            Log::error('Lỗi trong quá trình lấy danh sách học viên: ' . $e->getMessage());
            Log::error('Chi tiết lỗi: ' . $e->getTraceAsString());
            return response()->json(['error' => 'Đã xảy ra lỗi hệ thống'], 500);
        }
    }
}
