<?php

namespace App\Http\Controllers\Online\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassRoom;
use App\Models\Session;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ClassController extends Controller
{
    /**
     * Display a listing of classes for the teacher.
     */
    public function index()
    {
        try {
            // Lấy ID giảng viên từ session
            $teacherId = session('user_id');
            
            if (!$teacherId) {
                return view('online.teacher.classes.index', [
                    'currentClasses' => collect(),
                    'upcomingClasses' => collect(),
                    'completedClasses' => collect(),
                    'error' => 'Không tìm thấy thông tin giảng viên. Vui lòng đăng nhập lại.'
                ]);
            }
            
            // Kiểm tra xem có tồn tại giáo viên với ID này không
            $teacher = \App\Models\Employee::find($teacherId);
            if (!$teacher) {
                Log::warning('Teacher not found with ID: ' . $teacherId);
            } else {
                Log::info('Teacher found: ' . $teacher->name);
            }
            
            // Thêm điều kiện rõ ràng khi truy vấn
            $classes = ClassRoom::where(function($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId)
                      ->orWhere('assistant_id', $teacherId);
            })
            ->with([
                'students',
                'sessions' => function($query) {
                    $query->orderBy('session_date', 'asc');
                },
                'sessions.attendances'
            ])
            ->get();
            
            // In ra log để kiểm tra dữ liệu
            Log::info('Teacher ID: ' . $teacherId);
            Log::info('Classes count: ' . $classes->count());
            
            $now = Carbon::now();
            
            // Tính toán thống kê cho mỗi lớp học
            foreach ($classes as $class) {
                $totalStudents = $class->students->count();
                $totalSessions = $class->sessions->count();
                $totalAttendances = $class->sessions->pluck('attendances')->flatten()->count();
                
                // Tính tỷ lệ điểm danh
                $attendanceRate = 0;
                if ($totalStudents > 0 && $totalSessions > 0) {
                    $expectedAttendances = $totalStudents * $totalSessions;
                    $attendanceRate = $expectedAttendances > 0 
                        ? round(($totalAttendances / $expectedAttendances) * 100) 
                        : 0;
                }
                
                $class->stats = [
                    'total_students' => $totalStudents,
                    'total_sessions' => $totalSessions,
                    'total_attendances' => $totalAttendances,
                    'attendance_rate' => $attendanceRate
                ];
                
                // Format lịch học
                $schedules = $class->schedule ?? [];
                $scheduleDays = [];
                
                if (is_string($schedules)) {
                    $schedules = json_decode($schedules, true) ?? [];
                }
                
                foreach ((array)$schedules as $day => $times) {
                    $dayName = ['Chủ nhật', 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7'][$day % 7];
                    $scheduleDays[] = $dayName;
                }
                
                $class->formatted_schedule = !empty($scheduleDays) 
                    ? implode(', ', $scheduleDays) 
                    : 'Chưa có lịch cụ thể';
            }
            
            // Phân loại lớp học
            $currentClasses = $classes->filter(function($class) use ($now) {
                return $class->status === 'active' || 
                    ($class->start_date <= $now && $class->end_date >= $now);
            });
            
            $upcomingClasses = $classes->filter(function($class) use ($now) {
                return $class->status === 'pending' || 
                    ($class->start_date > $now);
            });
            
            $completedClasses = $classes->filter(function($class) use ($now) {
                return $class->status === 'completed' || 
                    ($class->end_date < $now);
            });
            
            return view('online.teacher.classes.index', [
                'currentClasses' => $currentClasses,
                'upcomingClasses' => $upcomingClasses,
                'completedClasses' => $completedClasses
            ]);
            
        } catch (\Exception $e) {
            Log::error('Lỗi hiển thị lớp học giảng viên: ' . $e->getMessage());
            
            // Nếu đang ở môi trường phát triển, hiển thị chi tiết lỗi
            if (config('app.debug')) {
                return view('online.teacher.classes.index', [
                    'currentClasses' => collect(),
                    'upcomingClasses' => collect(),
                    'completedClasses' => collect(),
                    'error' => 'Lỗi: ' . $e->getMessage()
                ]);
            }
            
            // Môi trường production, hiển thị thông báo chung
            return view('online.teacher.classes.index', [
                'currentClasses' => collect(),
                'upcomingClasses' => collect(),
                'completedClasses' => collect(),
                'error' => 'Có lỗi xảy ra khi tải lớp học. Vui lòng thử lại sau.'
            ]);
        }
    }

    /**
     * Display the specified class.
     */
    public function show($id)
    {
        try {
            $teacherId = session('user_id');
            
            // Lấy thông tin lớp học
            $class = ClassRoom::where('id', $id)
                ->where(function($query) use ($teacherId) {
                    $query->where('teacher_id', $teacherId)
                        ->orWhere('assistant_id', $teacherId);
                })
                ->with([
                    'students',
                    'teacher',
                    'assistant',
                    'sessions' => function($query) {
                        $query->orderBy('session_date', 'asc');
                    },
                    'sessions.attendances'
                ])
                ->firstOrFail();
            
            return view('online.teacher.classes.show', compact('class'));
            
        } catch (\Exception $e) {
            Log::error('Lỗi hiển thị chi tiết lớp học: ' . $e->getMessage());
            return redirect()->route('online.teacher.classes.index')
                ->with('notification', [
                    'type' => 'error',
                    'message' => 'Không tìm thấy lớp học hoặc bạn không có quyền truy cập.'
                ]);
        }
    }

    /**
     * Show attendance for a class.
     */
    public function attendance($id)
    {
        try {
            $teacherId = session('user_id');
            
            // Lấy thông tin lớp học
            $class = ClassRoom::where('id', $id)
                ->where(function($query) use ($teacherId) {
                    $query->where('teacher_id', $teacherId)
                        ->orWhere('assistant_id', $teacherId);
                })
                ->with(['students', 'sessions' => function($query) {
                    $query->orderBy('session_date', 'desc');
                }])
                ->firstOrFail();
            
            // Lấy buổi học hôm nay hoặc buổi gần nhất
            $today = Carbon::today()->format('Y-m-d');
            $todaySession = $class->sessions->firstWhere('session_date', $today);
            
            // Nếu không có buổi học hôm nay, chọn buổi học gần nhất
            if (!$todaySession) {
                $upcomingSessions = $class->sessions->filter(function($session) use ($today) {
                    return $session->session_date >= $today;
                })->sortBy('session_date');
                
                $todaySession = $upcomingSessions->first() ?? $class->sessions->sortByDesc('session_date')->first();
            }
            
            // Lấy danh sách học sinh với thông tin điểm danh cho buổi học này
            $students = $class->students;
            foreach ($students as $student) {
                if ($todaySession) {
                    $attendance = Attendance::where('student_id', $student->id)
                        ->where('session_id', $todaySession->id)
                        ->first();
                    
                    $student->attendance = $attendance;
                }
            }
            
            return view('online.teacher.classes.attendance', [
                'class' => $class,
                'students' => $students,
                'session' => $todaySession,
                'sessions' => $class->sessions
            ]);
            
        } catch (\Exception $e) {
            Log::error('Lỗi hiển thị điểm danh: ' . $e->getMessage());
            return redirect()->route('online.teacher.classes.index')
                ->with('notification', [
                    'type' => 'error',
                    'message' => 'Không thể hiển thị điểm danh. Vui lòng thử lại sau.'
                ]);
        }
    }
} 