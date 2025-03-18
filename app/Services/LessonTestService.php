<?php

namespace App\Services;

use App\Services\Interfaces\LessonTestServiceInterface;
use App\Repositories\Interfaces\LessonTestRepositoryInterface;

class LessonTestService extends BaseService implements LessonTestServiceInterface
{
    public function __construct(LessonTestRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function getAll()
    {
        try {
            $lessonTests = $this->repository->getAll();
            return $this->successResponse($lessonTests, 'Lấy danh sách thành công');
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi lấy danh sách');
        }
    }

    public function findById($id)
    {
        try {
            $lessonTest = $this->repository->findOrFail($id);
            return $this->successResponse($lessonTest, 'Lấy thông tin thành công');
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi lấy thông tin');
        }
    }

    public function searchByName($keyword)
    {
        try {
            $lessonTests = $this->repository->searchByName($keyword);
            return $this->successResponse($lessonTests, 'Tìm kiếm thành công');
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi tìm kiếm');
        }
    }
}
