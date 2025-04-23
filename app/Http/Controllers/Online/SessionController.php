<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassSession;
use App\Models\OnlineRoom;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Display a listing of the sessions.
     */
    public function index()
    {
        $upcomingSessions = ClassSession::with(['class', 'class.teacher', 'class.course'])
            ->where('class_sessions.start_time', '>', now())
            ->orderBy('class_sessions.start_time', 'asc')
            ->paginate(10);

        $pastSessions = ClassSession::with(['class', 'class.teacher', 'class.course'])
            ->where('class_sessions.start_time', '<', now())
            ->orderBy('class_sessions.start_time', 'desc')
            ->paginate(10);

        return view('online.sessions.index', compact('upcomingSessions', 'pastSessions'));
    }

    /**
     * Display the specified session.
     */
    public function show(ClassSession $session)
    {
        $session->load(['class', 'class.teacher', 'class.course', 'onlineRoom']);

        return view('online.sessions.show', compact('session'));
    }

    /**
     * Join an online session.
     */
    public function join(ClassSession $session)
    {
        $session->load(['class', 'onlineRoom']);

        // Check if session has an online room
        if (!$session->onlineRoom) {
            // Create a new online room if one doesn't exist
            $onlineRoom = OnlineRoom::create([
                'session_id' => $session->id,
                'room_id' => 'room_' . uniqid(),
                'host_id' => $session->class->teacher_id,
                'status' => 'active',
                'created_by' => Auth::id(),
            ]);

            $session->onlineRoom()->save($onlineRoom);
            $session->refresh();
        }

        return view('online.sessions.join', compact('session'));
    }
}
