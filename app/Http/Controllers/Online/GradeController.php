<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    /**
     * Hiển thị trang bảng điểm chính cho học viên
     */
    public function index()
    {
        // Lấy tất cả các lớp học của học viên hiện tại
        // và tổng hợp điểm
        
        return view('online.grades.index');
    }
    
    /**
     * Hiển thị bảng điểm chi tiết của một lớp học cụ thể cho học viên
     */
    public function show($class_id)
    {
        // Lấy thông tin lớp học và điểm số của học viên trong lớp đó
        
        return view('online.grades.show', compact('class_id'));
    }
    
    /**
     * Hiển thị chi tiết đánh giá cụ thể
     */
    public function detail($assessment_id)
    {
        // Lấy thông tin chi tiết về bài đánh giá và điểm của học viên
        
        return view('online.grades.detail', compact('assessment_id'));
    }
    
    /**
     * Trang tổng quan bảng điểm dành cho giảng viên
     */
    public function teacherIndex()
    {
        // Lấy danh sách lớp học mà giảng viên phụ trách
        
        return view('online.teacher.grades.index');
    }
    
    /**
     * Hiển thị bảng điểm của một lớp học
     */
    public function classGrades($class_id)
    {
        // Lấy tất cả học viên và điểm số trong lớp học này
        
        return view('online.teacher.grades.class', compact('class_id'));
    }
    
    /**
     * Hiển thị bảng điểm của một học viên cụ thể
     */
    public function studentGrades($student_id)
    {
        // Lấy tất cả điểm số của học viên này
        
        return view('online.teacher.grades.student', compact('student_id'));
    }
    
    /**
     * Hiển thị kết quả của một bài đánh giá cụ thể
     */
    public function assessmentGrades($assessment_id)
    {
        // Lấy tất cả điểm số của học viên cho bài đánh giá này
        
        return view('online.teacher.grades.assessment', compact('assessment_id'));
    }
    
    /**
     * Cập nhật điểm số cho học viên
     */
    public function updateGrades(Request $request)
    {
        // Lưu điểm số mới
        
        return redirect()->back()->with('success', 'Cập nhật điểm thành công');
    }
    
    /**
     * Xuất bảng điểm ra file Excel
     */
    public function exportGrades($class_id)
    {
        // Tạo file Excel chứa bảng điểm của lớp
        
        return response()->download('path-to-excel-file')->deleteFileAfterSend();
    }
} 