<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        Course::create(['categoryId' => 1, 'name' => 'Course 1', 'slug' => 'course-1', 'description' => 'Description for Course 1', 'sortDescription' => 'Short description for Course 1', 'price' => 100.00, 'salePrice' => 90.00, 'thumbnail' => 'path/to/thumbnail1.jpg', 'totalStudent' => 10, 'rating' => 4.5, 'totalRating' => 100, 'releaseTime' => now()]);
        Course::create(['categoryId' => 2, 'name' => 'Course 2', 'slug' => 'course-2', 'description' => 'Description for Course 2', 'sortDescription' => 'Short description for Course 2', 'price' => 150.00, 'salePrice' => 140.00, 'thumbnail' => 'path/to/thumbnail2.jpg', 'totalStudent' => 20, 'rating' => 4.0, 'totalRating' => 200, 'releaseTime' => now()]);
        Course::create(['categoryId' => 3, 'name' => 'Course 3', 'slug' => 'course-3', 'description' => 'Description for Course 3', 'sortDescription' => 'Short description for Course 3', 'price' => 200.00, 'salePrice' => 180.00, 'thumbnail' => 'path/to/thumbnail3.jpg', 'totalStudent' => 30, 'rating' => 4.8, 'totalRating' => 300, 'releaseTime' => now()]);
        Course::create(['categoryId' => 4, 'name' => 'Course 4', 'slug' => 'course-4', 'description' => 'Description for Course 4', 'sortDescription' => 'Short description for Course 4', 'price' => 250.00, 'salePrice' => 230.00, 'thumbnail' => 'path/to/thumbnail4.jpg', 'totalStudent' => 40, 'rating' => 4.2, 'totalRating' => 400, 'releaseTime' => now()]);
        Course::create(['categoryId' => 5, 'name' => 'Course 5', 'slug' => 'course-5', 'description' => 'Description for Course 5', 'sortDescription' => 'Short description for Course 5', 'price' => 300.00, 'salePrice' => 270.00, 'thumbnail' => 'path/to/thumbnail5.jpg', 'totalStudent' => 50, 'rating' => 4.6, 'totalRating' => 500, 'releaseTime' => now()]);
    }
}
