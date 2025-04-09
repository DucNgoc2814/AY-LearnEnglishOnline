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
        try {
            $course = Course::where('slug', $slug)->first();

            if (!$course) {
                return redirect()->route('home')
                    ->with('notification', [
                        'message' => 'Không tìm thấy khóa học.',
                        'type' => 'error'
                    ]);
            }

            $relatedCourses = Course::where('category_id', $course->categoryId)
                ->where('id', '!=', $course->id)
                ->get();

            $isEnrolled = false;
            if (Auth::check()) {
                $isEnrolled = $course->isEnrolledByUser(Auth::id());
            }

            return view('client.detailCourse.index', compact('course', 'relatedCourses', 'isEnrolled'));
        } catch (\Exception $e) {
            return redirect()->route('home')
                ->with('notification', [
                    'message' => 'Đã xảy ra lỗi khi tải thông tin khóa học.',
                    'type' => 'error'
                ]);
        }
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
            // Lấy khóa học
            $course = Course::where('slug', $courseSlug)->firstOrFail();

            // Lấy bài học hiện tại
            if (!$lessonSlug) {
                $currentLesson = $course->lessons()->orderBy('order_number')->first();
                if (!$currentLesson) {
                    throw new \Exception("Khóa học chưa có bài học nào");
                }
            } else {
                $currentLesson = $course->lessons()->where('slug', $lessonSlug)->firstOrFail();
            }

            $data = [
                'course' => $course,
                'currentLesson' => $currentLesson,
            ];

            // Xử lý bài kiểm tra
            $segments = request()->segments();
            $testSlug = in_array('bai-kiem-tra', $segments) ? end($segments) : null;

            if ($testSlug && str_contains(request()->path(), 'bai-kiem-tra')) {
                $currentTest = $currentLesson->lessonTests()
                    ->where('slug', $testSlug)
                    ->firstOrFail();
                $data['currentTest'] = $currentTest;
            }
            // Xử lý video
            else if ($videoSlug) {
                $video = $currentLesson->videoLessons()
                    ->where('slug', $videoSlug)
                    ->firstOrFail();
                $data['video1'] = $video;
            } else {
                $video = $currentLesson->videoLessons()->first();
                if (!$video) {
                    throw new \Exception("Bài học chưa có video nào");
                }
                $data['video1'] = $video;
            }

            return view('client.course.learning', $data);
        } catch (\Exception $e) {
            return redirect()->route('course.learning', ['courseSlug' => $courseSlug])
                ->with('error', 'Không tìm thấy nội dung bài học: ' . $e->getMessage());
        }
    }
}
