<?php

namespace App\Http\Controllers\Online;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\ClassSession;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    /**
     * Display a listing of the classes.
     */
    public function index()
    {
        return view('online.classes.index');
    }

    /**
     * Display the specified class.
     */
    public function show($classId)
    {
        return view('online.classes.show', compact('classId'));
    }
} 