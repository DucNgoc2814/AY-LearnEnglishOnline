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
                    // Kiểm tra xem học viên đã được xếp vào lớp nào chưa
                    $currentClass = ClassStudent::where('registration_id', $registration->id)
                        ->where('status', 'active')
                        ->with('class')
                        ->first();

                    $key = $registration->id . '-' . $student->id;

                    // Loại bỏ prefix HD nếu đã có trong invoice_number
                    $invoiceNumber = $registration->invoice_number;
                    if (!str_starts_with($invoiceNumber, 'HD')) {
                        $invoiceNumber = 'HD' . $invoiceNumber;
                    }

                    // Thêm thông tin lớp học hiện tại nếu có
                    $displayText = sprintf(
                        "%s - %s",
                        $student->full_name,
                        $invoiceNumber
                    );

                    if ($currentClass) {
                        // Chỉ hiển thị thông tin lớp nếu học viên đang học lớp khác với lớp đang chọn
                        if ($currentClass->class_id != $classId) {
                            $displayText .= sprintf(" (Đang học lớp: %s)", $currentClass->class->name);
                        }
                    }

                    $options[$key] = $displayText;
                }
            }

            return response()->json($options);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
