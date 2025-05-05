<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\OxfordDictionaryService;
use Stichoza\GoogleTranslate\GoogleTranslate;

class OxfordController extends Controller
{
    protected $oxfordService;
    protected $translator;

    public function __construct(OxfordDictionaryService $oxfordService)
    {
        $this->oxfordService = $oxfordService;

        try {
            $this->translator = new GoogleTranslate();
            $this->translator->setSource('vi');
            $this->translator->setTarget('en');
        } catch (\Exception $e) {
            Log::error('Error initializing GoogleTranslate: ' . $e->getMessage());
        }
    }

    public function processText(Request $request)
    {
        try {
            $text = $request->input('text');
            if (empty($text)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vui lòng nhập văn bản cần tra cứu'
                ]);
            }

            if (!$this->translator) {
                throw new \Exception('Dịch vụ dịch thuật không khả dụng');
            }

            Log::info('Processing text: ' . $text);
            $translatedText = $this->translator->translate($text);
            Log::info('Translated text: ' . $translatedText);

            if (empty($translatedText)) {
                throw new \Exception('Không thể dịch văn bản');
            }

            $words = explode(' ', trim($translatedText));
            $results = [];

            foreach ($words as $word) {
                $word = trim($word);
                if (empty($word)) continue;

                try {
                    Log::info('Processing word: ' . $word);
                    $wordInfo = $this->oxfordService->getWordInfo($word);

                    if ($wordInfo) {
                        Log::info('Word info found:', ['word' => $word, 'info' => $wordInfo]);
                        $results[] = $wordInfo;
                    } else {
                        Log::warning('No word info found for: ' . $word);
                        $results[] = [
                            'word' => $word,
                            'phonetic' => null,
                            'audio_url' => null,
                            'definitions' => [],
                            'examples' => [],
                            'pronunciations' => []
                        ];
                    }
                } catch (\Exception $e) {
                    Log::error('Error processing word: ' . $word, ['error' => $e->getMessage()]);
                    $results[] = [
                        'word' => $word,
                        'phonetic' => null,
                        'audio_url' => null,
                        'definitions' => [],
                        'examples' => [],
                        'pronunciations' => []
                    ];
                }
            }

            return response()->json([
                'success' => true,
                'originalText' => $text,
                'translatedText' => $translatedText,
                'data' => $results
            ]);

        } catch (\Exception $e) {
            Log::error('Error in processText: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
}
