<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Progress;

class ProgressSeeder extends Seeder
{
    public function run()
    {
        Progress::create([
            'userId' => 1,
            'courseId' => 1,
            'lessonId' => 1,
            'progressType' => 'video',
            'progressValue' => 30,
            'timestamp' => now(),
            'status' => 'in-progress',
        ]);
    }
}
