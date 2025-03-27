<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassSession;

class ClassSessionSeeder extends Seeder
{
    public function run()
    {
        $sessions = [
            [
                'class_id' => 1,
                'schedule_id' => 1,
                'session_date' => '2024-01-15',
                'start_time' => '18:30:00',
                'end_time' => '21:30:00',
                'room_number' => 'A101',
                'session_type' => 'online',
                'recording_url' => 'https://zoom.us/j/123456789',
                'topic' => 'Course overview and environment setup',
                'status' => 'completed'
            ],
            [
                'class_id' => 1,
                'schedule_id' => 1,
                'session_date' => '2024-01-17',
                'start_time' => '18:30:00',
                'end_time' => '21:30:00',
                'room_number' => 'A101',
                'session_type' => 'online',
                'recording_url' => 'https://zoom.us/j/123456789',
                'topic' => 'Understanding MVC pattern in Laravel',
                'status' => 'completed'
            ],
            // Thêm 8 session khác...
        ];

        foreach ($sessions as $session) {
            ClassSession::create($session);
        }
    }
}