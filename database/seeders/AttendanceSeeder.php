<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        $attendances = [
            [
                'session_id' => 1,
                'student_id' => 1,
                'status' => 'present',
                'check_in_time' => '18:25:00',
                'check_out_time' => '21:30:00',
                'duration_minutes' => 185,
                'manually_marked' => true,
                'marked_by' => 2,
                'notes' => 'Tham gia đầy đủ và tích cực'
            ],
            [
                'session_id' => 1,
                'student_id' => 2,
                'status' => 'late',
                'check_in_time' => '19:00:00',
                'check_out_time' => '21:30:00',
                'duration_minutes' => 150,
                'manually_marked' => true,
                'marked_by' => 2,
                'notes' => 'Đến muộn 30 phút'
            ],
            // Thêm 8 attendance khác...
        ];

        foreach ($attendances as $attendance) {
            Attendance::create($attendance);
        }
    }
}