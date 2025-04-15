<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassRoom;
use App\Models\Session;
use App\Models\Student;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    /**
     * Hiển thị danh sách lớp học
     */
    public function index()
    {
        return view('online.attendance.index');
    }

    /**
     * Hiển thị danh sách buổi học của một lớp
     */
    public function sessions()
    {
        return view('online.attendance.sessions');
    }

    /**
     * Hiển thị danh sách học sinh và điểm danh của một buổi học
     */
    public function students()
    {
        return view('online.attendance.students');
    }

    /**
     * Cập nhật trạng thái điểm danh của một học sinh
     */
    public function markAttendance(Request $request, $classId, $sessionId, $studentId)
    {
        $status = $request->input('status');
        $note = $request->input('note');

        // TODO: Cập nhật trạng thái điểm danh vào database
        
        return response()->json([
            'success' => true,
            'message' => 'Đã cập nhật điểm danh'
        ]);
    }

    /**
     * Điểm danh tất cả học sinh có mặt
     */
    public function markAllPresent(Request $request, $classId, $sessionId)
    {
        // TODO: Cập nhật trạng thái có mặt cho tất cả học sinh vào database
        
        return response()->json([
            'success' => true,
            'message' => 'Đã điểm danh tất cả học sinh có mặt'
        ]);
    }

    /**
     * Lấy thống kê điểm danh của một buổi học
     */
    public function getSessionStatistics($classId, $sessionId)
    {
        // TODO: Lấy thống kê điểm danh từ database
        
        return response()->json([
            'present_count' => 0,
            'late_count' => 0,
            'absent_count' => 0,
            'excused_count' => 0
        ]);
    }
} 