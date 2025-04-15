<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\TestResult;
use App\Models\TestResultDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TestResultController extends Controller
{
    /**
     * Xử lý nộp bài kiểm tra
     */
    public function submit(Request $request, Test $test)
    {
        try {
            // Log request data for debugging
            Log::info('Test submission request data', [
                'request' => $request->all(),
                'test_id' => $test->id,
                'has_token' => $request->has('_token'),
                'token' => $request->input('_token'),
                'method' => $request->method(),
                'user_id' => Auth::id()
            ]);
            
            DB::beginTransaction();

            // Tính toán số câu hỏi và câu trả lời đúng
            $totalQuestions = $test->questions->count();
            $correctAnswers = 0;
            $totalScore = 0;
            $pointsPerQuestion = $test->max_score / $totalQuestions;

            // Khởi tạo mảng answers nếu không có câu trả lời nào
            $answers = $request->answers ?? [];
            
            // Đảm bảo $answers là một array
            if (!is_array($answers)) {
                $answers = [];
            }

            // Xử lý từng câu trả lời
            foreach ($answers as $questionId => $answerId) {
                $question = $test->questions->find($questionId);
                if (!$question) continue;

                $answer = $question->answers->find($answerId);
                $isCorrect = $answer && $answer->is_correct;

                if ($isCorrect) {
                    $correctAnswers++;
                    $totalScore += $pointsPerQuestion;
                }
            }

            // Parse thời gian bắt đầu từ ISO 8601 sang MySQL datetime
            try {
                $startedAt = Carbon::parse($request->started_at)->format('Y-m-d H:i:s');
            } catch (\Exception $e) {
                $startedAt = now()->subMinutes($test->duration ?? 30)->format('Y-m-d H:i:s');
            }

            // Tạo kết quả bài kiểm tra
            $testResult = TestResult::create([
                'test_id' => $test->id,
                'user_id' => Auth::id(),
                'class_session_id' => $request->class_session_id,
                'score' => round($totalScore),
                'total_questions' => $totalQuestions,
                'correct_answers' => $correctAnswers,
                'attempt_number' => TestResult::where('test_id', $test->id)
                    ->where('user_id', Auth::id())
                    ->count() + 1,
                'started_at' => $startedAt,
                'completed_at' => now(),
                'status' => $request->has('timeout') ? 'timeout' : 'completed',
                'meta_data' => [
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]
            ]);

            // Lưu chi tiết từng câu trả lời
            foreach ($test->questions as $question) {
                $answerId = isset($answers[$question->id]) ? $answers[$question->id] : null;
                $answer = null;
                $isCorrect = false;

                if ($answerId) {
                    $answer = $question->answers->find($answerId);
                    $isCorrect = $answer && $answer->is_correct;
                }

                TestResultDetail::create([
                    'test_result_id' => $testResult->id,
                    'question_id' => $question->id,
                    'answer_id' => $answerId,
                    'is_correct' => $isCorrect,
                    'score' => $isCorrect ? $pointsPerQuestion : 0,
                    'time_spent' => null,
                    'order_number' => $question->order_number ?? 0
                ]);
            }

            DB::commit();

            // Nếu yêu cầu là AJAX, trả về JSON
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Nộp bài thành công',
                    'data' => [
                        'test_result_id' => $testResult->id,
                        'score' => round($totalScore),
                        'correct_answers' => $correctAnswers,
                        'total_questions' => $totalQuestions,
                        'passed' => $totalScore >= $test->min_score
                    ]
                ]);
            }

            // Nếu là form thông thường, chuyển hướng với thông báo
            return redirect()->back()->with([
                'success' => 'Nộp bài thành công',
                'test_result' => [
                    'id' => $testResult->id,
                    'score' => round($totalScore),
                    'correct_answers' => $correctAnswers,
                    'total_questions' => $totalQuestions,
                    'passed' => $totalScore >= $test->min_score
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Log lỗi để theo dõi
            Log::error('Test submission error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            // Nếu yêu cầu là AJAX, trả về JSON
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Có lỗi xảy ra khi nộp bài: ' . $e->getMessage()
                ], 500);
            }
            
            // Nếu là form thông thường, chuyển hướng với thông báo lỗi
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi nộp bài: ' . $e->getMessage());
        }
    }

    /**
     * Cho phép làm lại bài kiểm tra
     */
    public function retry(Test $test)
    {
        try {
            // Lấy tổng số lần đã làm bài của user
            $totalAttempts = TestResult::where('test_id', $test->id)
                ->where('user_id', Auth::id())
                ->count();

            // Lấy kết quả bài làm gần nhất
            $latestResult = TestResult::where('test_id', $test->id)
                ->where('user_id', Auth::id())
                ->latest()
                ->first();

            // Kiểm tra các điều kiện không được làm lại
            if (!$latestResult) {
                return redirect()->back()->with('error', 'Không tìm thấy kết quả bài làm trước đó.');
            }

            if ($latestResult->score >= $test->min_score) {
                return redirect()->back()->with('error', 'Bạn đã đạt điểm tối thiểu, không cần làm lại.');
            }

            if ($test->max_attempt && $totalAttempts >= $test->max_attempt) {
                return redirect()->back()->with('error', 'Bạn đã hết số lần làm lại cho phép.');
            }

            // Cập nhật tổng số lần làm trong bảng tests
            $test->increment('total_attempt');

            // Đánh dấu là đang làm lại bài
            session(['retaking_test_' . $test->id => true]);

            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
} 