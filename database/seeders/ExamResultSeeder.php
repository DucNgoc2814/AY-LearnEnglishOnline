<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExamResult;

class ExamResultSeeder extends Seeder
{
    public function run()
    {
        ExamResult::create(['userId' => 1, 'finalExamId' => 1, 'score' => 75, 'timeTaken' => 60, 'attemptNumber' => 1, 'status' => 'passed', 'startTime' => now(), 'endTime' => now()->addMinutes(60)]);
        ExamResult::create(['userId' => 2, 'finalExamId' => 1, 'score' => 60, 'timeTaken' => 50, 'attemptNumber' => 1, 'status' => 'passed', 'startTime' => now(), 'endTime' => now()->addMinutes(50)]);
        ExamResult::create(['userId' => 3, 'finalExamId' => 2, 'score' => 50, 'timeTaken' => 70, 'attemptNumber' => 1, 'status' => 'failed', 'startTime' => now(), 'endTime' => now()->addMinutes(70)]);
        ExamResult::create(['userId' => 4, 'finalExamId' => 2, 'score' => 80, 'timeTaken' => 40, 'attemptNumber' => 1, 'status' => 'passed', 'startTime' => now(), 'endTime' => now()->addMinutes(40)]);
        ExamResult::create(['userId' => 5, 'finalExamId' => 3, 'score' => 90, 'timeTaken' => 30, 'attemptNumber' => 1, 'status' => 'passed', 'startTime' => now(), 'endTime' => now()->addMinutes(30)]);
    }
}
