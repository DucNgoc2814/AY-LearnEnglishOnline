<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Attendance;
use App\Models\OnlineAttendanceDetail;

class AttendanceController extends Controller
{
    /**
     * Display attendance index.
     */
    public function index()
    {
        return view('online.attendance.index');
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
        return view('online.attendance.detail');
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