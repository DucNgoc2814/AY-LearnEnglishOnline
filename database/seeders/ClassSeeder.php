<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classes;

class ClassSeeder extends Seeder
{
    public function run()
    {
        $classes = [
            [
                'name' => 'Laravel Basic 2024A',
                'code' => 'LRV-2024A',
                'course_id' => 1,
                'teacher_id' => 2,
                'class_type' => 'online',
                'start_date' => '2024-01-15',
                'end_date' => '2024-03-15',
                'enrollment_deadline' => '2024-01-10',
                'max_students' => 30,
                'min_students' => 10,
                'fee' => 1500000,
                'current_students' => 0,
                'status' => 'pending',
                'is_active' => true
            ],
            // Thêm 9 class khác...
        ];

        foreach ($classes as $class) {
            Classes::create($class);
        }
    }
} 