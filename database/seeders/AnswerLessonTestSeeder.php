<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AnswerLessonTest;

class AnswerLessonTestSeeder extends Seeder
{
    public function run()
    {
        // Câu hỏi trắc nghiệm một lựa chọn
        AnswerLessonTest::create([
            'questionLessonTestId' => 1,
            'answer' => 'Paris',
            'isCorrect' => true,
            'answerType' => 'single_choice',
            'orderNumber' => 1,
            'caseSensitive' => false,
            'alternativeAnswers' => null
        ]);

        AnswerLessonTest::create([
            'questionLessonTestId' => 1,
            'answer' => 'London',
            'isCorrect' => false,
            'answerType' => 'single_choice',
            'orderNumber' => 2,
            'caseSensitive' => false,
            'alternativeAnswers' => null
        ]);

        // Câu hỏi điền vào chỗ trống
        AnswerLessonTest::create([
            'questionLessonTestId' => 2,
            'answer' => 'Laravel',
            'isCorrect' => true,
            'answerType' => 'fill_in_blank',
            'orderNumber' => 1,
            'caseSensitive' => true,
            'alternativeAnswers' => 'Laravel Framework|Laravel PHP'
        ]);

        // Câu hỏi nhiều lựa chọn
        AnswerLessonTest::create([
            'questionLessonTestId' => 3,
            'answer' => 'PHP',
            'isCorrect' => true,
            'answerType' => 'multiple_choice',
            'orderNumber' => 1,
            'caseSensitive' => false,
            'alternativeAnswers' => null
        ]);

        AnswerLessonTest::create([
            'questionLessonTestId' => 3,
            'answer' => 'MySQL',
            'isCorrect' => true,
            'answerType' => 'multiple_choice',
            'orderNumber' => 2,
            'caseSensitive' => false,
            'alternativeAnswers' => null
        ]);
    }
}
