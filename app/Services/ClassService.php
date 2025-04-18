<?php

namespace App\Services;

use App\Services\Interfaces\ClassServiceInterface;
use App\Repositories\Interfaces\ClassRepositoryInterface;

class ClassService extends BaseService implements ClassServiceInterface
{
    public function __construct(ClassRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function searchByName($keyword)
    {
        try {
            $classes = $this->repository->searchByName($keyword);
            return $this->successResponse($classes, 'Tìm kiếm thành công');
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi tìm kiếm');
        }
    }
}