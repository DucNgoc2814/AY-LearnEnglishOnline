<?php

namespace App\Http\Controllers;

use App\Models\VideoExerciseLesson;
use Illuminate\Http\Request;

class VideoExerciseController extends Controller
{
    /**
     * Display the video exercise lesson.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $lesson = VideoExerciseLesson::with(['videoExerciseQuestions', 'videoExerciseClips'])
            ->findOrFail($id);

        // Transform YouTube URL if needed
        $lesson->video_url = $this->transformYouTubeUrl($lesson->video_url);

        return view('online.classes.video-exercise.show', compact('lesson'));
    }

    /**
     * Transform YouTube URL to embed format
     *
     * @param string|null $url
     * @return string
     */
    private function transformYouTubeUrl($url)
    {
        if (empty($url)) {
            return 'https://www.youtube.com/embed/dQw4w9WgXcQ';
        }

        // Extract video ID from various YouTube URL formats
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);

        if (!empty($matches[1])) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }

        return $url;
    }
}
