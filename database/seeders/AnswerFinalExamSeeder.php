<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AnswerFinalExam;

class AnswerFinalExamSeeder extends Seeder
{
    public function run()
    {
        AnswerFinalExam::create([
            'questionFinalExamId' => 1,
            'answer' => 'Berlin',
            'isCorrect' => true,
        ]);
    }
}
