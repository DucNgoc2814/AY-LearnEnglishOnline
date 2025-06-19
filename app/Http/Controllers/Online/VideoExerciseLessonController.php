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
        return redirect()->route('online.video-exercise.show', 1);
    }

    public function show($lesson_id)
    {
        try {
            $lesson = VideoExerciseLesson::where('lesson_id', $lesson_id)
                ->with('videoExerciseQuestions') // Load questions relationship
                ->first();

            if (!$lesson) {
                return view('online.classes.video-exercise.show', [
                    'lesson' => null,
                    'message' => 'Bài học này chưa có bài tập video. Vui lòng quay lại sau!'
                ]);
            }

            if (empty($lesson->video_url)) {
                session()->flash('error', 'Video bài học này chưa được cập nhật. Vui lòng quay lại sau!');
                return back();
            }

            // Xử lý URL video từ base URL
            $lesson->video_url = VideoHelper::getEmbedUrl($lesson->video_url);

            // Chuẩn bị dữ liệu cho word bank
            $wordBank = $lesson->videoExerciseQuestions->pluck('correct_answer')->unique()->values()->toArray();

            return view('online.classes.video-exercise.show', compact('lesson', 'wordBank'));
        } catch (\Exception $e) {
            return back()->with('error', 'Không thể tải bài tập video. Vui lòng thử lại sau.');
        }
    }
}
