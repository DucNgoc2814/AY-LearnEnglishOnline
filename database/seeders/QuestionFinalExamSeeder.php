<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuestionFinalExam;

class QuestionFinalExamSeeder extends Seeder
{
    public function run()
    {
        QuestionFinalExam::create([
            'finalExamId' => 1,
            'question' => 'What is the capital of Germany?',
        ]);
    }
}
