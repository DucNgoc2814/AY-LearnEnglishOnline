<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rating;

class RatingSeeder extends Seeder
{
    public function run()
    {
        Rating::create([
            'userId' => 1,
            'courseId' => 1,
            'rating' => 5,
            'feedback' => 'Excellent course!',
        ]);
    }
}
