<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dictation;
use App\Models\VideoDubbingProgress;
use Illuminate\Support\Facades\Auth;

class ExerciseProgressController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'type' => 'required|in:video,dictation',
            'exercise_id' => 'required|integer',
            'completed' => 'required|boolean'
        ]);

        try {
            if ($request->type === 'video') {
                // Cập nhật tiến độ video dubbing
                $progress = VideoDubbingProgress::updateOrCreate(
                    [
                        'user_id' => Auth::id(),
                        'video_id' => $request->exercise_id
                    ],
                    [
                        'completed' => $request->completed,
                        'completed_at' => $request->completed ? now() : null
                    ]
                );
            } else {
                // Cập nhật tiến độ dictation
                $dictation = Dictation::findOrFail($request->exercise_id);
                $dictation->update([
                    'completed' => $request->completed,
                    'completed_at' => $request->completed ? now() : null
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Tiến độ đã được cập nhật'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật tiến độ'
            ], 500);
        }
    }
}
