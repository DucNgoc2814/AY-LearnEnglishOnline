<?php

namespace App\Http\Controllers;

use App\Models\LessonProgress;
use App\Models\Lesson;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LessonProgressController extends Controller
{
    /**
     * Save or update lesson progress
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveProgress(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'enrollment_id' => 'required|exists:enrollments,id',
            'watched_time' => 'required|integer|min:0',
            'total_time' => 'required|integer|min:0',
            'status' => 'required|in:in_progress,completed',
        ]);

        $user = Auth::user();
        
        // Verify enrollment belongs to the user
        $enrollment = Enrollment::where('id', $request->enrollment_id)
            ->where('user_id', $user->id)
            ->firstOrFail();
            
        // Get lesson to verify it belongs to the course
        $lesson = Lesson::findOrFail($request->lesson_id);
        
        // Verify lesson belongs to the course in enrollment
        if ($lesson->course_id !== $enrollment->course_id) {
            return response()->json([
                'success' => false,
                'message' => 'Lesson does not belong to the enrolled course',
            ], 403);
        }
        
        // Calculate completion status
        $status = $request->status;
        $completedAt = null;
        
        if ($status === 'completed') {
            $completedAt = now();
        }
        
        // Update or create progress
        $progress = LessonProgress::updateOrCreate(
            [
                'enrollment_id' => $request->enrollment_id,
                'lesson_id' => $request->lesson_id,
            ],
            [
                'watched_time' => $request->watched_time,
                'total_time' => $request->total_time,
                'status' => $status,
                'last_watched_at' => now(),
                'completed_at' => $completedAt,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Lesson progress saved successfully',
            'data' => $progress,
        ]);
    }

    /**
     * Get lesson progress for the current user
     *
     * @param int $lessonId
     * @param int $enrollmentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProgress($lessonId, $enrollmentId)
    {
        $user = Auth::user();
        
        // Verify enrollment belongs to the user
        $enrollment = Enrollment::where('id', $enrollmentId)
            ->where('user_id', $user->id)
            ->firstOrFail();
        
        $progress = LessonProgress::where('enrollment_id', $enrollmentId)
            ->where('lesson_id', $lessonId)
            ->first();
            
        if (!$progress) {
            return response()->json([
                'success' => true,
                'data' => [
                    'watched_time' => 0,
                    'total_time' => 0,
                    'status' => 'in_progress',
                    'last_watched_at' => null,
                    'completed_at' => null,
                ]
            ]);
        }
        
        return response()->json([
            'success' => true,
            'data' => $progress,
        ]);
    }
    
    /**
     * Get all lesson progress for a course
     *
     * @param int $enrollmentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCourseProgress($enrollmentId)
    {
        $user = Auth::user();
        
        // Verify enrollment belongs to the user
        $enrollment = Enrollment::where('id', $enrollmentId)
            ->where('user_id', $user->id)
            ->firstOrFail();
            
        $progress = LessonProgress::where('enrollment_id', $enrollmentId)
            ->with('lesson')
            ->get();
            
        return response()->json([
            'success' => true,
            'data' => $progress,
        ]);
    }
} 