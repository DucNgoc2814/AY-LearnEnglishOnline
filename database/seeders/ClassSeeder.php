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

            // Create 30 classes instead of 20
            for ($i = 1; $i <= 30; $i++) {
                $teacherId = rand(1, 5); // Assuming we have 5 teachers
                $timeSlot = $timeSlots[array_rand($timeSlots)];
                $className = $classNames[array_rand($classNames)];

                // Create more realistic dates
                $startDate = Carbon::now()->subDays(rand(0, 30)); // Some classes already started, some will start soon
                $endDate = (clone $startDate)->addMonths(rand(2, 4)); // 2-4 month duration

                Classes::create([
                    'name' => "{$className} - " . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2),
                    'code' => "C{$i}-" . uniqid(),
                    'teacher_id' => $teacherId,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'enrollment_deadline' => (clone $startDate)->subDays(5),
                    'max_students' => 30,
                    'min_students' => 10,
                    'fee' => rand(1500000, 3000000),
                    'current_students' => rand(8, 25), // More realistic student counts
                    'status' => rand(1, 10) > 2 ? 'active' : (rand(1, 2) == 1 ? 'pending' : 'completed'), // Mostly active classes
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
            Log::info('ClassSeeder completed successfully');
        } catch (\Exception $e) {
            Log::error('Error in ClassSeeder: ' . $e->getMessage());
            // Make sure to re-enable foreign key checks even if there's an error
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            // Rethrow the exception to notify of the error
            throw $e;
        }
    }
}
