<?php

namespace App\Services;

use App\Models\VideoLesson;
use App\Services\Interfaces\AnswerLessonTestServiceInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\AnswerLessonTestRepositoryInterface;

class AnswerLessonTestService extends BaseService implements AnswerLessonTestServiceInterface
{
    protected $repository;

    public function __construct(AnswerLessonTestRepositoryInterface $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function searchByName($keyword)
    {
        try {
            $answerLessonTests = $this->repository->searchByName($keyword);
            return $this->successResponse($answerLessonTests, 'Tìm kiếm thành công');
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi tìm kiếm');
        }
    }
}
