<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\VideoProgress;
use App\Models\LessonVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoProgressController extends Controller
{
    public function update(Request $request)
    {
        try {
            $request->validate([
                'video_id' => 'required|exists:lesson_videos,id',
                'current_time' => 'required|integer|min:0'
            ]);

            $video = LessonVideo::findOrFail($request->video_id);
            
            // Lấy hoặc tạo mới video progress
            $progress = VideoProgress::firstOrNew([
                'user_id' => Auth::id(),
                'video_id' => $video->id
            ]);

            if (!$progress->exists) {
                $progress->watch_count = 0;
                $progress->watched_seconds = 0;
                $progress->percentage = 0;
                $progress->completed = false;
            }

            // Cập nhật tiến độ
            $progress->updateProgress($request->current_time);

            return response()->json([
                'success' => true,
                'progress' => $progress->percentage,
                'completed' => $progress->completed
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function show(LessonVideo $video)
    {
        $progress = VideoProgress::where('user_id', Auth::id())
            ->where('video_id', $video->id)
            ->first();

        if (!$progress) {
            return response()->json([
                'last_position' => 0,
                'percentage' => 0,
                'completed' => false
            ]);
        }

        return response()->json([
            'last_position' => $progress->last_position,
            'percentage' => $progress->percentage,
            'completed' => $progress->completed
        ]);
    }
} 