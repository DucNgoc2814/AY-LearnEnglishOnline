<?php

namespace App\Services;

use App\Models\Lesson;
use App\Services\Interfaces\LessonServiceInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\LessonRepositoryInterface;

class LessonService extends BaseService implements LessonServiceInterface
{
    protected $repository;

    public function __construct(LessonRepositoryInterface $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function searchByName($keyword)
    {
        try {
            $lessons = $this->repository->searchByName($keyword);
            return $this->successResponse($lessons, 'Tìm kiếm thành công');
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi tìm kiếm');
        }
    }
}
