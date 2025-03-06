<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run()
    {
        Banner::create([
            'image' => 'path/to/banner.jpg',
            'content' => 'Welcome to our platform!',
            'isActive' => true,
        ]);
    }
}
