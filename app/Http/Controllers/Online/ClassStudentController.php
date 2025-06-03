<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use App\Models\ClassStudent;
use App\Models\CourseRegistration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ClassStudentController extends Controller
{
    public function index()
    {
        // Lấy thông tin user đang đăng nhập
        $studentUser = Auth::guard('online')->user();
        Log::info('Online guard user:', ['user_id' => $studentUser ? $studentUser->id : null]);

        // Lấy user ID từ guard online
        $userId = Auth::guard('online')->id();
        Log::info('Using student ID:', ['id' => $userId]);

        if (!$userId) {
            Log::error('No authenticated student found');
            return view('online.classes.index', [
                'upcomingClasses' => collect(),
                'currentClasses' => collect(),
                'completedClasses' => collect(),
                'error' => 'Vui lòng đăng nhập để xem thông tin lớp học.'
            ]);
        }

        try {
            // Get course registrations for the current user with eager loading
            $registrations = CourseRegistration::with([
                'students',
                'classStudents.class.teacher',
                'classStudents.attendances'
            ])->whereHas('students', function($query) use ($userId) {
                $query->where('students.id', $userId);
            })->get();

            Log::info('Found registrations: ', [
                'count' => $registrations->count(),
                'registration_ids' => $registrations->pluck('id')->toArray()
            ]);

            // Initialize collections
            $upcomingClasses = collect();
            $currentClasses = collect();
            $completedClasses = collect();

            foreach ($registrations as $registration) {
                Log::info('Processing registration: ', [
                    'registration_id' => $registration->id,
                    'class_students_count' => $registration->classStudents->count()
                ]);

                foreach ($registration->classStudents as $classStudent) {
                    $class = $classStudent->class;
                    if (!$class) {
                        Log::warning('No class found for class student: ' . $classStudent->id);
                        continue;
                    }

                    // Calculate attendance statistics
                    $totalSessions = $classStudent->attendances->count();
                    $attendedSessions = $classStudent->attendances->where('status', 'present')->count();
                    $attendanceRate = $totalSessions > 0 ? ($attendedSessions / $totalSessions) * 100 : 0;

                    // Add registration and payment status to class object
                    $class->stats = [
                        'registration_status' => $registration->status,
                        'payment_status' => $registration->payment_status,
                        'attended_sessions' => $attendedSessions,
                        'total_sessions' => $totalSessions,
                        'attendance_rate' => $attendanceRate
                    ];

                    $now = Carbon::now();
                    $startDate = Carbon::parse($classStudent->start_date);
                    $endDate = $classStudent->end_date
                        ? Carbon::parse($classStudent->end_date)
                        : Carbon::parse($class->end_date);

                    Log::info('Processing class: ', [
                        'class_id' => $class->id,
                        'start_date' => $startDate->format('Y-m-d'),
                        'end_date' => $endDate->format('Y-m-d'),
                        'status' => $classStudent->status
                    ]);

                    if ($startDate->isFuture()) {
                        $upcomingClasses->push($class);
                    } elseif ($now->between($startDate, $endDate) && $classStudent->status === 'active') {
                        $currentClasses->push($class);
                    } else {
                        $completedClasses->push($class);
                    }
                }
            }

            Log::info('Final counts: ', [
                'upcoming' => $upcomingClasses->count(),
                'current' => $currentClasses->count(),
                'completed' => $completedClasses->count()
            ]);

            return view('online.classes.index', [
                'upcomingClasses' => $upcomingClasses,
                'currentClasses' => $currentClasses,
                'completedClasses' => $completedClasses,
                'hasClasses' => $upcomingClasses->isNotEmpty() || $currentClasses->isNotEmpty() || $completedClasses->isNotEmpty()
            ]);

        } catch (\Exception $e) {
            Log::error('Error in ClassStudentController@index: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            return view('online.classes.index', [
                'upcomingClasses' => collect(),
                'currentClasses' => collect(),
                'completedClasses' => collect(),
                'error' => 'Có lỗi xảy ra khi tải thông tin lớp học. Vui lòng thử lại sau.'
            ]);
        }
    }

    public function show($id)
    {
        $class = ClassStudent::with(['class', 'class.teacher', 'registration'])
            ->where('class_id', $id)
            ->whereHas('registration.students', function($query) {
                $query->where('students.id', auth()->id());
            })
            ->firstOrFail();

        return view('online.classes.show', compact('class'));
    }

    public function quiz($quiz)
    {
        // Implement quiz logic here
        return view('online.classes.quiz', compact('quiz'));
    }
}
