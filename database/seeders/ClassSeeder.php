<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classes;
use Carbon\Carbon;

class ClassSeeder extends Seeder
{
    public function run()
    {
        $classes = [
            [
                'name' => 'Lớp Tiếng Anh Giao Tiếp Cơ Bản 2024A',
                'code' => 'ENG-BASIC-2024A',
                'teacher_id' => 2, // Jane Smith
                'start_date' => Carbon::now()->addDays(15),
                'end_date' => Carbon::now()->addMonths(2),
                'enrollment_deadline' => Carbon::now()->addDays(10),
                'max_students' => 30,
                'min_students' => 10,
                'current_students' => 0,
                'status' => Classes::STATUS_PENDING,
                'description' => 'Khóa học tiếng Anh giao tiếp cơ bản dành cho người mới bắt đầu, tập trung vào kỹ năng nghe nói.',
                'schedule' => [
                    'monday' => ['08:00 - 10:00'],
                    'wednesday' => ['08:00 - 10:00'],
                    'friday' => ['08:00 - 10:00']
                ],
                'is_active' => true
            ],
            [
                'name' => 'Lớp Tiếng Anh Thương Mại 2024A',
                'code' => 'ENG-BUS-2024A',
                'teacher_id' => 2, // Jane Smith
                'start_date' => Carbon::now()->addMonth(),
                'end_date' => Carbon::now()->addMonths(3),
                'enrollment_deadline' => Carbon::now()->addDays(20),
                'max_students' => 25,
                'min_students' => 8,
                'current_students' => 0,
                'status' => Classes::STATUS_PENDING,
                'description' => 'Khóa học tiếng Anh thương mại cho người đi làm, tập trung vào kỹ năng giao tiếp trong môi trường doanh nghiệp.',
                'schedule' => [
                    'tuesday' => ['18:30 - 21:30'],
                    'thursday' => ['18:30 - 21:30']
                ],
                'is_active' => true
            ],
            [
                'name' => 'Lớp IELTS Target 7.0 2024A',
                'code' => 'IELTS-7-2024A',
                'teacher_id' => 7, // Michael Wilson
                'start_date' => Carbon::now()->addMonths(2),
                'end_date' => Carbon::now()->addMonths(5),
                'enrollment_deadline' => Carbon::now()->addMonths(1)->subDays(5),
                'max_students' => 20,
                'min_students' => 5,
                'current_students' => 0,
                'status' => Classes::STATUS_PENDING,
                'description' => 'Khóa học luyện thi IELTS chuyên sâu, mục tiêu đạt 7.0+, phù hợp cho học viên đã có nền tảng tiếng Anh tốt.',
                'schedule' => [
                    'saturday' => ['14:00 - 17:00'],
                    'sunday' => ['14:00 - 17:00']
                ],
                'is_active' => true
            ],
            [
                'name' => 'Lớp TOEIC 4 Kỹ Năng 2024A',
                'code' => 'TOEIC-4S-2024A',
                'teacher_id' => 7, // Michael Wilson
                'start_date' => Carbon::now()->addMonths(1),
                'end_date' => Carbon::now()->addMonths(4),
                'enrollment_deadline' => Carbon::now()->addDays(25),
                'max_students' => 25,
                'min_students' => 8,
                'current_students' => 0,
                'status' => Classes::STATUS_PENDING,
                'description' => 'Khóa học TOEIC toàn diện bao gồm cả 4 kỹ năng Nghe, Nói, Đọc, Viết, hướng đến chứng chỉ TOEIC 4 kỹ năng quốc tế.',
                'schedule' => [
                    'monday' => ['18:30 - 21:30'],
                    'wednesday' => ['18:30 - 21:30']
                ],
                'is_active' => true
            ]
        ];

        foreach ($classes as $class) {
            try {
                // Tự động encode schedule thành JSON
                $class['schedule'] = json_encode($class['schedule']);
                Classes::create($class);
                $this->command->info("Đã tạo lớp: {$class['name']}");
            } catch (\Exception $e) {
                $this->command->error("Lỗi khi tạo lớp {$class['name']}: " . $e->getMessage());
            }
        }
    }
}
