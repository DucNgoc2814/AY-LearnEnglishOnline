<?php

namespace App\Services;

use App\Models\VideoLesson;
use App\Services\Interfaces\VideoLessonServiceInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\VideoLessonRepositoryInterface;
use Illuminate\Support\Facades\Log;

class VideoLessonService extends BaseService implements VideoLessonServiceInterface
{
    protected $repository;

    public function __construct(VideoLessonRepositoryInterface $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }

    public function searchByName($keyword)
    {
        try {
            $videoLessons = $this->repository->searchByName($keyword);
            return $this->successResponse($videoLessons, 'Tìm kiếm thành công');
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi tìm kiếm');
        }
    }

    /**
     * Tìm video lesson với URLs đầy đủ
     *
     * @param int $id
     * @return array
     */
    public function findWithFullUrls($id)
    {
        try {
            $videoLesson = $this->repository->findWithFullUrls($id);
            if (!$videoLesson) {
                throw new \Exception('Không tìm thấy bài học video');
            }

            return $videoLesson;
        } catch (\Exception $e) {
            Log::error('Error in VideoLessonService findWithFullUrls:', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
}
