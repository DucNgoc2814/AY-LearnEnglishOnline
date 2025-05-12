<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DictationExercise;
use App\Services\FreeDictionaryService;

class DictationController extends Controller
{
    protected $dictionaryService;

    public function __construct(FreeDictionaryService $dictionaryService)
    {
        $this->dictionaryService = $dictionaryService;
    }

    public function show($id)
    {
        // TODO: Get exercise data from database
        $exercise = [
            'id' => $id,
            'audio_url' => '/audio/sample.mp3',
            'correct_text' => 'What is your hobby?',
            'translation' => 'Sở thích của bạn là gì?',
        ];

        return view('online.exercises.dictation', compact('exercise'));
    }

    public function check(Request $request)
    {
        $request->validate([
            'exercise_id' => 'required|integer',
            'user_text' => 'required|string',
        ]);

        // TODO: Get correct text from database
        $correctText = 'What is your hobby?';

        $isCorrect = strtolower(trim($request->user_text)) === strtolower(trim($correctText));

        return response()->json([
            'success' => true,
            'is_correct' => $isCorrect,
            'message' => $isCorrect ? 'You are correct!' : 'Incorrect. Try again!',
        ]);
    }

    public function getScript(Request $request)
    {
        $request->validate([
            'exercise_id' => 'required|integer',
        ]);

        // TODO: Get script data from database
        $script = [
            'text' => 'What is your hobby?',
            'translation' => 'Sở thích của bạn là gì?',
            'words' => ['What', 'is', 'your', 'hobby'],
        ];

        return response()->json([
            'success' => true,
            'data' => $script,
        ]);
    }
}
