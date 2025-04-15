<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\LessonVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * @package App\Http\Controllers\Client
 * @author Assistant
 * @description Handles course functionality for client users
 */
class CourseController extends BaseController
{
    protected function getAuthenticatedUser()
    {
        try {
            $token = session('jwt_token');
            if (!$token) {
                return null;
            }
            
            return JWTAuth::setToken($token)->authenticate();
        } catch (\Exception $e) {
            return null;
        }
    }

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
        $course = Course::with([
            'lessons',
            'lessons.lessonTests' => function($query) {
                $query->where('type', 'lesson_test')
                      ->whereNull('deleted_at');
            }
        ])->where('slug', $slug)->first();
        
        $relatedCourses = Course::where('category_id', $course->category_id)
            ->where('id', '!=', $course->id)
            ->get();

        $isEnrolled = false;
        $user = $this->getAuthenticatedUser();
        
        if ($user) {
            // Kiểm tra nếu user là admin hoặc đã đăng ký khóa học
            $isEnrolled = $user->role === 'admin' || $course->isEnrolledByUser($user->id);
        }

        $courseStats = [
            'total_lessons' => $course->totalLessons(),
            'total_videos' => $course->totalVideos(),
            'total_tests' => $course->totalTests(),
            'total_duration' => $course->totalDuration(),
        ];

        return view('client.detailCourse.index', compact(
            'course', 
            'relatedCourses', 
            'isEnrolled',
            'courseStats'
        ));
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
                
                // Add debug info
                \Illuminate\Support\Facades\Log::info('Video info:', [
                    'id' => $video->id,
                    'name' => $video->name,
                    'video_url' => $video->video_url
                ]);
            } else {
                $video = $currentLesson->videoLessons()->first();
                if (!$video) {
                    throw new \Exception("Bài học chưa có video nào");
                }
                $data['video1'] = $video;
                
                // Add debug info
                \Illuminate\Support\Facades\Log::info('Default video info:', [
                    'id' => $video->id,
                    'name' => $video->name,
                    'video_url' => $video->video_url
                ]);
            }

            return view('client.course.learning', $data);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Learning error: ' . $e->getMessage());
            return redirect()->route('course.learning', ['courseSlug' => $courseSlug])
                ->with('error', 'Không tìm thấy nội dung bài học: ' . $e->getMessage());
        }
    }

    /**
     * Stream video through Laravel to avoid CORS/CSP issues
     *
     * @param int $videoId
     * @return \Illuminate\Http\Response
     */
    public function videoProxy($videoId)
    {
        try {
            \Illuminate\Support\Facades\Log::info('Video proxy called with ID: ' . $videoId);
            
            $video = LessonVideo::findOrFail($videoId);
            \Illuminate\Support\Facades\Log::info('Video found:', [
                'id' => $video->id,
                'name' => $video->name,
                'video_url' => $video->video_url
            ]);
            
            // Get the video path
            $videoUrl = $video->video_url;
            
            // If it's a relative path, convert to full CloudFront URL
            if (!str_starts_with($videoUrl, 'http')) {
                $videoUrl = config('app.cloudfront_url') . '/' . $videoUrl;
                \Illuminate\Support\Facades\Log::info('Using constructed URL: ' . $videoUrl);
            } else {
                \Illuminate\Support\Facades\Log::info('Using original URL: ' . $videoUrl);
            }
            
            // Use a redirect instead for debugging
            return redirect()->away($videoUrl);
            
            // This is the original file_get_contents code, uncomment later
            // $videoContent = file_get_contents($videoUrl);
            // 
            // if ($videoContent === false) {
            //     throw new \Exception("Could not read video content from: " . $videoUrl);
            // }
            // 
            // // Return the video content with proper headers
            // return response($videoContent)
            //     ->header('Content-Type', 'video/mp4')
            //     ->header('Accept-Ranges', 'bytes')
            //     ->header('Content-Disposition', 'inline; filename="' . basename($videoUrl) . '"');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Video proxy error: ' . $e->getMessage());
            return response()->json(['error' => 'Video not found: ' . $e->getMessage()], 404);
        }
    }

    /**
     * Stream video directly with appropriate headers 
     * @param int $videoId
     * @return \Illuminate\Http\Response
     */
    public function streamVideo($videoId)
    {
        try {
            $video = LessonVideo::findOrFail($videoId);
            $videoUrl = $video->video_url;
            
            // If it doesn't start with http, it's a relative path
            if (!str_starts_with($videoUrl, 'http')) {
                // Add path prefix if needed
                if (!str_contains($videoUrl, 'video-lessons/videos') && !str_contains($videoUrl, '/')) {
                    $videoUrl = 'video-lessons/videos/' . $videoUrl;
                }
                $videoUrl = 'https://dxud4suchjyje.cloudfront.net/' . $videoUrl;
            }
            
            // Create a simple HTML page with the video embedded with no CSP restrictions
            $html = <<<HTML
<!DOCTYPE html>
<html>
<head>
    <title>Video Player</title>
    <style>
        body, html { margin: 0; padding: 0; width: 100%; height: 100%; overflow: hidden; }
        video { width: 100%; height: 100%; object-fit: contain; }
    </style>
</head>
<body>
    <video controls autoplay controlsList="nodownload">
        <source src="{$videoUrl}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</body>
</html>
HTML;
            
            return response($html)
                ->header('Content-Type', 'text/html')
                ->header('X-Frame-Options', 'ALLOWALL')
                ->header('Content-Security-Policy', "default-src 'self'; style-src 'unsafe-inline'; media-src * https://dxud4suchjyje.cloudfront.net");
        } catch (\Exception $e) {
            return response()->json(['error' => 'Video not found: ' . $e->getMessage()], 404);
        }
    }
    
    /**
     * Redirect to direct video URL
     * 
     * @param int $videoId
     * @return \Illuminate\Http\Response
     */
    public function directVideo($videoId)
    {
        try {
            $video = LessonVideo::findOrFail($videoId);
            $videoUrl = $video->video_url;
            
            // If it doesn't start with http, it's a relative path
            if (!str_starts_with($videoUrl, 'http')) {
                // Add path prefix if needed
                if (!str_contains($videoUrl, 'video-lessons/videos') && !str_contains($videoUrl, '/')) {
                    $videoUrl = 'video-lessons/videos/' . $videoUrl;
                }
                $videoUrl = 'https://dxud4suchjyje.cloudfront.net/' . $videoUrl;
            }
            
            // Simply redirect to the actual video file
            return redirect()->away($videoUrl);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Video not found: ' . $e->getMessage()], 404);
        }
    }
}
