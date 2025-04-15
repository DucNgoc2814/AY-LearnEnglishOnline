<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resource;

class ResourceSeeder extends Seeder
{
    public function run(): void
    {
        $resourceTypes = ['document', 'video', 'audio', 'presentation', 'exercise'];
        $fileTypes = [
            'document' => ['pdf', 'doc', 'docx'],
            'video' => ['mp4', 'webm'],
            'audio' => ['mp3', 'wav'],
            'presentation' => ['ppt', 'pptx'],
            'exercise' => ['pdf', 'doc', 'docx']
        ];
        
        $titles = [
            'English Grammar Basics',
            'Pronunciation Guide',
            'Business English Essentials',
            'IELTS Writing Tips',
            'TOEIC Practice Tests',
            'Common English Phrases',
            'Academic Writing Guide',
            'Vocabulary Builder',
            'Speaking Practice Materials',
            'Listening Comprehension'
        ];
        
        for ($i = 1; $i <= 20; $i++) {
            $type = $resourceTypes[array_rand($resourceTypes)];
            $fileType = $fileTypes[$type][array_rand($fileTypes[$type])];
            $title = $titles[array_rand($titles)] . ' - Part ' . ceil($i/2);
            
            Resource::create([
                'title' => $title,
                'description' => "Tài liệu học tập: $title",
                'type' => $type,
                'url' => "resources/" . strtolower(str_replace(' ', '-', $title)) . ".$fileType",
                'file_type' => $fileType,
                'file_size' => rand(500, 100000), // 500KB to 100MB
                'download_count' => rand(0, 1000),
                'is_public' => rand(0, 1) === 1,
                'order' => $i,
                'is_active' => true
            ]);
        }
    }
}