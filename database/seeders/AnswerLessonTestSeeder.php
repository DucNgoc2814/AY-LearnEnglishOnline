<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AnswerLessonTest;

class AnswerLessonTestSeeder extends Seeder
{
    public function run()
    {
        AnswerLessonTest::create(['questionLessonTestId' => 1, 'answer' => 'Paris', 'isCorrect' => true, 'order_number' => 1]);
        AnswerLessonTest::create(['questionLessonTestId' => 1, 'answer' => 'London', 'isCorrect' => false, 'order_number' => 2]);
        AnswerLessonTest::create(['questionLessonTestId' => 1, 'answer' => 'Berlin', 'isCorrect' => false, 'order_number' => 3]);
        AnswerLessonTest::create(['questionLessonTestId' => 1, 'answer' => 'Madrid', 'isCorrect' => false, 'order_number' => 4]);
        AnswerLessonTest::create(['questionLessonTestId' => 1, 'answer' => 'Rome', 'isCorrect' => false, 'order_number' => 5]);
    }
}
