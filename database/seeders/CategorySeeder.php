<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Programming']);
        Category::create(['name' => 'Design']);
        Category::create(['name' => 'Marketing']);
        Category::create(['name' => 'Business']);
        Category::create(['name' => 'Music']);
    }
}
