<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CourseRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tắt foreign key checks tạm thời
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Xóa dữ liệu cũ
        if (Schema::hasTable('course_registrations')) {
            DB::table('course_registrations')->truncate();
        }

        $this->createCourseRegistrations();

        // Bật lại foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
    
    /**
     * Tạo đăng ký khóa học cho học viên
     */
    private function createCourseRegistrations()
    {
        try {
            // Lấy tất cả học viên
            $students = Student::all();
            if ($students->isEmpty()) {
                Log::warning("Không có học viên nào trong hệ thống!");
                return;
            }
            
            // Lấy tất cả lớp học
            $classes = Classes::all();
            if ($classes->isEmpty()) {
                Log::warning("Không có lớp học nào trong hệ thống!");
                return;
            }
            
            // Mỗi học viên đăng ký 1-3 lớp học
            foreach ($students as $student) {
                // Chọn ngẫu nhiên số lượng lớp học để đăng ký
                $classesToRegister = $classes->random(rand(1, min(3, $classes->count())));
                
                foreach ($classesToRegister as $class) {
                    // Kiểm tra xem đã đăng ký chưa
                    $exists = DB::table('course_registrations')
                        ->where('student_id', $student->id)
                        ->where('class_id', $class->id)
                        ->exists();
                    
                    if (!$exists) {
                        // Tạo ngày đăng ký (1-30 ngày trước)
                        $enrollmentDate = Carbon::now()->subDays(rand(1, 30));
                        
                        // Hầu hết các đăng ký đều là active để dễ kiểm tra
                        $status = 'active';
                        if (rand(1, 10) > 8) { // 20% trường hợp là completed
                            $status = 'completed';
                        }
                        
                        // Tạo bản ghi đăng ký
                        DB::table('course_registrations')->insert([
                            'student_id' => $student->id,
                            'class_id' => $class->id,
                            'status' => $status,
                            'fee_amount' => rand(500000, 5000000), // Học phí ngẫu nhiên
                            'payment_status' => rand(1, 10) > 2 ? 'paid' : 'pending',
                            'payment_method' => ['cash', 'bank_transfer', 'credit_card'][rand(0, 2)],
                            'payment_date' => rand(1, 10) > 2 ? $enrollmentDate : null,
                            'invoice_number' => 'INV-' . strtoupper(substr(md5(rand()), 0, 8)),
                            'enrollment_date' => $enrollmentDate,
                            'completion_date' => $status == 'completed' ? Carbon::now()->subDays(rand(1, 5)) : null,
                            'notes' => 'Đăng ký tự động tạo bởi CourseRegistrationSeeder',
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                        
                        Log::info("Đã đăng ký học viên ID {$student->id} vào lớp {$class->name}");
                    }
                }
            }
            
            Log::info("Đã hoàn thành việc tạo đăng ký khóa học");
        } catch (\Exception $e) {
            Log::error("Lỗi khi tạo đăng ký khóa học: {$e->getMessage()}");
        }
    }
} 