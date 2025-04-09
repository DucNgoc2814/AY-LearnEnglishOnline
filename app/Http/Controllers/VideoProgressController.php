<?php

namespace App\Http\Controllers;

use App\Models\VideoProgress;
use App\Models\LessonVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VideoProgressController extends Controller
{
    /**
     * Save or update video progress
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveProgress(Request $request)
    {
        $request->validate([
            'video_id' => 'required|exists:lesson_videos,id',
            'watched_seconds' => 'required|integer|min:0',
            'percentage' => 'required|integer|min:0|max:100',
            'last_position' => 'required|integer|min:0',
            'completed' => 'boolean',
        ]);

        $user = Auth::user();
        
        // Get video duration to calculate completion
        $video = LessonVideo::findOrFail($request->video_id);
        $videoDuration = $video->duration ?? 0;
        
        // Calculate if video is completed based on percentage
        $completed = $request->percentage >= 90 || $request->completed;
        
        // Update or create progress
        $progress = VideoProgress::updateOrCreate(
            [
                'user_id' => $user->id,
                'video_id' => $request->video_id,
            ],
            [
                'watched_seconds' => $request->watched_seconds,
                'percentage' => $request->percentage,
                'last_position' => $request->last_position,
                'completed' => $completed,
                'last_watched_at' => now(),
                'watch_count' => DB::raw('watch_count + 1'),
                'meta_data' => [
                    'video_duration' => $videoDuration,
                    'last_session' => now()->toIso8601String(),
                ],
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Progress saved successfully',
            'data' => $progress,
        ]);
    }

    /**
     * Get video progress for the current user
     *
     * @param int $videoId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProgress($videoId)
    {
        $user = Auth::user();
        
        $progress = VideoProgress::where('user_id', $user->id)
            ->where('video_id', $videoId)
            ->first();
            
        if (!$progress) {
            return response()->json([
                'success' => true,
                'data' => [
                    'watched_seconds' => 0,
                    'percentage' => 0,
                    'last_position' => 0,
                    'completed' => false,
                ]
            ]);
        }
        
        return response()->json([
            'success' => true,
            'data' => $progress,
        ]);
    }
} 