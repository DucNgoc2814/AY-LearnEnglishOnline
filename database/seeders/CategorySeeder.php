<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Lập trình Web',
                'slug' => 'lap-trinh-web',
                'description' => 'Các khóa học về phát triển web frontend và backend'
            ],
            [
                'name' => 'Lập trình Mobile',
                'slug' => 'lap-trinh-mobile',
                'description' => 'Các khóa học về phát triển ứng dụng di động iOS và Android'
            ],
            [
                'name' => 'Cơ sở dữ liệu',
                'slug' => 'co-so-du-lieu',
                'description' => 'Các khóa học về quản trị và thiết kế cơ sở dữ liệu'
            ],
            [
                'name' => 'DevOps',
                'slug' => 'devops',
                'description' => 'Các khóa học về CI/CD, Docker, Kubernetes'
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}