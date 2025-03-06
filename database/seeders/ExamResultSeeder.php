<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExamResult;

class ExamResultSeeder extends Seeder
{
    public function run()
    {
        ExamResult::create([
            'userId' => 1,
            'courseId' => 1,
            'finalExamId' => 1,
            'score' => 75,
            'status' => 'passed',
        ]);
    }
}
