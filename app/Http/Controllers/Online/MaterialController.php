<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MaterialController extends Controller
{
    /**
     * Display video exercise with subtitle fill-in activity
     *
     * @param int $id The exercise ID
     * @return \Illuminate\View\View
     */
    public function videoExercise($id)
    {
        // Mock data for the video exercise
        $exercises = [
            1 => [
                'title' => 'Basic Introductions',
                'description' => 'Watch the video about introducing yourself and fill in the missing words.',
                'video_url' => 'https://example.com/videos/basic-introductions.mp4',
                'thumbnail' => 'https://via.placeholder.com/640x360.png?text=Video+Exercise:+Introductions',
                'transcript' => [
                    ['time' => '00:03', 'text' => 'Hello, my name is Sarah.'],
                    ['time' => '00:06', 'text' => 'I\'m from _____.', 'answer' => 'London'],
                    ['time' => '00:09', 'text' => 'I _____ English at the university.', 'answer' => 'study'],
                    ['time' => '00:14', 'text' => 'I enjoy _____ to music and reading books.', 'answer' => 'listening'],
                    ['time' => '00:18', 'text' => 'What\'s your _____?', 'answer' => 'name'],
                    ['time' => '00:21', 'text' => 'Where are you _____?', 'answer' => 'from'],
                ],
            ],
            2 => [
                'title' => 'Daily Routines',
                'description' => 'Watch the video about daily routines and fill in the missing words.',
                'video_url' => 'https://example.com/videos/daily-routines.mp4',
                'thumbnail' => 'https://via.placeholder.com/640x360.png?text=Video+Exercise:+Daily+Routines',
                'transcript' => [
                    ['time' => '00:02', 'text' => 'Every morning, I wake up at 6 AM.'],
                    ['time' => '00:06', 'text' => 'First, I _____ my teeth.', 'answer' => 'brush'],
                    ['time' => '00:10', 'text' => 'Then I _____ breakfast.', 'answer' => 'have'],
                    ['time' => '00:15', 'text' => 'I usually _____ a bus to work.', 'answer' => 'take'],
                    ['time' => '00:20', 'text' => 'I start working at _____ o\'clock.', 'answer' => 'nine'],
                    ['time' => '00:25', 'text' => 'After work, I go to the _____.', 'answer' => 'gym'],
                ],
            ],
        ];

        // Check if the exercise exists
        if (!isset($exercises[$id])) {
            abort(404, 'Exercise not found');
        }

        $exercise = $exercises[$id];

        return view('online.exercises.video', compact('exercise'));
    }

    /**
     * Display audio exercise with listening and fill-in activity
     *
     * @param int $id The exercise ID
     * @return \Illuminate\View\View
     */
    public function audioExercise($id)
    {
        // Mock data for the audio exercise
        $exercises = [
            1 => [
                'title' => 'Basic Greetings',
                'description' => 'Listen to the conversation and fill in the missing words.',
                'audio_url' => 'https://example.com/audio/basic-greetings.mp3',
                'transcript' => [
                    'A: Good morning! How are you today?',
                    'B: I\'m _____, thank you. How about you?',
                    'A: I\'m doing great. Are you ready for the _____?',
                    'B: Yes, I\'ve _____ all the materials.',
                    'A: That\'s excellent. Let\'s _____ with the first topic.',
                    'B: Sounds good to me.',
                ],
                'answers' => ['fine', 'meeting', 'prepared', 'start'],
            ],
            2 => [
                'title' => 'Weather Forecast',
                'description' => 'Listen to the weather forecast and fill in the missing information.',
                'audio_url' => 'https://example.com/audio/weather-forecast.mp3',
                'transcript' => [
                    'Good evening. Here is the weather forecast for tomorrow.',
                    'In the north, it will be _____ with temperatures around 15 degrees.',
                    'The south will experience _____ showers in the afternoon.',
                    'Eastern regions will be _____ and sunny all day.',
                    'In the west, expect _____ in the morning, clearing by noon.',
                    'That\'s all for the weather update. Back to the studio.',
                ],
                'answers' => ['cloudy', 'heavy', 'warm', 'fog'],
            ],
        ];

        // Check if the exercise exists
        if (!isset($exercises[$id])) {
            abort(404, 'Exercise not found');
        }

        $exercise = $exercises[$id];

        return view('online.exercises.audio', compact('exercise'));
    }

    /**
     * Display grammar exercise
     *
     * @param int $id The exercise ID
     * @return \Illuminate\View\View
     */
    public function grammarExercise($id)
    {
        // Mock data for the grammar exercise
        $exercises = [
            1 => [
                'title' => 'Present Simple vs Present Continuous',
                'description' => 'Fill in the blanks with the correct form of the verbs.',
                'instructions' => 'Choose the correct form (present simple or present continuous) of the verbs in brackets.',
                'questions' => [
                    ['question' => 'Look! She _____ (run) very fast.', 'answer' => 'is running'],
                    ['question' => 'They usually _____ (go) to school by bus.', 'answer' => 'go'],
                    ['question' => 'What _____ you _____ (do) right now?', 'answer' => 'are doing'],
                    ['question' => 'He _____ (not work) on Sundays.', 'answer' => 'doesn\'t work'],
                    ['question' => 'I _____ (study) for my exam at the moment.', 'answer' => 'am studying'],
                    ['question' => 'We _____ (have) lunch at 12:30 every day.', 'answer' => 'have'],
                    ['question' => '_____ she _____ (speak) English fluently?', 'answer' => 'Does speak'],
                    ['question' => 'They _____ (not listen) to the teacher right now.', 'answer' => 'aren\'t listening'],
                    ['question' => 'Water _____ (boil) at 100 degrees Celsius.', 'answer' => 'boils'],
                    ['question' => 'Why _____ you _____ (wear) a coat? It\'s not cold.', 'answer' => 'are wearing'],
                ],
            ],
        ];

        // Check if the exercise exists
        if (!isset($exercises[$id])) {
            abort(404, 'Exercise not found');
        }

        $exercise = $exercises[$id];

        return view('online.exercises.grammar', compact('exercise'));
    }

    /**
     * Display video series collection
     *
     * @param int $id The series ID
     * @return \Illuminate\View\View
     */
    public function videoSeries($id)
    {
        // Mock data for video series
        $series = [
            1 => [
                'title' => 'English in Real Life',
                'description' => 'A collection of videos showing real-life conversations in different situations.',
                'videos' => [
                    [
                        'id' => 101,
                        'title' => 'At the Restaurant',
                        'thumbnail' => 'https://via.placeholder.com/320x180.png?text=Restaurant',
                        'duration' => '3:45',
                    ],
                    [
                        'id' => 102,
                        'title' => 'Shopping for Clothes',
                        'thumbnail' => 'https://via.placeholder.com/320x180.png?text=Shopping',
                        'duration' => '4:12',
                    ],
                    [
                        'id' => 103,
                        'title' => 'At the Doctor\'s Office',
                        'thumbnail' => 'https://via.placeholder.com/320x180.png?text=Doctor',
                        'duration' => '5:30',
                    ],
                    [
                        'id' => 104,
                        'title' => 'Job Interview',
                        'thumbnail' => 'https://via.placeholder.com/320x180.png?text=Interview',
                        'duration' => '6:18',
                    ],
                    [
                        'id' => 105,
                        'title' => 'Making Travel Plans',
                        'thumbnail' => 'https://via.placeholder.com/320x180.png?text=Travel',
                        'duration' => '4:55',
                    ],
                ],
            ],
        ];

        // Check if the series exists
        if (!isset($series[$id])) {
            abort(404, 'Video series not found');
        }

        $seriesData = $series[$id];

        return view('online.exercises.video-series', compact('seriesData'));
    }

    /**
     * Display audio collection
     *
     * @param int $id The collection ID
     * @return \Illuminate\View\View
     */
    public function audioCollection($id)
    {
        // Mock data for audio collection
        $collections = [
            1 => [
                'title' => 'Everyday Conversations',
                'description' => 'A collection of audio conversations for various everyday situations.',
                'audios' => [
                    [
                        'id' => 201,
                        'title' => 'Making Introductions',
                        'duration' => '2:30',
                    ],
                    [
                        'id' => 202,
                        'title' => 'Asking for Directions',
                        'duration' => '3:15',
                    ],
                    [
                        'id' => 203,
                        'title' => 'Ordering Food',
                        'duration' => '2:45',
                    ],
                    [
                        'id' => 204,
                        'title' => 'Making an Appointment',
                        'duration' => '3:20',
                    ],
                    [
                        'id' => 205,
                        'title' => 'Hotel Check-in',
                        'duration' => '2:50',
                    ],
                    [
                        'id' => 206,
                        'title' => 'Telephone Conversation',
                        'duration' => '3:10',
                    ],
                    [
                        'id' => 207,
                        'title' => 'At the Airport',
                        'duration' => '4:05',
                    ],
                    [
                        'id' => 208,
                        'title' => 'Shopping Dialogue',
                        'duration' => '3:30',
                    ],
                    [
                        'id' => 209,
                        'title' => 'Weather Conversation',
                        'duration' => '2:15',
                    ],
                    [
                        'id' => 210,
                        'title' => 'Weekend Plans',
                        'duration' => '3:40',
                    ],
                ],
            ],
        ];

        // Check if the collection exists
        if (!isset($collections[$id])) {
            abort(404, 'Audio collection not found');
        }

        $collectionData = $collections[$id];

        return view('online.exercises.audio-collection', compact('collectionData'));
    }

    /**
     * Display vocabulary games
     *
     * @param int $id The game collection ID
     * @return \Illuminate\View\View
     */
    public function vocabularyGames($id)
    {
        // Mock data for vocabulary games
        $games = [
            1 => [
                'title' => 'Interactive Vocabulary Games',
                'description' => 'A collection of interactive games to help you learn and practice vocabulary.',
                'games' => [
                    [
                        'id' => 301,
                        'title' => 'Word Match',
                        'type' => 'matching',
                        'difficulty' => 'Easy',
                        'thumbnail' => 'https://via.placeholder.com/200x200.png?text=Word+Match',
                    ],
                    [
                        'id' => 302,
                        'title' => 'Hangman',
                        'type' => 'word guessing',
                        'difficulty' => 'Medium',
                        'thumbnail' => 'https://via.placeholder.com/200x200.png?text=Hangman',
                    ],
                    [
                        'id' => 303,
                        'title' => 'Crossword Puzzle',
                        'type' => 'puzzle',
                        'difficulty' => 'Hard',
                        'thumbnail' => 'https://via.placeholder.com/200x200.png?text=Crossword',
                    ],
                    [
                        'id' => 304,
                        'title' => 'Word Categories',
                        'type' => 'sorting',
                        'difficulty' => 'Medium',
                        'thumbnail' => 'https://via.placeholder.com/200x200.png?text=Categories',
                    ],
                    [
                        'id' => 305,
                        'title' => 'Word Search',
                        'type' => 'search',
                        'difficulty' => 'Easy',
                        'thumbnail' => 'https://via.placeholder.com/200x200.png?text=Word+Search',
                    ],
                    [
                        'id' => 306,
                        'title' => 'Flashcards',
                        'type' => 'memory',
                        'difficulty' => 'Easy',
                        'thumbnail' => 'https://via.placeholder.com/200x200.png?text=Flashcards',
                    ],
                    [
                        'id' => 307,
                        'title' => 'Sentence Builder',
                        'type' => 'construction',
                        'difficulty' => 'Hard',
                        'thumbnail' => 'https://via.placeholder.com/200x200.png?text=Sentence+Builder',
                    ],
                    [
                        'id' => 308,
                        'title' => 'Vocabulary Quiz',
                        'type' => 'quiz',
                        'difficulty' => 'Medium',
                        'thumbnail' => 'https://via.placeholder.com/200x200.png?text=Vocab+Quiz',
                    ],
                ],
            ],
        ];

        // Check if the game collection exists
        if (!isset($games[$id])) {
            abort(404, 'Game collection not found');
        }

        $gameData = $games[$id];

        return view('online.exercises.vocabulary-games', compact('gameData'));
    }

    /**
     * Handle submission of video exercise
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function submitVideoExercise(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string',
        ]);

        // Process the submitted answers (in a real app, compare with correct answers)
        $answers = $request->input('answers');
        $correct = 0;
        $total = count($answers);

        // Mock correct answers for the demo
        $correctAnswers = [
            1 => ['London', 'study', 'listening', 'name', 'from'],
            2 => ['brush', 'have', 'take', 'nine', 'gym'],
        ];

        if (isset($correctAnswers[$id])) {
            foreach ($answers as $index => $answer) {
                if (strtolower(trim($answer)) === strtolower(trim($correctAnswers[$id][$index]))) {
                    $correct++;
                }
            }
        }

        // Calculate score
        $score = ($total > 0) ? ($correct / $total) * 100 : 0;

        // Return results
        return redirect()->back()->with([
            'result' => [
                'score' => $score,
                'correct' => $correct,
                'total' => $total,
                'message' => "You got $correct out of $total correct!",
            ]
        ]);
    }

    /**
     * Handle submission of audio exercise
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function submitAudioExercise(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string',
        ]);

        // Process the submitted answers
        $answers = $request->input('answers');
        $correct = 0;
        $total = count($answers);

        // Mock correct answers for the demo
        $correctAnswers = [
            1 => ['fine', 'meeting', 'prepared', 'start'],
            2 => ['cloudy', 'heavy', 'warm', 'fog'],
        ];

        if (isset($correctAnswers[$id])) {
            foreach ($answers as $index => $answer) {
                if (strtolower(trim($answer)) === strtolower(trim($correctAnswers[$id][$index]))) {
                    $correct++;
                }
            }
        }

        // Calculate score
        $score = ($total > 0) ? ($correct / $total) * 100 : 0;

        // Return results
        return redirect()->back()->with([
            'result' => [
                'score' => $score,
                'correct' => $correct,
                'total' => $total,
                'message' => "You got $correct out of $total correct!",
            ]
        ]);
    }

    /**
     * Handle submission of grammar exercise
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function submitGrammarExercise(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|string',
        ]);

        // Process the submitted answers
        $answers = $request->input('answers');
        $correct = 0;
        $total = count($answers);

        // Mock correct answers for the demo
        $correctAnswers = [
            1 => [
                'is running',
                'go',
                'are doing',
                'doesn\'t work',
                'am studying',
                'have',
                'Does speak',
                'aren\'t listening',
                'boils',
                'are wearing',
            ],
        ];

        if (isset($correctAnswers[$id])) {
            foreach ($answers as $index => $answer) {
                if (strtolower(trim($answer)) === strtolower(trim($correctAnswers[$id][$index]))) {
                    $correct++;
                }
            }
        }

        // Calculate score
        $score = ($total > 0) ? ($correct / $total) * 100 : 0;

        // Return results
        return redirect()->back()->with([
            'result' => [
                'score' => $score,
                'correct' => $correct,
                'total' => $total,
                'message' => "You got $correct out of $total correct!",
            ]
        ]);
    }
}
