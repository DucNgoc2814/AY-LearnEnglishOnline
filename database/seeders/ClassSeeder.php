<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classes;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        try {
            // Disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Classes::truncate();

            // Lấy danh sách course_id từ bảng courses
            $courseIds = DB::table('courses')->pluck('id')->toArray();
            if (empty($courseIds)) {
                Log::warning('Không tìm thấy courses nào trong database. Vui lòng chạy CourseSeeder trước.');
                return;
            }

            $timeSlots = [
                ['08:00-09:30', 'Sáng'],
                ['10:00-11:30', 'Giữa sáng'],
                ['14:00-15:30', 'Chiều'],
                ['16:00-17:30', 'Cuối chiều'],
                ['18:30-20:00', 'Tối'],
            ];

            $classNames = [
                "Basic English",
                "Intermediate English",
                "Advanced English",
                "Business English",
                "English Communication",
                "IELTS Preparation",
                "TOEIC Preparation",
                "English Grammar",
                "English Vocabulary",
                "English Pronunciation",
                "Academic English",
                "English for Kids",
                "English for Teens",
                "English Conversation",
                "English for Specific Purposes"
            ];

            // Create 30 classes
            for ($i = 1; $i <= 30; $i++) {
                $teacherId = rand(1, 5); // Giả sử có 5 giáo viên
                $timeSlot = $timeSlots[array_rand($timeSlots)];
                $className = $classNames[array_rand($classNames)];

                // Tạo ngày giờ thực tế hơn
                $startDate = Carbon::now()->subDays(rand(0, 30))->setTime(rand(8, 18), [0, 30][rand(0, 1)], 0);
                $endDate = (clone $startDate)->addMonths(rand(2, 4));

                Classes::create([
                    'course_id' => $courseIds[array_rand($courseIds)],
                    'name' => "{$className} - " . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2),
                    'code' => "C{$i}-" . uniqid(),
                    'teacher_id' => $teacherId,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'enrollment_deadline' => (clone $startDate)->subDays(5),
                    'max_students' => 30,
                    'min_students' => 10,
                    'current_students' => rand(8, 25),
                    'status' => rand(1, 10) > 2 ? 'active' : (rand(1, 2) == 1 ? 'pending' : 'completed'),
                    'description' => "Lớp {$className} - {$timeSlot[1]} - " . implode(',', array_rand(array_flip([2, 3, 4, 5, 6, 7]), 3)),
                    'schedule' => json_encode([
                        'days' => array_rand(array_flip([2, 3, 4, 5, 6, 7]), 3),
                        'time' => $timeSlot[0]
                    ]),
                    'is_active' => true
                ]);
            }

            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            Log::info('ClassSeeder đã chạy thành công');
        } catch (\Exception $e) {
            Log::error('Lỗi trong ClassSeeder: ' . $e->getMessage());
            // Đảm bảo bật lại foreign key checks ngay cả khi có lỗi
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            throw $e;
        }
    }
}
