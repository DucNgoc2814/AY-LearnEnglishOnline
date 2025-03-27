<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resource;

class ResourceSeeder extends Seeder
{
    public function run()
    {
        $resources = [
            [
                'title' => 'Laravel Installation Guide',
                'description' => 'Hướng dẫn cài đặt Laravel chi tiết',
                'type' => 'document',
                'url' => 'resources/laravel-installation.pdf',
                'file_type' => 'pdf',
                'file_size' => 1024,
                'download_count' => 150,
                'is_public' => true,
                'order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Git Basics Tutorial',
                'description' => 'Video hướng dẫn Git cơ bản',
                'type' => 'video',
                'url' => 'resources/git-basics.mp4',
                'file_type' => 'mp4',
                'file_size' => 52428800,
                'download_count' => 200,
                'is_public' => true,
                'order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'Database Design Templates',
                'description' => 'Mẫu thiết kế cơ sở dữ liệu',
                'type' => 'template',
                'url' => 'resources/db-templates.zip',
                'file_type' => 'zip',
                'file_size' => 5242880,
                'download_count' => 75,
                'is_public' => true,
                'order' => 3,
                'is_active' => true
            ],
            // Thêm 7 resource khác...
        ];

        foreach ($resources as $resource) {
            Resource::create($resource);
        }
    }
}