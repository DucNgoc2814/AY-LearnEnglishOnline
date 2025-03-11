<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Models\Course;
use Illuminate\Http\Request;

/**
 * @package App\Http\Controllers\Client
 * @author Assistant
 * @description Handles homepage functionality for client users
 */
class HomeController extends BaseController
{
    /**
     * Display the homepage
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $topCourses = Course::where('deleted_at', null)->get();
        return view('client.index', compact('topCourses'));
    }
}
