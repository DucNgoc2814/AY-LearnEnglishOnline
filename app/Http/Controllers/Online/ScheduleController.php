<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassSession;
use App\Models\Classes;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display the schedule.
     */
    public function index()
    {
        return view('online.schedule.index');
    }
} 