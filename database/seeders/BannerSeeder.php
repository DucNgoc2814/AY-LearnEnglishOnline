<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run()
    {
        Banner::create(['image' => 'path/to/banner1.jpg', 'content' => 'Welcome to our platform!', 'isActive' => true]);
        Banner::create(['image' => 'path/to/banner2.jpg', 'content' => 'Join our courses today!', 'isActive' => true]);
        Banner::create(['image' => 'path/to/banner3.jpg', 'content' => 'Learn from the best!', 'isActive' => true]);
        Banner::create(['image' => 'path/to/banner4.jpg', 'content' => 'Get certified!', 'isActive' => true]);
        Banner::create(['image' => 'path/to/banner5.jpg', 'content' => 'Start your journey now!', 'isActive' => true]);
    }
}
