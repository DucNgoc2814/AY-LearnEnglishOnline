<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VideoLesson;

class VideoLessonSeeder extends Seeder
{
    public function run()
    {
        // Video cho bài giới thiệu
        VideoLesson::create([
            'lessonId' => 1,
            'videoUrl' => 'https://example.com/videos/intro.mp4',
            'duration' => 300, // 5 phút
            'videoType' => 'mp4',
            'thumbnailUrl' => 'https://example.com/thumbnails/intro.jpg',
            'isProcessed' => true,
            'videoQuality' => json_encode(['480p', '720p', '1080p'])
        ]);

        // Video cho bài học cơ bản 1
        VideoLesson::create([
            'lessonId' => 2,
            'videoUrl' => 'https://example.com/videos/basic1.mp4',
            'duration' => 900, // 15 phút
            'videoType' => 'mp4',
            'thumbnailUrl' => 'https://example.com/thumbnails/basic1.jpg',
            'isProcessed' => true,
            'videoQuality' => json_encode(['480p', '720p', '1080p'])
        ]);

        // Video cho bài học nâng cao 1
        VideoLesson::create([
            'lessonId' => 4,
            'videoUrl' => 'https://example.com/videos/advanced1.mp4',
            'duration' => 1200, // 20 phút
            'videoType' => 'mp4',
            'thumbnailUrl' => 'https://example.com/thumbnails/advanced1.jpg',
            'isProcessed' => true,
            'videoQuality' => json_encode(['720p', '1080p'])
        ]);

        // Video cho bài học nâng cao 2
        VideoLesson::create([
            'lessonId' => 5,
            'videoUrl' => 'https://example.com/videos/advanced2.mp4',
            'duration' => 1500, // 25 phút
            'videoType' => 'mp4',
            'thumbnailUrl' => 'https://example.com/thumbnails/advanced2.jpg',
            'isProcessed' => true,
            'videoQuality' => json_encode(['720p', '1080p'])
        ]);
    }
}
