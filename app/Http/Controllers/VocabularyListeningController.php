<?php

namespace App\Http\Controllers;

use App\Models\VocabularyListeningQuizlet;
use App\Models\VocabularyListeningDictation;
use Illuminate\Http\Request;

class VocabularyListeningController extends Controller
{
    public function show()
    {
        // Get the first Quizlet from database
        $quizlet = VocabularyListeningQuizlet::first();

        // Get all dictation exercises grouped by lesson
        $dictationExercises = VocabularyListeningDictation::with('lesson')
            ->orderBy('lesson_id')
            ->get()
            ->groupBy('lesson_id')
            ->map(function ($exercises) {
                $firstExercise = $exercises->first();
                return [
                    'title' => $firstExercise->title,
                    'exercises' => $exercises->map(function ($exercise) {
                        return [
                            'id' => $exercise->id,
                            'text' => $this->generateDisplayText($exercise->display_text, json_decode($exercise->getRawOriginal('blank_words'), true)),
                            'answer' => $exercise->correct_text,
                            'audio_url' => $exercise->audio_url
                        ];
                    })->values()
                ];
            })->values();

        $data = [
            'title' => 'Vocabulary & Listening Practice',
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
                    'phrases' => [
                        [
                            'english' => [
                                'incomplete' => 'It\'s f___, f___ its landmarks',
                                'complete' => 'It\'s famous for its landmarks'
                            ],
                            'vietnamese' => 'Nơi đó nổi tiếng về các địa danh'
                        ],
                        [
                            'english' => [
                                'incomplete' => 'It\'s also w___ f___ its food',
                                'complete' => 'It\'s also well-known for its food'
                            ],
                            'vietnamese' => 'Nơi đó cũng nổi tiếng về ẩm thực.'
                        ],
                        [
                            'english' => [
                                'incomplete' => 'It\'s a h___, b___, i___ city',
                                'complete' => 'It\'s a huge, bustling, international city'
                            ],
                            'vietnamese' => 'Đó là một thành phố rộng lớn, hối hả & đa quốc tịch.'
                        ]
                    ]
                ],
                [
                    'id' => 'step5',
                    'title' => 'SENTENCE BUILDING',
                    'description' => 'Kéo thả để sắp xếp các từ dưới đây thành một câu đúng',
                    'sentences' => [
                        [
                            'words' => ['great', 'is', 'but', 'living', 'really', 'of', 'cost', 'Paris', 'high', 'the', ','],
                            'answer' => 'Paris is really great but , the cost of living is high'
                        ],
                        [
                            'words' => ['boring', 'it', 'a', 'find', 'I', 'bit'],
                            'answer' => 'I find it a bit boring'
                        ],
                        [
                            'words' => ['on', 'hot', 'weather', 'very', 'the', 'I\'m', 'not', 'keen'],
                            'answer' => 'I\'m not very keen on the hot weather'
                        ],
                        [
                            'words' => ['to', 'the', 'are', 'tourists', 'very', 'friendly', 'locals', 'off', 'first'],
                            'answer' => 'the locals are very friendly to tourists off first'
                        ],
                        [
                            'words' => ['dishes', 'of', 'wide', 'come', 'local', 'from', 'far', 'many', 'enjoy', 'to', 'variety', 'foreigners', 'the'],
                            'answer' => 'many foreigners come from far to enjoy the wide variety of local dishes'
                        ],
                        [
                            'words' => ['five', 'been', 'there', 'for', 'about', 'living', 'I\'ve', 'years'],
                            'answer' => 'I\'ve been living there for about five years'
                        ]
                    ]
                ],
                [
                    'id' => 'step6',
                    'title' => 'GRAMMAR (Trạng từ + Tính từ)',
                    'description' => 'Kéo thả từ trong hộp để di chuyển đáp án lên câu hỏi',
                    'grammar_exercise' => [
                        'word_bank' => [
                            'fairly large',
                            'really stressful',
                            'somewhat expensive',
                            'a bit boring',
                            'stunningly beautiful',
                            'extremely delicious',
                            'pretty boring',
                            'really high',
                            'extremely hospitable',
                            'really pleasant'
                        ],
                        'questions' => [
                            [
                                'sentence' => 'My hometown is a khá rộng town',
                                'vietnamese_word' => 'khá rộng',
                                'correct_synonym' => 'fairly large'
                            ],
                            [
                                'sentence' => 'The fresh food from the farms is cực kì ngon',
                                'vietnamese_word' => 'cực kì ngon',
                                'correct_synonym' => 'extremely delicious'
                            ],
                            [
                                'sentence' => 'It\'s a thực sự căng thẳng place',
                                'vietnamese_word' => 'thực sự căng thẳng',
                                'correct_synonym' => 'really stressful'
                            ],
                            [
                                'sentence' => 'My hometown is a khá nhàm chán village',
                                'vietnamese_word' => 'khá nhàm chán',
                                'correct_synonym' => 'pretty boring'
                            ],
                            [
                                'sentence' => 'It\'s hơi đắt in my hometown',
                                'vietnamese_word' => 'hơi đắt',
                                'correct_synonym' => 'somewhat expensive'
                            ],
                            [
                                'sentence' => 'The cost of living is thực sự cao',
                                'vietnamese_word' => 'thực sự cao',
                                'correct_synonym' => 'really high'
                            ],
                            [
                                'sentence' => 'Banbury\'s nice, but sometimes I find it hơi tẻ nhạt',
                                'vietnamese_word' => 'hơi tẻ nhạt',
                                'correct_synonym' => 'a bit boring'
                            ],
                            [
                                'sentence' => 'The locals here are cực kì hiếu khách',
                                'vietnamese_word' => 'cực kì hiếu khách',
                                'correct_synonym' => 'extremely hospitable'
                            ],
                            [
                                'sentence' => 'It has tuyệt đẹp beaches',
                                'vietnamese_word' => 'tuyệt đẹp',
                                'correct_synonym' => 'stunningly beautiful'
                            ]
                        ]
                    ]
                ],
                [
                    'id' => 'step7',
                    'title' => 'TRANSCRIPTION',
                    'description' => 'Tra phiên âm NAmE (North American English) của 10 từ',
                    'dictionary_url' => 'https://www.oxfordlearnersdictionaries.com/'
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
}
