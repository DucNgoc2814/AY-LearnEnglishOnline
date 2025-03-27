<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;

class BannerSeeder extends Seeder
{
    public function run()
    {
        $banners = [
            [
                'title' => 'Khóa học mới: Laravel Advanced',
                'image_url' => 'banners/laravel-advanced.jpg',
                'link_url' => '/courses/laravel-advanced',
                'start_date' => '2024-01-01 00:00:00',
                'end_date' => '2024-02-01 00:00:00',
                'position' => 'home_top',
                'is_active' => true,
                'order' => 1
            ],
            [
                'title' => 'Tết 2024 - Sale lớn',
                'image_url' => 'banners/tet-2024.jpg',
                'link_url' => '/promotions/tet-2024',
                'start_date' => '2024-01-15 00:00:00',
                'end_date' => '2024-02-15 00:00:00',
                'position' => 'home_slider',
                'is_active' => true,
                'order' => 2
            ],
            // Thêm 8 banner khác...
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}