<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VideoExerciseController extends Controller
{
    public function show($id)
    {
        // Get video URL from database or configuration
        $videoUrl = $this->getVideoUrl($id);

        return view('online.classes.video-exercise.show', [
            'lesson' => [
                'video_url' => $videoUrl
            ]
        ]);
    }

    private function getVideoUrl($id)
    {
        // Here you would typically fetch the video URL from your database
        // For now, we'll use a placeholder URL
        $baseUrl = "https://tienganh-abc.com/videos/";
        $videoId = "tuoi-tho-ba-djao-cua-sheldon-2017=66735f66cd8dc73b802af882/tap-1";

        // You might want to add some validation and processing here
        return $baseUrl . $videoId;
    }
}
