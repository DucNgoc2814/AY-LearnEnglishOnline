<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Course;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a new comment
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'content' => 'required|string|min:1|max:1000',
                'commentable_type' => 'required|string',
                'commentable_id' => 'required|integer',
                'parent_id' => 'nullable|integer|exists:comments,id'
            ]);

            // Check if commentable exists
            $commentableType = $request->commentable_type;
            $commentableId = $request->commentable_id;
            
            if ($commentableType === 'App\Models\Course') {
                $commentable = Course::find($commentableId);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy đối tượng để bình luận'
                ], 404);
            }
            
            if (!$commentable) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy đối tượng để bình luận'
                ], 404);
            }

            // Kiểm tra nếu người dùng đã gửi comment này trong khoảng thời gian ngắn (30 giây)
            $recentComment = Comment::where('user_id', Auth::id())
                ->where('commentable_type', $request->commentable_type)
                ->where('commentable_id', $request->commentable_id)
                ->where('content', $request->content)
                ->where('created_at', '>=', now()->subSeconds(30))
                ->first();
            
            if ($recentComment) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Vui lòng đợi trước khi gửi lại bình luận tương tự'
                    ]);
                }
                return redirect()->back()->with('error', 'Vui lòng đợi trước khi gửi lại bình luận tương tự');
            }

            // Create the comment
            $comment = Comment::create([
                'user_id' => Auth::id(),
                'commentable_type' => $commentableType,
                'commentable_id' => $commentableId,
                'content' => $request->content,
                'parent_id' => $request->parent_id,
                'is_published' => true,
            ]);

            // Load the user relationship
            $comment->load('user');

            if ($request->ajax()) {
                // Trả về response với token CSRF mới
                return response()->json([
                    'success' => true,
                    'message' => 'Bình luận đã được thêm thành công',
                    'comment' => $comment,
                    'csrf_token' => csrf_token()
                ]);
            }

            return redirect()->back()->with('success', 'Bình luận đã được thêm thành công');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error creating comment: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Có lỗi xảy ra: ' . $e->getMessage(),
                    'csrf_token' => csrf_token()
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm bình luận');
        }
    }

    /**
     * Delete a comment
     */
    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn không có quyền xóa bình luận này'
            ], 403);
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bình luận đã được xóa thành công'
        ]);
    }

    /**
     * Reply to a comment
     */
    public function reply(Request $request, Comment $comment)
    {
        try {
            $request->validate([
                'content' => 'required|string|min:1|max:500'
            ]);

            // Check if the user can reply to this comment
            if (!$comment->is_published) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không thể trả lời bình luận này',
                    'csrf_token' => csrf_token()
                ], 403);
            }

            // Kiểm tra nếu người dùng đã gửi trả lời này trong khoảng thời gian ngắn (30 giây)
            $recentReply = Comment::where('user_id', Auth::id())
                ->where('commentable_type', $comment->commentable_type)
                ->where('commentable_id', $comment->commentable_id)
                ->where('content', $request->content)
                ->where('parent_id', $comment->id)
                ->where('created_at', '>=', now()->subSeconds(30))
                ->first();
            
            if ($recentReply) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Vui lòng đợi trước khi gửi lại trả lời tương tự'
                    ]);
                }
                return redirect()->back()->with('error', 'Vui lòng đợi trước khi gửi lại trả lời tương tự');
            }

            // Create the reply
            $reply = Comment::create([
                'user_id' => Auth::id(),
                'commentable_type' => $comment->commentable_type,
                'commentable_id' => $comment->commentable_id,
                'content' => $request->content,
                'parent_id' => $comment->id,
                'is_published' => true,
            ]);

            // Load the user relationship
            $reply->load('user');

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Trả lời đã được thêm thành công',
                    'reply' => $reply,
                    'csrf_token' => csrf_token()
                ]);
            }

            return redirect()->back()->with('success', 'Trả lời đã được thêm thành công');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error creating reply: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Có lỗi xảy ra: ' . $e->getMessage(),
                    'csrf_token' => csrf_token()
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm trả lời');
        }
    }
    
    /**
     * Store a course rating
     */
    public function storeRating(Request $request)
    {
        $request->validate([
            'course_id' => 'required|integer|exists:courses,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|min:10|max:1000',
        ]);
        
        // Kiểm tra xem người dùng đã đánh giá khóa học này chưa
        $existingRating = Rating::where('user_id', Auth::id())
            ->where('course_id', $request->course_id)
            ->first();
            
        if ($existingRating) {
            // Cập nhật đánh giá hiện có
            $existingRating->update([
                'rating' => $request->rating,
                'review' => $request->review,
                'is_published' => true
            ]);
            
            // Cập nhật rating trung bình của khóa học
            $course = Course::find($request->course_id);
            $course->updateRating();
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Đánh giá của bạn đã được cập nhật',
                    'rating' => $existingRating
                ]);
            }
            
            return redirect()->back()->with('success', 'Đánh giá của bạn đã được cập nhật');
        }
        
        // Tạo đánh giá mới
        $rating = Rating::create([
            'user_id' => Auth::id(),
            'course_id' => $request->course_id,
            'rating' => $request->rating,
            'review' => $request->review,
            'is_published' => true,
            'is_verified' => true,
        ]);
        
        // Cập nhật rating trung bình của khóa học
        $course = Course::find($request->course_id);
        $course->updateRating();
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Cảm ơn bạn đã đánh giá khóa học',
                'rating' => $rating->load('user')
            ]);
        }
        
        return redirect()->back()->with('success', 'Cảm ơn bạn đã đánh giá khóa học');
    }
    
    /**
     * Get course ratings
     */
    public function getCourseRatings($courseId)
    {
        $course = Course::findOrFail($courseId);
        $ratings = Rating::where('course_id', $courseId)
            ->where('is_published', true)
            ->with('user')
            ->latest()
            ->paginate(10);
            
        $userRating = null;
        
        if (Auth::check()) {
            $userRating = Rating::where('user_id', Auth::id())
                ->where('course_id', $courseId)
                ->first();
        }
        
        $averageRating = $course->rating;
        $totalRatings = $course->total_ratings;
        
        // Đếm số lượng đánh giá cho mỗi số sao
        $ratingCounts = [];
        for ($i = 5; $i >= 1; $i--) {
            $ratingCounts[$i] = Rating::where('course_id', $courseId)
                ->where('rating', $i)
                ->where('is_published', true)
                ->count();
        }
        
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'ratings' => $ratings,
                'userRating' => $userRating,
                'averageRating' => $averageRating,
                'totalRatings' => $totalRatings,
                'ratingCounts' => $ratingCounts
            ]);
        }
        
        return view('client.courses.ratings', [
            'course' => $course,
            'ratings' => $ratings,
            'userRating' => $userRating,
            'averageRating' => $averageRating,
            'totalRatings' => $totalRatings,
            'ratingCounts' => $ratingCounts
        ]);
    }

    public function getCourseComments($courseId)
    {
        try {
            $comments = Comment::with('user', 'replies.user')
                ->where('commentable_type', 'App\Models\Course')
                ->where('commentable_id', $courseId)
                ->where('parent_id', null)
                ->where('is_published', true)
                ->latest()
                ->paginate(5);

            $html = view('client.detailCourse.partials.comments', compact('comments'))->render();
            
            // Kiểm tra nếu còn trang tiếp theo
            $hasMore = $comments->hasMorePages();
            $nextPage = $comments->currentPage() + 1;

            return response()->json([
                'success' => true,
                'html' => $html,
                'comments' => $comments,
                'hasMore' => $hasMore,
                'nextPage' => $nextPage,
                'csrf_token' => csrf_token()
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error loading comments: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tải bình luận: ' . $e->getMessage(),
                'csrf_token' => csrf_token()
            ], 500);
        }
    }
} 