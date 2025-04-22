<?php

namespace App\Http\Controllers\Online\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\User;
use App\Models\GradeItem;
use App\Models\ClassSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    /**
     * Show all grade items for a specific class
     */
    public function index($classId)
    {
        $class = Classes::with(['students'])->findOrFail($classId);
        
        // Check if the authenticated user is the teacher of this class
        if ($class->teacher_id != Auth::id()) {
            return redirect()->route('online.teacher.classes.index')
                ->with('error', 'Bạn không có quyền truy cập lớp học này.');
        }
        
        $students = $class->students;
        $gradeItems = GradeItem::where('class_id', $classId)
            ->select('id', 'item_name', 'description', 'max_score', 'grade_type')
            ->distinct()
            ->get();
            
        $studentGrades = [];
        foreach ($students as $student) {
            $grades = GradeItem::where('class_id', $classId)
                ->where('student_id', $student->id)
                ->get();
                
            $studentData = [
                'id' => $student->id,
                'student_id' => $student->student_id ?? $student->id,
                'name' => $student->name,
                'grades' => [],
                'total_score' => 0,
                'max_possible' => 0
            ];
            
            foreach ($gradeItems as $item) {
                $grade = $grades->where('item_name', $item->item_name)->first();
                if ($grade) {
                    $studentData['grades'][$item->id] = $grade->score;
                    $studentData['total_score'] += $grade->score;
                    $studentData['max_possible'] += $grade->max_score;
                }
            }
            
            if ($studentData['max_possible'] > 0) {
                $studentData['average'] = ($studentData['total_score'] / $studentData['max_possible']) * 10;
            }
            
            $studentGrades[] = $studentData;
        }
        
        // Calculate class averages
        $classAverages = $this->calculateGradeStatistics($studentGrades);
        $distribution = $this->calculateGradeDistribution($studentGrades);
        
        return view('online.teacher.grades.index', [
            'class' => $class,
            'students' => $studentGrades,
            'gradeItems' => $gradeItems,
            'averages' => $classAverages,
            'distribution' => $distribution
        ]);
    }
    
    /**
     * Add a new grade item
     */
    public function store(Request $request, $classId)
    {
        $class = Classes::findOrFail($classId);
        
        // Check if the authenticated user is the teacher of this class
        if ($class->teacher_id != Auth::id()) {
            return redirect()->route('online.teacher.classes.index')
                ->with('error', 'Bạn không có quyền truy cập lớp học này.');
        }
        
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_score' => 'required|numeric|min:0',
            'grade_type' => 'required|string|in:assignment,quiz,exam,participation,other',
            'session_id' => 'nullable|exists:class_sessions,id',
            'grade_date' => 'required|date'
        ]);
        
        // Create grade items for all students in the class
        $students = $class->students;
        foreach ($students as $student) {
            GradeItem::create([
                'class_id' => $classId,
                'student_id' => $student->id,
                'session_id' => $validated['session_id'] ?? null,
                'item_name' => $validated['item_name'],
                'description' => $validated['description'] ?? null,
                'score' => null, // Initially no score
                'max_score' => $validated['max_score'],
                'grade_type' => $validated['grade_type'],
                'grade_date' => $validated['grade_date'],
                'is_published' => false
            ]);
        }
        
        return redirect()->route('online.teacher.grades.index', $classId)
            ->with('success', 'Đã thêm đầu điểm mới thành công.');
    }
    
    /**
     * Update a student's grade
     */
    public function updateGrade(Request $request, $classId)
    {
        $class = Classes::findOrFail($classId);
        
        // Check if the authenticated user is the teacher of this class
        if ($class->teacher_id != Auth::id()) {
            return redirect()->route('online.teacher.classes.index')
                ->with('error', 'Bạn không có quyền truy cập lớp học này.');
        }
        
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'item_id' => 'required|exists:grade_items,id',
            'score' => 'required|numeric|min:0',
            'feedback' => 'nullable|string'
        ]);
        
        $gradeItem = GradeItem::where('class_id', $classId)
            ->where('student_id', $validated['student_id'])
            ->where('id', $validated['item_id'])
            ->firstOrFail();
            
        $gradeItem->update([
            'score' => $validated['score'],
            'feedback' => $validated['feedback'] ?? null
        ]);
        
        return redirect()->route('online.teacher.grades.index', $classId)
            ->with('success', 'Cập nhật điểm thành công.');
    }
    
    /**
     * Publish grades for the entire class
     */
    public function publishGrades(Request $request, $classId)
    {
        $class = Classes::findOrFail($classId);
        
        // Check if the authenticated user is the teacher of this class
        if ($class->teacher_id != Auth::id()) {
            return redirect()->route('online.teacher.classes.index')
                ->with('error', 'Bạn không có quyền truy cập lớp học này.');
        }
        
        $validated = $request->validate([
            'item_ids' => 'required|array',
            'item_ids.*' => 'exists:grade_items,id',
            'publish' => 'required|boolean'
        ]);
        
        GradeItem::where('class_id', $classId)
            ->whereIn('id', $validated['item_ids'])
            ->update(['is_published' => $validated['publish']]);
            
        $message = $validated['publish'] ? 'Đã công bố điểm cho học viên.' : 'Đã ẩn điểm khỏi học viên.';
        
        return redirect()->route('online.teacher.grades.index', $classId)
            ->with('success', $message);
    }
    
    /**
     * Export grades to Excel
     */
    public function export($classId)
    {
        $class = Classes::with(['students'])->findOrFail($classId);
        
        // Check if the authenticated user is the teacher of this class
        if ($class->teacher_id != Auth::id()) {
            return redirect()->route('online.teacher.classes.index')
                ->with('error', 'Bạn không có quyền truy cập lớp học này.');
        }
        
        // Export logic will be implemented here
        // This can use Laravel Excel or custom CSV export
        
        return redirect()->route('online.teacher.grades.index', $classId)
            ->with('success', 'Đã xuất bảng điểm thành công.');
    }
    
    /**
     * Calculate grade statistics for a class
     */
    private function calculateGradeStatistics($students)
    {
        $averages = [];
        $studentAverages = [];
        
        foreach ($students as $student) {
            if (isset($student['average'])) {
                $studentAverages[] = $student['average'];
            }
        }
        
        if (count($studentAverages) > 0) {
            $averages['class'] = array_sum($studentAverages) / count($studentAverages);
            $averages['highest'] = max($studentAverages);
            $averages['lowest'] = min($studentAverages);
        }
        
        return $averages;
    }
    
    /**
     * Calculate grade distribution for a class
     */
    private function calculateGradeDistribution($students)
    {
        $distribution = [
            '0-4' => 0,
            '4-5.5' => 0,
            '5.5-7' => 0,
            '7-8.5' => 0,
            '8.5-10' => 0
        ];
        
        foreach ($students as $student) {
            if (!isset($student['average'])) {
                continue;
            }
            
            $avg = $student['average'];
            
            if ($avg < 4) {
                $distribution['0-4']++;
            } elseif ($avg < 5.5) {
                $distribution['4-5.5']++;
            } elseif ($avg < 7) {
                $distribution['5.5-7']++;
            } elseif ($avg < 8.5) {
                $distribution['7-8.5']++;
            } else {
                $distribution['8.5-10']++;
            }
        }
        
        return $distribution;
    }
}
