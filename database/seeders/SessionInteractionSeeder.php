<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SessionInteraction;
use App\Models\ClassSession;
use App\Models\Student;

class SessionInteractionSeeder extends Seeder
{
    public function run()
    {
        // Get existing sessions and students
        $sessions = ClassSession::all();
        $students = Student::all();
        
        if ($sessions->isEmpty() || $students->isEmpty()) {
            return; // Skip if no sessions or students exist
        }
        
        foreach ($sessions as $session) {
            // Create a question from a random student
            if ($students->isNotEmpty()) {
                $student = $students->random();
                SessionInteraction::create([
                    'session_id' => $session->id,
                    'student_id' => $student->id,
                    'type' => 'question',
                    'content' => 'Làm thế nào để tạo một migration trong Laravel?',
                    'is_private' => false,
                    'is_highlighted' => true,
                    'is_answered' => true,
                    'interaction_time' => $session->session_date
                ]);
                
                // Create an answer from teacher (student_id = null)
                SessionInteraction::create([
                    'session_id' => $session->id,
                    'student_id' => null,
                    'type' => 'answer',
                    'content' => 'Bạn có thể sử dụng lệnh: php artisan make:migration create_table_name',
                    'is_private' => false,
                    'is_highlighted' => true,
                    'is_answered' => true,
                    'interaction_time' => $session->session_date
                ]);
            }
        }
    }
}