<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoHandoutController extends Controller
{
    public function show()
    {
        $data = [
            'title' => 'Video Learning with Handouts',
            'video_folders' => [
                [
                    'id' => 1,
                    'name' => 'Unit 1: Basic Conversations',
                    'videos' => [
                        [
                            'id' => 1,
                            'title' => 'Greeting and Introduction',
                            'description' => 'Learn basic greetings and self-introduction',
                            'url' => 'https://www.youtube.com/embed/video1',
                        ],
                        [
                            'id' => 2,
                            'title' => 'Small Talk',
                            'description' => 'Practice making small talk in English',
                            'url' => 'https://www.youtube.com/embed/video2',
                        ],
                    ]
                ],
                [
                    'id' => 2,
                    'name' => 'Unit 2: Daily Activities',
                    'videos' => [
                        [
                            'id' => 3,
                            'title' => 'Morning Routine',
                            'description' => 'Vocabulary about morning activities',
                            'url' => 'https://www.youtube.com/embed/video3',
                        ],
                        [
                            'id' => 4,
                            'title' => 'Weekend Activities',
                            'description' => 'Talking about weekend plans and activities',
                            'url' => 'https://www.youtube.com/embed/video4',
                        ],
                    ]
                ],
            ],
            'exercises' => [
                'pronunciation' => [
                    'title' => 'Pronunciation',
                    'sections' => [
                        [
                            'title' => 'Vowel: long /ɑ:/',
                            'type' => 'word_practice',
                            'words' => [
                                ['word' => 'car', 'image' => 'car.png'],
                                ['word' => 'star', 'image' => 'star.png'],
                                ['word' => 'farm', 'image' => 'farm.png'],
                                ['word' => 'park', 'image' => 'park.png'],
                            ],
                            'common_patterns' => [
                                'ar: car, park, start, smart'
                            ],
                            'example_sentences' => [
                                'How far is the car park?',
                                'The road is a busy but full of life today.',
                                'We are starting in half an hour.'
                            ]
                        ],
                        [
                            'title' => 'Vowel: short /ʌ/',
                            'type' => 'word_practice',
                            'words' => [
                                ['word' => 'bus', 'image' => 'bus.png'],
                                ['word' => 'public', 'image' => 'public.png'],
                                ['word' => 'country', 'image' => 'country.png'],
                                ['word' => 'enough', 'image' => 'enough.png'],
                            ],
                            'common_patterns' => [
                                'u: bus, much, but',
                                'ou: country, enough, trouble',
                                'o: come, some, money'
                            ],
                            'example_sentences' => [
                                'What country are you from?',
                                'Would you like another one?',
                                'Do you have enough money?',
                                'I love it!'
                            ]
                        ]
                    ]
                ],
                'listening_speaking' => [
                    'title' => 'Listening & Speaking',
                    'sections' => [
                        [
                            'title' => 'Unit 1: Hometown',
                            'type' => 'practice',
                            'word_pairs' => [
                                ['word1' => 'busy', 'phonetic1' => '/ˈbɪzi/', 'word2' => "doesn't /dʌznt/"],
                                ['word1' => 'much', 'phonetic1' => '/mʌtʃ/', 'word2' => "don't /dəʊnt/"],
                                ['word1' => 'such', 'phonetic1' => '/sʌtʃ/', 'word2' => 'nothing /ˈnʌθɪŋ/'],
                                ['word1' => 'happy', 'phonetic1' => '/ˈhæpi/', 'word2' => 'mouth /maʊθ/']
                            ]
                        ],
                        [
                            'title' => 'Reduction',
                            'type' => 'reduction_practice',
                            'examples' => [
                                [
                                    'title' => "What's he gonna do?",
                                    'explanation' => 'going to → gonna',
                                    'sentences' => [
                                        "He's gonna go to Chicago",
                                        "I'm gonna go home now",
                                        "They're gonna be late"
                                    ]
                                ]
                            ],
                            'speaking_practice' => [
                                'title' => 'Speaking Practice',
                                'steps' => [
                                    'Step 1: Time talk',
                                    'Step 2: Actual good thing'
                                ],
                                'video_url' => 'https://youtube.com/example'
                            ]
                        ]
                    ]
                ]
            ],
            'handout' => [
                'title' => 'Handout Exercise',
                'pdf_url' => asset('handouts/exercise.pdf'),
                'description' => 'Làm bài tập trong file handout sau khi xem video.'
            ]
        ];

        return view('online.classes.video-handout.show', $data);
    }
}
