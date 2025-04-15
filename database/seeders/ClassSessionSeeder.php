<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassSession;
use App\Models\ClassSchedule;
use App\Models\Classes;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClassSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            // Disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            
            // Clear existing sessions
            ClassSession::truncate();
            
            $topics = [
                'Introduction to Grammar',
                'Basic Conversation',
                'Reading Comprehension',
                'Listening Practice',
                'Writing Skills',
                'Speaking Practice',
                'Vocabulary Building',
                'Pronunciation',
                'Business Communication',
                'Academic Writing'
            ];

            // Lấy danh sách lịch học từ bảng class_schedules
            $schedules = DB::table('class_schedules')
                ->join('classes', 'class_schedules.class_id', '=', 'classes.id')
                ->select('class_schedules.*')
                ->get();

            Log::info("Tìm thấy {$schedules->count()} lịch học để tạo buổi học");

            if ($schedules->isEmpty()) {
                echo "No schedules found in the database!\n";
                return;
            }

            $startDate = Carbon::now()->startOfWeek();
            $sessions = [];

            // Tạo buổi học cho mỗi lịch học
            foreach ($schedules as $schedule) {
                $class = DB::table('classes')->where('id', $schedule->class_id)->first();
                $className = $class ? $class->name : 'Unknown';
                $classType = $class ? $class->class_type : 'offline';
                
                echo "Processing class {$className} (ID: {$schedule->class_id})\n";
                echo "Class type: {$classType}, Days: {$schedule->day_of_week}, Time: {$schedule->start_time}-{$schedule->end_time}\n";
                
                // Create only 2 weeks of sessions for testing
                for ($week = 0; $week < 2; $week++) {
                    $sessionDate = $startDate->copy()->addWeeks($week);
                    
                    // Adjust date to match day_of_week
                    while ($sessionDate->dayOfWeek != $schedule->day_of_week) {
                        $sessionDate->addDay();
                    }

                    $room = $classType === 'online' ? 'ONLINE-' . rand(1, 5) : $schedule->room_number;
                    echo "Created schedule for day {$schedule->day_of_week} in room {$room}\n";
                    
                    $sessions[] = [
                        'schedule_id' => $schedule->id,
                        'resource_id' => null, // Nullable field
                        'session_date' => $sessionDate->format('Y-m-d'),
                        'start_time' => $schedule->start_time,
                        'end_time' => $schedule->end_time,
                        'topic' => $topics[array_rand($topics)],
                        'content' => 'Chi tiết nội dung buổi học sẽ được cập nhật',
                        'session_materials' => null, // Nullable field
                        'recording_url' => null, // Nullable field
                        'notes' => $classType === 'online' 
                            ? 'Buổi học trực tuyến qua Zoom - Meeting ID sẽ được cập nhật'
                            : 'Buổi học tại phòng ' . $room,
                        'status' => 'scheduled',
                        'created_at' => now(),
                        'updated_at' => now()
                    ];

                    // Insert in chunks to prevent memory issues
                    if (count($sessions) >= 50) {
                        ClassSession::insert($sessions);
                        $sessions = [];
                    }
                }
            }

            // Insert any remaining sessions
            if (!empty($sessions)) {
                ClassSession::insert($sessions);
            }

            echo "\nSuccessfully created all class sessions!\n";

        } catch (\Exception $e) {
            Log::error("Lỗi khi tạo buổi học: {$e->getMessage()}");
            echo "Error: " . $e->getMessage() . "\n";
        } finally {
            // Always re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }
}