<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Course;
use App\Models\ClassSchedule;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class StudentSeeder extends Seeder
{
    public function run()
    {
        // Tắt foreign key checks tạm thời
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Xóa dữ liệu cũ
        DB::table('students')->truncate();
        
        // Kiểm tra xem bảng class_student đã tồn tại chưa
        try {
            if (Schema::hasTable('class_student')) {
                DB::table('class_student')->truncate();
            } else {
                // Nếu bảng không tồn tại, bỏ qua việc truncate bảng này
                Log::warning('Không tìm thấy bảng class_student để truncate');
            }
        } catch (\Exception $e) {
            Log::error('Lỗi khi truncate bảng class_student: ' . $e->getMessage());
        }
        
        // Truncate enrollment table if it exists
        try {
            if (Schema::hasTable('enrollments')) {
                DB::table('enrollments')->truncate();
            } else {
                Log::warning('Không tìm thấy bảng enrollments để truncate');
            }
        } catch (\Exception $e) {
            Log::error('Lỗi khi truncate bảng enrollments: ' . $e->getMessage());
        }

        // Create test account with a known password
        try {
            // Standard hash
            $testPassword = '123456';
            $hashedPassword = Hash::make($testPassword);
            DB::table('students')->insert([
                [
                    'student_code' => 'test123',
                    'password' => $hashedPassword,  // Use properly hashed password
                    'full_name' => 'Test Account',
                    'email' => 'emily',
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

        try {
            $testStudent = Student::where('student_code', 'test123')->first();
            if ($testStudent) {
                if (Schema::hasTable('class_student')) {
                    $this->assignClassesToStudent($testStudent->id);
                }
                
                if (Schema::hasTable('enrollments')) {
                    $this->assignCoursesToStudent($testStudent->id, $testStudent->user_id);
                }
            }
        } catch (\Exception $e) {
            Log::error('Error assigning classes to test student', [
                'error' => $e->getMessage()
            ]);
        }
        
        // Bật lại foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
    
    /**
     * Assign classes to a student
     */
    private function assignClassesToStudent($studentId)
    {
        // Make sure class_student table exists
        if (!Schema::hasTable('class_student')) {
            Log::warning("Bảng class_student không tồn tại, bỏ qua việc gán lớp học cho học viên $studentId");
            return;
        }
        
        // Get more random classes (between 3 and 6)
        $classes = Classes::inRandomOrder()->take(rand(3, 6))->get();
        
        // If this is the test student, ensure they have at least 5 classes
        if ($studentId == Student::where('student_code', 'test123')->value('id')) {
            $classes = Classes::inRandomOrder()->take(5)->get();
        }
        
        foreach ($classes as $class) {
            try {
                // Check if the student is already assigned to this class
                $exists = DB::table('class_student')
                    ->where('class_id', $class->id)
                    ->where('student_id', $studentId)
                    ->exists();
                
                if (!$exists) {
                    // Generate enrollment date between 1 and 30 days ago
                    $enrollmentDate = Carbon::now()->subDays(rand(1, 30));
                    
                    // Almost all classes should be active for better testing
                    $status = 'active';
                    if (rand(1, 10) > 9) { // Only 10% chance of completed
                        $status = 'completed';
                    }
                    
                    // Insert into pivot table
                    DB::table('class_student')->insert([
                        'class_id' => $class->id,
                        'student_id' => $studentId,
                        'status' => $status,
                        'enrollment_date' => $enrollmentDate,
                        'completion_date' => $status === 'completed' ? Carbon::now()->subDays(rand(1, 5)) : null,
                        'payment_status' => rand(1, 10) > 2 ? 'paid' : 'pending',
                        'payment_date' => rand(1, 10) > 2 ? $enrollmentDate : null,
                        'invoice_number' => 'INV-' . Str::random(8),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    
                    // Increment the class current_students count
                    $class->increment('current_students');
                    
                    Log::info("Student $studentId assigned to class {$class->name}");
                }
            } catch (\Exception $e) {
                Log::error("Error assigning student to class", [
                    'student_id' => $studentId,
                    'class_id' => $class->id,
                    'error' => $e->getMessage()
                ]);
            }
        }
    }
    
    /**
     * Assign courses to a student via enrollments
     */
    private function assignCoursesToStudent($studentId, $userId)
    {
        // Make sure enrollments table exists
        if (!Schema::hasTable('enrollments')) {
            Log::warning("Bảng enrollments không tồn tại, bỏ qua việc gán khóa học cho học viên $studentId");
            return;
        }
        
        // Get random courses (between 1 and 3)
        $courses = Course::inRandomOrder()->take(rand(1, 3))->get();
        
        foreach ($courses as $course) {
            try {
                // Check if the enrollment already exists
                $exists = Enrollment::where('user_id', $userId)
                    ->where('course_id', $course->id)
                    ->exists();
                
                if (!$exists) {
                    // Generate enrollment date between 1 and 60 days ago
                    $enrollmentDate = Carbon::now()->subDays(rand(1, 60));
                    
                    // Expiry date is 1 year from enrollment
                    $expiryDate = (clone $enrollmentDate)->addYear();
                    
                    // Calculate random progress
                    $progress = rand(0, 100);
                    
                    // Determine status
                    $status = 'active';
                    if ($progress >= 100) {
                        $status = 'completed';
                    } elseif (rand(1, 10) === 1) {
                        $status = 'expired';
                    }
                    
                    // Create enrollment record
                    Enrollment::create([
                        'user_id' => $userId,
                        'course_id' => $course->id,
                        'enrollment_date' => $enrollmentDate,
                        'expiry_date' => $expiryDate,
                        'status' => $status,
                        'progress' => $progress,
                        'last_access_date' => $status === 'active' ? Carbon::now()->subDays(rand(0, 10)) : $enrollmentDate,
                        'completion_date' => $status === 'completed' ? $enrollmentDate->addDays(rand(10, 90)) : null,
                        'notes' => 'Auto-generated enrollment via StudentSeeder'
                    ]);
                    
                    // Increment course enrollment count
                    $course->increment('total_students');
                    
                    Log::info("Student userId $userId enrolled in course {$course->title}");
                }
            } catch (\Exception $e) {
                Log::error("Error enrolling student in course", [
                    'student_id' => $studentId,
                    'user_id' => $userId,
                    'course_id' => $course->id,
                    'error' => $e->getMessage()
                ]);
            }
        }
    }
}
