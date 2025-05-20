<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoShadowingController extends Controller
{
    public function show()
    {
        $data = [
            'title' => 'Video Shadowing Practice',
            'video' => [
                'title' => 'Basic English Conversation Practice',
                'url' => 'https://www.youtube.com/embed/your-video-id', // Thay thế bằng URL video thực tế
                'description' => 'Luyện phát âm theo phương pháp Shadowing với các đoạn hội thoại cơ bản.',
                'transcript' => [
                    [
                        'time' => '0:00 - 0:15',
                        'text' => 'A: Hi, how are you today?
B: I\'m good, thanks. How about you?
A: I\'m doing well, thank you.',
                        'translation' => 'A: Chào, hôm nay bạn khỏe không?
B: Tôi khỏe, cảm ơn. Còn bạn thì sao?
A: Tôi cũng khỏe, cảm ơn bạn.'
                    ],
                    [
                        'time' => '0:16 - 0:30',
                        'text' => 'A: What do you do for work?
B: I\'m a teacher. How about you?
A: I work as a software engineer.',
                        'translation' => 'A: Bạn làm nghề gì?
B: Tôi là giáo viên. Còn bạn?
A: Tôi làm kỹ sư phần mềm.'
                    ]
                ],
                'tips' => [
                    'Nghe đoạn hội thoại vài lần để làm quen với nội dung',
                    'Tập trung vào ngữ điệu và cách phát âm của người bản xứ',
                    'Bắt đầu lặp lại từng câu theo người nói',
                    'Cố gắng nói đồng thời với video (shadowing)',
                    'Ghi âm giọng nói của bạn để so sánh và cải thiện'
                ]
            ]
        ];

        return view('online.classes.video-shadowing.show', $data);
    }
}
