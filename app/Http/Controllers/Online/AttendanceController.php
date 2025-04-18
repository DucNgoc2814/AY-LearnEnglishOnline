<?php

namespace App\Http\Controllers\Online;

use App\Models\Classes;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\ClassSession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OnlineAttendanceDetail;
use App\Models\CourseRegistration;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    /**
     * Display attendance index.
     */
    public function index(Request $request)
    {
        // Lấy thông tin user từ request
        $user = $request->attributes->get('user');
        $userType = $request->attributes->get('user_type');

        $query = Classes::with(['teacher', 'sessions', 'students']);

        // Phân quyền hiển thị lớp học
        if ($userType === 'employee') {
            $employeeRole = $user->role;

            // Nếu là teacher hoặc teaching_assistant thì chỉ xem lớp của mình
            if (in_array($employeeRole, ['teacher', 'teaching_assistant'])) {
                $query->where('teacher_id', $user->id);
            }
            // Nếu là admin thì xem tất cả (mặc định)
        }

        // Filter by teacher_id if provided in request
        if ($request->has('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
        }

        // Filter by status if provided
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Filter by course_type if provided
        if ($request->has('course_type') && !empty($request->course_type)) {
            $query->where('course_type', $request->course_type);
        }

        // Filter by level if provided
        if ($request->has('level') && !empty($request->level)) {
            $query->where('level', $request->level);
        }

        $classes = $query->orderBy('start_date', 'desc')
            ->get()
            ->map(function ($class) {
                $totalSessions = $class->sessions->count();
                $completedSessions = $class->sessions->where('status', 'completed')->count();

                return [
                    'id' => $class->id,
                    'code' => $class->code,
                    'name' => $class->name,
                    'status' => $class->status,
                    'student_count' => $class->students->count(),
                    'schedule' => $class->schedule,
                    'teacher_name' => $class->teacher ? $class->teacher->name : 'N/A',
                    'teacher_id' => $class->teacher_id,
                    'progress' => [
                        'completed' => $completedSessions,
                        'total' => $totalSessions,
                        'percentage' => $totalSessions > 0 ? ($completedSessions / $totalSessions * 100) : 0
                    ]
                ];
            });

        // Get list of teachers for the filter dropdown
        $teachers = Employee::where('role', 'teacher')->get();

        // Check if current user is admin to toggle filter visibility
        $isAdmin = ($userType === 'employee' && $user->role === 'admin');

        return view('online.attendance.index', compact('classes', 'teachers', 'isAdmin'));
    }

    /**
     * Display class attendance.
     */
    public function show(Request $request, $classId)
    {
        // Lấy thông tin user từ request
        $user = $request->attributes->get('user');
        $userType = $request->attributes->get('user_type');

        // Query builder để kiểm tra quyền trước khi load
        $query = Classes::query();

        // Phân quyền hiển thị lớp học
        if ($userType === 'employee') {
            $employeeRole = $user->role;

            // Nếu là teacher hoặc teaching_assistant thì chỉ xem lớp của mình
            if (in_array($employeeRole, ['teacher', 'teaching_assistant'])) {
                $query->where('teacher_id', $user->id);
            }
            // Nếu là admin thì xem tất cả (mặc định)
        }

        // Kiểm tra lớp có tồn tại và người dùng có quyền xem không
        $exists = $query->where('id', $classId)->exists();

        if (!$exists) {
            return redirect()->route('online.attendance.index')
                ->with('notification', [
                    'message' => 'Bạn không có quyền truy cập lớp này hoặc lớp không tồn tại.',
                    'type' => 'error'
                ]);
        }

        return view('online.attendance.show', compact('classId'));
    }

    public function sessions(Request $request, $class)
    {
        // Lấy thông tin user từ request
        $user = $request->attributes->get('user');
        $userType = $request->attributes->get('user_type');

        // Query builder để kiểm tra quyền trước khi load
        $query = Classes::query();

        // Phân quyền hiển thị lớp học
        if ($userType === 'employee') {
            $employeeRole = $user->role;

            // Nếu là teacher hoặc teaching_assistant thì chỉ xem lớp của mình
            if (in_array($employeeRole, ['teacher', 'teaching_assistant'])) {
                $query->where('teacher_id', $user->id);
            }
            // Nếu là admin thì xem tất cả (mặc định)
        }

        // Load the class with its sessions
        $class = $query->with(['sessions' => function ($query) {
            $query->orderBy('session_date', 'desc');
        }])->findOrFail($class);

        return view('online.attendance.sessions', compact('class'));
    }

    public function detail(Request $request, $id)
    {
        // Load the session với attendances và schedule
        $session = ClassSession::with([
            'attendances.student',
            'schedule'
        ])->findOrFail($id);
        
        // Lấy thông tin user từ request
        $user = $request->attributes->get('user');
        $userType = $request->attributes->get('user_type');
        
        // Lấy thông tin lớp học từ schedule
        $schedule = $session->schedule;
        
        if (!$schedule) {
            return redirect()->route('online.attendance.index')
                ->with('notification', [
                    'message' => 'Không tìm thấy lịch học cho buổi học này.',
                    'type' => 'error'
                ]);
        }
        
        $class = Classes::findOrFail($schedule->class_id);
        
        // Kiểm tra quyền truy cập
        if ($userType === 'employee') {
            $employeeRole = $user->role;
            
            // Nếu không phải admin và không phải giáo viên của lớp, chuyển hướng về trang danh sách
            if ($employeeRole !== 'admin' && $employeeRole !== 'teacher' && $class->teacher_id !== $user->id) {
                return redirect()->route('online.attendance.index')
                    ->with('notification', [
                        'message' => 'Bạn không có quyền truy cập buổi học này.',
                        'type' => 'error'
                    ]);
            }
        }

        // Lấy danh sách học viên đã đăng ký khóa học từ bảng trung gian
        $registrations = CourseRegistration::where('class_id', $class->id)
            ->where('status', 'active')  // Chỉ lấy những học viên có trạng thái active
            ->with('student')
            ->get();
        
        // Lấy danh sách điểm danh hiện tại của buổi học này
        $attendances = Attendance::where('session_id', $id)
            ->get()
            ->keyBy('student_id');
        
        // Đếm số học viên có mặt/vắng mặt
        $presentCount = $attendances->where('status', 'present')->count();
        $absentCount = $attendances->where('status', 'absent')->count();
        $totalStudents = $registrations->count();
        
        // Xử lý thông tin điểm danh cho từng học viên
        foreach ($registrations as $registration) {
            $student = $registration->student;
            
            // Gán attendance hiện tại cho student để truy cập trong view
            $student->current_attendance = $attendances->get($student->id);
            
            // Lấy tất cả các buổi học của lớp
            $classSessions = ClassSession::whereHas('schedule', function($query) use ($class) {
                $query->where('class_id', $class->id);
            })->get();
            
            $totalSessions = $classSessions->count();
            $sessionIds = $classSessions->pluck('id')->toArray();
            
            // Đếm số buổi học sinh đã tham gia
            $attendedCount = Attendance::whereIn('session_id', $sessionIds)
                ->where('student_id', $student->id)
                ->whereIn('status', ['present', 'late'])
                ->count();
            
            $absentCount = Attendance::whereIn('session_id', $sessionIds)
                ->where('student_id', $student->id)
                ->where('status', 'absent')
                ->count();
            
            // Tạo thông tin thống kê
            $student->attendance_stats = [
                'present_count' => $attendedCount,
                'absent_count' => $absentCount,
                'total_sessions' => $totalSessions,
                'attendance_rate' => $totalSessions > 0 ? round(($attendedCount / $totalSessions) * 100) : 0
            ];
        }
        
        // Tạo biến classSession cho view
        $classSession = $session;
        
        return view('online.attendance.detail', compact('session', 'class', 'registrations', 'attendances', 'presentCount', 'absentCount', 'totalStudents', 'classSession'));
    }

    public function saveAttendance(Request $request, $id)
    {
        // Lấy thông tin user từ request
        $user = $request->attributes->get('user');
        $userType = $request->attributes->get('user_type');

        try {
            // Log input data để debug
            Log::info('SaveAttendance input data', [
                'session_id' => $id,
                'request_data' => $request->all()
            ]);

            // Lấy thông tin buổi học và schedule liên quan
            $session = ClassSession::with('schedule')->findOrFail($id);
            $schedule = $session->schedule;
            
            if (!$schedule) {
                Log::error('Schedule not found for session', ['session_id' => $id]);
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy lịch học cho buổi học này'
                ], 404);
            }
            
            // Kiểm tra quyền lưu điểm danh
            $query = Classes::query();

            if ($userType === 'employee') {
                $employeeRole = $user->role;

                // Nếu là teacher hoặc teaching_assistant thì chỉ lưu điểm danh lớp của mình
                if (in_array($employeeRole, ['teacher', 'teaching_assistant'])) {
                    $query->where('teacher_id', $user->id);
                }
                // Nếu là admin thì có thể lưu điểm danh tất cả (mặc định)
            }

            // Kiểm tra session thuộc về một lớp mà người dùng có quyền
            $classExists = $query->where('id', $schedule->class_id)
                ->exists();

            if (!$classExists) {
                Log::warning('User does not have permission', [
                    'user_id' => $user->id,
                    'user_type' => $userType,
                    'class_id' => $schedule->class_id
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn không có quyền lưu điểm danh cho buổi học này'
                ], 403);
            }

            // Validate the request
            $attendance = $request->input('attendance', []);
            
            if (empty($attendance)) {
                Log::error('Empty attendance data', ['session_id' => $id]);
                return response()->json([
                    'success' => false,
                    'message' => 'Dữ liệu điểm danh không hợp lệ'
                ], 400);
            }

            // Đánh dấu session này đã được điểm danh bằng cách lưu trạng thái trong notes
            $notes = json_decode($session->notes ?? '{}', true) ?: [];
            $notes['attendance'] = [
                'taken' => true,
                'taken_at' => now()->toDateTimeString(),
                'taken_by' => $user->id,
                'user_type' => $userType
            ];

            $session->update([
                'notes' => json_encode($notes)
            ]);

            // Lấy danh sách học viên đã đăng ký lớp học
            $registrations = CourseRegistration::where('class_id', $schedule->class_id)
                ->where('status', 'active')
                ->pluck('student_id')
                ->toArray();

            Log::info('Processing attendance data', [
                'session_id' => $id,
                'student_count' => count($attendance)
            ]);

            // Lưu điểm danh cho từng học viên
            foreach ($attendance as $attendanceData) {
                $studentId = $attendanceData['student_id'] ?? null;
                $status = $attendanceData['status'] ?? 'absent';
                $note = $attendanceData['notes'] ?? null;

                if (!$studentId) {
                    continue; // Bỏ qua nếu không có ID học viên
                }

                // Kiểm tra xem học viên có đăng ký lớp học này không
                if (!in_array($studentId, $registrations)) {
                    Log::warning('Student not registered for class', [
                        'student_id' => $studentId,
                        'class_id' => $schedule->class_id
                    ]);
                    continue; // Bỏ qua nếu học viên không đăng ký lớp này
                }

                // Tìm bản ghi điểm danh hiện có hoặc tạo mới
                $attendance = Attendance::firstOrNew([
                    'session_id' => $id,
                    'student_id' => $studentId
                ]);

                // Cập nhật thông tin điểm danh
                $attendance->notes = $note;
                $attendance->status = $status;
                $attendance->save();
                
                Log::info('Saved attendance for student', [
                    'student_id' => $studentId,
                    'status' => $status
                ]);
            }

            // Cập nhật số liệu thống kê cho lớp học
            $this->updateClassAttendanceStats($schedule->class_id);

            session()->flash('type', 'success');
            session()->flash('message', 'Điểm danh đã được lưu thành công');

            return response()->json([
                'success' => true,
                'message' => 'Điểm danh đã được lưu thành công'
            ]);
        } catch (\Exception $e) {
            Log::error('Error in saveAttendance', [
                'session_id' => $id,
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            session()->flash('type', 'error');
            session()->flash('message', 'Có lỗi xảy ra khi lưu điểm danh');

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lưu điểm danh: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cập nhật thống kê điểm danh cho lớp học
     */
    private function updateClassAttendanceStats($classId)
    {
        try {
            $class = Classes::findOrFail($classId);

            // Lấy danh sách học viên đã đăng ký lớp học
            $registrations = CourseRegistration::where('class_id', $classId)
                ->where('status', 'active')
                ->with('student')
                ->get();

            // Lấy danh sách buổi học của lớp thông qua bảng class_schedules
            $sessions = ClassSession::whereHas('schedule', function($query) use ($classId) {
                $query->where('class_id', $classId);
            })->get();
            
            $totalSessions = $sessions->count();
            $sessionIds = $sessions->pluck('id')->toArray();

            // Lấy số liệu thống kê điểm danh cho mỗi học viên
            foreach ($registrations as $registration) {
                $student = $registration->student;

                // Đếm số buổi có mặt và vắng mặt
                $attendances = Attendance::whereIn('session_id', $sessionIds)
                    ->where('student_id', $student->id)
                    ->get();

                $presentCount = $attendances->whereIn('status', [
                    'present',
                    'late'
                ])->count();

                $absentCount = $attendances->where('status', 'absent')->count();

                // Lưu thông tin thống kê vào meta data hoặc ghi chú
                $notes = json_decode($registration->notes ?? '{}', true) ?: [];
                $notes['attendance_stats'] = [
                    'present_count' => $presentCount,
                    'absent_count' => $absentCount,
                    'total_sessions' => $totalSessions,
                    'attendance_rate' => $totalSessions > 0 ? round(($presentCount / $totalSessions) * 100) : 0,
                    'last_updated' => now()->toDateTimeString()
                ];

                // Cập nhật thông tin trong bảng registrations
                $registration->update([
                    'notes' => json_encode($notes)
                ]);
            }

            return true;
        } catch (\Exception $e) {
            Log::error('Lỗi khi cập nhật thống kê điểm danh: ' . $e->getMessage(), [
                'class_id' => $classId,
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }
}
