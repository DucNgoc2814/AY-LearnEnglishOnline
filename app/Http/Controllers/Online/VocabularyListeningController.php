<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use App\Models\VocabularyListeningQuizlet;
use App\Models\VocabularyListeningDictation;
use App\Models\VocabularyListeningKeyPhrase;
use App\Models\VocabularyListeningDictationProgress;
use App\Models\VocabularyListeningSentenceBuilding;
use App\Models\VocabularyListeningSentenceBuildingProgress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\VocabularyListeningGrammar;
use App\Models\VocabularyListeningGrammarProgress;
use App\Models\VocabularyListeningTranscription;
use App\Models\VocabularyListeningTranscriptionProgress;

class VocabularyListeningController extends Controller
{
    public function show($lesson_id = null)
    {
        // Get the first Quizlet from database
        $quizlet = VocabularyListeningQuizlet::first();

        // Get dictation exercises for specific lesson only
        $dictationQuery = VocabularyListeningDictation::with('lesson')
            ->orderBy('lesson_id');

        if ($lesson_id) {
            $dictationQuery->where('lesson_id', $lesson_id);
        }

        $dictationExercises = $dictationQuery->get()
            ->groupBy('lesson_id')
            ->map(function ($exercises) {
                $firstExercise = $exercises->first();
                return [
                    'title' => $firstExercise->title,
                    'exercises' => $exercises->map(function ($exercise) {
                        // Get media URL using the HasMedia trait method
                        $audioUrl = $exercise->getMediaUrl('audio_url');

                        return [
                            'id' => $exercise->id,
                            'text' => $this->generateDisplayText($exercise->display_text, json_decode($exercise->getRawOriginal('blank_words'), true)),
                            'answer' => $exercise->correct_text,
                            'audio_url' => $audioUrl,
                            'audio_file' => $exercise->audio_url,
                            'file_type' => 'audio' // Force audio type for dictation exercises
                        ];
                    })->values()
                ];
            })->values();

        // Lấy dữ liệu transcription từ database
        $transcriptionWords = [];
        if ($lesson_id) {
            $transcriptionWords = \App\Models\VocabularyListeningTranscription::where('lesson_id', $lesson_id)
                ->select('word', 'correct_phonetic')
                ->get()
                ->map(function ($item) {
                    return [
                        'word' => $item->word,
                        'phonetic' => $item->correct_phonetic
                    ];
                })
                ->toArray();
        }

        // Get key phrases from database for this lesson
        $keyPhrases = VocabularyListeningKeyPhrase::where('lesson_id', $lesson_id)
            ->get()
            ->map(function ($phrase) {
                // Xử lý highlighted words
                $highlightedWords = $phrase->highlighted_words;

                // Nếu là chuỗi JSON, decode nó
                if (is_string($highlightedWords)) {
                    $decoded = json_decode($highlightedWords, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $highlightedWords = $decoded;
                    } else {
                        // Nếu không phải JSON, xử lý như chuỗi thường
                        $words = array_map('trim', explode(',', $highlightedWords));
                        $highlightedWords = array_map(function($word) {
                            return [
                                'id' => 0,
                                'word' => $word,
                                'position' => 0
                            ];
                        }, array_filter($words));
                    }
                }

                return [
                    'id' => $phrase->id,
                    'english' => [
                        'incomplete' => $phrase->incomplete_phrase,
                        'complete' => $phrase->english_phrase,
                        'blanks' => $this->extractBlanks($phrase->incomplete_phrase, $phrase->english_phrase)
                    ],
                    'vietnamese' => $phrase->vietnamese_phrase,
                    'highlighted_words' => $highlightedWords
                ];
            });

        // Lấy câu từ database và kiểm tra dữ liệu
        $sentenceBuildings = [];
        $sentenceBuildingMessage = null;

        if ($lesson_id) {
            $sentenceBuildings = VocabularyListeningSentenceBuilding::where('lesson_id', $lesson_id)
                ->orderBy('sentence_number')
                ->get()
                ->map(function ($sentence) {
                    // Tách câu thành mảng các từ
                    $words = explode(' ', $sentence->correct_sentence);
                    // Đảo ngẫu nhiên thứ tự các từ
                    shuffle($words);

                    return [
                        'id' => $sentence->id,
                        'words' => $words, // Trả về mảng các từ đã được đảo ngẫu nhiên
                        'answer' => $sentence->correct_sentence,
                        'max_retries' => $sentence->max_retries,
                        'min_required_score' => $sentence->min_required_score
                    ];
                });

            // Kiểm tra nếu không có dữ liệu
            if ($sentenceBuildings->isEmpty()) {
                $sentenceBuildingMessage = [
                    'type' => 'info',
                    'message' => 'Hiện tại chưa có bài tập Sentence Building cho bài học này.'
                ];
            }
        } else {
            $sentenceBuildingMessage = [
                'type' => 'info',
                'message' => 'Vui lòng chọn một bài học để xem các bài tập Sentence Building.'
            ];
        }

        // Lấy bài tập grammar từ database
        $grammarExercises = [];
        $grammarMessage = null;

        if ($lesson_id) {
            $grammarExercises = VocabularyListeningGrammar::where('lesson_id', $lesson_id)
                ->get()
                ->map(function ($grammar) {
                    return [
                        'id' => $grammar->id,
                        'sentence' => $grammar->sentence,
                        'vietnamese_word' => $grammar->vietnamese_word,
                        'correct_synonym' => $grammar->correct_synonym
                    ];
                });

            if ($grammarExercises->isEmpty()) {
                $grammarMessage = [
                    'type' => 'info',
                    'message' => 'Hiện tại chưa có bài tập Grammar cho bài học này.'
                ];
            }
        } else {
            $grammarMessage = [
                'type' => 'info',
                'message' => 'Vui lòng chọn một bài học để xem các bài tập Grammar.'
            ];
        }

        // Word bank cho grammar exercises
        $wordBank = collect($grammarExercises)->pluck('correct_synonym')->unique()->values()->toArray();

        $data = [
            'title' => 'Vocabulary & Listening Practice',
            'current_lesson_id' => $lesson_id,
            'steps' => [
                [
                    'id' => 'step1',
                    'title' => 'INSTRUCTIONS & VIDEO',
                    'description' => 'Xem video hướng dẫn về phương pháp học',
                    'video_url' => 'https://www.youtube.com/watch?v=example'
                ],
                [
                    'id' => 'step2',
                    'title' => 'QUIZLET',
                    'description' => 'Học từ vựng với Quizlet',
                    'quizlet_url' => $quizlet ? $quizlet->url : '#',
                    'guide_url' => route('online.guides.show', 'quizlet')
                ],
                [
                    'id' => 'step3',
                    'title' => 'DICTATION',
                    'description' => 'Luyện nghe và điền từ',
                    'dictation_id' => $dictationExercises->count() > 0 ? $dictationExercises[0]['exercises'][0]['id'] : null,
                    'dictation_exercises' => $dictationExercises
                ],
                [
                    'id' => 'step4',
                    'title' => 'KEY PHRASES',
                    'description' => 'Có 2 cột: một cột tiếng Việt & 1 cột tiếng Anh. Cột tiếng Anh để 1 chỗ trống để học viên tự điền',
                    'phrases' => $keyPhrases
                ],
                [
                    'id' => 'step5',
                    'title' => 'SENTENCE BUILDING',
                    'description' => 'Kéo thả để sắp xếp các từ dưới đây thành một câu đúng',
                    'sentences' => $sentenceBuildings,
                    'message' => $sentenceBuildingMessage
                ],
                [
                    'id' => 'step6',
                    'title' => 'GRAMMAR (Trạng từ + Tính từ)',
                    'description' => 'Kéo thả từ trong hộp để di chuyển đáp án lên câu hỏi',
                    'grammar_exercise' => [
                        'grammar_id' => !empty($grammarExercises) ? $grammarExercises[0]['id'] : null,
                        'word_bank' => $wordBank,
                        'questions' => $grammarExercises,
                        'message' => $grammarMessage
                    ]
                ],
                [
                    'id' => 'step7',
                    'title' => 'TRANSCRIPTION',
                    'description' => 'Tra phiên âm NAmE (North American English) của 10 từ',
                    'dictionary_url' => 'https://www.oxfordlearnersdictionaries.com/',
                    'words' => $transcriptionWords
                ],
                [
                    'id' => 'step8',
                    'title' => 'ENDING SOUND',
                    'description' => 'Thêm âm cuối cho 5 từ theo quy tắc'
                ],
                [
                    'id' => 'step9',
                    'title' => 'LISTENING & READING – TEST 1',
                    'description' => 'Làm bài test về kỹ năng nghe & đọc trong 10 phút'
                ]
            ]
        ];

        return view('online.classes.vocabulary-listening.show', $data);
    }

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

