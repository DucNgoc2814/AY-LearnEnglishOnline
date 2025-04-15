<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\ClassSession;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    /**
     * Display a listing of the classes.
     */
    public function index(Request $request)
    {
        try {
            // Get user from request attributes (set by JwtRoleMiddleware)
            $user = $request->attributes->get('user');
            $userType = $request->attributes->get('user_type');
            
            if (!$user) {
                return redirect()->route('online.login')
                    ->with('notification', [
                        'message' => 'Vui lòng đăng nhập để tiếp tục.',
                        'type' => 'error'
                    ]);
            }
            

            // Process based on user type
            if ($userType === 'student') {
                return $this->handleStudentClasses($user);
            } else {
                return $this->handleTeacherClasses($user);
            }
            
        } catch (\Exception $e) {

            return view('online.classes.index', [
                'currentClasses' => collect(),
                'completedClasses' => collect(),
                'error' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Handle class listing for students
     */
    private function handleStudentClasses($student)
    {
        // Get classes the student is enrolled in
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
        
        return $this->processClassesAndReturnView($classes, $student, 'student');
    }

    /**
     * Handle class listing for teachers/employees
     */
    private function handleTeacherClasses($employee)
    {
        // Get classes where the employee is teacher or assistant
        $classes = Classes::where(function($query) use ($employee) {
            $query->where('teacher_id', $employee->id)
                  ->orWhere('assistant_id', $employee->id);
        })
        ->with([
            'teacher',
            'students',
            'sessions' => function($query) {
                $query->orderBy('session_date');
            },
            'sessions.schedule',
            'sessions.attendances'
        ])
        ->get();
        
        return $this->processClassesAndReturnView($classes, $employee, $employee->role ?? 'teacher');
    }

    /**
     * Process classes and return view with data
     */
    private function processClassesAndReturnView($classes, $user, $userRole)
    {
        $now = Carbon::now();
        Log::debug('Current date/time', ['now' => $now->toDateTimeString()]);
        
        // Log details for each class before categorization
        foreach ($classes as $class) {
            $startDate = Carbon::parse($class->start_date);
            $endDate = Carbon::parse($class->end_date);
            
            Log::debug('Class date details', [
                'id' => $class->id,
                'name' => $class->name,
                'code' => $class->code,
                'status' => $class->status,
                'start_date' => $class->start_date,
                'start_date_parsed' => $startDate->toDateTimeString(),
                'end_date' => $class->end_date,
                'end_date_parsed' => $endDate->toDateTimeString(),
                'is_future_start' => $startDate->gt($now),
                'days_until_start' => $now->diffInDays($startDate, false),
                'raw_start_date' => $class->getRawOriginal('start_date')
            ]);
        }
        
        // Get completed classes first (based on status)
        $completedClasses = $classes->filter(function($class) {
            return $class->status === 'completed';
        });
        
        // Classes with future start dates (not in completed) are upcoming
        $upcomingClasses = $classes->filter(function($class) use ($completedClasses, $now) {
            $startDate = Carbon::parse($class->start_date);
            $isFutureStart = $startDate->gt($now);
            $isNotCompleted = !$completedClasses->contains('id', $class->id);
            
            Log::debug('Checking if class is upcoming', [
                'id' => $class->id,
                'name' => $class->name,
                'start_date' => $startDate->toDateTimeString(),
                'now' => $now->toDateTimeString(),
                'is_future_start' => $isFutureStart,
                'is_not_completed' => $isNotCompleted,
                'is_upcoming' => ($isNotCompleted && $isFutureStart)
            ]);
            
            return $isNotCompleted && $isFutureStart;
        });
        
        // Remaining classes are current (active and already started, or past end date but not completed)
        $currentClasses = $classes->filter(function($class) use ($upcomingClasses, $completedClasses) {
            return !$upcomingClasses->contains('id', $class->id) && 
                  !$completedClasses->contains('id', $class->id);
        });
        
        Log::debug('Filtered classes', [
            'user_id' => $user->id,
            'upcoming_count' => $upcomingClasses->count(),
            'current_count' => $currentClasses->count(),
            'completed_count' => $completedClasses->count(),
            'upcoming_ids' => $upcomingClasses->pluck('id'),
            'current_ids' => $currentClasses->pluck('id'),
            'completed_ids' => $completedClasses->pluck('id')
        ]);

        // Calculate statistics for each class
        foreach ($classes as $class) {
            if ($userRole === 'student') {
                $this->calculateStudentStats($class, $user);
            } else {
                $this->calculateTeacherStats($class);
            }
            
            // Debug log for each class
            Log::debug('Class info', [
                'id' => $class->id,
                'name' => $class->name,
                'status' => $class->status,
                'teacher' => $class->teacher ? ($class->teacher->name ?? $class->teacher->employee_code ?? 'Unknown') : 'No teacher',
                'start_date' => $class->start_date,
                'end_date' => $class->end_date,
                'is_current' => $currentClasses->contains('id', $class->id),
                'is_completed' => $completedClasses->contains('id', $class->id),
                'is_upcoming' => $upcomingClasses->contains('id', $class->id)
            ]);
        }

        return view('online.classes.index', [
            'upcomingClasses' => $upcomingClasses,
            'currentClasses' => $currentClasses,
            'completedClasses' => $completedClasses,
            'isTeacher' => $userRole !== 'student',
            'user' => $user,
            'userRole' => $userRole,
            'now' => $now->toDateTimeString()
        ]);
    }

    /**
     * Calculate statistics for student view
     */
    private function calculateStudentStats($class, $student)
    {
        $totalSessions = $class->sessions->count();
        $attendances = $class->sessions->pluck('attendances')->flatten();
        
        $presentCount = $attendances->where('status', 'present')
                                   ->where('student_id', $student->id)
                                   ->count();
        
        $absentCount = $attendances->where('status', 'absent')
                                  ->where('student_id', $student->id)
                                  ->count();
                                  
        // Get registration status
        $registration = DB::table('course_registrations')
            ->where('class_id', $class->id)
            ->where('student_id', $student->id)
            ->first();
            
        $paymentStatus = $registration ? $registration->payment_status : 'pending';
        $registrationStatus = $registration ? $registration->status : 'pending';

        $class->stats = [
            'total_sessions' => $totalSessions,
            'present_count' => $presentCount,
            'absent_count' => $absentCount,
            'payment_status' => $paymentStatus,
            'registration_status' => $registrationStatus,
            'attendance_rate' => $totalSessions > 0 
                ? round(($presentCount / $totalSessions) * 100, 1) 
                : 0
        ];
    }

    /**
     * Calculate statistics for teacher view
     */
    private function calculateTeacherStats($class)
    {
        $totalStudents = $class->students->count();
        $totalSessions = $class->sessions->count();
        $totalAttendances = $class->sessions->pluck('attendances')
                                          ->flatten()
                                          ->where('status', 'present')
                                          ->count();

        $class->stats = [
            'total_students' => $totalStudents,
            'total_sessions' => $totalSessions,
            'total_attendances' => $totalAttendances,
            'attendance_rate' => ($totalStudents * $totalSessions) > 0 
                ? round(($totalAttendances / ($totalStudents * $totalSessions)) * 100, 1)
                : 0
        ];
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