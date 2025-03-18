<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AnswerFinalExam;

class AnswerFinalExamSeeder extends Seeder
{
    public function run()
    {
        AnswerFinalExam::create(['questionFinalExamId' => 1, 'answer' => 'Berlin', 'isCorrect' => true, 'order_number' => 1]);
        AnswerFinalExam::create(['questionFinalExamId' => 1, 'answer' => 'Paris', 'isCorrect' => false, 'order_number' => 2]);
        AnswerFinalExam::create(['questionFinalExamId' => 1, 'answer' => 'Madrid', 'isCorrect' => false, 'order_number' => 3]);
        AnswerFinalExam::create(['questionFinalExamId' => 1, 'answer' => 'Rome', 'isCorrect' => false, 'order_number' => 4]);
        AnswerFinalExam::create(['questionFinalExamId' => 1, 'answer' => 'Lisbon', 'isCorrect' => false, 'order_number' => 5]);
    }
}
