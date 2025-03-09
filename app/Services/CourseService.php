<?php

namespace App\Services;

use App\Models\Course;
use App\Services\Interfaces\CourseServiceInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\CourseRepositoryInterface;

class CourseService extends BaseService implements CourseServiceInterface
{
    protected $repository;

    public function __construct(CourseRepositoryInterface $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function searchByName($keyword)
    {
        try {
            $courses = $this->repository->searchByName($keyword);
            return $this->successResponse($courses, 'Tìm kiếm thành công');
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi tìm kiếm');
        }
    }
}