    public function savePhrasesProgress(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'key_phrase_id' => 'required|exists:vocabulary_listening_key_phrases,id',
                'progress' => 'required|numeric|min:0|max:100',
                'score' => 'required|numeric|min:0|max:100',
                'completed_items' => 'required|array',
                'current_position' => 'required|integer|min:0'
            ]);

            $progress = \App\Models\VocabularyListeningKeyPhraseProgress::updateOrCreate(
                [
                    'student_id' => Auth::id(),
                    'key_phrase_id' => $validatedData['key_phrase_id']
                ],
                [
                    'progress' => $validatedData['progress'],
                    'highest_score' => max($validatedData['score'], $this->getCurrentKeyPhraseHighestScore($validatedData['key_phrase_id'])),
                    'completed_items' => $validatedData['completed_items'],
                    'current_position' => $validatedData['current_position'],
                    'last_attempt' => now(),
                    'retries' => $this->incrementKeyPhraseRetries($validatedData['key_phrase_id']),
                    'scores_history' => $this->updateKeyPhraseScoresHistory($validatedData['key_phrase_id'], $validatedData['score'])
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

    public function saveSentenceProgress(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'sentence_building_id' => 'required|exists:vocabulary_listening_sentence_buildings,id',
                'current_position' => 'required|integer|min:0',
                'completed_count' => 'required|integer|min:0',
                'attempts' => 'required|array',
                'score' => 'required|numeric|min:0|max:100'
            ]);

            // Tính toán tiến độ dựa trên số câu đã hoàn thành
            $totalSentences = VocabularyListeningSentenceBuilding::where('lesson_id', $request->lesson_id)->count();
            $progress = ($validatedData['completed_count'] / $totalSentences) * 100;

            $progress = VocabularyListeningSentenceBuildingProgress::updateOrCreate(
                [
                    'student_id' => Auth::id(),
                    'sentence_building_id' => $validatedData['sentence_building_id']
                ],
                [
                    'progress' => $progress,
                    'current_position' => $validatedData['current_position'],
                    'completed_count' => $validatedData['completed_count'],
                    'attempts' => $validatedData['attempts'],
                    'last_attempt' => now(),
                    'retries' => DB::raw('retries + 1'),
                    'scores_history' => DB::raw("JSON_ARRAY_APPEND(
                        COALESCE(scores_history, '[]'),
                        '$',
                        '" . json_encode(['score' => $validatedData['score'], 'date' => now()]) . "'
                    )")
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

    public function saveGrammarProgress(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'grammar_id' => 'required|exists:vocabulary_listening_grammars,id',
                'progress' => 'required|numeric|min:0|max:100',
                'score' => 'required|numeric|min:0|max:100',
                'completed_items' => 'required|array',
                'current_position' => 'required|integer|min:0'
            ]);

            // Lấy grammar để kiểm tra điểm tối thiểu
            $grammar = VocabularyListeningGrammar::find($validatedData['grammar_id']);
            $minScoreAchieved = $validatedData['score'] >= $grammar->min_required_score;

            $progress = VocabularyListeningGrammarProgress::updateOrCreate(
                [
                    'student_id' => Auth::id(),
                    'grammar_id' => $validatedData['grammar_id']
                ],
                [
                    'progress' => $validatedData['progress'],
                    'highest_score' => max($validatedData['score'], $this->getGrammarHighestScore($validatedData['grammar_id'])),
                    'completed_items' => $validatedData['completed_items'],
                    'current_position' => $validatedData['current_position'],
                    'last_attempt' => now(),
                    'retries' => $this->incrementGrammarRetries($validatedData['grammar_id']),
                    'scores_history' => $this->updateGrammarScoresHistory($validatedData['grammar_id'], $validatedData['score']),
                    'min_score_achieved' => $minScoreAchieved
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

    public function saveTranscriptionProgress(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'lesson_id' => 'required|exists:lessons,id',
                'progress' => 'required|array',
                'progress.*.word' => 'required|string',
                'progress.*.phonetic' => 'required|string'
            ]);

            $totalWords = count($validatedData['progress']);
            $correctWords = 0;
            $completedItems = [];
            $currentPosition = 0;

            // Lưu tiến độ cho từng từ và tính toán số từ đúng
            foreach ($validatedData['progress'] as $index => $wordProgress) {
                $transcription = VocabularyListeningTranscription::where('lesson_id', $validatedData['lesson_id'])
                    ->where('word', $wordProgress['word'])
                    ->first();

                if ($transcription) {
                    // Kiểm tra phiên âm có đúng không
                    $isCorrect = $wordProgress['phonetic'] === $transcription->correct_phonetic;

                    if ($isCorrect) {
                        $correctWords++;
                        $completedItems[] = $wordProgress['word'];
                    }

                    // Cập nhật vị trí hiện tại (từ cuối cùng được làm)
                    $currentPosition = $index + 1;

                    // Tính điểm cho từ này
                    $score = $isCorrect ? 100 : 0;

                    // Lưu tiến độ vào bảng progress
                    $progress = VocabularyListeningTranscriptionProgress::updateOrCreate(
                        [
                            'student_id' => Auth::id(),
                            'transcription_id' => $transcription->id
                        ],
                        [
                            'progress' => ($currentPosition / $totalWords) * 100,
                            'highest_score' => DB::raw("GREATEST(COALESCE(highest_score, 0), $score)"),
                            'completed_items' => $completedItems,
                            'current_position' => $currentPosition,
                            'last_attempt' => now(),
                            'retries' => DB::raw('COALESCE(retries, 0) + 1'),
                            'scores_history' => DB::raw("JSON_ARRAY_APPEND(
                                COALESCE(scores_history, '[]'),
                                '$',
                                '" . json_encode(['score' => $score, 'date' => now()]) . "'
                            )"),
                            'min_score_achieved' => $score >= $transcription->min_required_score
                        ]
                    );
                }
            }

            // Tính tổng điểm và tiến độ chung
            $overallScore = ($correctWords / $totalWords) * 100;
            $overallProgress = ($currentPosition / $totalWords) * 100;

            return response()->json([
                'success' => true,
                'message' => 'Tiến độ đã được lưu thành công',
                'data' => [
                    'score' => round($overallScore, 2),
                    'progress' => round($overallProgress, 2),
                    'correct_words' => $correctWords,
                    'total_words' => $totalWords,
                    'completed_items' => $completedItems
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error saving transcription progress: ' . $e->getMessage());
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

    private function getCurrentKeyPhraseHighestScore($keyPhraseId)
    {
        $currentProgress = \App\Models\VocabularyListeningKeyPhraseProgress::where('student_id', Auth::id())
            ->where('key_phrase_id', $keyPhraseId)
            ->first();

        return $currentProgress ? $currentProgress->highest_score : 0;
    }

    private function incrementKeyPhraseRetries($keyPhraseId)
    {
        $currentProgress = \App\Models\VocabularyListeningKeyPhraseProgress::where('student_id', Auth::id())
            ->where('key_phrase_id', $keyPhraseId)
            ->first();

        return $currentProgress ? $currentProgress->retries + 1 : 1;
    }

    private function updateKeyPhraseScoresHistory($keyPhraseId, $newScore)
    {
        $currentProgress = \App\Models\VocabularyListeningKeyPhraseProgress::where('student_id', Auth::id())
            ->where('key_phrase_id', $keyPhraseId)
            ->first();

        $scoresHistory = $currentProgress ? $currentProgress->scores_history ?? [] : [];
        $scoresHistory[] = [
            'score' => $newScore,
            'date' => now()->toDateTimeString()
        ];

        return $scoresHistory;
    }

    private function getGrammarHighestScore($grammarId)
    {
        $currentProgress = VocabularyListeningGrammarProgress::where('student_id', Auth::id())
            ->where('grammar_id', $grammarId)
            ->first();

        return $currentProgress ? $currentProgress->highest_score : 0;
    }

    private function incrementGrammarRetries($grammarId)
    {
        $currentProgress = VocabularyListeningGrammarProgress::where('student_id', Auth::id())
            ->where('grammar_id', $grammarId)
            ->first();

        return $currentProgress ? $currentProgress->retries + 1 : 1;
    }

    private function updateGrammarScoresHistory($grammarId, $newScore)
    {
        $currentProgress = VocabularyListeningGrammarProgress::where('student_id', Auth::id())
            ->where('grammar_id', $grammarId)
            ->first();

        $scoresHistory = $currentProgress ? $currentProgress->scores_history ?? [] : [];
        $scoresHistory[] = [
            'score' => $newScore,
            'date' => now()->toDateTimeString()
        ];

        return $scoresHistory;
    }

    /**
     * Generate display text with blanks for missing words
     */
    protected function generateDisplayText($displayText, $blankWords)
    {
        if (empty($blankWords)) {
            return $displayText;
        }

        $text = $displayText;
        foreach ($blankWords as $word) {
            $text = str_replace($word['word'], str_repeat('_', strlen($word['word'])), $text);
        }

        return $text;
    }

    /**
     * Helper function để trích xuất các từ bị ẩn
     */
    private function extractBlanks($incompletePhrases, $completePhrases)
    {
        $blanks = [];
        $incompleteWords = explode(' ', $incompletePhrases);
        $completeWords = explode(' ', $completePhrases);

        foreach ($incompleteWords as $index => $word) {
            if (strpos($word, '_') !== false) {
                $blanks[] = $completeWords[$index];
            }
        }

        return $blanks;
    }

    /**
     * Determine file type based on extension
     */
    protected function getFileType($filePath)
    {
        if (!$filePath) return null;

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            return 'image';
        } elseif (in_array($extension, ['mp4', 'mov', 'avi'])) {
            return 'video';
        } elseif (in_array($extension, ['mp3', 'wav'])) {
            return 'audio';
        }

        return 'other';
    }
}
