<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Answer;

class AnswerSeeder extends Seeder
{
    public function run()
    {
        $answers = [
            // Câu trả lời cho câu hỏi 1
            [
                'question_id' => 1,
                'answer' => 'php artisan make:migration',
                'is_correct' => true,
                'explanation' => 'Đây là câu lệnh Artisan chính xác để tạo migration mới',
                'order_number' => 1
            ],
            [
                'question_id' => 1,
                'answer' => 'php artisan migration:make',
                'is_correct' => false,
                'explanation' => 'Cú pháp này không đúng trong Laravel',
                'order_number' => 2
            ],
            [
                'question_id' => 1,
                'answer' => 'php artisan create:migration',
                'is_correct' => false,
                'explanation' => 'Cú pháp này không tồn tại trong Laravel',
                'order_number' => 3
            ],
            [
                'question_id' => 1,
                'answer' => 'php artisan new:migration',
                'is_correct' => false,
                'explanation' => 'Đây không phải là cú pháp đúng',
                'order_number' => 4
            ],

            // Câu trả lời cho câu hỏi 2
            [
                'question_id' => 2,
                'answer' => 'app/Models',
                'is_correct' => true,
                'explanation' => 'Từ Laravel 8, Models được lưu trữ trong thư mục app/Models',
                'order_number' => 1
            ],
            [
                'question_id' => 2,
                'answer' => 'app/Controllers',
                'is_correct' => false,
                'explanation' => 'Controllers được lưu trong app/Http/Controllers',
                'order_number' => 2
            ],
            // Thêm các câu trả lời cho các câu hỏi còn lại...
        ];

        foreach ($answers as $answer) {
            Answer::create($answer);
        }
    }
}