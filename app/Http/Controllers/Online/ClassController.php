<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\ClassSession;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    /**
     * Display a listing of the classes.
     */
    public function index()
    {
        try {
            // Get the currently authenticated user
            $user = Auth::user();
            
            if (!$user) {
                \Log::debug('No authenticated user found');
                return view('online.classes.index', [
                    'currentClasses' => collect(),
                    'completedClasses' => collect(),
                    'debug' => 'No authenticated user found'
                ]);
            }
            
            \Log::debug('Authenticated user found', ['user_id' => $user->id, 'email' => $user->email]);
            
            // Find the student related to this user
            $student = Student::where('user_id', $user->id)->first();
            
            if (!$student) {
                \Log::debug('No student record found for user', ['user_id' => $user->id]);
                return view('online.classes.index', [
                    'currentClasses' => collect(),
                    'completedClasses' => collect(),
                    'debug' => 'No student record found for user ID: ' . $user->id
                ]);
            }
            
            \Log::debug('Student record found', ['student_id' => $student->id, 'student_code' => $student->student_code]);

            // Count class_student entries for this student
            $classStudentCount = DB::table('class_student')->where('student_id', $student->id)->count();
            \Log::debug('Class student entries count', ['count' => $classStudentCount]);
            
            // Get classes the student is enrolled in with eager loading
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
            
            \Log::debug('Classes count', ['count' => $classes->count()]);
            
            // Separate into current and completed classes
            $now = Carbon::now();
            
            $currentClasses = $classes->filter(function($class) use ($now) {
                return in_array($class->status, ['active', 'pending']) || ($class->end_date && $class->end_date >= $now);
            });
            
            $completedClasses = $classes->filter(function($class) use ($now) {
                return $class->status === 'completed' || ($class->end_date && $class->end_date < $now);
            });
            
            \Log::debug('Filtered classes', [
                'current_count' => $currentClasses->count(),
                'completed_count' => $completedClasses->count()
            ]);
            
            // Calculate attendance statistics for each class
            foreach ($classes as $class) {
                // Count total sessions
                $totalSessions = $class->sessions->count();
                
                if ($student && $totalSessions > 0) {
                    // Get attendance stats from eager loaded data
                    $attendances = $class->sessions->pluck('attendances')->flatten()->filter();
                    
                    // If no attendance data was loaded, try to get it from the database
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
            
            // Include debugger info for current view
            return view('online.classes.index', [
                'currentClasses' => $currentClasses,
                'completedClasses' => $completedClasses,
                'debug' => [
                    'user_id' => $user->id,
                    'student_id' => $student->id,
                    'class_student_count' => $classStudentCount,
                    'classes_count' => $classes->count(),
                    'current_classes_count' => $currentClasses->count(),
                    'completed_classes_count' => $completedClasses->count()
                ]
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Error displaying classes: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return view('online.classes.index', [
                'currentClasses' => collect(),
                'completedClasses' => collect(),
                'error' => 'Có lỗi xảy ra khi tải danh sách lớp học: ' . $e->getMessage(),
                'debug' => 'Exception: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified class.
     */
    public function show($classId)
    {
        try {
            // Find the student safely
            $user = Auth::user();
            $student = null;
            
            if ($user) {
                $student = Student::where('user_id', $user->id)->first();
            }
            
            // Get the class with sessions and attendance data
            $class = Classes::with([
                'teacher', 
                'sessions' => function($query) {
                    $query->orderBy('session_date');
                },
                'sessions.schedule',
                'sessions.attendances' => function($query) use ($student) {
                    if ($student) {
                        $query->where('student_id', $student->id);
                    }
                }
            ])->findOrFail($classId);
            
            // Get attendance stats for this student in this class
            $totalSessions = $class->sessions->count();
            
            if ($student && $totalSessions > 0) {
                // Get attendance from eager loaded data
                $attendances = $class->sessions->pluck('attendances')->flatten()->filter();
                
                // If no data was loaded, get it from the database
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
            
            return view('online.classes.show', compact('class'));
            
        } catch (\Exception $e) {
            Log::error('Error displaying class details: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tải thông tin lớp học. Vui lòng thử lại sau.');
        }
    }
} 