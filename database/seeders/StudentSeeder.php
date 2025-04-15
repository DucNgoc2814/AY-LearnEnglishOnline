<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class StudentSeeder extends Seeder
{
    public function run()
    {
        // Tắt foreign key checks tạm thời
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Xóa dữ liệu cũ
        DB::table('students')->truncate();

        // Create test account with a known password
        try {
            // Standard hash
            $testPassword = '123456';
            $hashedPassword = Hash::make($testPassword);
            
            // Also save raw password to verify it works
            // (Normally we wouldn't do this, but for testing it's OK)
            DB::table('students')->insert([
                [
                    'user_id' => 6,
                    'student_code' => 'test123',
                    'password' => $hashedPassword,  // Use properly hashed password
                    'full_name' => 'Test Account',
                    'date_of_birth' => '2000-01-01',
                    'gender' => 'male',
                    'phone' => '0912345681',
                    'address' => '123 Test St, City',
                    'parent1_name' => 'Test Parent',
                    'parent1_relationship' => 'father',
                    'parent1_phone' => '0923456792',
                    'parent1_email' => 'test.p@email.com',
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
            
            // Log success and test that hash works
            $insertedUser = DB::table('students')->where('student_code', 'test123')->first();
            if ($insertedUser) {
                $hashWorks = Hash::check('123456', $insertedUser->password);
                Log::info('Test account created', [
                    'id' => $insertedUser->id,
                    'hash_verification_works' => $hashWorks
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error creating test account', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }

        // Regular student accounts
        $defaultPassword = Hash::make('password');
        
        $students = [
            [
                'user_id' => 3,
                'student_code' => 'STU001',
                'password' => $defaultPassword,
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
                'password' => $defaultPassword,
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
                'password' => $defaultPassword,
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
            try {
                // Kiểm tra xem student đã tồn tại chưa
                $existingStudent = Student::where('student_code', $student['student_code'])->first();
                if (!$existingStudent) {
                    Student::create($student);
                }
            } catch (\Exception $e) {
                Log::error('Error creating student', [
                    'student_code' => $student['student_code'],
                    'error' => $e->getMessage()
                ]);
            }
        }

        // Bật lại foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}