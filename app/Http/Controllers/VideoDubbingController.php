<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoDubbingController extends Controller
{
    public function index()
    {
        // Mock data for video dubbing exercises
        $videos = [
            [
                'id' => 1,
                'title' => 'Basic Greetings',
                'description' => 'Practice dubbing common greeting conversations',
                'thumbnail' => 'https://via.placeholder.com/640x360?text=Greetings',
                'video_url' => 'https://example.com/videos/greetings.mp4',
                'difficulty' => 'Beginner'
            ],
            [
                'id' => 2,
                'title' => 'Restaurant Orders',
                'description' => 'Learn how to order food and drinks',
                'thumbnail' => 'https://via.placeholder.com/640x360?text=Restaurant',
                'video_url' => 'https://example.com/videos/restaurant.mp4',
                'difficulty' => 'Intermediate'
            ],
            [
                'id' => 3,
                'title' => 'Job Interview',
                'description' => 'Practice common job interview scenarios',
                'thumbnail' => 'https://via.placeholder.com/640x360?text=Interview',
                'video_url' => 'https://example.com/videos/interview.mp4',
                'difficulty' => 'Advanced'
            ],
            [
                'id' => 4,
                'title' => 'Shopping Dialogue',
                'description' => 'Learn shopping conversations',
                'thumbnail' => 'https://via.placeholder.com/640x360?text=Shopping',
                'video_url' => 'https://example.com/videos/shopping.mp4',
                'difficulty' => 'Beginner'
            ],
            [
                'id' => 5,
                'title' => 'Travel Conversations',
                'description' => 'Practice travel-related dialogues',
                'thumbnail' => 'https://via.placeholder.com/640x360?text=Travel',
                'video_url' => 'https://example.com/videos/travel.mp4',
                'difficulty' => 'Intermediate'
            ],
            [
                'id' => 6,
                'title' => 'Business Meeting',
                'description' => 'Professional business meeting scenarios',
                'thumbnail' => 'https://via.placeholder.com/640x360?text=Business',
                'video_url' => 'https://example.com/videos/business.mp4',
                'difficulty' => 'Advanced'
            ]
        ];

        return view('online.exercises.video-dubbing', compact('videos'));
    }

    public function show($id)
    {
        // In a real application, you would fetch this from a database
        $video = [
            'id' => $id,
            'title' => 'Video Exercise ' . $id,
            'description' => 'Practice dubbing this conversation',
            'video_url' => 'https://example.com/videos/exercise' . $id . '.mp4',
            'script' => [
                [
                    'timestamp' => '0:00',
                    'speaker' => 'Person A',
                    'text' => 'Hello! How are you today?'
                ],
                [
                    'timestamp' => '0:03',
                    'speaker' => 'Person B',
                    'text' => 'I\'m doing great, thank you! And you?'
                ],
                [
                    'timestamp' => '0:06',
                    'speaker' => 'Person A',
                    'text' => 'I\'m fine too. Would you like to get some coffee?'
                ],
                [
                    'timestamp' => '0:09',
                    'speaker' => 'Person B',
                    'text' => 'Sure, that sounds great!'
                ]
            ]
        ];

        return view('online.exercises.video-dubbing-practice', compact('video'));
    }
}
