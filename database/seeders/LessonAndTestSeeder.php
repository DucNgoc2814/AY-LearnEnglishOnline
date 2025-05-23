<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Test;
use App\Models\LessonVideo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LessonAndTestSeeder extends Seeder
{
    public function run()
    {
        $courses = Course::all();

        foreach ($courses as $course) {
            // Create exactly 10 lessons per course
            for ($i = 1; $i <= 10; $i++) {
                $lessonName = match($i) {
                    1 => "Giới thiệu khóa học",
                    2 => "Cài đặt môi trường",
                    3 => "Kiến thức nền tảng",
                    4 => "Thực hành cơ bản",
                    5 => "Làm việc với dữ liệu",
                    6 => "Xử lý form và validation",
                    7 => "Authentication và Authorization",
                    8 => "REST API và Integration",
                    9 => "Testing và Debug",
                    10 => "Deploy và Optimization",
                };

                // Create unique slug with course id prefix
                $uniqueSlug = 'course-' . $course->id . '-' . Str::slug($lessonName);

                $lesson = Lesson::create([
                    'course_id' => $course->id,
                    'name' => $lessonName,
                    'slug' => $uniqueSlug,
                    'description' => "Bài học chi tiết về " . strtolower($lessonName),
                    'order_number' => $i
                ]);

                // Create exactly 10 videos per lesson
                for ($v = 1; $v <= 10; $v++) {
                    $videoName = "Phần $v: " . $lessonName;
                    // Create unique video slug
                    $videoSlug = 'lesson-' . $lesson->id . '-video-' . $v . '-' . Str::slug($videoName);

                    LessonVideo::create([
                        'lesson_id' => $lesson->id,
                        'name' => $videoName,
                        'slug' => $videoSlug,
                        'video_url' => 'https://www.youtube.com/watch?v=' . Str::random(11),
                        'duration' => rand(10, 45), // 10-45 minutes
                        'is_preview' => $i === 1 // First lesson's videos are preview
                    ]);
                }

                // Create lesson test for each lesson with unique slug
                $testSlug = 'lesson-' . $lesson->id . '-test-' . Str::slug($lessonName);

                Test::create([
                    'lesson_id' => $lesson->id,
                    'name' => "Bài kiểm tra: " . $lessonName,
                    'slug' => $testSlug,
                    'description' => "Kiểm tra kiến thức về " . $lessonName,
                    'duration' => 30,
                    'min_score' => 70,
                    'max_score' => 100,
                    'is_required' => true,
                    'total_attempt' => 0,
                    'max_attempt' => 3,
                    'type' => 'course_test'
                ]);
            }

        }
    }
}
