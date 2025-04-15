<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AwardController extends Controller
{
    /**
     * Display a listing of the student's awards and discipline records.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the authenticated student
        $student = Auth::guard('online')->user();
        
        // Logic to get all awards and discipline records for the student
        // This is a placeholder - implement actual records retrieval logic
        $awards = [];
        $disciplines = [];
        
        return view('online.awards.index', compact('awards', 'disciplines'));
    }

    /**
     * Display the specified award or discipline record.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Get the authenticated student
        $student = Auth::guard('online')->user();
        
        // Logic to get specific award/discipline record
        // This is a placeholder - implement actual record retrieval logic
        $record = null; // Replace with actual record retrieval
        
        return view('online.awards.show', compact('record'));
    }
} 