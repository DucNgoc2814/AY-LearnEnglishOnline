<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    public function run()
    {
        Comment::create([
            'userId' => 1,
            'courseId' => 1,
            'lessonId' => 1,
            'content' => 'Great lesson!',
            'timestamp' => null,
            'status' => 'approved',
        ]);
    }
}
