<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VocabularyListeningDictationProgress;
use Illuminate\Support\Facades\Auth;

class VocabularyListeningDictationController extends Controller
{
    public function saveProgress(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'dictation_id' => 'required|exists:vocabulary_listening_dictations,id',
                'progress' => 'required|numeric|min:0|max:100',
                'score' => 'required|numeric|min:0|max:100',
                'completed_blanks' => 'required|array'
            ]);

            $progress = VocabularyListeningDictationProgress::updateOrCreate(
                [
                    'student_id' => Auth::id(),
                    'dictation_id' => $validatedData['dictation_id']
                ],
                [
                    'progress' => $validatedData['progress'],
                    'highest_score' => max($validatedData['score'], $this->getCurrentHighestScore($validatedData['dictation_id'])),
                    'completed_blanks' => $validatedData['completed_blanks'],
                    'last_activity' => now(),
                    'retries' => $this->incrementRetries($validatedData['dictation_id']),
                    'scores_history' => $this->updateScoresHistory($validatedData['dictation_id'], $validatedData['score'])
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Tiến độ đã được lưu thành công',
                'data' => $progress
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lưu tiến độ: ' . $e->getMessage()
            ], 500);
        }
    }

    private function getCurrentHighestScore($dictationId)
    {
        $currentProgress = VocabularyListeningDictationProgress::where('student_id', Auth::id())
            ->where('dictation_id', $dictationId)
            ->first();

        return $currentProgress ? $currentProgress->highest_score : 0;
    }

    private function incrementRetries($dictationId)
    {
        $currentProgress = VocabularyListeningDictationProgress::where('student_id', Auth::id())
            ->where('dictation_id', $dictationId)
            ->first();

        return $currentProgress ? $currentProgress->retries + 1 : 1;
    }

    private function updateScoresHistory($dictationId, $newScore)
    {
        $currentProgress = VocabularyListeningDictationProgress::where('student_id', Auth::id())
            ->where('dictation_id', $dictationId)
            ->first();

        $scoresHistory = $currentProgress ? $currentProgress->scores_history ?? [] : [];
        $scoresHistory[] = [
            'score' => $newScore,
            'date' => now()->toDateTimeString()
        ];

        return $scoresHistory;
    }
}
