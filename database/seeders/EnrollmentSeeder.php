<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enrollment;

class EnrollmentSeeder extends Seeder
{
    public function run()
    {
        $enrollments = [
            [
                'user_id' => 1,
                'course_id' => 1,
                'enroll_date' => '2024-01-01',
                'status' => 'active',
                'payment_status' => 'paid',
                'amount_paid' => 0,
                'progress_percentage' => 0,
                'last_access_date' => '2024-01-01 10:00:00',
                'completion_date' => null,
                'notes' => 'Enrolled in Laravel Basics course'
            ],
            [
                'user_id' => 2,
                'course_id' => 1,
                'enroll_date' => '2024-01-02',
                'status' => 'active',
                'payment_status' => 'paid',
                'amount_paid' => 0,
                'progress_percentage' => 10,
                'last_access_date' => '2024-01-02 15:30:00',
                'completion_date' => null,
                'notes' => 'Started first module'
            ],
            // Thêm 8 enrollment khác...
        ];

        foreach ($enrollments as $enrollment) {
            Enrollment::create($enrollment);
        }
    }
}