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
        $this->viewPath = 'admin.class-students';
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
                    // Kiểm tra xem học viên đã được xếp vào lớp này chưa
                    $currentClass = ClassStudent::where('student_id', $student->id)
                        ->where('class_id', $classId)
                        ->first();

                    // Nếu học viên đã có trong lớp này, bỏ qua
                    if ($currentClass) {
                        continue;
                    }

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

                    // Kiểm tra xem học viên có đang học lớp khác không
                    $otherClass = ClassStudent::where('student_id', $student->id)
                        ->where('class_id', '!=', $classId)
                        ->with('class')
                        ->first();

                    if ($otherClass) {
                        $displayText .= sprintf(" (Đang học lớp: %s)", $otherClass->class->name);
                    }

                    $options[$key] = $displayText;
                }
            }

            return response()->json($options);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Validate đầu vào
            $request->validate([
                'class_id' => 'required|exists:classes,id',
                'registration_id' => 'required|array',
                'registration_id.*' => 'required|string',
                'start_date' => 'required|date',
                'notes' => 'nullable|string'
            ]);

            $classId = $request->input('class_id');
            $startDate = $request->input('start_date');
            $notes = $request->input('notes');

            Log::info('Starting to add students to class', [
                'class_id' => $classId,
                'registration_ids' => $request->input('registration_id')
            ]);

            $successCount = 0;
            $skippedCount = 0;
            $errorMessages = [];

            // Tạo các bản ghi ClassStudent cho từng học viên được chọn
            foreach ($request->input('registration_id') as $registrationKey) {
                $parts = explode('-', $registrationKey);
                if (count($parts) !== 2) {
                    Log::warning('Invalid registration key format', ['key' => $registrationKey]);
                    $errorMessages[] = "Định dạng key không hợp lệ: $registrationKey";
                    continue;
                }

                $registrationId = $parts[0];
                $studentId = $parts[1];

                Log::info('Processing student', [
                    'registration_id' => $registrationId,
                    'student_id' => $studentId
                ]);

                try {
                    // Kiểm tra xem học viên đã được xếp vào lớp này chưa
                    $existingClassStudent = ClassStudent::where('student_id', $studentId)
                        ->where('class_id', $classId)
                        ->first();

                    if ($existingClassStudent) {
                        Log::info('Student already in class', [
                            'student_id' => $studentId,
                            'class_id' => $classId
                        ]);
                        $skippedCount++;
                        continue;
                    }

                    // Kiểm tra xem học viên có đang học lớp khác không
                    $otherClass = ClassStudent::where('student_id', $studentId)
                        ->where('class_id', '!=', $classId)
                        ->first();

                    if ($otherClass) {
                        Log::info('Student is in another class', [
                            'student_id' => $studentId,
                            'old_class_id' => $otherClass->class_id
                        ]);
                        // Nếu học viên đang học lớp khác, xóa bản ghi cũ
                        $otherClass->delete();
                    }

                    // Tạo bản ghi mới
                    ClassStudent::create([
                        'class_id' => $classId,
                        'student_id' => $studentId,
                        'registration_id' => $registrationId,
                        'start_date' => $startDate,
                        'notes' => $notes
                    ]);

                    Log::info('Successfully added student to class', [
                        'student_id' => $studentId,
                        'class_id' => $classId
                    ]);

                    $successCount++;
                } catch (\Exception $e) {
                    Log::error("Error adding student", [
                        'registration_id' => $registrationId,
                        'student_id' => $studentId,
                        'error' => $e->getMessage()
                    ]);
                    $errorMessages[] = "Không thể thêm học viên với mã đăng ký {$registrationId}";
                }
            }

            DB::commit();

            Log::info('Finished adding students', [
                'success_count' => $successCount,
                'skipped_count' => $skippedCount,
                'error_count' => count($errorMessages)
            ]);

            if ($successCount > 0) {
                $message = "Đã xếp thành công $successCount học viên vào lớp.";
                if ($skippedCount > 0) {
                    $message .= " Bỏ qua $skippedCount học viên đã có trong lớp.";
                }
                if (!empty($errorMessages)) {
                    $message .= " Có lỗi với một số học viên: " . implode(", ", $errorMessages);
                }
                return redirect()->route($this->route . '.index')
                    ->with('success', $message);
            } else {
                if ($skippedCount > 0) {
                    return back()->with('warning', "Tất cả học viên đã có trong lớp này.")->withInput();
                }
                return back()->withErrors(['error' => implode(", ", $errorMessages)])->withInput();
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating class students', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withErrors(['error' => 'Có lỗi xảy ra khi xếp lớp cho học viên: ' . $e->getMessage()])->withInput();
        }
    }
}
