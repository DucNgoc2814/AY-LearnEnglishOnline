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

    public function findWithFullUrls($id)
    {
        try {
            $course = $this->repository->findWithFullUrls($id);
            if (!$course) {
                throw new \Exception('Không tìm thấy khóa học');
            }
            return $course;
        } catch (\Exception $e) {
            \Log::error('Error in CourseService findWithFullUrls:', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
}
