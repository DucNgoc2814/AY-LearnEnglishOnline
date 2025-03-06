<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionLessonTest;

class QuestionLessonTestSeeder extends Seeder
{
    public function run()
    {
        QuestionLessonTest::create([
            'lessonTestId' => 1,
            'question' => 'What is the capital of France?',
        ]);
    }
}
