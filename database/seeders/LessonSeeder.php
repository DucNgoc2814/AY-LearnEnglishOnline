<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;

class LessonSeeder extends Seeder
{
    public function run()
    {
        Lesson::create(['courseId' => 1, 'name' => 'Lesson 1', 'slug' => 'lesson-1', 'videoUrl' => 'http://example.com/video1', 'description' => 'Description for Lesson 1', 'duration' => 60, 'orderNumber' => 1, 'isPreview' => true, 'totalView' => 0, 'totalComment' => 0]);
        Lesson::create(['courseId' => 1, 'name' => 'Lesson 2', 'slug' => 'lesson-2', 'videoUrl' => 'http://example.com/video2', 'description' => 'Description for Lesson 2', 'duration' => 90, 'orderNumber' => 2, 'isPreview' => false, 'totalView' => 0, 'totalComment' => 0]);
        Lesson::create(['courseId' => 2, 'name' => 'Lesson 3', 'slug' => 'lesson-3', 'videoUrl' => 'http://example.com/video3', 'description' => 'Description for Lesson 3', 'duration' => 120, 'orderNumber' => 3, 'isPreview' => false, 'totalView' => 0, 'totalComment' => 0]);
        Lesson::create(['courseId' => 2, 'name' => 'Lesson 4', 'slug' => 'lesson-4', 'videoUrl' => 'http://example.com/video4', 'description' => 'Description for Lesson 4', 'duration' => 150, 'orderNumber' => 4, 'isPreview' => false, 'totalView' => 0, 'totalComment' => 0]);
        Lesson::create(['courseId' => 3, 'name' => 'Lesson 5', 'slug' => 'lesson-5', 'videoUrl' => 'http://example.com/video5', 'description' => 'Description for Lesson 5', 'duration' => 180, 'orderNumber' => 5, 'isPreview' => false, 'totalView' => 0, 'totalComment' => 0]);
    }
}
