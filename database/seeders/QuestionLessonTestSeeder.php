<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionLessonTest;

class QuestionLessonTestSeeder extends Seeder
{
    public function run()
    {
        QuestionLessonTest::create(['lessonTestId' => 1, 'question' => 'What is the capital of France?', 'orderNumber' => 1]);
        QuestionLessonTest::create(['lessonTestId' => 1, 'question' => 'What is the capital of Germany?', 'orderNumber' => 2]);
        QuestionLessonTest::create(['lessonTestId' => 2, 'question' => 'What is the capital of Spain?', 'orderNumber' => 1]);
        QuestionLessonTest::create(['lessonTestId' => 2, 'question' => 'What is the capital of Italy?', 'orderNumber' => 2]);
        QuestionLessonTest::create(['lessonTestId' => 3, 'question' => 'What is the capital of Portugal?', 'orderNumber' => 1]);
    }
}
