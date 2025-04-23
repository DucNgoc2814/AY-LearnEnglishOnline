<?php

namespace App\Http\Controllers\Online\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassSession;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    /**
     * Hiển thị trang điểm danh cho một buổi học cụ thể
     */
    public function sessionAttendance($sessionId)
    {
        try {
            $teacherId = session('user_id');
            
            // Lấy thông tin buổi học
            $session = ClassSession::with([
                'schedule.class',
                'attendances',
            ])->findOrFail($sessionId);
            
            // Kiểm tra quyền truy cập
            if ($session->schedule->class->teacher_id != $teacherId) {
                return redirect()->route('online.teacher.classes.index')
                    ->with('notification', [
                        'type' => 'error',
                        'message' => 'Không có quyền truy cập buổi học này'
                    ]);
            }
            
            $class = $session->schedule->class;
            
            // Lấy danh sách học sinh của lớp
            $students = $class->students;
            
            // Gán thông tin điểm danh cho từng học sinh
            foreach ($students as $student) {
                $attendance = $session->attendances->where('student_id', $student->id)->first();
                
                if (!$attendance) {
                    // Nếu chưa có bản ghi điểm danh, tạo một bản ghi mới với trạng thái vắng mặt
                    $attendance = new Attendance([
                        'session_id' => $session->id,
                        'student_id' => $student->id,
                        'status' => 'absent',
                        'recorded_by' => $teacherId,
                    ]);
                }
                
                $student->attendance = $attendance;
            }
            
            return view('online.teacher.attendance.session', [
                'session' => $session,
                'class' => $class,
                'students' => $students,
            ]);
            
        } catch (\Exception $e) {
            Log::error('Lỗi hiển thị trang điểm danh buổi học: ' . $e->getMessage());
            return redirect()->route('online.teacher.classes.index')
                ->with('notification', [
                    'type' => 'error',
                    'message' => 'Không thể hiển thị trang điểm danh. Vui lòng thử lại sau.'
                ]);
        }
    }
    
    /**
     * Lưu thông tin điểm danh cho buổi học
     */
    public function saveAttendance(Request $request)
    {
        try {
            $request->validate([
                'session_id' => 'required|exists:class_sessions,id',
                'attendances' => 'required|array',
                'attendances.*.student_id' => 'required|exists:students,id',
                'attendances.*.status' => 'required|in:present,late,absent,excused',
                'attendances.*.note' => 'nullable|string|max:255',
            ]);
            
            $sessionId = $request->input('session_id');
            $teacherId = session('user_id');
            
            // Lấy thông tin buổi học
            $session = ClassSession::with('schedule.class')->findOrFail($sessionId);
            
            // Kiểm tra quyền truy cập
            if ($session->schedule->class->teacher_id != $teacherId) {
                return redirect()->back()->with('notification', [
                    'type' => 'error',
                    'message' => 'Không có quyền truy cập buổi học này'
                ]);
            }
            
            // Lưu thông tin điểm danh
            foreach ($request->input('attendances') as $data) {
                $attendance = Attendance::updateOrCreate(
                    [
                        'session_id' => $sessionId,
                        'student_id' => $data['student_id'],
                    ],
                    [
                        'status' => $data['status'],
                        'note' => $data['note'] ?? null,
                        'check_in_time' => $data['status'] === 'present' ? now() : null,
                        'recorded_by' => $teacherId,
                    ]
                );
            }
            
            return redirect()->back()->with('notification', [
                'type' => 'success',
                'message' => 'Lưu thông tin điểm danh thành công'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Lỗi lưu thông tin điểm danh: ' . $e->getMessage());
            return redirect()->back()->with('notification', [
                'type' => 'error',
                'message' => 'Không thể lưu thông tin điểm danh. Vui lòng thử lại sau.'
            ]);
        }
    }
} 