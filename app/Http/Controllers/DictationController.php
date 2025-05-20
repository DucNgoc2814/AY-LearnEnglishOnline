<?php

namespace App\Http\Controllers;

use App\Models\Dictation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\FreeDictionaryService;
use Stichoza\GoogleTranslate\GoogleTranslate;

class DictationController extends Controller
{
    protected $dictionaryService;
    protected $translator;

    public function __construct(FreeDictionaryService $dictionaryService)
    {
        $this->dictionaryService = $dictionaryService;
        $this->translator = new GoogleTranslate('vi');
    }

    public function index()
    {
        $dictations = Dictation::orderBy('id', 'asc')->get();
        return view('online.exercises.dictation-list', compact('dictations'));
    }

    public function show($id)
    {
        $exercise = Dictation::findOrFail($id);
        $total = Dictation::count();

        return view('online.exercises.dictation', compact('exercise', 'total'));
    }

    public function check(Request $request)
    {
        $request->validate([
            'exercise_id' => 'required|integer',
            'user_text' => 'required|string',
        ]);

        $exercise = Dictation::findOrFail($request->exercise_id);
        $isCorrect = strtolower(trim($request->user_text)) === strtolower(trim($exercise->content));

        return response()->json([
            'success' => true,
            'is_correct' => $isCorrect,
            'message' => $isCorrect ? 'Chính xác!' : 'Chưa chính xác. Hãy thử lại!',
        ]);
    }

    public function getScript(Request $request, $id)
    {
        try {
            $exercise = Dictation::findOrFail($id);

            // Get translation
            $translation = $this->translator->translate($exercise->content);

            // Split content into words and get pronunciation for each
            $words = explode(' ', $exercise->content);
            $pronunciations = [];
            foreach ($words as $word) {
                $wordInfo = $this->dictionaryService->getWordInfo($word);
                $pronunciations[] = [
                    'word' => $word,
                    'phonetic' => $wordInfo['phonetic'] ?? '',
                    'audio_url' => $wordInfo['audio_url'] ?? '',
                    'definitions' => $wordInfo['definitions'] ?? []
                ];
            }

            $script = [
                'text' => $exercise->content,
                'translation' => $translation,
                'audio_url' => $exercise->audio_url,
                'words' => $words,
                'pronunciations' => $pronunciations
            ];

            return response()->json([
                'success' => true,
                'data' => $script,
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting script: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tải script: ' . $e->getMessage()
            ], 500);
        }
    }

    protected function getPronunciation($word)
    {
        try {
            $wordInfo = $this->dictionaryService->getWordInfo($word);
            if (!empty($wordInfo) && isset($wordInfo['phonetic'])) {
                return $wordInfo['phonetic'];
            }
        } catch (\Exception $e) {
            Log::error('Error getting pronunciation: ' . $e->getMessage());
        }
        return '';
    }
}
