<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassSession;
use App\Models\ClassSchedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ClassSessionClassIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Bắt đầu cập nhật class_id cho các class_sessions...');
        
        try {
            // Lấy tất cả session có schedule_id
            $sessions = ClassSession::whereNotNull('schedule_id')->get();
            $this->command->info("Tìm thấy {$sessions->count()} session cần cập nhật");
            
            $count = 0;
            
            foreach ($sessions as $session) {
                // Tìm schedule tương ứng
                $schedule = ClassSchedule::find($session->schedule_id);
                
                if ($schedule && $schedule->class_id) {
                    // Cập nhật class_id cho session
                    $session->class_id = $schedule->class_id;
                    $session->save();
                    $count++;
                    
                    $this->command->info("Đã cập nhật session #{$session->id} với class_id = {$schedule->class_id}");
                } else {
                    $this->command->warn("Không tìm thấy class_id cho session #{$session->id}");
                }
            }
            
            $this->command->info("Hoàn thành cập nhật {$count} session.");
        } catch (\Exception $e) {
            $this->command->error("Lỗi cập nhật: " . $e->getMessage());
            Log::error("Error in ClassSessionClassIdSeeder: " . $e->getMessage());
        }
    }
} 