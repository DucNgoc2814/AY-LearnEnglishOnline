<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resource;
use App\Models\Lesson;
use Illuminate\Support\Facades\Log;

class ResourceSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            'English Grammar Basics',
            'Pronunciation Guide',
            'Business English Essentials',
            'IELTS Writing Tips',
            'TOEIC Practice Tests',
            'Common English Phrases',
            'Academic Writing Guide',
            'Vocabulary Builder',
            'Speaking Practice Materials',
            'Listening Comprehension'
        ];
        
        // Kiểm tra xem có bản ghi Lesson tồn tại hay không
        $lesson = Lesson::first();
        
        if (!$lesson) {
            // Nếu không có bản ghi Lesson, tạo Resource không liên kết với Lesson
            Log::warning('Không tìm thấy bản ghi Lesson nào. Tạo Resource không có lesson_id.');
            
            for ($i = 1; $i <= 20; $i++) {
                $title = $titles[array_rand($titles)] . ' - Part ' . ceil($i/2);
                Resource::create([
                    'title' => $title,
                    'description' => "Tài liệu học tập: $title",
                    'file_path' => "resources/" . strtolower(str_replace(' ', '-', $title)) . ".pdf",
                    'order' => $i,
                    'is_active' => true
                ]);
            }
        } else {
            // Nếu có bản ghi Lesson, tạo Resource liên kết với Lesson
            $lessonIds = Lesson::pluck('id')->toArray();
            
            for ($i = 1; $i <= 20; $i++) {
                $title = $titles[array_rand($titles)] . ' - Part ' . ceil($i/2);
                $randomLessonId = $lessonIds[array_rand($lessonIds)];
                
                Resource::create([
                    'lesson_id' => $randomLessonId,
                    'title' => $title,
                    'description' => "Tài liệu học tập: $title",
                    'file_path' => "resources/" . strtolower(str_replace(' ', '-', $title)) . ".pdf",
                    'order' => $i,
                    'is_active' => true
                ]);
            }
        }
    }
}