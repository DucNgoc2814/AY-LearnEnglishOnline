<?php

namespace App\Http\Controllers\Online\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GradeItem;
use App\Models\Classes;
use App\Models\ClassSession;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GradeController extends Controller
{
    /**
     * Display a listing of the student's grades.
     */
    public function index()
    {
        try {
            $studentId = Auth::id();
            
            // Lấy tất cả lớp học mà học viên đang tham gia
            $classes = Classes::whereHas('students', function($query) use ($studentId) {
                $query->where('users.id', $studentId);
            })->with('teacher')->get();
            
            // Lấy tổng quan điểm số cho mỗi lớp học
            $classGrades = [];
            foreach ($classes as $class) {
                $grades = GradeItem::where('class_id', $class->id)
                    ->where('student_id', $studentId)
                    ->where('is_published', true)
                    ->get();
                
                $classScore = [
                    'class_id' => $class->id,
                    'class_name' => $class->name,
                    'teacher_name' => $class->teacher->name ?? 'N/A',
                    'total_score' => 0,
                    'max_score' => 0,
                    'average' => 0,
                    'items_count' => $grades->count()
                ];
                
                foreach ($grades as $grade) {
                    if ($grade->score !== null) {
                        $classScore['total_score'] += $grade->score;
                        $classScore['max_score'] += $grade->max_score;
                    }
                }
                
                if ($classScore['max_score'] > 0) {
                    $classScore['average'] = ($classScore['total_score'] / $classScore['max_score']) * 10;
                }
                
                $classGrades[] = $classScore;
            }
            
            return view('online.student.grades.index', [
                'classes' => $classes,
                'classGrades' => $classGrades
            ]);
            
        } catch (\Exception $e) {
            Log::error('Lỗi hiển thị điểm cho học viên: ' . $e->getMessage());
            return view('online.student.grades.index', [
                'classes' => collect(),
                'classGrades' => [],
                'error' => 'Không thể tải thông tin điểm. Vui lòng thử lại sau.'
            ]);
        }
    }

    /**
     * Display the specific class grades for a student.
     */
    public function show($classId)
    {
        try {
            $studentId = Auth::id();
            
            // Kiểm tra học viên có thuộc lớp học này không
            $class = Classes::whereHas('students', function($query) use ($studentId) {
                $query->where('users.id', $studentId);
            })
            ->with(['teacher', 'course'])
            ->findOrFail($classId);
            
            // Lấy tất cả đầu điểm có sẵn cho lớp học này
            $gradeItems = GradeItem::where('class_id', $classId)
                ->where('student_id', $studentId)
                ->where('is_published', true)
                ->get()
                ->groupBy('item_name');
            
            // Chuyển đổi dữ liệu để hiển thị
            $formattedGrades = [];
            $totalScore = 0;
            $totalMaxScore = 0;
            
            foreach ($gradeItems as $itemName => $grades) {
                $itemData = [
                    'name' => $itemName,
                    'description' => $grades->first()->description,
                    'type' => $grades->first()->grade_type,
                    'date' => $grades->first()->grade_date,
                    'score' => $grades->first()->score,
                    'max_score' => $grades->first()->max_score,
                    'percentage' => 0,
                    'feedback' => $grades->first()->feedback,
                ];
                
                if ($itemData['score'] !== null && $itemData['max_score'] > 0) {
                    $itemData['percentage'] = ($itemData['score'] / $itemData['max_score']) * 100;
                    $totalScore += $itemData['score'];
                    $totalMaxScore += $itemData['max_score'];
                }
                
                $formattedGrades[] = $itemData;
            }
            
            // Tính điểm trung bình
            $averageScore = $totalMaxScore > 0 ? ($totalScore / $totalMaxScore) * 10 : 0;
            
            // Phân loại đánh giá
            $assessment = 'Chưa có đánh giá';
            if ($totalMaxScore > 0) {
                if ($averageScore >= 8.5) {
                    $assessment = 'Xuất sắc';
                } elseif ($averageScore >= 7.0) {
                    $assessment = 'Tốt';
                } elseif ($averageScore >= 5.5) {
                    $assessment = 'Khá';
                } elseif ($averageScore >= 4.0) {
                    $assessment = 'Trung bình';
                } else {
                    $assessment = 'Cần cải thiện';
                }
            }
            
            return view('online.student.grades.show', [
                'class' => $class,
                'grades' => $formattedGrades,
                'averageScore' => $averageScore,
                'assessment' => $assessment,
                'totalItems' => count($formattedGrades)
            ]);
            
        } catch (\Exception $e) {
            Log::error('Lỗi hiển thị chi tiết điểm lớp học: ' . $e->getMessage());
            return redirect()->route('online.student.grades.index')
                ->with('error', 'Không thể tải thông tin điểm. Vui lòng thử lại sau.');
        }
    }
}
