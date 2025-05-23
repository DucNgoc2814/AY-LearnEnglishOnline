<?php

namespace App\Http\Controllers;

use App\Models\VideoExerciseClip;
use App\Models\VideoExerciseProgress;
use Illuminate\Http\Request;

class VideoExerciseClipController extends Controller
{
    public function index($lessonId)
    {
        $clips = VideoExerciseClip::where('video_exercise_lesson_id', $lessonId)
            ->orderBy('start_time')
            ->get();

        return response()->json($clips);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'video_exercise_lesson_id' => 'required|exists:video_exercise_lessons,id',
            'title' => 'required|string|max:255',
            'start_time' => 'required|integer|min:0',
            'audio_url' => 'nullable|url',
            'transcript' => 'required|string',
            'translation' => 'nullable|string',
        ]);

        $clip = VideoExerciseClip::create($validated);
        return response()->json($clip);
    }

    public function update(Request $request, $id)
    {
        $clip = VideoExerciseClip::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_time' => 'required|integer|min:0',
            'audio_url' => 'nullable|url',
            'transcript' => 'required|string',
            'translation' => 'nullable|string',
        ]);

        $clip->update($validated);
        return response()->json($clip);
    }

    public function destroy($id)
    {
        $clip = VideoExerciseClip::findOrFail($id);
        $clip->delete();

        return response()->json(['message' => 'Clip đã được xóa thành công']);
    }

    public function markAsCompleted($id)
    {
        $clip = VideoExerciseClip::findOrFail($id);

        // Cập nhật tiến độ của user
        $progress = VideoExerciseProgress::firstOrCreate([
            'user_id' => auth()->id(),
            'video_exercise_lesson_id' => $clip->video_exercise_lesson_id
        ]);

        $progress->completeClip($clip->id);

        return response()->json([
            'success' => true,
            'message' => 'Đã đánh dấu hoàn thành clip',
            'progress' => $progress->step3_progress
        ]);
    }

    public function getClipStatus($id)
    {
        $clip = VideoExerciseClip::findOrFail($id);
        $isCompleted = $clip->isCompletedByUser(auth()->id());

        return response()->json([
            'completed' => $isCompleted
        ]);
    }
}
