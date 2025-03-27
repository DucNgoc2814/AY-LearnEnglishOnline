<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $students = [
            [
                'user_id' => 3,
                'student_code' => 'STU001',
                'full_name' => 'Alex Thompson',
                'date_of_birth' => '2000-01-15',
                'gender' => 'male',
                'phone' => '0912345678',
                'address' => '123 Student St, City',
                'parent1_name' => 'John Thompson',
                'parent1_relationship' => 'father',
                'parent1_phone' => '0923456789',
                'parent1_email' => 'john.t@email.com',
                'is_active' => true
            ],
            [
                'user_id' => 4,
                'student_code' => 'STU002',
                'full_name' => 'Emily Parker',
                'date_of_birth' => '2001-03-20',
                'gender' => 'female',
                'phone' => '0912345679',
                'address' => '456 Student Ave, City',
                'parent1_name' => 'Mary Parker',
                'parent1_relationship' => 'mother',
                'parent1_phone' => '0923456790',
                'parent1_email' => 'mary.p@email.com',
                'is_active' => true
            ],
            [
                'user_id' => 5,
                'student_code' => 'STU003',
                'full_name' => 'William Chen',
                'date_of_birth' => '1999-07-10',
                'gender' => 'male',
                'phone' => '0912345680',
                'address' => '789 Student Rd, City',
                'parent1_name' => 'Michael Chen',
                'parent1_relationship' => 'father',
                'parent1_phone' => '0923456791',
                'parent1_email' => 'michael.c@email.com',
                'is_active' => true
            ],
            // Thêm 7 student khác với thông tin tương tự...
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}