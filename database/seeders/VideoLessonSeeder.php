<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VideoLesson;
use Illuminate\Support\Str;

class VideoLessonSeeder extends Seeder
{
    public function run()
    {
        // Video cho bài giới thiệu
        VideoLesson::create([
            'lessonId' => 1,
            'name' => 'Bài giới thiệu khóa học',
            'slug' => Str::slug('Bài giới thiệu khóa học'),
            'videoUrl' => 'https://example.com/videos/intro.mp4',
            'duration' => 300, // 5 phút
            'videoType' => 'mp4',
            'thumbnailUrl' => 'https://example.com/thumbnails/intro.jpg'
        ]);

        // Video cho bài học cơ bản 1
        VideoLesson::create([
            'lessonId' => 2,
            'name' => 'Bài học cơ bản 1',
            'slug' => Str::slug('Bài học cơ bản 1'),
            'videoUrl' => 'https://example.com/videos/basic1.mp4',
            'duration' => 900, // 15 phút
            'videoType' => 'mp4',
            'thumbnailUrl' => 'https://example.com/thumbnails/basic1.jpg'
        ]);

        // Video cho bài học cơ bản 2
        VideoLesson::create([
            'lessonId' => 3,
            'name' => 'Bài học cơ bản 2',
            'slug' => Str::slug('Bài học cơ bản 2'),
            'videoUrl' => 'https://example.com/videos/basic2.mp4',
            'duration' => 1200, // 20 phút
            'videoType' => 'mp4',
            'thumbnailUrl' => 'https://example.com/thumbnails/basic2.jpg'
        ]);

        // Video cho bài học nâng cao 1
        VideoLesson::create([
            'lessonId' => 4,
            'name' => 'Bài học nâng cao 1',
            'slug' => Str::slug('Bài học nâng cao 1'),
            'videoUrl' => 'https://example.com/videos/advanced1.mp4',
            'duration' => 1500, // 25 phút
            'videoType' => 'mp4',
            'thumbnailUrl' => 'https://example.com/thumbnails/advanced1.jpg'
        ]);
    }
}
