<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\VideoLesson;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Display the course detail page
     * 
     * @param string $slug Course slug
     * @return \Illuminate\View\View
     */
    public function detailCourse($slug)
    {
        $course = Course::where('slug', $slug)->first();
        $relatedCourses = Course::where('categoryId', $course->categoryId)
            ->where('id', '!=', $course->id)
            ->get();
            
        $isEnrolled = false;
        if (Auth::check()) {
            $isEnrolled = $course->isEnrolledByUser(Auth::id());
        }
        
        return view('client.detailCourse.index', compact('course', 'relatedCourses', 'isEnrolled'));
    }

    /**
     * Display the course learning page with outline and video
     *
     * @param string $courseSlug
     * @return \Illuminate\View\View
     */
    public function learning($courseSlug)
    {
        // Find the course by slug
        $course = Course::where('slug', $courseSlug)
            ->whereNull('deleted_at')
            ->firstOrFail();
            
        return view('client.course.learning', compact('course'));
    }
}
