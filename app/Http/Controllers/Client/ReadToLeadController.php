<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReadToLeadController extends Controller
{
    public function index()
    {
        return view('client.read-to-lead.index');
    }

    public function discovery()
    {
        return view('client.read-to-lead.discovery', [
            'category' => 'DISCOVERY'
        ]);
    }

    public function healthLifestyle()
    {
        return view('client.read-to-lead.health-lifestyle', [
            'category' => 'HEALTH & LIFESTYLE'
        ]);
    }

    public function culture()
    {
        return view('client.read-to-lead.culture', [
            'category' => 'CULTURE'
        ]);
    }

    public function travel()
    {
        return view('client.read-to-lead.travel', [
            'category' => 'TRAVEL'
        ]);
    }

    public function cuisine()
    {
        return view('client.read-to-lead.cuisine', [
            'category' => 'CUISINE'
        ]);
    }

    public function articleDetail($id)
    {
        // TODO: Fetch article data from database
        $article = [
            'id' => $id,
            'title' => 'Sample Article',
            'category' => 'DISCOVERY',
            'level' => 'Intermediate',
            'reading_time' => '10 minutes',
            'content' => 'Article content goes here...',
            'vocabulary' => [
                ['word' => 'example', 'meaning' => 'a representative form or pattern'],
                ['word' => 'vocabulary', 'meaning' => 'a list or collection of words and their meanings'],
            ],
            'questions' => [
                [
                    'question' => 'What is the main idea of this article?',
                    'options' => ['Option A', 'Option B', 'Option C', 'Option D'],
                    'correct_answer' => 'Option A'
                ],
                // Add more questions as needed
            ]
        ];

        return view('client.read-to-lead.article-detail', compact('article'));
    }
}
