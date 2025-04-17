<?php

namespace App\Http\Controllers\Online;

use App\Models\Classes;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\ClassSession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OnlineAttendanceDetail;
use App\Models\Employee;
use App\Models\ClassSession;
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
        $class = $query->with(['sessions' => function($query) {
            $query->orderBy('session_date', 'desc');
        }])->findOrFail($class);

        return view('online.attendance.sessions', compact('class'));
    }

    public function detail(Request $request, $id)
    {
        // Load the session with its relationships
        $session = ClassSession::with([
            'class',
            'class.students',
            'attendances.student',
            'schedule'
        ])->findOrFail($id);

        // Calculate attendance statistics
        $totalStudents = $session->class->students->count();
        $presentCount = $session->attendances->where('status', 'present')->count();
        $absentCount = $session->attendances->where('status', 'absent')->count();

        return view('online.attendance.detail', compact('session', 'totalStudents', 'presentCount', 'absentCount'));
        // Lấy thông tin user từ request
        $user = $request->attributes->get('user');
        $userType = $request->attributes->get('user_type');
        
        // Lấy thông tin buổi học
        $session = ClassSession::with(['schedule'])->findOrFail($id);
        
        // Lấy thông tin lớp học của buổi học này
        $class = Classes::with([
            'teacher'
        ])->findOrFail($session->schedule->class_id);
        
        // Kiểm tra quyền truy cập
        if ($userType === 'employee') {
            $employeeRole = $user->role;
            
            // Nếu không phải admin và không phải giáo viên của lớp, chuyển hướng về trang danh sách
            if ($employeeRole !== 'admin' && $class->teacher_id !== $user->id) {
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
        
        // Lấy tỷ lệ điểm danh của mỗi học viên trong lớp này
        foreach ($registrations as $registration) {
            $student = $registration->student;
            
            // Đếm số buổi đã học của học viên này
            $studentAttendances = Attendance::whereHas('session', function($query) use ($class) {
                $query->whereHas('schedule', function($q) use ($class) {
                    $q->where('class_id', $class->id);
                });
            })
            ->where('student_id', $student->id)
            ->get();
            
            $totalSessionsCount = $class->sessions()->count();
            $presentSessionsCount = $studentAttendances->where('status', 'present')->count();
            $absentSessionsCount = $studentAttendances->where('status', 'absent')->count();
            
            $student->attendance_stats = [
                'present_count' => $presentSessionsCount,
                'absent_count' => $absentSessionsCount,
                'total_sessions' => $totalSessionsCount,
                'attendance_rate' => $totalSessionsCount > 0 ? 
                    round(($presentSessionsCount / $totalSessionsCount) * 100) : 0
            ];
            
            // Kiểm tra xem học viên đã được điểm danh trong buổi học này chưa
            $student->current_attendance = $attendances->get($student->id);
            
            // Thêm thông tin đăng ký vào student để xử lý trong view
            $student->registration = $registration;
        }
        
        return view('online.attendance.detail', compact('session', 'class', 'registrations', 'attendances', 'presentCount', 'absentCount', 'totalStudents'));
    }

    public function saveAttendance(Request $request, $id)
    {
        // Lấy thông tin user từ request
        $user = $request->attributes->get('user');
        $userType = $request->attributes->get('user_type');
        
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
        $classExists = $query->whereHas('sessions', function($q) use ($id) {
            $q->where('class_sessions.id', $id);
        })->exists();
        
        if (!$classExists) {
            session()->flash('type', 'error');
            session()->flash('message', 'Bạn không có quyền lưu điểm danh cho buổi học này');
            return response()->json([
                'success' => false
            ], 403);
        }

        // Validate the request
        $validatedData = $request->validate([
            'attendance' => 'required|array',
            'attendance.*.student_id' => 'required',
            'attendance.*.status' => 'required|in:present,absent',
            'attendance.*.notes' => 'nullable|string|max:255',
        ]);

        try {
            // Lấy thông tin buổi học
            $session = ClassSession::findOrFail($id);
            
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
            $registrations = CourseRegistration::where('class_id', $session->schedule->class_id)
                ->where('status', 'active')
                ->pluck('student_id')
                ->toArray();
            
            // Lưu điểm danh cho từng học viên
            foreach ($validatedData['attendance'] as $attendanceData) {
                $studentId = $attendanceData['student_id'];
                $status = $attendanceData['status'];
                $note = $attendanceData['notes'] ?? null;

                // Kiểm tra xem học viên có đăng ký lớp học này không
                if (!in_array($studentId, $registrations)) {
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
            }
            
            // Cập nhật số liệu thống kê cho lớp học
            $this->updateClassAttendanceStats($session->schedule->class_id);
            
            session()->flash('type', 'success');
            session()->flash('message', 'Điểm danh đã được lưu thành công');
            
            return response()->json([
                'success' => true
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
                'success' => false
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
            
            // Lấy danh sách buổi học của lớp
            $sessions = $class->sessions()->get();
            $totalSessions = $sessions->count();
            
            // Lấy số liệu thống kê điểm danh cho mỗi học viên
            foreach ($registrations as $registration) {
                $student = $registration->student;
                
                // Đếm số buổi có mặt và vắng mặt
                $attendances = Attendance::whereIn('session_id', $sessions->pluck('id'))
                    ->where('student_id', $student->id)
                    ->get();
                
                $presentCount = $attendances->whereIn('status', [
                    Attendance::STATUS_PRESENT, 
                    Attendance::STATUS_LATE
                ])->count();
                
                $absentCount = $attendances->where('status', Attendance::STATUS_ABSENT)->count();
                
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