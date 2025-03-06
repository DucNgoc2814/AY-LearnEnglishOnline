<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionFinalExam;

class QuestionFinalExamSeeder extends Seeder
{
    public function run()
    {
        QuestionFinalExam::create(['finalExamId' => 1, 'question' => 'What is the capital of Germany?', 'orderNumber' => 1]);
        QuestionFinalExam::create(['finalExamId' => 1, 'question' => 'What is the capital of France?', 'orderNumber' => 2]);
        QuestionFinalExam::create(['finalExamId' => 2, 'question' => 'What is the capital of Spain?', 'orderNumber' => 1]);
        QuestionFinalExam::create(['finalExamId' => 2, 'question' => 'What is the capital of Italy?', 'orderNumber' => 2]);
        QuestionFinalExam::create(['finalExamId' => 3, 'question' => 'What is the capital of Portugal?', 'orderNumber' => 1]);
    }
}
