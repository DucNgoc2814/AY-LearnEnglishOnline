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
    public function run(): void
    {
        try {
            // Disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            
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

            // Get schedules with their associated classes
            $schedules = ClassSchedule::select(
                'class_schedules.*',
                'classes.type as class_type',
                'classes.name as class_name'
            )
            ->join('classes', 'class_schedules.class_id', '=', 'classes.id')
            ->get();

            if ($schedules->isEmpty()) {
                echo "No schedules found in the database!\n";
                return;
            }

            $startDate = Carbon::now()->startOfWeek();
            $sessions = [];

            foreach ($schedules as $schedule) {
                echo "Processing class {$schedule->class_name} (ID: {$schedule->class_id})\n";
                echo "Class type: {$schedule->class_type}, Days: {$schedule->day_of_week}, Time: {$schedule->start_time}-{$schedule->end_time}\n";
                
                // Create only 2 weeks of sessions for testing
                for ($week = 0; $week < 2; $week++) {
                    $sessionDate = $startDate->copy()->addWeeks($week);
                    
                    // Adjust date to match day_of_week
                    while ($sessionDate->dayOfWeek != $schedule->day_of_week) {
                        $sessionDate->addDay();
                    }

                    $room = $schedule->class_type === 'online' ? 'ONLINE-' . rand(1, 5) : $schedule->room_number;
                    echo "Created schedule for day {$schedule->day_of_week} in room {$room}\n";
                    
                    $sessions[] = [
                        'class_id' => $schedule->class_id,
                        'schedule_id' => $schedule->id,
                        'session_date' => $sessionDate->format('Y-m-d'),
                        'start_time' => $schedule->start_time,
                        'end_time' => $schedule->end_time,
                        'room_number' => $room,
                        'topic' => $topics[array_rand($topics)],
                        'content' => 'Chi tiết nội dung buổi học sẽ được cập nhật',
                        'homework' => 'Bài tập về nhà sẽ được giao sau buổi học',
                        'recording_url' => null,
                        'attendance_required' => true,
                        'status' => 'scheduled',
                        'notes' => $schedule->class_type === 'online' 
                            ? 'Buổi học trực tuyến qua Zoom - Meeting ID sẽ được cập nhật'
                            : 'Buổi học tại phòng ' . $room,
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
            Log::error('Error in ClassSessionSeeder: ' . $e->getMessage());
            echo "Error: " . $e->getMessage() . "\n";
        } finally {
            // Always re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }
}