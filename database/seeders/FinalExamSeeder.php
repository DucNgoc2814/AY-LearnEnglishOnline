<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FinalExam;

class FinalExamSeeder extends Seeder
{
    public function run()
    {
        FinalExam::create(['courseId' => 1, 'slug' => 'final-exam-1', 'name' => 'Final Exam 1', 'description' => 'Description for Final Exam 1', 'duration' => 120, 'minScore' => 60, 'maxScore' => 100, 'totalAttempt' => 0, 'maxAttempt' => 3, 'isRequired' => true]);
        FinalExam::create(['courseId' => 2, 'slug' => 'final-exam-2', 'name' => 'Final Exam 2', 'description' => 'Description for Final Exam 2', 'duration' => 120, 'minScore' => 70, 'maxScore' => 100, 'totalAttempt' => 0, 'maxAttempt' => 3, 'isRequired' => true]);
        FinalExam::create(['courseId' => 3, 'slug' => 'final-exam-3', 'name' => 'Final Exam 3', 'description' => 'Description for Final Exam 3', 'duration' => 120, 'minScore' => 75, 'maxScore' => 100, 'totalAttempt' => 0, 'maxAttempt' => 3, 'isRequired' => true]);
        FinalExam::create(['courseId' => 4, 'slug' => 'final-exam-4', 'name' => 'Final Exam 4', 'description' => 'Description for Final Exam 4', 'duration' => 120, 'minScore' => 80, 'maxScore' => 100, 'totalAttempt' => 0, 'maxAttempt' => 3, 'isRequired' => true]);
        FinalExam::create(['courseId' => 5, 'slug' => 'final-exam-5', 'name' => 'Final Exam 5', 'description' => 'Description for Final Exam 5', 'duration' => 120, 'minScore' => 85, 'maxScore' => 100, 'totalAttempt' => 0, 'maxAttempt' => 3, 'isRequired' => true]);
    }
}
