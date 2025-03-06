<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LessonTest;

class LessonTestSeeder extends Seeder
{
    public function run()
    {
        LessonTest::create(['lessonId' => 1, 'slug' => 'lesson-test-1', 'name' => 'Lesson Test 1', 'description' => 'Description for Lesson Test 1', 'duration' => 60, 'minScore' => 50, 'maxScore' => 100, 'orderNumber' => 1, 'isRequired' => true, 'totalAttempt' => 0, 'maxAttempt' => 3]);
        LessonTest::create(['lessonId' => 2, 'slug' => 'lesson-test-2', 'name' => 'Lesson Test 2', 'description' => 'Description for Lesson Test 2', 'duration' => 60, 'minScore' => 60, 'maxScore' => 100, 'orderNumber' => 2, 'isRequired' => true, 'totalAttempt' => 0, 'maxAttempt' => 3]);
        LessonTest::create(['lessonId' => 3, 'slug' => 'lesson-test-3', 'name' => 'Lesson Test 3', 'description' => 'Description for Lesson Test 3', 'duration' => 60, 'minScore' => 70, 'maxScore' => 100, 'orderNumber' => 3, 'isRequired' => false, 'totalAttempt' => 0, 'maxAttempt' => 3]);
        LessonTest::create(['lessonId' => 4, 'slug' => 'lesson-test-4', 'name' => 'Lesson Test 4', 'description' => 'Description for Lesson Test 4', 'duration' => 60, 'minScore' => 80, 'maxScore' => 100, 'orderNumber' => 4, 'isRequired' => true, 'totalAttempt' => 0, 'maxAttempt' => 3]);
        LessonTest::create(['lessonId' => 5, 'slug' => 'lesson-test-5', 'name' => 'Lesson Test 5', 'description' => 'Description for Lesson Test 5', 'duration' => 60, 'minScore' => 90, 'maxScore' => 100, 'orderNumber' => 5, 'isRequired' => false, 'totalAttempt' => 0, 'maxAttempt' => 3]);
    }
}
