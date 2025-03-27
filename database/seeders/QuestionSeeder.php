<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        $questions = [
            [
                'test_id' => 1,
                'type' => 'text',
                'question' => 'Artisan command để tạo một migration mới là gì?',
                'media_url' => null,
                'order_number' => 1
            ],
            [
                'test_id' => 1,
                'type' => 'text',
                'question' => 'Trong Laravel, Model được lưu trữ ở thư mục nào?',
                'media_url' => null,
                'order_number' => 2
            ],
            [
                'test_id' => 1,
                'type' => 'image',
                'question' => 'Đâu là cấu trúc thư mục đúng của một project Laravel?',
                'media_url' => 'questions/laravel-structure.png',
                'order_number' => 3
            ],
            [
                'test_id' => 1,
                'type' => 'text',
                'question' => 'Method nào được sử dụng để định nghĩa route POST trong Laravel?',
                'media_url' => null,
                'order_number' => 4
            ],
            [
                'test_id' => 1,
                'type' => 'text',
                'question' => 'Làm thế nào để tạo một controller mới trong Laravel?',
                'media_url' => null,
                'order_number' => 5
            ],
            [
                'test_id' => 1,
                'type' => 'text',
                'question' => 'Câu lệnh để chạy tất cả các migration là gì?',
                'media_url' => null,
                'order_number' => 6
            ],
            [
                'test_id' => 1,
                'type' => 'text',
                'question' => 'File cấu hình database trong Laravel được đặt ở đâu?',
                'media_url' => null,
                'order_number' => 7
            ],
            [
                'test_id' => 1,
                'type' => 'text',
                'question' => 'Để tạo một seeder mới trong Laravel, ta sử dụng lệnh gì?',
                'media_url' => null,
                'order_number' => 8
            ],
            [
                'test_id' => 1,
                'type' => 'text',
                'question' => 'Trong Laravel, method nào được sử dụng để lấy tất cả bản ghi từ database?',
                'media_url' => null,
                'order_number' => 9
            ],
            [
                'test_id' => 1,
                'type' => 'text',
                'question' => 'Để inject một dependency trong constructor của controller, ta sử dụng tính năng gì của Laravel?',
                'media_url' => null,
                'order_number' => 10
            ],
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}