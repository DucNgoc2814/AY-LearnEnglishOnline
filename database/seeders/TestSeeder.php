<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Test;

class TestSeeder extends Seeder
{
    public function run()
    {
        $tests = [
            [
                'testable_type' => 'App\Models\Lesson',
                'testable_id' => 1,
                'slug' => 'laravel-basics-quiz',
                'name' => 'Laravel Basics Quiz',
                'description' => 'Kiểm tra kiến thức cơ bản về Laravel',
                'duration' => 30, // minutes
                'min_score' => 70,
                'max_score' => 100,
                'max_attempt' => 2,
                'type' => 'lesson_test',
                'settings' => json_encode([
                    'show_result' => true,
                    'randomize_questions' => true,
                    'show_correct_answers' => true
                ])
            ],
            // Thêm 9 test khác...
        ];

        foreach ($tests as $test) {
            Test::create($test);
        }
    }
}