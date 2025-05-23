<?php

namespace App\Http\Controllers;

use App\Models\VideoExerciseQuestion;
use App\Models\VideoExerciseProgress;
use Illuminate\Http\Request;

class VideoExerciseQuestionController extends Controller
{
    public function index($lessonId)
    {
        $questions = VideoExerciseQuestion::where('video_exercise_lesson_id', $lessonId)
            ->orderBy('order')
            ->get();

        return response()->json($questions);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'video_exercise_lesson_id' => 'required|exists:video_exercise_lessons,id',
            'time_point' => 'required|integer|min:0',
            'question_text' => 'required|string',
            'context_text' => 'required|string',
            'correct_answer' => 'required|string',
        ]);

        $question = VideoExerciseQuestion::create($validated);
        return response()->json($question);
    }

    public function update(Request $request, $id)
    {
        $question = VideoExerciseQuestion::findOrFail($id);

        $validated = $request->validate([
            'time_point' => 'required|integer|min:0',
            'question_text' => 'required|string',
            'context_text' => 'required|string',
            'correct_answer' => 'required|string',
        ]);

        $question->update($validated);
        return response()->json($question);
    }

    public function destroy($id)
    {
        $question = VideoExerciseQuestion::findOrFail($id);
        $question->delete();

        return response()->json(['message' => 'Câu hỏi đã được xóa thành công']);
    }

    public function checkAnswer(Request $request, $id)
    {
        $question = VideoExerciseQuestion::findOrFail($id);
        $answer = $request->input('answer');

        $isCorrect = $question->checkAnswer($answer);

        if ($isCorrect) {
            // Cập nhật tiến độ của user
            $progress = VideoExerciseProgress::firstOrCreate([
                'user_id' => auth()->id(),
                'video_exercise_lesson_id' => $question->video_exercise_lesson_id
            ]);

            $progress->completeQuestion($question->id);
        }

        return response()->json([
            'correct' => $isCorrect,
            'message' => $isCorrect ? 'Chính xác!' : 'Chưa chính xác, hãy thử lại.'
        ]);
    }

    public function getWordBank($lessonId)
    {
        $questions = VideoExerciseQuestion::where('video_exercise_lesson_id', $lessonId)
            ->pluck('correct_answer')
            ->shuffle();

        return response()->json($questions);
    }
}
