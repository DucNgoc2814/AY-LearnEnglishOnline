<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;

class LessonSeeder extends Seeder
{
    public function run()
    {
        Lesson::create([
            'name' => 'Lesson 1',
            'courseId' => 1,
            'type' => 'video',
            'linkVideo' => 'http://example.com/video',
            'linkZoom' => null,
            'startTime' => now(),
            'endTime' => now()->addHours(1),
            'duration' => 60,
            'notes' => json_encode([]),
        ]);
    }
}
