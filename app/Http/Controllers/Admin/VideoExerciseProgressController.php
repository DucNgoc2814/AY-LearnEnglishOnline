<?php

namespace App\Http\Controllers;

use App\Models\VideoExerciseProgress;
use App\Models\VideoExerciseLesson;
use Illuminate\Http\Request;

class VideoExerciseProgressController extends Controller
{
    public function show($lessonId)
    {
        $progress = VideoExerciseProgress::where('user_id', auth()->id())
            ->where('video_exercise_lesson_id', $lessonId)
            ->firstOrCreate([
                'user_id' => auth()->id(),
                'video_exercise_lesson_id' => $lessonId
            ]);

        return response()->json($progress);
    }

    public function updateVideoProgress(Request $request, $lessonId)
    {
        $validated = $request->validate([
            'watch_time' => 'required|integer|min:0',
            'total_duration' => 'required|integer|min:1'
        ]);

        $progress = VideoExerciseProgress::firstOrCreate([
            'user_id' => auth()->id(),
            'video_exercise_lesson_id' => $lessonId
        ]);

        $progress->updateVideoProgress(
            $validated['watch_time'],
            $validated['total_duration']
        );

        return response()->json([
            'step1_progress' => $progress->step1_progress,
            'total_progress' => $progress->total_progress
        ]);
    }

    public function getUserProgress()
    {
        $progress = VideoExerciseProgress::where('user_id', auth()->id())
            ->with('videoExerciseLesson')
            ->get()
            ->map(function ($item) {
                return [
                    'lesson_title' => $item->videoExerciseLesson->title,
                    'step1_progress' => $item->step1_progress,
                    'step2_progress' => $item->step2_progress,
                    'step3_progress' => $item->step3_progress,
                    'total_progress' => $item->total_progress,
                    'completed_at' => $item->completed_at,
                    'last_accessed_at' => $item->last_accessed_at
                ];
            });

        return response()->json($progress);
    }

    public function resetProgress($lessonId)
    {
        $progress = VideoExerciseProgress::where('user_id', auth()->id())
            ->where('video_exercise_lesson_id', $lessonId)
            ->first();

        if ($progress) {
            $progress->update([
                'step1_progress' => 0,
                'step2_progress' => 0,
                'step3_progress' => 0,
                'video_watch_time' => 0,
                'completed_questions' => [],
                'completed_clips' => [],
                'total_progress' => 0,
                'completed_at' => null
            ]);
        }

        return response()->json(['message' => 'Đã reset tiến độ thành công']);
    }

    public function getClassProgress($lessonId)
    {
        // Dành cho giáo viên xem tiến độ của cả lớp
        $allProgress = VideoExerciseProgress::where('video_exercise_lesson_id', $lessonId)
            ->with('user')
            ->get()
            ->map(function ($item) {
                return [
                    'user_name' => $item->user->name,
                    'step1_progress' => $item->step1_progress,
                    'step2_progress' => $item->step2_progress,
                    'step3_progress' => $item->step3_progress,
                    'total_progress' => $item->total_progress,
                    'completed_at' => $item->completed_at,
                    'last_accessed_at' => $item->last_accessed_at
                ];
            });

        return response()->json($allProgress);
    }
}
