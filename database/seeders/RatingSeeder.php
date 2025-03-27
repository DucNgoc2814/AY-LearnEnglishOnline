<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rating;

class RatingSeeder extends Seeder
{
    public function run()
    {
        $ratings = [
            [
                'user_id' => 3,
                'course_id' => 1,
                'rating' => 5,
                'review' => 'Khóa học rất hay và dễ hiểu. Giảng viên nhiệt tình.',
                'is_verified' => true,
                'is_published' => true
            ],
            [
                'user_id' => 4,
                'course_id' => 1,
                'rating' => 4,
                'review' => 'Nội dung phong phú, tuy nhiên cần thêm bài tập thực hành.',
                'is_verified' => true,
                'is_published' => true
            ],
            // Thêm 8 rating khác...
        ];

        foreach ($ratings as $rating) {
            Rating::create($rating);
        }
    }
}