<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OnlineRoom;

class OnlineRoomSeeder extends Seeder
{
    public function run()
    {
        $rooms = [
            [
                'roomable_type' => 'App\Models\Course',
                'roomable_id' => 1,
                'name' => 'Laravel Basic - Room 1',
                'room_type' => 'class_session',
                'meeting_id' => '123456789',
                'platform' => 'zoom',
                'host_id' => '2',
                'host_email' => 'teacher@example.com',
                'join_url' => 'https://zoom.us/j/123456789',
                'host_url' => 'https://zoom.us/s/123456789',
                'password' => 'laravel123',
                'scheduled_start' => '2024-01-15 18:30:00',
                'scheduled_end' => '2024-01-15 21:30:00',
                'duration_minutes' => 180,
                'is_recurring' => true,
                'recurrence_pattern' => json_encode([
                    'type' => 'weekly',
                    'days' => [2, 4],
                    'until' => '2024-03-15'
                ]),
                'meeting_settings' => json_encode([
                    'waiting_room' => true,
                    'mute_on_entry' => true,
                    'auto_recording' => 'cloud'
                ]),
                'status' => 'scheduled',
                'description' => 'Phòng học trực tuyến khóa Laravel cơ bản',
                'is_active' => true
            ],
            // Thêm 9 room khác...
        ];

        foreach ($rooms as $room) {
            OnlineRoom::create($room);
        }
    }
}