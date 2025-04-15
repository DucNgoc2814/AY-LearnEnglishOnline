<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'category_id' => 1,
                'title' => 'English Communication Basic',
                'slug' => 'english-communication-basic-' . uniqid(),
                'description' => 'Khóa học tiếng Anh giao tiếp cơ bản cho người mới bắt đầu',
                'short_description' => 'Học giao tiếp tiếng Anh từ cơ bản',
                'course_type' => 'instructor_led',
                'course_format' => 'online',
                'price' => 1500000,
                'sale_price' => 1200000,
                'estimated_hours' => 40,
                'has_certificate' => true,
                'requires_enrollment' => true,
                'total_students' => 100,
                'rating' => 4.5,
                'total_ratings' => 50,
                'is_featured' => true,
                'is_active' => true
            ]
        ];

        // Tạo thêm 19 khóa học với dữ liệu khác nhau
        $courseTypes = ['English Communication', 'Grammar', 'IELTS', 'TOEIC', 'Business English'];
        $levels = ['Basic', 'Intermediate', 'Advanced', 'Master'];
        $usedSlugs = []; // Theo dõi các slug đã sử dụng

        for ($i = 2; $i <= 20; $i++) {
            $type = $courseTypes[array_rand($courseTypes)];
            $level = $levels[array_rand($levels)];
            $title = "$type - $level";
            $price = rand(1500000, 3000000);
            
            // Tạo slug duy nhất bằng cách thêm timestamp
            $baseSlug = strtolower(str_replace(' ', '-', $title));
            $slug = $baseSlug . '-' . uniqid();
            
            $courses[] = [
                'category_id' => rand(1, 3),
                'title' => $title,
                'slug' => $slug,
                'description' => "Khóa học $title dành cho học viên " . strtolower($level),
                'short_description' => "Khóa học $type cấp độ " . strtolower($level),
                'course_type' => 'instructor_led',
                'course_format' => rand(0, 1) ? 'online' : 'hybrid',
                'price' => $price,
                'sale_price' => $price * 0.8,
                'estimated_hours' => rand(30, 60),
                'has_certificate' => true,
                'requires_enrollment' => true,
                'total_students' => rand(50, 200),
                'rating' => rand(35, 50) / 10,
                'total_ratings' => rand(20, 100),
                'is_featured' => rand(0, 1) === 1,
                'is_active' => true
            ];
        }

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}