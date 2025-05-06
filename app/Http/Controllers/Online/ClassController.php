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
     * Update class statuses based on dates
     */
    private function updateClassStatuses()
    {
        try {
            // Chỉ lấy và kiểm tra các lớp có status = 'pending'
            $pendingClasses = Classes::where('status', 'pending')->get();
            $now = Carbon::now()->startOfDay();

            foreach ($pendingClasses as $class) {
                if ($class->start_date->startOfDay()->lte($now)) {
                    $class->status = 'active';
                    $class->save();

                    Log::info('Class activated', [
                        'class_id' => $class->id,
                        'class_name' => $class->name,
                        'start_date' => $class->start_date->toDateString()
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error updating class statuses: ' . $e->getMessage(), [
                'exception' => $e
            ]);
        }
    }

    /**
     * Display a listing of the classes.
     */
    public function index(Request $request)
    {
        try {
            $this->updateClassStatuses();
            $user = $request->attributes->get('user');
            $userType = $request->attributes->get('user_type');

            if (!$user) {
                return redirect()->route('online.login')
                    ->with('notification', [
                        'message' => 'Vui lòng đăng nhập để tiếp tục.',
                        'type' => 'error'
                    ]);
            }

            if ($userType === 'student') {
                return $this->handleStudentClasses($user);
            } else {
                return $this->handleTeacherClasses($user);
            }
        } catch (\Exception $e) {
            return view('online.classes.index', [
                'currentClasses' => collect(),
                'completedClasses' => collect(),
                'upcomingClasses' => collect(),
                'error' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Handle class listing for students
     */
    private function handleStudentClasses($student)
    {
        try {
            $query = Classes::whereHas('registrations', function ($query) use ($student) {
                $query->where('student_id', $student->id)
                    ->where('status', 'active')
                    ->where('payment_status', 'paid');
            });

            $classes = $query->with([
                'teacher',
                'schedules',
                'sessions' => function ($query) {
                    $query->orderBy('session_date');
                },
                'sessions.schedule',
                'sessions.attendances' => function ($query) use ($student) {
                    $query->where('student_id', $student->id);
                }
            ])
                ->get();

            // Format schedule information for each class
            foreach ($classes as $class) {
                $class->formatted_schedule = $this->formatScheduleInfo($class->schedules);
            }

            return $this->processClassesAndReturnView($classes, $student, 'student');
        } catch (\Exception $e) {

            throw $e;
        }
    }

    /**
     * Format schedule information into readable text
     */
    private function formatScheduleInfo($schedules)
    {
        if ($schedules->isEmpty()) {
            return 'Chưa có lịch học';
        }

        $dayMapping = [
            'monday' => '2',
            'tuesday' => '3',
            'wednesday' => '4',
            'thursday' => '5',
            'friday' => '6',
            'saturday' => '7',
            'sunday' => '8'
        ];

        $scheduleInfo = [];
        foreach ($schedules as $schedule) {
            $day = $dayMapping[strtolower($schedule->day_of_week)] ?? $schedule->day_of_week;
            $time = Carbon::parse($schedule->start_time)->format('H:i') .
                ' - ' .
                Carbon::parse($schedule->end_time)->format('H:i');

            $scheduleInfo[] = "Thứ {$day}: {$time}";
        }

        return implode(' | ', $scheduleInfo);
    }

    /**
     * Handle class listing for teachers/employees
     */
    private function handleTeacherClasses($employee)
    {
        // Get classes where the employee is teacher or assistant
        $classes = Classes::where(function ($query) use ($employee) {
            $query->where('teacher_id', $employee->id)
                ->orWhere('assistant_id', $employee->id);
        })
            ->with([
                'teacher',
                'schedules',
                'students',
                'sessions' => function ($query) {
                    $query->orderBy('session_date');
                },
                'sessions.schedule',
                'sessions.attendances'
            ])
            ->get();

        // Format schedule information for each class
        foreach ($classes as $class) {
            $class->formatted_schedule = $this->formatScheduleInfo($class->schedules);
        }

        return $this->processClassesAndReturnView($classes, $employee, $employee->role ?? 'teacher');
    }

    /**
     * Process classes and return view with data
     */
    private function processClassesAndReturnView($classes, $user, $userRole)
    {
        $now = Carbon::now();
        Log::debug('Current date/time', ['now' => $now->toDateTimeString()]);

        // Phân loại theo status
        $upcomingClasses = $classes->filter(function ($class) {
            return $class->status === 'pending';
        });

        $currentClasses = $classes->filter(function ($class) {
            return $class->status === 'active';
        });

        $completedClasses = $classes->filter(function ($class) {
            return $class->status === 'completed';
        });

        Log::debug('Filtered classes by status', [
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
    public function show($id)
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
                'schedules',
                'students',
                'sessions' => function ($query) {
                    $query->orderBy('session_date');
                },
                'sessions.schedule',
                'sessions.attendances' => function ($query) use ($student) {
                    if ($student) {
                        $query->where('student_id', $student->id);
                    }
                }
            ])->findOrFail($id);

            // Format schedule information
            $class->formatted_schedule = $this->formatScheduleInfo($class->schedules);

            // Prepare statistics for the view
            $totalSessions = $class->sessions->count();
            $completedSessions = $class->sessions->where('status', 'completed')->count();
            $upcomingSessions = $class->sessions->where('status', '!=', 'completed')->count();

            // Calculate attendance statistics
            $attendanceRate = 0;
            $assignmentCount = 0;
            $averageScore = 0;

            if ($student && $totalSessions > 0) {
                // Get attendance from eager loaded data
                $attendances = $class->sessions->pluck('attendances')->flatten()->filter();

                // Calculate attendance rate
                $presentCount = $attendances->whereIn('status', ['present', 'late'])->count();
                $attendanceRate = $totalSessions > 0 ? round(($presentCount / $totalSessions) * 100, 1) : 0;

                // Get assignments data (you may need to adjust this based on your actual models)
                $assignmentCount = DB::table('assignments')
                    ->where('class_id', $class->id)
                    ->count();

                // Get average score (adjust based on your grading model)
                $grades = DB::table('grades')
                    ->where('class_id', $class->id)
                    ->where('student_id', $student->id)
                    ->get();

                if ($grades->count() > 0) {
                    $averageScore = round($grades->avg('grade'), 1);
                }
            }

            // Prepare stats for view
            $stats = [
                'total_sessions' => $totalSessions,
                'completed_sessions' => $completedSessions,
                'upcoming_sessions' => $upcomingSessions,
                'attendance_rate' => $attendanceRate,
                'assignment_count' => $assignmentCount,
                'average_score' => $averageScore
            ];

            return view('online.classes.show', compact('class', 'stats'));
        } catch (\Exception $e) {
            Log::error('Error displaying class details: ' . $e->getMessage(), [
                'exception' => $e,
                'id' => $id
            ]);
            return redirect()->route('online.classes.index')->with('error', 'Có lỗi xảy ra khi tải thông tin lớp học. Vui lòng thử lại sau.');
        }
    }

    /**
     * Display a listing of classes for teachers
     */
    public function teacherClasses(Request $request)
    {
        try {
            $this->updateClassStatuses();
            $user = $request->attributes->get('user');

            if (!$user) {
                return redirect()->route('online.login')
                    ->with('notification', [
                        'message' => 'Vui lòng đăng nhập để tiếp tục.',
                        'type' => 'error'
                    ]);
            }

            $classes = Classes::where('teacher_id', $user->id)
                ->with([
                    'teacher',
                    'schedules',
                    'students',
                    'sessions' => function ($query) {
                        $query->orderBy('session_date');
                    },
                    'sessions.schedule',
                    'sessions.attendances'
                ])
                ->get();

            // Format schedule information for each class
            foreach ($classes as $class) {
                $class->formatted_schedule = $this->formatScheduleInfo($class->schedules);
                $this->calculateTeacherStats($class);
            }

            // Phân loại theo status
            $upcomingClasses = $classes->filter(function ($class) {
                return $class->status === 'pending';
            });

            $currentClasses = $classes->filter(function ($class) {
                return $class->status === 'active';
            });

            $completedClasses = $classes->filter(function ($class) {
                return $class->status === 'completed';
            });

            return view('online.teacher.classes.index', [
                'upcomingClasses' => $upcomingClasses,
                'currentClasses' => $currentClasses,
                'completedClasses' => $completedClasses,
                'user' => $user
            ]);

        } catch (\Exception $e) {
            Log::error('Error in teacherClasses: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            
            return view('online.teacher.classes.index', [
                'currentClasses' => collect(),
                'completedClasses' => collect(),
                'upcomingClasses' => collect(),
                'error' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Hiển thị trang làm bài trắc nghiệm
     *
     * @param  string  $quiz
     * @return \Illuminate\View\View
     */
    public function quiz($quiz)
    {
        // Xử lý lấy thông tin của bài quiz dựa trên tham số $quiz
        $quizData = [
            'present-simple' => [
                'title' => 'Bài trắc nghiệm 2.1: Thì hiện tại đơn',
                'time' => 15, // phút
                'questions' => 10
            ],
            'present-continuous' => [
                'title' => 'Bài trắc nghiệm 2.2: Thì hiện tại tiếp diễn',
                'time' => 15,
                'questions' => 10
            ],
            'communication-vocab' => [
                'title' => 'Bài trắc nghiệm 2.3: Từ vựng về chủ đề giao tiếp',
                'time' => 10,
                'questions' => 10
            ]
        ];

        // Kiểm tra bài quiz có tồn tại không
        if (!isset($quizData[$quiz])) {
            abort(404, 'Không tìm thấy bài trắc nghiệm');
        }

        $quizInfo = $quizData[$quiz];

        return view('online.classes.partials.quiz', compact('quizInfo', 'quiz'));
    }
}
