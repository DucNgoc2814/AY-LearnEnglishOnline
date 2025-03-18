<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rating;

class RatingSeeder extends Seeder
{
    public function run()
    {
        Rating::create(['userId' => 1, 'courseId' => 1, 'rating' => 5, 'feedback' => 'Excellent course!']);
        Rating::create(['userId' => 2, 'courseId' => 1, 'rating' => 4, 'feedback' => 'Very good!']);
        Rating::create(['userId' => 3, 'courseId' => 2, 'rating' => 3, 'feedback' => 'Average course.']);
        Rating::create(['userId' => 4, 'courseId' => 2, 'rating' => 2, 'feedback' => 'Not what I expected.']);
        Rating::create(['userId' => 5, 'courseId' => 3, 'rating' => 5, 'feedback' => 'Loved it!']);
    }
}
