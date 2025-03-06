<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    public function run()
    {
        Comment::create(['userId' => 1, 'lessonId' => 1, 'content' => 'Great lesson!']);
        Comment::create(['userId' => 2, 'lessonId' => 1, 'content' => 'Very informative!']);
        Comment::create(['userId' => 3, 'lessonId' => 2, 'content' => 'I learned a lot!']);
        Comment::create(['userId' => 4, 'lessonId' => 2, 'content' => 'Excellent explanation!']);
        Comment::create(['userId' => 5, 'lessonId' => 3, 'content' => 'Looking forward to the next lesson!']);
    }
}
