<?php

namespace App\Services;

use App\Services\Interfaces\TestServiceInterface;
use App\Repositories\Interfaces\TestRepositoryInterface;
use Illuminate\Support\Facades\Log;

class TestService extends BaseService implements TestServiceInterface
{
    public function __construct(TestRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function searchByName($keyword)
    {
        try {
            $tests = $this->repository->searchByName($keyword);
            return $this->successResponse($tests, 'Tìm kiếm thành công');
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi tìm kiếm');
        }
    }

    /**
     * Lấy danh sách câu hỏi của bài test
     *
     * @param int $testId
     * @return array
     */
    public function getQuestionsByTest($testId)
    {
        try {
            $questions = $this->repository->getQuestionsByTestId($testId);

            // Thêm số lượng đáp án cho mỗi câu hỏi
            foreach ($questions as $question) {
                $question->answers_count = $question->answers->count();
            }

            return [
                'success' => true,
                'questions' => $questions
            ];
        } catch (\Exception $e) {
            Log::error('Error in TestService getQuestionsByTest: ' . $e->getMessage(), [
                'test_id' => $testId,
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách câu hỏi: ' . $e->getMessage()
            ];
        }
    }
}
