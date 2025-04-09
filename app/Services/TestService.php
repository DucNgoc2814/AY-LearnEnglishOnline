<?php

namespace App\Services;

use App\Services\Interfaces\TestServiceInterface;
use App\Repositories\Interfaces\TestRepositoryInterface;

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
}