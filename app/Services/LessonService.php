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

    public function getList()
    {
        try {
            $items = $this->repository->getQuery()->paginate(10);
            return [
                'status' => true,
                'message' => 'Lấy danh sách thành công',
                'data' => $items->items(),
                'pagination' => [
                    'total' => $items->total(),
                    'per_page' => $items->perPage(),
                    'current_page' => $items->currentPage(),
                    'last_page' => $items->lastPage(),
                    'links' => $items->links()
                ]
            ];
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi lấy danh sách');
        }
    }
}
