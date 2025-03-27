<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SessionInteraction;

class SessionInteractionSeeder extends Seeder
{
    public function run()
    {
        $interactions = [
            [
                'session_id' => 1,
                'student_id' => 3,
                'type' => 'question',
                'content' => 'Làm thế nào để tạo một migration trong Laravel?',
                'is_private' => false,
                'is_highlighted' => true,
                'is_answered' => true,
                'interaction_time' => now()
            ],
            [
                'session_id' => 1,
                'student_id' => null,
                'type' => 'answer',
                'content' => 'Bạn có thể sử dụng lệnh: php artisan make:migration create_table_name',
                'is_private' => false,
                'is_highlighted' => true,
                'is_answered' => true,
                'interaction_time' => now()
            ],
            // Thêm 8 interaction khác...
        ];

        foreach ($interactions as $interaction) {
            SessionInteraction::create($interaction);
        }
    }
}