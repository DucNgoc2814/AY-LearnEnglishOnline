<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassSchedule;
use App\Models\ClassRoom;

class ClassScheduleSeeder extends Seeder
{
    public function run()
    {
        // Đảm bảo có lớp học trong database trước
        $class = ClassRoom::first();
        if (!$class) {
            // Nếu chưa có lớp học nào, tạo một lớp mẫu
            $class = ClassRoom::create([
                'name' => 'Lớp học mẫu',
                'description' => 'Mô tả lớp học mẫu',
                'status' => 'active'
            ]);
        }

        $schedules = [
            [
                'class_id' => $class->id, // Sử dụng ID của lớp học thực tế
                'day_of_week' => 2, // Tuesday
                'start_time' => '18:30:00',
                'end_time' => '21:30:00',
                'room_number' => 'A101',
                'is_online' => true,
                'meeting_url' => 'https://zoom.us/j/123456789',
                'is_repeating' => true,
                'is_active' => true
            ],
            [
                'class_id' => $class->id, // Sử dụng ID của lớp học thực tế
                'day_of_week' => 4, // Thursday
                'start_time' => '18:30:00',
                'end_time' => '21:30:00',
                'room_number' => 'A101',
                'is_online' => true,
                'meeting_url' => 'https://zoom.us/j/123456789',
                'is_repeating' => true,
                'is_active' => true
            ],
            [
                'class_id' => $class->id, // Sử dụng ID của lớp học thực tế
                'day_of_week' => 3, // Wednesday
                'start_time' => '19:00:00',
                'end_time' => '22:00:00',
                'room_number' => 'B202',
                'is_online' => false,
                'meeting_url' => null,
                'is_repeating' => true,
                'is_active' => true
            ],
            // Thêm 7 schedule khác...
        ];

        foreach ($schedules as $schedule) {
            ClassSchedule::create($schedule);
        }
    }
}