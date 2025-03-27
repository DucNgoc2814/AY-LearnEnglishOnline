<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run()
    {
        $blogs = [
            [
                'user_id' => 2,
                'title' => 'Tại sao nên học Laravel trong năm 2024?',
                'slug' => 'tai-sao-nen-hoc-laravel-trong-nam-2024',
                'content' => 'Nội dung chi tiết về lợi ích của Laravel...',
                'summary' => 'Laravel là framework PHP phổ biến nhất hiện nay...',
                'featured_image' => 'blogs/laravel-2024.jpg',
                'is_published' => true,
                'published_at' => now(),
                'views' => 150,
                'likes' => 45,
                'allow_comments' => true
            ],
            [
                'user_id' => 2,
                'title' => 'Các tính năng mới trong Laravel 11',
                'slug' => 'cac-tinh-nang-moi-trong-laravel-11',
                'content' => 'Chi tiết về các tính năng mới trong Laravel 11...',
                'summary' => 'Khám phá những tính năng hấp dẫn trong phiên bản mới...',
                'featured_image' => 'blogs/laravel-11.jpg',
                'is_published' => true,
                'published_at' => now(),
                'views' => 120,
                'likes' => 30,
                'allow_comments' => true
            ],
            // Thêm các blog khác...
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}