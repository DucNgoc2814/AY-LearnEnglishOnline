<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Models\Course;

/**
 * @package App\Http\Controllers\Client
 * @author Assistant
 * @description Handles course functionality for client users
 */
class CourseController extends BaseController
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

    public function detailCourse($slug)
    {
        $course = Course::where('slug', $slug)->first();
        $relatedCourses = Course::where('categoryId', $course->categoryId)
            ->where('id', '!=', $course->id)
            ->get();
        return view('client.detailCourse.index', compact('course', 'relatedCourses'));
    }
}
