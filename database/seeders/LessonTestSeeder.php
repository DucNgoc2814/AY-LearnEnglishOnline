<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LessonTest;

class LessonTestSeeder extends Seeder
{
    public function run()
    {
        LessonTest::create([
            'lessonId' => 1,
            'minScore' => 50,
            'isRequired' => true,
        ]);
    }
}
