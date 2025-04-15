<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\ClassSession;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $sessions = ClassSession::take(20)->get();
        $statuses = ['present', 'late', 'absent', 'excused'];
        
        foreach ($sessions as $session) {
            // Create attendance for 3-5 students per session
            $numStudents = rand(3, 5);
            
            for ($i = 1; $i <= $numStudents; $i++) {
                $status = $statuses[array_rand($statuses)];
                $startTime = Carbon::parse($session->start_time);
                
                // Generate realistic check-in and check-out times based on status
                if ($status === 'present') {
                    $checkIn = $startTime->copy()->subMinutes(rand(5, 15));
                    $checkOut = Carbon::parse($session->end_time)->addMinutes(rand(0, 5));
                } elseif ($status === 'late') {
                    $checkIn = $startTime->copy()->addMinutes(rand(10, 30));
                    $checkOut = Carbon::parse($session->end_time)->addMinutes(rand(0, 5));
                } else {
                    $checkIn = null;
                    $checkOut = null;
                }
                
                Attendance::create([
                    'session_id' => $session->id,
                    'student_id' => rand(1, 20), // Assuming we have 20 students
                    'status' => $status,
                    'check_in_time' => $checkIn ? $checkIn->format('H:i:s') : null,
                    'check_out_time' => $checkOut ? $checkOut->format('H:i:s') : null,
                    'duration_minutes' => ($checkIn && $checkOut) ? $checkIn->diffInMinutes($checkOut) : null,
                    'manually_marked' => rand(0, 1) === 1,
                    'marked_by' => rand(1, 5), // Assuming we have 5 teachers
                    'notes' => $this->getAttendanceNote($status)
                ]);
            }
        }
    }

    private function getAttendanceNote($status)
    {
        switch ($status) {
            case 'present':
                return 'Tham gia đầy đủ và tích cực';
            case 'late':
                return 'Đến muộn ' . rand(10, 30) . ' phút';
            case 'absent':
                return 'Vắng mặt không phép';
            case 'excused':
                return 'Vắng mặt có phép - ' . ['Bệnh', 'Việc gia đình', 'Công tác'][array_rand([0,1,2])];
            default:
                return '';
        }
    }
}