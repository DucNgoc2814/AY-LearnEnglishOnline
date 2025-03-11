<?php

namespace App\Services;

use App\Models\Course;
use App\Services\Interfaces\ZoomSessionServiceInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\ZoomSessionRepositoryInterface;

class ZoomSessionService extends BaseService implements ZoomSessionServiceInterface
{
    protected $repository;

    public function __construct(ZoomSessionRepositoryInterface $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function searchByName($keyword)
    {
        try {
            $zoomSessions = $this->repository->searchByName($keyword);
            return $this->successResponse($zoomSessions, 'Tìm kiếm thành công');
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi tìm kiếm');
        }
    }
}
