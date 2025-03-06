<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Progress;

class ProgressSeeder extends Seeder
{
    public function run()
    {
        Progress::create(['enrollmentId' => 1, 'lessonId' => 1, 'watchedTime' => 30, 'totalTime' => 60, 'status' => 'in-progress', 'lastWatchedAt' => now(), 'completedAt' => null]);
        Progress::create(['enrollmentId' => 2, 'lessonId' => 1, 'watchedTime' => 50, 'totalTime' => 60, 'status' => 'completed', 'lastWatchedAt' => now(), 'completedAt' => now()]);
        Progress::create(['enrollmentId' => 3, 'lessonId' => 2, 'watchedTime' => 20, 'totalTime' => 90, 'status' => 'in-progress', 'lastWatchedAt' => now(), 'completedAt' => null]);
        Progress::create(['enrollmentId' => 4, 'lessonId' => 2, 'watchedTime' => 80, 'totalTime' => 90, 'status' => 'completed', 'lastWatchedAt' => now(), 'completedAt' => now()]);
        Progress::create(['enrollmentId' => 5, 'lessonId' => 3, 'watchedTime' => 10, 'totalTime' => 120, 'status' => 'in-progress', 'lastWatchedAt' => now(), 'completedAt' => null]);
    }
}
