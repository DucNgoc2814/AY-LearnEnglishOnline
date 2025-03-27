<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LearningLog;

class LearningLogSeeder extends Seeder
{
    public function run()
    {
        $logs = [
            [
                'user_id' => 3,
                'loggable_type' => 'App\Models\Lesson',
                'loggable_id' => 1,
                'action' => 'viewed',
                'ip_address' => '192.168.1.1',
                'device' => 'desktop',
                'browser' => 'Chrome',
                'duration_seconds' => 1800,
                'action_time' => '2024-01-15 19:00:00',
                'meta_data' => json_encode([
                    'os' => 'Windows',
                    'progress' => 75
                ])
            ],
            // Thêm 9 log khác...
        ];

        foreach ($logs as $log) {
            LearningLog::create($log);
        }
    }
}