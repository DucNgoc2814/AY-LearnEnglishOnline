<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassSession;
use App\Models\Classes;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ScheduleController extends Controller
{
    /**
     * Display the schedule.
     */
    public function index()
    {
        try {
            // Lấy người dùng hiện tại một cách an toàn
            $user = Auth::user();
            
            if (!$user) {
                return view('online.schedule.index', [
                    'currentClasses' => collect(),
                    'completedClasses' => collect()
                ]);
            }
            
            // Tìm học viên liên quan đến người dùng này
            $student = Student::where('user_id', $user->id)->first();
            
            if (!$student) {
                return view('online.schedule.index', [
                    'currentClasses' => collect(),
                    'completedClasses' => collect()
                ]);
            }

            // Lấy các lớp học sinh đã đăng ký với eager loading đầy đủ
            $classes = Classes::whereHas('students', function($query) use ($student) {
                $query->where('students.id', $student->id);
            })
            ->with([
                'teacher', 
                'sessions' => function($query) {
                    $query->orderBy('session_date');
                },
                'sessions.schedule', 
                'sessions.attendances' => function($query) use ($student) {
                    $query->where('student_id', $student->id);
                }
            ])
            ->get();
            
            // Phân loại lớp học thành hiện tại và đã hoàn thành
            $now = Carbon::now();
            
            $currentClasses = $classes->filter(function($class) use ($now) {
                return in_array($class->status, ['active', 'pending']) || ($class->end_date && $class->end_date >= $now);
            });
            
            $completedClasses = $classes->filter(function($class) use ($now) {
                return $class->status === 'completed' || ($class->end_date && $class->end_date < $now);
            });
            
            // Tính toán thống kê điểm danh cho mỗi lớp học
            foreach ($classes as $class) {
                // Đếm số buổi học
                $totalSessions = $class->sessions->count();
                
                if ($student && $totalSessions > 0) {
                    // Lấy thống kê điểm danh cho học sinh trong lớp này
                    $attendances = $class->sessions->pluck('attendances')->flatten()->filter();
                    
                    // Nếu không có thông tin điểm danh, thử lấy từ database
                    if ($attendances->isEmpty()) {
                        $attendances = Attendance::whereIn('session_id', $class->sessions->pluck('id'))
                            ->where('student_id', $student->id)
                            ->get();
                    }
                    
                    $absentCount = $attendances->where('status', 'absent')->count();
                    $absentPercentage = $totalSessions > 0 ? round(($absentCount / $totalSessions) * 100, 1) : 0;
                    
                    $class->attendance_stats = [
                        'absent_count' => $absentCount,
                        'total_sessions' => $totalSessions,
                        'absent_percentage' => $absentPercentage
                    ];
                } else {
                    $class->attendance_stats = [
                        'absent_count' => 0,
                        'total_sessions' => $totalSessions ?: 0,
                        'absent_percentage' => 0
                    ];
                }
            }
            
            return view('online.schedule.index', [
                'currentClasses' => $currentClasses,
                'completedClasses' => $completedClasses
            ]);
            
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Lỗi hiển thị lịch học: ' . $e->getMessage());
            return view('online.schedule.index', [
                'currentClasses' => collect(),
                'completedClasses' => collect(),
                'error' => 'Có lỗi xảy ra khi tải lịch học. Vui lòng thử lại sau.'
            ]);
        }
    }
} 