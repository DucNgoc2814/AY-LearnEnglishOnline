<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classes;
use Carbon\Carbon;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        $classTypes = ['online', 'hybrid'];
        $timeSlots = [
            ['08:00-09:30', 'Sáng'],
            ['10:00-11:30', 'Giữa sáng'],
            ['14:00-15:30', 'Chiều'],
            ['16:00-17:30', 'Cuối chiều'],
            ['18:30-20:00', 'Tối'],
        ];
        
        for ($i = 1; $i <= 20; $i++) {
            $courseId = rand(1, 20); // Assuming we have 20 courses from CourseSeeder
            $teacherId = rand(1, 5); // Assuming we have 5 teachers
            $timeSlot = $timeSlots[array_rand($timeSlots)];
            $classType = $classTypes[array_rand($classTypes)];
            
            Classes::create([
                'name' => "Class-{$courseId}-" . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2),
                'code' => "C{$courseId}-" . uniqid(),
                'course_id' => $courseId,
                'teacher_id' => $teacherId,
                'class_type' => $classType,
                'start_date' => Carbon::now()->addDays(rand(1, 14)),
                'end_date' => Carbon::now()->addMonths(3),
                'enrollment_deadline' => Carbon::now()->addDays(rand(3, 10)),
                'max_students' => 30,
                'min_students' => 10,
                'fee' => rand(1500000, 3000000),
                'current_students' => rand(0, 15),
                'status' => 'active',
                'description' => "Lớp học - {$timeSlot[1]} - " . implode(',', array_rand(array_flip([2,3,4,5,6,7]), 3)),
                'schedule' => json_encode([
                    'days' => array_rand(array_flip([2,3,4,5,6,7]), 3),
                    'time' => $timeSlot[0]
                ]),
                'is_active' => true
            ]);
        }
    }
} 