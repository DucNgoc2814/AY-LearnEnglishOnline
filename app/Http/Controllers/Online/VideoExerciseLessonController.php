<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use App\Models\VideoExerciseLesson;
use App\Helpers\VideoHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VideoExerciseLessonController extends Controller
{
    public function index()
    {
        $lessons = VideoExerciseLesson::with(['questions', 'clips'])->get();
        return view('online.classes.video-exercise.index', compact('lessons'));
    }

    public function show($id)
    {
        try {
            $lesson = VideoExerciseLesson::findOrFail($id);

            // Xử lý URL video từ base URL
            $videoUrl = $lesson->video_url;
            if (!empty($videoUrl)) {
                $lesson->video_url = VideoHelper::getEmbedUrl($videoUrl);
                Log::info('Video URL processed:', ['original' => $videoUrl, 'processed' => $lesson->video_url]);
            }

            return view('online.classes.video-exercise.show', compact('lesson'));
        } catch (\Exception $e) {
            Log::error('Error in VideoExerciseLessonController@show: ' . $e->getMessage());
            return redirect()->route('online.video-exercise.index')
                ->with('error', 'Không thể tải bài học video. Vui lòng thử lại sau.');
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'lesson_id' => 'required|exists:lessons,id',
                'title' => 'required|string|max:255',
                'video_url' => 'required|string',
                'description' => 'nullable|string',
            ]);

            $lesson = VideoExerciseLesson::create($validated);
            return redirect()->route('online.video-exercise.show', $lesson->id)
                ->with('success', 'Bài tập video đã được tạo thành công.');
        } catch (\Exception $e) {
            Log::error('Error in VideoExerciseLessonController@store: ' . $e->getMessage());
            return back()->with('error', 'Không thể tạo bài tập video. Vui lòng thử lại sau.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $lesson = VideoExerciseLesson::findOrFail($id);

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'video_url' => 'required|string',
                'description' => 'nullable|string',
            ]);

            $lesson->update($validated);
            return redirect()->route('online.video-exercise.show', $lesson->id)
                ->with('success', 'Bài tập video đã được cập nhật thành công.');
        } catch (\Exception $e) {
            Log::error('Error in VideoExerciseLessonController@update: ' . $e->getMessage());
            return back()->with('error', 'Không thể cập nhật bài tập video. Vui lòng thử lại sau.');
        }
    }

    public function destroy($id)
    {
        try {
            $lesson = VideoExerciseLesson::findOrFail($id);
            $lesson->delete();

            return redirect()->route('online.video-exercise.index')
                ->with('success', 'Bài tập video đã được xóa thành công.');
        } catch (\Exception $e) {
            Log::error('Error in VideoExerciseLessonController@destroy: ' . $e->getMessage());
            return back()->with('error', 'Không thể xóa bài tập video. Vui lòng thử lại sau.');
        }
    }
}
