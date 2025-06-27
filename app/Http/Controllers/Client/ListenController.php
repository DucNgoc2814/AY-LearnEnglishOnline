<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListenController extends Controller
{
    /**
     * Display the main Listen in English page.
     */
    public function index()
    {
        return view('client.listen-in-english.index');
    }

    /**
     * Display the Easy TV lessons page.
     */
    public function easyTv()
    {
        return view('client.listen-in-english.easy-tv');
    }

    /**
     * Display the TV & Movies lessons page.
     */
    public function tvMovies()
    {
        return view('client.listen-in-english.tv-movies');
    }

    /**
     * Display the lesson detail page.
     */
    public function lessonDetail($id)
    {
        // TODO: Fetch lesson data from database
        $lesson = [
            'id' => $id,
            'title' => 'B.1 Rob Checks In',
            'level' => 'Beginner',
            'duration' => '1:37',
            'accent' => 'British',
            'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ'
        ];

        return view('client.listen-in-english.lesson-detail', compact('lesson'));
    }
}
