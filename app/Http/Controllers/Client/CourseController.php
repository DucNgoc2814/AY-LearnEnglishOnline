<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Models\Course;
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
     * Display the course learning page with outline and video/test
     *
     * @param string $courseSlug
     * @param string|null $lessonSlug
     * @param string|null $videoSlug
     * @param string|null $testSlug
     * @return \Illuminate\View\View
     */
    public function learning($courseSlug, $lessonSlug = null, $videoSlug = null, $testSlug = null)
    {
        try {
            $course = Course::where('slug', $courseSlug)->firstOrFail();
            if (!$lessonSlug) {
                $currentLesson = $course->lessons()->first();
            } else {
                $currentLesson = $course->lessons()->where('slug', $lessonSlug)->firstOrFail();
            }
            $data = [
                'course' => $course,
                'currentLesson' => $currentLesson,
            ];
            $segments = request()->segments();
            $testSlug = in_array('bai-kiem-tra', $segments) ? end($segments) : null;
            if ($testSlug && str_contains(request()->path(), 'bai-kiem-tra')) {
                $currentTest = $currentLesson->lessonTests()
                    ->where('slug', $testSlug)
                    ->first();
                if ($currentTest) {
                    $data['currentTest'] = $currentTest;
                } else {
                    throw new \Exception("Không tìm thấy bài kiểm tra với slug: $testSlug");
                }
            } elseif ($videoSlug) {
                $video = $currentLesson->videoLessons()
                    ->where('slug', $videoSlug)
                    ->first();
                $data['video1'] = $video;
            } else {
                $data['video1'] = $currentLesson->videoLessons()->first();
            }

            return view('client.course.learning', $data);

        } catch (\Exception $e) {
            return redirect()->route('course.learning', ['courseSlug' => $courseSlug])
                ->with('error', 'Không tìm thấy nội dung bài học: ' . $e->getMessage());
        }
    }
}
