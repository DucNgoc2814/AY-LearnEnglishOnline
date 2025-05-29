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
                return response()->json(['error' => 'Class ID is required'], 400);
            }

            $class = Classes::findOrFail($classId);

            // Lấy danh sách học viên đã đăng ký khóa học tương ứng với lớp
            $registrations = CourseRegistration::where('course_id', $class->course_id)
                ->where('status', 'active')
                ->whereDoesntHave('classStudents', function($query) {
                    $query->where('status', 'active');
                })
                ->get();

            $options = [];
            foreach ($registrations as $registration) {
                // Lấy danh sách học viên từ bảng trung gian
                $students = DB::table('course_registration_student')
                    ->join('students', 'students.id', '=', 'course_registration_student.student_id')
                    ->where('course_registration_student.course_registration_id', $registration->id)
                    ->whereNull('students.deleted_at')
                    ->select('students.*')
                    ->get();

                foreach ($students as $student) {
                    $key = $registration->id . '-' . $student->id;
                    // Loại bỏ prefix HD nếu đã có trong invoice_number
                    $invoiceNumber = $registration->invoice_number;
                    if (!str_starts_with($invoiceNumber, 'HD')) {
                        $invoiceNumber = 'HD' . $invoiceNumber;
                    }

                    $options[$key] = sprintf(
                        "%s - %s",
                        $student->full_name,
                        $invoiceNumber
                    );
                }
            }

            return response()->json($options);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
