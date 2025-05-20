<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VocabularyListeningController extends Controller
{
    public function show()
    {
        $data = [
            'title' => 'Vocabulary & Listening Practice',
            'steps' => [
                [
                    'id' => 'step0',
                    'title' => 'XEM VIDEO 6 BƯỚC LÀM "ACTIVE LISTENING"',
                    'description' => 'Xem video hướng dẫn về phương pháp Active Listening',
                    'video_url' => 'https://drive.google.com/drive/folders/1oFPtDF8ajwokCpVHEgTew4UZVbOtD7A0?usp=sharing'
                ],
                [
                    'id' => 'step1',
                    'title' => 'QUIZLET',
                    'description' => 'Học từ mới (Unit 1: Hometown) với 4 tính năng trên quizlet',
                    'quizlet_url' => 'https://quizlet.com/join/ezqH7nkEv?i=qpkku&x=1bqt',
                    'guide_url' => 'https://drive.google.com/drive/folders/112lwm_z4CeM8pMi2nMQe8GQ6sMcDg7YO?usp=sharing'
                ],
                [
                    'id' => 'step2',
                    'title' => 'DICTATION',
                    'description' => 'Mở audio, nghe & điền từ còn thiếu vào chỗ trống',
                    'dictation_exercises' => [
                        [
                            'title' => 'Audio 1: General information',
                            'exercises' => [
                                [
                                    'id' => '1.1',
                                    'text' => 'I live in Paris, it\'s the capital city. It\'s ________________ its _________________ such as the Eiffel Tower, Notre Dame Cathedral or the Louvre. It\'s also _________________ its food, of course!',
                                    'answer' => 'I live in Paris, it\'s the capital city. It\'s famous for its landmarks such as the Eiffel Tower, Notre Dame Cathedral or the Louvre. It\'s also well-known for its food, of course!'
                                ],
                                [
                                    'id' => '1.2',
                                    'text' => 'I live in Shanghai. It\'s a __________, _______________, _________________ city. People from all over the world live and work there.',
                                    'answer' => 'I live in Shanghai. It\'s a huge, bustling, international city. People from all over the world live and work there.'
                                ],
                                [
                                    'id' => '1.3',
                                    'text' => 'I live in a small town called Banbury. I\'ve ______________ there for about five years, since I finished university. It\'s a _________________, to be honest.',
                                    'answer' => 'I live in a small town called Banbury. I\'ve been living there for about five years, since I finished university. It\'s a pretty sleepy place, to be honest.'
                                ],
                                [
                                    'id' => '1.4',
                                    'text' => 'Well, I was born in a ______________ outside of Hangzhou, but I also ______________ in Hangzhou. It\'s ______________ from Shanghai.',
                                    'answer' => 'Well, I was born in a small village outside of Hangzhou, but I also grew up in Hangzhou. It\'s a couple of hours away from Shanghai.'
                                ],
                                [
                                    'id' => '1.5',
                                    'text' => "Man So tell me about your hometown, Abby.\nAbby Well, not many people live there, but it's actually a ______________town. It has some large farms, a river, two lakes, and even a mountain.\nMan Do you like those kinds of things?\nAbby Oh, yes. I love nature. I think it's ______________. And the ______________ from the farms is delicious.",
                                    'answer' => "Man So tell me about your hometown, Abby.\nAbby Well, not many people live there, but it's actually a fairly large town. It has some large farms, a river, two lakes, and even a mountain.\nMan Do you like those kinds of things?\nAbby Oh, yes. I love nature. I think it's extremely beautiful. And the fresh food from the farms is delicious."
                                ],
                                [
                                    'id' => '1.6',
                                    'text' => "Woman Where did you grow up, Christopher?\nChristopher I ______________ a city. So I guess you could say my hometown isn't really a town – it's a city. For me, it's a ______________, though.\nWoman Why do you say that?\nChristopher Well, for one thing, it's too crowded. The streets and the subways are full of people day and night.\nWoman Really? Is it a polluted place?\nChristopher I wouldn't say that. But it's not very clean.\nWoman Like many cities, I guess.\nChristopher Right. And like many cities, it's ______________. My parents still live there, and they always talk about the high prices.",
                                    'answer' => "Woman Where did you grow up, Christopher?\nChristopher I grew up in a city. So I guess you could say my hometown isn't really a town – it's a city. For me, it's a really stressful place, though.\nWoman Why do you say that?\nChristopher Well, for one thing, it's too crowded. The streets and the subways are full of people day and night.\nWoman Really? Is it a polluted place?\nChristopher I wouldn't say that. But it's not very clean.\nWoman Like many cities, I guess.\nChristopher Right. And like many cities, it's somewhat expensive. My parents still live there, and they always talk about the high prices."
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'id' => 'step3',
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
                    'id' => 'step4',
                    'title' => 'SENTENCE BUILDING',
                    'description' => 'Kéo thả để sắp xếp các từ dưới đây thành một câu đúng',
                    'sentences' => [
                        [
                            'words' => ['great', 'is', 'but', 'living', 'really', 'of', 'cost', 'Paris', 'high', 'the'],
                            'answer' => 'Paris is really great but the cost of living is high'
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
                    'id' => 'step5',
                    'title' => 'GRAMMAR (Trạng từ + Tính từ)',
                    'description' => 'Kéo thả từ trong hộp để di chuyển đáp án lên câu hỏi',
                    'grammar_exercise' => [
                        'questions' => [
                            [
                                'text' => 'My hometown is a khá rộng _______ town',
                                'answer' => 'fairly large'
                            ],
                            [
                                'text' => 'The fresh food from the farms is cực kì ngon _______.',
                                'answer' => 'extremely delicious'
                            ],
                            [
                                'text' => 'It\'s a thực sự căng thẳng _______ place.',
                                'answer' => 'really stressful'
                            ],
                            [
                                'text' => 'My hometown is a khá nhàm chán _______ village.',
                                'answer' => 'pretty boring'
                            ],
                            [
                                'text' => 'It\'s hơi đắt _______ in my hometown.',
                                'answer' => 'somewhat expensive'
                            ],
                            [
                                'text' => 'The cost of living is thực sự cao_______.',
                                'answer' => 'really high'
                            ],
                            [
                                'text' => 'Banbury\'s nice, but sometimes I find it hơi tẻ nhạt _______',
                                'answer' => 'a bit boring'
                            ],
                            [
                                'text' => 'The locals here are cực kì hiếu khách _______.',
                                'answer' => 'extremely hospitable'
                            ],
                            [
                                'text' => 'It has tuyệt đẹp _______ beaches.',
                                'answer' => 'stunningly beautiful'
                            ]
                        ],
                        'answers' => [
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
                        ]
                    ]
                ],
                [
                    'id' => 'step6',
                    'title' => 'TRANSCRIPTION',
                    'description' => 'Tra phiên âm NAmE (North American English) của 10 từ',
                    'dictionary_url' => 'https://www.oxfordlearnersdictionaries.com/'
                ],
                [
                    'id' => 'step7',
                    'title' => 'ENDING SOUND',
                    'description' => 'Thêm âm cuối cho 5 từ theo quy tắc'
                ],
                [
                    'id' => 'step8',
                    'title' => 'LISTENING & READING – TEST 1',
                    'description' => 'Làm bài test về kỹ năng nghe & đọc trong 10 phút'
                ]
            ]
        ];

        return view('online.classes.vocabulary-listening.show', $data);
    }
}
