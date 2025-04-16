<?php

namespace App\Http\Controllers\Online;

use App\Models\Classes;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\ClassSession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OnlineAttendanceDetail;

class AttendanceController extends Controller
{
    /**
     * Display attendance index.
     */
    public function index(Request $request)
    {
        $query = Classes::with(['teacher', 'sessions', 'students']);

        // Filter by teacher_id if provided
        if ($request->has('teacher_id')) {
            $query->where('teacher_id', $request->teacher_id);
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
        $teachers = Employee::whereHas('roles', function($query) {
            $query->where('name', 'teacher');
        })->get();

        return view('online.attendance.index', compact('classes', 'teachers'));
    }

    /**
     * Display class attendance.
     */
    public function show($classId)
    {
        return view('online.attendance.show', compact('classId'));
    }
    public function sessions($class)
    {
        // Load the class with its sessions
        $class = Classes::with(['sessions' => function($query) {
            $query->orderBy('session_date', 'desc');
        }])->findOrFail($class);

        return view('online.attendance.sessions', compact('class'));
    }
    public function detail($id)
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
    }

    public function saveAttendance(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'attendance' => 'required|array',
            'attendance.*.student_id' => 'required|string',
            'attendance.*.status' => 'required|in:present,absent',
            'attendance.*.note' => 'nullable|string|max:255',
        ]);

        // Here you would save the attendance data to your database
        // For now, we'll just return a success response
        return response()->json([
            'message' => 'Attendance saved successfully'
        ]);
    }

}
