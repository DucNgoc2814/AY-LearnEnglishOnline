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
     * Display the TV & Movies detail page.
     */
    public function tvMoviesDetail($id)
    {
        // Tìm show theo ID từ collection
        $shows = collect([
            ['id' => 1, 'title' => 'Friends', 'episode' => 'The One Where It All Began', 'level' => 'Intermediate', 'duration' => 25, 'accent' => 'American'],
            ['id' => 2, 'title' => 'Modern Family', 'episode' => 'Pilot', 'level' => 'Intermediate', 'duration' => 30, 'accent' => 'American'],
            ['id' => 3, 'title' => 'The Office', 'episode' => 'Diversity Day', 'level' => 'Advanced', 'duration' => 28, 'accent' => 'American'],
            ['id' => 4, 'title' => 'Big Bang Theory', 'episode' => 'The Roommate Agreement', 'level' => 'Intermediate', 'duration' => 22, 'accent' => 'American'],
            ['id' => 5, 'title' => 'How I Met Your Mother', 'episode' => 'Purple Giraffe', 'level' => 'Advanced', 'duration' => 25, 'accent' => 'American'],
            ['id' => 6, 'title' => 'Brooklyn Nine-Nine', 'episode' => 'The Tagger', 'level' => 'Intermediate', 'duration' => 24, 'accent' => 'American'],
            ['id' => 7, 'title' => 'The Crown', 'episode' => 'Wolferton Splash', 'level' => 'Advanced', 'duration' => 35, 'accent' => 'British'],
            ['id' => 8, 'title' => 'Stranger Things', 'episode' => 'The Vanishing of Will Byers', 'level' => 'Beginner', 'duration' => 32, 'accent' => 'American'],
        ]);

        $show = $shows->firstWhere('id', (int)$id);

        if (!$show) {
            abort(404);
        }

        return view('client.listen-in-english.tv-movies-detail', compact('show'));
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
