<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\FreeDictionaryService;

class OxfordController extends Controller
{
    protected $dictionaryService;

    public function __construct(FreeDictionaryService $dictionaryService)
    {
        $this->dictionaryService = $dictionaryService;
    }

    public function processText(Request $request)
    {
        try {
            $word = trim($request->input('text'));
            if (empty($word)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please enter a word to look up'
                ]);
            }

            // Remove any punctuation and get the first word only
            $word = preg_replace('/[^a-zA-Z\s]/', '', $word);
            $word = strtok($word, ' ');

            if (empty($word)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please enter a valid English word'
                ]);
            }

            Log::info('Looking up word: ' . $word);
            $wordInfo = $this->dictionaryService->getWordInfo($word);

                    if ($wordInfo) {
                        Log::info('Word info found:', ['word' => $word, 'info' => $wordInfo]);
                return response()->json([
                    'success' => true,
                    'data' => [$wordInfo] // Wrap in array to maintain compatibility with frontend
                ]);
                    } else {
                        Log::warning('No word info found for: ' . $word);
                return response()->json([
                    'success' => false,
                    'message' => 'Word not found in dictionary'
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Error in processText: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while looking up the word'
            ], 500);
        }
    }
}
