<?php

namespace App\Services;

use App\Models\VideoLesson;
use App\Models\LessonVideo;
use App\Services\Interfaces\VideoLessonServiceInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Repositories\Interfaces\VideoLessonRepositoryInterface;

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
            Log::error('Error in VideoLessonService searchByName:', [
                'keyword' => $keyword,
                'error' => $e->getMessage()
            ]);
            return $this->errorResponse('Có lỗi xảy ra khi tìm kiếm');
        }
    }

    public function findWithFullUrls($id)
    {
        try {
            $videoLesson = $this->repository->findWithFullUrls($id);
            if (!$videoLesson) {
                throw new \Exception('Không tìm thấy video bài học');
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

    /**
     * Lấy danh sách video theo bài học
     *
     * @param int $lessonId
     * @return array
     */
    public function getVideosByLesson($lessonId)
    {
        try {
            $videos = $this->repository->getVideosByLesson($lessonId);

            return [
                'success' => true,
                'videos' => $videos
            ];
        } catch (\Exception $e) {
            Log::error('Error in VideoLessonService getVideosByLesson:', [
                'lesson_id' => $lessonId,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách video: ' . $e->getMessage()
            ];
        }
    }
}
