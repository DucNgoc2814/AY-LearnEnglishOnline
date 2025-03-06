<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        Course::create([
            'name' => 'Course 1',
            'description' => 'Description for Course 1',
            'price' => 100.00,
            'type' => 'paid',
            'learningPath' => null,
            'categoryId' => null,
            'lessons' => json_encode([]),
            'paymentContent' => null,
            'totalRating' => null,
        ]);
    }
}
