<?php

namespace App\Http\Controllers;

use App\Models\ClassSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassSessionController extends Controller
{
    /**
     * Get the meeting URL for a class session.
     * This keeps the URL secure by not exposing it in the HTML.
     *
     * @param int $sessionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMeetingUrl($sessionId)
    {
        $session = ClassSession::findOrFail($sessionId);
        
        // Check if the session has a schedule with a meeting URL
        if ($session->schedule && $session->schedule->meeting_url) {
            return response()->json([
                'success' => true,
                'meeting_url' => $session->schedule->meeting_url
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Không tìm thấy đường dẫn phòng học.'
        ], 404);
    }
}
