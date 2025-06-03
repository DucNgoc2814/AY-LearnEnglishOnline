<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use App\Models\ClassStudent;
use App\Models\CourseRegistration;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class ClassStudentController extends Controller
{
    public function index()
    {
        try {
            // Lấy token từ session
            $token = session('jwt_token');
            if (!$token) {
                Log::error('No JWT token found in session');
                return view('online.classes.index', [
                    'upcomingClasses' => collect(),
                    'currentClasses' => collect(),
                    'completedClasses' => collect(),
                    'error' => 'Vui lòng đăng nhập để xem thông tin lớp học.'
                ]);
            }

            // Xác thực token và lấy user
            JWTAuth::setToken($token);
            $user = JWTAuth::authenticate();

            if (!$user) {
                Log::error('Failed to authenticate JWT token');
                return view('online.classes.index', [
                    'upcomingClasses' => collect(),
                    'currentClasses' => collect(),
                    'completedClasses' => collect(),
                    'error' => 'Phiên đăng nhập không hợp lệ. Vui lòng đăng nhập lại.'
                ]);
            }

            // Lấy payload để kiểm tra user type
            $payload = JWTAuth::getPayload();
            $userType = $payload->get('user_type');

            if (!in_array($userType, ['users', 'student'])) {
                Log::error('Invalid user type for class access', ['user_type' => $userType]);
                return view('online.classes.index', [
                    'upcomingClasses' => collect(),
                    'currentClasses' => collect(),
                    'completedClasses' => collect(),
                    'error' => 'Bạn không có quyền truy cập vào trang này.'
                ]);
            }

            Log::info('Processing classes for user:', [
                'user_id' => $user->id,
                'user_type' => $userType
            ]);

            // Get course registrations for the current user
            $registrations = CourseRegistration::whereHas('students', function($query) use ($user) {
                $query->where('students.id', $user->id);
            })->with(['classStudents.class.teacher'])->get();

            Log::info('Found registrations:', [
                'count' => $registrations->count(),
                'registration_ids' => $registrations->pluck('id')->toArray()
            ]);

            // Initialize collections
            $upcomingClasses = collect();
            $currentClasses = collect();
            $completedClasses = collect();

            foreach ($registrations as $registration) {
                foreach ($registration->classStudents as $classStudent) {
                    $class = $classStudent->class;
                    if (!$class) {
                        Log::warning('No class found for class student: ' . $classStudent->id);
                        continue;
                    }

                    // Calculate attendance statistics
                    $totalSessions = 0; // Tạm thời set mặc định
                    $attendedSessions = 0; // Tạm thời set mặc định
                    $attendanceRate = 0;

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

                    Log::info('Processing class:', [
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

            Log::info('Final class counts:', [
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
            Log::error('Error in ClassStudentController@index:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
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
