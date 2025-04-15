<?php

namespace App\Services;

use App\Services\Interfaces\AnswerServiceInterface;
use App\Repositories\Interfaces\AnswerRepositoryInterface;

class AnswerService extends BaseService implements AnswerServiceInterface
{
    public function __construct(AnswerRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function searchByName($keyword)
    {
        try {
            $answers = $this->repository->searchByName($keyword);
            return $this->successResponse($answers, 'Tìm kiếm thành công');
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi tìm kiếm');
        }
    }
}