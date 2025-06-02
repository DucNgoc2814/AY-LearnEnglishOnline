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
        // Thử lấy user từ guard 'online'
        $studentUser = Auth::guard('online')->user();
        Log::info('Online guard user:', ['user' => $studentUser ? $studentUser->toArray() : null]);

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

        // Get course registrations for the current user
        $registrations = CourseRegistration::whereHas('students', function($query) use ($userId) {
            $query->where('students.id', $userId);
        })->with(['classStudents.class.teacher'])->get();

        Log::info('Found registrations: ', [
            'count' => $registrations->count(),
            'registrations' => $registrations->toArray()
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

                // Add registration and payment status to class object
                $class->stats = [
                    'registration_status' => $registration->status,
                    'payment_status' => $registration->payment_status,
                    'attended_sessions' => 0, // You can calculate this from your attendance table
                    'total_sessions' => 0, // You can calculate this from your sessions table
                    'attendance_rate' => 0 // You can calculate this from attendance/total sessions
                ];

                $now = Carbon::now();
                $startDate = Carbon::parse($classStudent->start_date);
                $endDate = $classStudent->end_date ? Carbon::parse($classStudent->end_date) : Carbon::parse($class->end_date);

                Log::info('Processing class: ', [
                    'class_id' => $class->id,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
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

        return view('online.classes.index', compact('upcomingClasses', 'currentClasses', 'completedClasses'));
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
