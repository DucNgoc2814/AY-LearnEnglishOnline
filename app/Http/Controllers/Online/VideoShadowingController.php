<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\VideoShadowing;
use Illuminate\Http\Request;

class VideoShadowingController extends Controller
{
    public function show($id)
    {
        // Lấy lesson
        $lesson = Lesson::findOrFail($id);

        // Lấy video shadowing của lesson
        $videoShadowing = $lesson->videoShadowing;

        if (!$videoShadowing) {
            abort(404, 'Video shadowing không tồn tại cho bài học này');
        }

        $data = [
            'title' => $videoShadowing->title,
            'video' => [
                'title' => $videoShadowing->title,
                'url' => $videoShadowing->getMediaUrl('video_url'),
                'description' => $videoShadowing->description,
                'transcript' => $videoShadowing->segments->map(function($segment) {
                    return [
                        'time' => $segment->time_range,
                        'text' => $segment->text,
                        'translation' => $segment->translation
                    ];
                }),
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
