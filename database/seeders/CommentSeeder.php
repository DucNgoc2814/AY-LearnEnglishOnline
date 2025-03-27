<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $comments = [
            [
                'user_id' => 3,
                'commentable_type' => 'App\Models\Lesson',
                'commentable_id' => 1,
                'content' => 'Bài học rất hữu ích, cảm ơn giảng viên!',
                'parent_id' => null,
                'is_published' => true,
                'likes' => 5
            ],
            [
                'user_id' => 2, // teacher
                'commentable_type' => 'App\Models\Lesson',
                'commentable_id' => 1,
                'content' => 'Cảm ơn bạn đã theo dõi bài giảng!',
                'parent_id' => 1, // reply to first comment
                'is_published' => true,
                'likes' => 3
            ],
            // Thêm 8 comment khác...
        ];

        foreach ($comments as $comment) {
            Comment::create($comment);
        }
    }
}