<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resource;

class ResourceSeeder extends Seeder
{
    public function run(): void
    {
        
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
            $title = $titles[array_rand($titles)] . ' - Part ' . ceil($i/2);
            Resource::create([
                'title' => $title,
                'description' => "Tài liệu học tập: $title",
                'file_path' => "resources/" . strtolower(str_replace(' ', '-', $title)) . ".pdf",
                'order' => $i,
                'is_active' => true
            ]);
        }
    }
}