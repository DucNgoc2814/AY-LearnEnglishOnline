<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;

class LessonSeeder extends Seeder
{
    public function run()
    {
        // Video Lessons
        Lesson::create([
            'courseId' => 1,
            'name' => 'Giới thiệu khóa học',
            'slug' => 'gioi-thieu-khoa-hoc',
            'description' => 'Bài học giới thiệu tổng quan về khóa học',
            'orderNumber' => 1,
            'isPreview' => true,
            'totalView' => 0,
            'totalComment' => 0
        ]);

        Lesson::create([
            'courseId' => 1,
            'name' => 'Bài học cơ bản 1',
            'slug' => 'bai-hoc-co-ban-1',
            'description' => 'Nội dung bài học cơ bản 1',
            'orderNumber' => 2,
            'isPreview' => false,
            'totalView' => 0,
            'totalComment' => 0
        ]);

        // Zoom Lessons
        Lesson::create([
            'courseId' => 1,
            'name' => 'Buổi thảo luận trực tuyến 1',
            'slug' => 'buoi-thao-luan-truc-tuyen-1',
            'description' => 'Buổi học trực tuyến qua Zoom',
            'orderNumber' => 3,
            'isPreview' => false,
            'totalView' => 0,
            'totalComment' => 0
        ]);

        // More Video Lessons
        Lesson::create([
            'courseId' => 2,
            'name' => 'Bài học nâng cao 1',
            'slug' => 'bai-hoc-nang-cao-1',
            'description' => 'Nội dung bài học nâng cao 1',
            'orderNumber' => 1,
            'isPreview' => false,
            'totalView' => 0,
            'totalComment' => 0
        ]);

        Lesson::create([
            'courseId' => 2,
            'name' => 'Bài học nâng cao 2',
            'slug' => 'bai-hoc-nang-cao-2',
            'description' => 'Nội dung bài học nâng cao 2',
            'orderNumber' => 2,
            'isPreview' => false,
            'totalView' => 0,
            'totalComment' => 0
        ]);
    }
}
