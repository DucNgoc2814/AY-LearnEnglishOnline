<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AnswerLessonTest;

class AnswerLessonTestSeeder extends Seeder
{
    public function run()
    {
        AnswerLessonTest::create([
            'questionLessonTestId' => 1,
            'answer' => 'Paris',
            'isCorrect' => true,
        ]);
    }
}
