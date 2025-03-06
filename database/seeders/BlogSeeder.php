<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run()
    {
        Blog::create(['name' => 'Latest Updates', 'description' => 'Description of the latest updates.', 'image' => null, 'language' => 'en']);
        Blog::create(['name' => 'Learning Tips', 'description' => 'Tips for effective learning.', 'image' => null, 'language' => 'en']);
        Blog::create(['name' => 'Course Highlights', 'description' => 'Highlights of our courses.', 'image' => null, 'language' => 'en']);
        Blog::create(['name' => 'Student Success Stories', 'description' => 'Stories from our successful students.', 'image' => null, 'language' => 'en']);
        Blog::create(['name' => 'Upcoming Events', 'description' => 'Information about upcoming events.', 'image' => null, 'language' => 'en']);
    }
}
