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
            echo "Starting ClassSessionSeeder...\n";

            // Disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            echo "Disabled foreign key checks\n";

            // Clear existing sessions
            ClassSession::truncate();
            echo "Cleared existing sessions\n";

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
            echo "Fetching class schedules...\n";
            $schedules = DB::table('class_schedules')
                ->select(['id', 'day_of_week', 'start_time', 'end_time'])
                ->orderBy('id')
                ->get();

            echo "Found {$schedules->count()} schedules\n";
            Log::info("Tìm thấy {$schedules->count()} lịch học để tạo buổi học");

            if ($schedules->isEmpty()) {
                echo "No schedules found in the database!\n";
                Log::warning("No schedules found in the database!");
                return;
            }

            $startDate = now()->startOfWeek();
            echo "Start date: " . $startDate->format('Y-m-d') . "\n";
            Log::info("Start date: " . $startDate->format('Y-m-d'));
            $sessions = [];
            $totalCreated = 0;

            // Tạo buổi học cho mỗi lịch học
            echo "Generating sessions...\n";
            foreach ($schedules as $schedule) {
                try {
                    echo "Processing schedule ID {$schedule->id} for day {$schedule->day_of_week}\n";
                    Log::info("Processing schedule ID {$schedule->id} for day {$schedule->day_of_week}");

                    $scheduleSession = [];

                    // Create only 2 weeks of sessions for testing
                    for ($week = 0; $week < 2; $week++) {
                        $sessionDate = $startDate->copy()->addWeeks($week);

                        // Adjust date to match day_of_week
                        while (true) {
                            $currentDayOfWeek = $sessionDate->dayOfWeek;
                            // Convert Carbon's 0-6 to our 1-7 format
                            $currentDayOfWeek = ($currentDayOfWeek === 0) ? 7 : $currentDayOfWeek;

                            if ($currentDayOfWeek == $schedule->day_of_week) {
                                break;
                            }
                            $sessionDate->addDay();
                        }

                        echo "Week {$week}, Session date: " . $sessionDate->format('Y-m-d') . "\n";
                        Log::info("Week {$week}, Session date: " . $sessionDate->format('Y-m-d') . ", Is future: " . ($sessionDate->isFuture() ? 'true' : 'false'));

                        // Chỉ tạo buổi học cho những ngày trong tương lai
                        if ($sessionDate->isFuture()) {
                            $scheduleSession[] = [
                                'schedule_id' => $schedule->id,
                                'resource_id' => null,
                                'session_date' => $sessionDate->format('Y-m-d'),
                                'start_time' => $schedule->start_time,
                                'end_time' => $schedule->end_time,
                                'topic' => $topics[array_rand($topics)],
                                'content' => 'Chi tiết nội dung buổi học sẽ được cập nhật',
                                'session_materials' => null,
                                'recording_url' => null,
                                'notes' => 'Buổi học trực tuyến qua Zoom - Meeting ID sẽ được cập nhật',
                                'status' => 'scheduled',
                                'created_at' => now(),
                                'updated_at' => now()
                            ];
                            echo "Added session for date: " . $sessionDate->format('Y-m-d') . "\n";
                            Log::info("Added session for date: " . $sessionDate->format('Y-m-d'));
                        }
                    }

                    // Insert sessions for this schedule immediately
                    if (!empty($scheduleSession)) {
                        ClassSession::insert($scheduleSession);
                        $totalCreated += count($scheduleSession);
                        echo "Inserted " . count($scheduleSession) . " sessions for schedule {$schedule->id}\n";
                    }

                } catch (\Exception $e) {
                    Log::error("Error processing schedule {$schedule->id}: {$e->getMessage()}");
                    echo "Error processing schedule {$schedule->id}: {$e->getMessage()}\n";
                    continue; // Skip to next schedule if there's an error
                }
            }

            echo "Successfully created {$totalCreated} class sessions in total\n";
            Log::info("Successfully created {$totalCreated} class sessions in total");

        } catch (\Exception $e) {
            Log::error("Lỗi khi tạo buổi học: {$e->getMessage()}");
            echo "Error occurred: " . $e->getMessage() . "\n";
        } finally {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            echo "Re-enabled foreign key checks\n";
            echo "ClassSessionSeeder completed\n";
        }
    }
}
