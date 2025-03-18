<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Programming', 'slug' => 'programming']);
        Category::create(['name' => 'Design', 'slug' => 'design']);
        Category::create(['name' => 'Marketing', 'slug' => 'marketing']);
        Category::create(['name' => 'Business', 'slug' => 'business']);
        Category::create(['name' => 'Music', 'slug' => 'music']);
    }
}
