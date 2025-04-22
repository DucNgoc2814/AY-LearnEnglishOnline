<?php

namespace App\Http\Controllers\Online\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassSession;
use App\Models\Classes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\GradeItem;

class SessionController extends Controller
{
    /**
     * Lấy thông tin chi tiết của buổi học
     */
    public function getDetail(Request $request)
    {
        try {
            $sessionId = $request->input('session_id');
            $teacherId = session('user_id');
            
            $session = ClassSession::with([
                'schedule.class',
                'attendances.student',
            ])->findOrFail($sessionId);
            
            // Kiểm tra quyền truy cập
            if ($session->schedule->class->teacher_id != $teacherId) {
                return response()->json(['error' => 'Không có quyền truy cập'], 403);
            }
            
            // Thống kê điểm danh
            $class = $session->schedule->class;
            $totalStudents = $class->students->count();
            $presentStudents = $session->attendances->whereIn('status', ['present', 'late'])->count();
            $absentStudents = $totalStudents - $presentStudents;
            
            $attendanceRate = $totalStudents > 0 ? round(($presentStudents / $totalStudents) * 100) : 0;
            
            return view('online.teacher.partials.session_detail', compact('session', 'totalStudents', 'presentStudents', 'absentStudents', 'attendanceRate'));
            
        } catch (\Exception $e) {
            Log::error('Lỗi lấy thông tin chi tiết buổi học: ' . $e->getMessage());
            return response()->json(['error' => 'Không thể tải thông tin buổi học'], 500);
        }
    }
    
    /**
     * Lấy thông tin buổi học cho form chỉnh sửa
     */
    public function getSession(Request $request)
    {
        try {
            $sessionId = $request->input('session_id');
            $teacherId = session('user_id');
            
            $session = ClassSession::with('schedule.class')->findOrFail($sessionId);
            
            // Kiểm tra quyền truy cập
            if ($session->schedule->class->teacher_id != $teacherId) {
                return response()->json(['error' => 'Không có quyền truy cập'], 403);
            }
            
            return response()->json([
                'id' => $session->id,
                'topic' => $session->topic,
                'content' => $session->content,
                'status' => $session->status,
                'notes' => $session->notes,
                'session_date' => $session->session_date->format('Y-m-d'),
                'start_time' => $session->start_time->format('H:i'),
                'end_time' => $session->end_time->format('H:i'),
            ]);
            
        } catch (\Exception $e) {
            Log::error('Lỗi lấy thông tin buổi học: ' . $e->getMessage());
            return response()->json(['error' => 'Không thể tải thông tin buổi học'], 500);
        }
    }
    
    /**
     * Cập nhật thông tin buổi học
     */
    public function update(Request $request)
    {
        try {
            $sessionId = $request->input('session_id');
            $teacherId = session('user_id');
            
            $session = ClassSession::with('schedule.class')->findOrFail($sessionId);
            
            // Kiểm tra quyền truy cập
            if ($session->schedule->class->teacher_id != $teacherId) {
                return redirect()->back()->with('notification', [
                    'type' => 'error',
                    'message' => 'Không có quyền truy cập'
                ]);
            }
            
            // Cập nhật thông tin
            $session->topic = $request->input('topic');
            $session->content = $request->input('content');
            $session->status = $request->input('status');
            $session->notes = $request->input('notes');
            $session->save();
            
            return redirect()->back()->with('notification', [
                'type' => 'success',
                'message' => 'Cập nhật thông tin buổi học thành công'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Lỗi cập nhật thông tin buổi học: ' . $e->getMessage());
            return redirect()->back()->with('notification', [
                'type' => 'error',
                'message' => 'Không thể cập nhật thông tin buổi học. Vui lòng thử lại sau.'
            ]);
        }
    }
    
    /**
     * Thêm tài liệu cho buổi học
     */
    public function addMaterial(Request $request)
    {
        try {
            $request->validate([
                'session_id' => 'required|exists:class_sessions,id',
                'material_name' => 'required|string|max:255',
                'material_file' => 'required|file|max:20480', // 20MB max
                'material_description' => 'nullable|string'
            ]);
            
            $sessionId = $request->input('session_id');
            $teacherId = session('user_id');
            
            $session = ClassSession::with('schedule.class')->findOrFail($sessionId);
            
            // Kiểm tra quyền truy cập
            if ($session->schedule->class->teacher_id != $teacherId) {
                return redirect()->back()->with('notification', [
                    'type' => 'error',
                    'message' => 'Không có quyền truy cập'
                ]);
            }
            
            // Upload file
            $file = $request->file('material_file');
            $fileName = time() . '_' . Str::slug($request->input('material_name')) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('materials/' . $session->id, $fileName, 'public');
            
            // Lưu thông tin tài liệu
            $materials = $session->session_materials ?? [];
            $materials[] = [
                'name' => $request->input('material_name'),
                'file_name' => $fileName,
                'url' => asset('storage/' . $filePath),
                'description' => $request->input('material_description'),
                'uploaded_at' => now()->toDateTimeString(),
                'uploaded_by' => $teacherId
            ];
            
            $session->session_materials = $materials;
            $session->save();
            
            return redirect()->back()->with('notification', [
                'type' => 'success',
                'message' => 'Thêm tài liệu thành công'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Lỗi thêm tài liệu buổi học: ' . $e->getMessage());
            return redirect()->back()->with('notification', [
                'type' => 'error',
                'message' => 'Không thể thêm tài liệu. Vui lòng thử lại sau.'
            ]);
        }
    }

    /**
     * Hiển thị chi tiết buổi học
     */
    public function show($id)
    {
        try {
            $teacherId = session('user_id');
            
            // Lấy thông tin buổi học với các quan hệ cần thiết
            $session = ClassSession::with([
                'class.students',
                'class.teacher',
                'attendances.student',
                'materials'
            ])->findOrFail($id);
            
            // Kiểm tra quyền truy cập
            if ($session->class->teacher_id != $teacherId) {
                return redirect()->route('online.teacher.classes.index')
                    ->with('error', 'Không có quyền truy cập buổi học này');
            }
            
            // Tính toán thống kê điểm danh
            $totalStudents = $session->class->students->count();
            $presentStudents = $session->attendances->whereIn('status', ['present', 'late'])->count();
            $absentStudents = $totalStudents - $presentStudents;
            $attendanceRate = $totalStudents > 0 ? round(($presentStudents / $totalStudents) * 100) : 0;
            
            // Lấy danh sách điểm của buổi học
            $grades = GradeItem::where('session_id', $id)
                ->with('student')
                ->get();
                
            return view('online.teacher.sessions.show', compact(
                'session',
                'totalStudents',
                'presentStudents',
                'absentStudents',
                'attendanceRate',
                'grades'
            ));
            
        } catch (\Exception $e) {
            Log::error('Lỗi hiển thị chi tiết buổi học: ' . $e->getMessage());
            return redirect()->route('online.teacher.classes.index')
                ->with('error', 'Không thể tải thông tin buổi học');
        }
    }
} 