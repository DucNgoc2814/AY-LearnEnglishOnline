<?php

namespace App\Http\Controllers\Online\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\User;
use App\Models\GradeItem;
use App\Models\Test;
use App\Models\ClassSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GradeItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $classId)
    {
        try {
            $class = Classes::with(['teacher', 'students'])->findOrFail($classId);
            
            // Check if the authenticated user is the teacher of this class
            if ($class->teacher_id != Auth::id() && Auth::user()->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }
            
            $gradeItems = GradeItem::where('class_id', $classId)
                ->with(['test', 'student'])
                ->get()
                ->groupBy('item_name');
                
            return response()->json([
                'grade_items' => $gradeItems,
                'class' => $class
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching grade items: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load grade items'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $classId)
    {
        try {
            $class = Classes::findOrFail($classId);
            
            // Check if the authenticated user is the teacher of this class
            if ($class->teacher_id != Auth::id() && Auth::user()->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }
            
            $validated = $request->validate([
                'item_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'max_score' => 'required|numeric|min:0',
                'grade_type' => 'required|string|in:assignment,quiz,exam,participation,other',
                'session_id' => 'nullable|exists:class_sessions,id',
                'test_id' => 'nullable|exists:tests,id',
                'grade_date' => 'required|date',
                'is_published' => 'boolean',
                'student_ids' => 'nullable|array',
                'student_ids.*' => 'exists:users,id'
            ]);
            
            // Determine which students to create grade items for
            $studentIds = $validated['student_ids'] ?? $class->students->pluck('id')->toArray();
            $createdItems = [];
            
            DB::beginTransaction();
            
            foreach ($studentIds as $studentId) {
                $gradeItem = GradeItem::create([
                    'class_id' => $classId,
                    'student_id' => $studentId,
                    'session_id' => $validated['session_id'] ?? null,
                    'test_id' => $validated['test_id'] ?? null,
                    'item_name' => $validated['item_name'],
                    'description' => $validated['description'] ?? null,
                    'score' => 0, // Default score
                    'max_score' => $validated['max_score'],
                    'grade_type' => $validated['grade_type'],
                    'grade_date' => $validated['grade_date'],
                    'is_published' => $validated['is_published'] ?? false
                ]);
                
                // If there's a test associated, create the relationship in the pivot table
                if (!empty($validated['test_id'])) {
                    $gradeItem->tests()->attach($validated['test_id'], [
                        'metadata' => json_encode(['created_at' => now()->toDateTimeString()])
                    ]);
                }
                
                $createdItems[] = $gradeItem;
            }
            
            DB::commit();
            
            return response()->json([
                'message' => 'Grade items created successfully',
                'grade_items' => $createdItems
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating grade item: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create grade item: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $gradeItem = GradeItem::with(['student', 'class', 'test', 'tests'])->findOrFail($id);
            
            // Check if the authenticated user is the teacher of this class
            if ($gradeItem->class->teacher_id != Auth::id() && Auth::user()->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }
            
            return response()->json(['grade_item' => $gradeItem]);
        } catch (\Exception $e) {
            Log::error('Error fetching grade item: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load grade item'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $gradeItem = GradeItem::findOrFail($id);
            
            // Check if the authenticated user is the teacher of this class
            if ($gradeItem->class->teacher_id != Auth::id() && Auth::user()->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }
            
            $validated = $request->validate([
                'score' => 'nullable|numeric|min:0',
                'max_score' => 'nullable|numeric|min:0',
                'feedback' => 'nullable|string',
                'is_published' => 'nullable|boolean',
                'test_id' => 'nullable|exists:tests,id',
            ]);
            
            DB::beginTransaction();
            
            $gradeItem->update($validated);
            
            // Update test association if test_id provided
            if (isset($validated['test_id'])) {
                // Remove existing test associations
                $gradeItem->tests()->detach();
                
                if ($validated['test_id']) {
                    // Add new association
                    $gradeItem->tests()->attach($validated['test_id'], [
                        'metadata' => json_encode(['updated_at' => now()->toDateTimeString()])
                    ]);
                }
            }
            
            DB::commit();
            
            return response()->json([
                'message' => 'Grade item updated successfully',
                'grade_item' => $gradeItem->fresh(['test', 'tests'])
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating grade item: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update grade item: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $gradeItem = GradeItem::findOrFail($id);
            
            // Check if the authenticated user is the teacher of this class
            if ($gradeItem->class->teacher_id != Auth::id() && Auth::user()->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }
            
            DB::beginTransaction();
            
            // Remove test associations
            $gradeItem->tests()->detach();
            
            // Delete the grade item
            $gradeItem->delete();
            
            DB::commit();
            
            return response()->json(['message' => 'Grade item deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting grade item: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete grade item'], 500);
        }
    }
    
    /**
     * Get available tests for a class
     */
    public function getAvailableTests($classId)
    {
        try {
            $class = Classes::findOrFail($classId);
            
            // Check if the authenticated user is the teacher of this class
            if ($class->teacher_id != Auth::id() && Auth::user()->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }
            
            // Get tests related to this class
            $tests = Test::whereHasMorph(
                'testable',
                [Classes::class],
                function ($query) use ($classId) {
                    $query->where('testable_id', $classId);
                }
            )->get();
            
            return response()->json(['tests' => $tests]);
        } catch (\Exception $e) {
            Log::error('Error fetching available tests: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load tests'], 500);
        }
    }
    
    /**
     * Batch update multiple grade items
     */
    public function batchUpdate(Request $request, $classId)
    {
        try {
            $class = Classes::findOrFail($classId);
            
            // Check if the authenticated user is the teacher of this class
            if ($class->teacher_id != Auth::id() && Auth::user()->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }
            
            $validated = $request->validate([
                'items' => 'required|array',
                'items.*.id' => 'required|exists:grade_items,id',
                'items.*.score' => 'nullable|numeric|min:0',
                'items.*.feedback' => 'nullable|string',
                'items.*.is_published' => 'nullable|boolean'
            ]);
            
            DB::beginTransaction();
            
            $updatedItems = [];
            foreach ($validated['items'] as $item) {
                $gradeItem = GradeItem::findOrFail($item['id']);
                
                // Only update specified fields
                $updateData = [];
                if (isset($item['score'])) $updateData['score'] = $item['score'];
                if (isset($item['feedback'])) $updateData['feedback'] = $item['feedback'];
                if (isset($item['is_published'])) $updateData['is_published'] = $item['is_published'];
                
                $gradeItem->update($updateData);
                $updatedItems[] = $gradeItem->fresh();
            }
            
            DB::commit();
            
            return response()->json([
                'message' => 'Grade items updated successfully',
                'grade_items' => $updatedItems
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error batch updating grade items: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update grade items: ' . $e->getMessage()], 500);
        }
    }
    
    /**
     * Import test results as grade items
     */
    public function importTestResults(Request $request, $classId)
    {
        try {
            $class = Classes::findOrFail($classId);
            
            // Check if the authenticated user is the teacher of this class
            if ($class->teacher_id != Auth::id() && Auth::user()->role !== 'admin') {
                return response()->json(['error' => 'Unauthorized access'], 403);
            }
            
            $validated = $request->validate([
                'test_id' => 'required|exists:tests,id',
                'item_name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'grade_type' => 'required|string|in:assignment,quiz,exam,participation,other',
                'is_published' => 'boolean'
            ]);
            
            $test = Test::with(['results'])->findOrFail($validated['test_id']);
            
            DB::beginTransaction();
            
            $createdItems = [];
            
            // Get all students in the class
            $students = $class->students;
            
            foreach ($students as $student) {
                // Find the best test result for this student
                $testResult = $test->results()
                    ->where('user_id', $student->id)
                    ->orderByDesc('score')
                    ->first();
                
                if ($testResult) {
                    $gradeItem = GradeItem::create([
                        'class_id' => $classId,
                        'student_id' => $student->id,
                        'test_id' => $test->id,
                        'item_name' => $validated['item_name'],
                        'description' => $validated['description'] ?? null,
                        'score' => $testResult->score,
                        'max_score' => $test->max_score,
                        'grade_type' => $validated['grade_type'],
                        'grade_date' => now(),
                        'feedback' => "Automatically imported from test: {$test->name}",
                        'is_published' => $validated['is_published'] ?? false
                    ]);
                    
                    // Create the pivot relationship
                    $gradeItem->tests()->attach($test->id, [
                        'metadata' => json_encode([
                            'imported_at' => now()->toDateTimeString(),
                            'test_result_id' => $testResult->id
                        ])
                    ]);
                    
                    $createdItems[] = $gradeItem;
                }
            }
            
            DB::commit();
            
            return response()->json([
                'message' => 'Test results imported successfully as grade items',
                'grade_items' => $createdItems,
                'imported_count' => count($createdItems)
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error importing test results: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to import test results: ' . $e->getMessage()], 500);
        }
    }
}
