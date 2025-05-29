<?php

namespace App\Http\Controllers;

use App\Models\VideoExerciseLesson;
use Illuminate\Http\Request;

class VideoExerciseLessonController extends Controller
{
    public function index()
    {
        $lessons = VideoExerciseLesson::with(['questions', 'clips'])->get();
        return view('video-exercises.index', compact('lessons'));
    }

    public function show($id)
    {
        $lesson = VideoExerciseLesson::findOrFail($id);
        return view('online.classes.video-exercise.show', compact('lesson'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
            'description' => 'nullable|string',
        ]);

        $lesson = VideoExerciseLesson::create($validated);
        return redirect()->route('video-exercises.show', $lesson->id)
            ->with('success', 'Bài tập video đã được tạo thành công.');
    }

    public function update(Request $request, $id)
    {
        $lesson = VideoExerciseLesson::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
            'description' => 'nullable|string',
        ]);

        $lesson->update($validated);
        return redirect()->route('video-exercises.show', $lesson->id)
            ->with('success', 'Bài tập video đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        $lesson = VideoExerciseLesson::findOrFail($id);
        $lesson->delete();

        return redirect()->route('video-exercises.index')
            ->with('success', 'Bài tập video đã được xóa thành công.');
    }
}
