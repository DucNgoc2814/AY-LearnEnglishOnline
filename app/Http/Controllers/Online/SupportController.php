<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    /**
     * Display the support page with form and previous tickets.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the authenticated student
        $student = Auth::guard('online')->user();
        
        // Logic to get previous support tickets for the student
        // This is a placeholder - implement actual tickets retrieval logic
        $tickets = [];
        
        return view('online.support.index', compact('tickets'));
    }

    /**
     * Store a new support ticket.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'attachment' => 'nullable|file|max:5120', // 5MB max
        ]);
        
        // Get the authenticated student
        $student = Auth::guard('online')->user();
        
        // Logic to store the new support ticket
        // This is a placeholder - implement actual ticket creation logic
        
        // Redirect back with success message
        return redirect()->route('online.support.index')
                         ->with('success', 'Yêu cầu hỗ trợ của bạn đã được gửi thành công.');
    }
} 