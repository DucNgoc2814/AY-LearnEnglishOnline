<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
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

            // Lấy tất cả khóa học
            $courses = Course::all();
            if ($courses->isEmpty()) {
                Log::warning("Không có khóa học nào trong hệ thống!");
                return;
            }

            $registrations = [];
            $count = 0;
            $maxRegistrations = 200;
            $existingPairs = [];

            echo "Bắt đầu tạo {$maxRegistrations} đăng ký khóa học...\n";

            // Tạo đăng ký cho đến khi đủ số lượng
            while ($count < $maxRegistrations && !$courses->isEmpty() && !$students->isEmpty()) {
                $student = $students->random();
                $course = $courses->random();
                $pairKey = $student->id . '-' . $course->id;

                // Kiểm tra xem cặp student-course này đã tồn tại chưa
                if (!isset($existingPairs[$pairKey])) {
                    $existingPairs[$pairKey] = true;

                    $enrollmentDate = Carbon::now()->subDays(rand(1, 90));
                    $status = rand(1, 10) > 8 ? 'completed' : 'active';

                    $registrations[] = [
                        'course_id' => $course->id,
                        'status' => $status,
                        'fee_amount' => rand(500000, 5000000),
                        'payment_status' => rand(1, 10) > 2 ? 'paid' : 'pending',
                        'payment_method' => ['cash', 'bank_transfer', 'credit_card'][rand(0, 2)],
                        'payment_date' => rand(1, 10) > 2 ? $enrollmentDate : null,
                        'invoice_number' => 'INV-' . strtoupper(substr(md5(uniqid()), 0, 8)),
                        'enrollment_date' => $enrollmentDate,
                        'completion_date' => $status == 'completed' ? Carbon::now()->subDays(rand(1, 5)) : null,
                        'notes' => 'Đăng ký tự động tạo bởi CourseRegistrationSeeder',
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                    $count++;

                    // Insert mỗi 50 bản ghi để tránh quá tải
                    if (count($registrations) >= 50) {
                        echo "Đang insert {$count}/200 đăng ký...\n";
                        DB::table('course_registrations')->insert($registrations);
                        $registrations = [];
                    }
                }
            }

            // Insert các bản ghi còn lại
            if (!empty($registrations)) {
                DB::table('course_registrations')->insert($registrations);
            }

            echo "Đã tạo thành công {$count} đăng ký khóa học\n";
            Log::info("Đã tạo chính xác {$count} đăng ký khóa học");

        } catch (\Exception $e) {
            Log::error("Lỗi khi tạo đăng ký khóa học: {$e->getMessage()}");
            echo "Lỗi: " . $e->getMessage() . "\n";
        }
    }
}
