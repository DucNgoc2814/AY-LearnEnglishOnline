<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run()
    {
        Blog::create([
            'name' => 'Latest Updates',
            'description' => 'Description of the latest updates.',
            'image' => null,
            'language' => 'en',
        ]);
    }
}
