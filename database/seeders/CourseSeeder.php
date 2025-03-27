<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            [
                'category_id' => 1,
                'title' => 'Laravel for Beginners',
                'slug' => 'laravel-for-beginners',
                'description' => 'Khóa học Laravel cơ bản cho người mới bắt đầu',
                'short_description' => 'Học Laravel từ cơ bản đến nâng cao',
                'course_type' => 'self_paced',
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
            ],
            [
                'category_id' => 1,
                'title' => 'React.js Advanced',
                'slug' => 'reactjs-advanced',
                'description' => 'Khóa học React.js nâng cao',
                'short_description' => 'Làm chủ React.js với các kỹ thuật nâng cao',
                'course_type' => 'instructor_led',
                'course_format' => 'hybrid',
                'price' => 2000000,
                'sale_price' => 1800000,
                'estimated_hours' => 50,
                'has_certificate' => true,
                'requires_enrollment' => true,
                'total_students' => 80,
                'rating' => 4.7,
                'total_ratings' => 40,
                'is_featured' => true,
                'is_active' => true
            ],
            // Thêm 8 khóa học khác tương tự...
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}