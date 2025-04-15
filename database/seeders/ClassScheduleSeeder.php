<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassSchedule;
use App\Models\Classes;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClassScheduleSeeder extends Seeder
{
    public function run(): void
    {
        try {
            // Disable foreign key checks temporarily
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // Clear existing schedules
            ClassSchedule::truncate();
            Log::info('Truncated class_schedules table');

            $classes = Classes::all();
            
            if ($classes->isEmpty()) {
                Log::warning("No classes found in database!");
                return;
            }

            Log::info("Found " . $classes->count() . " classes");
            
            // Phòng học cho từng loại lớp
            $rooms = [
                'online' => ['ONLINE-1', 'ONLINE-2', 'ONLINE-3', 'ONLINE-4', 'ONLINE-5'],
                'offline' => ['A101', 'A102', 'A103', 'B201', 'B202'],
                'hybrid' => ['H101', 'H102', 'H103', 'H201', 'H202']
            ];

            foreach ($classes as $class) {
                Log::info("Processing class {$class->name} (ID: {$class->id})");
                
                // Decode lịch học từ class
                $schedule = json_decode($class->schedule, true);
                if (!$schedule || empty($schedule['days']) || empty($schedule['time'])) {
                    Log::warning("Invalid schedule for class {$class->name}");
                    continue;
                }

                $days = $schedule['days'];
                $times = explode('-', $schedule['time']);
                
                // Xác định loại phòng dựa trên class_type
                $roomType = $class->class_type ?? 'offline';
                $availableRooms = $rooms[$roomType] ?? $rooms['offline'];
                
                Log::info("Class type: {$roomType}, Days: " . implode(',', $days) . ", Time: {$schedule['time']}");
                
                foreach ($days as $day) {
                    $isOnline = in_array($roomType, ['online', 'hybrid']);
                    $room = $availableRooms[array_rand($availableRooms)];
                    
                    try {
                        ClassSchedule::create([
                            'class_id' => $class->id,
                            'day_of_week' => $day,
                            'start_time' => $times[0],
                            'end_time' => $times[1],
                            'room_number' => $room,
                            'meeting_url' => $isOnline ? 'https://zoom.us/j/' . rand(100000000, 999999999) . '?pwd=' . substr(str_shuffle('abcdefghijklmnopqrstuvwxyz123456789'), 0, 6) : null,
                            'is_repeating' => true,
                            'is_active' => true,
                            'is_online' => $isOnline,
                            'start_date' => $class->start_date,
                            'end_date' => $class->end_date,
                            'notes' => $this->getNotes($roomType)
                        ]);
                        Log::info("Created schedule for day {$day} in room {$room}");
                    } catch (\Exception $e) {
                        Log::error("Error creating schedule: " . $e->getMessage());
                    }
                }
            }
            
            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            Log::info('ClassScheduleSeeder completed successfully');
            
        } catch (\Exception $e) {
            Log::error('Error in ClassScheduleSeeder: ' . $e->getMessage());
            // Make sure to re-enable foreign key checks even if there's an error
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            // Rethrow the exception
            throw $e;
        }
    }

    private function getNotes(string $classType): string
    {
        return match($classType) {
            'online' => 'Lớp học trực tuyến qua Zoom',
            'hybrid' => 'Lớp học kết hợp (trực tiếp và trực tuyến)',
            default => 'Lớp học trực tiếp tại phòng học'
        };
    }
}