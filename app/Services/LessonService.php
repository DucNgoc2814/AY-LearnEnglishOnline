<?php

namespace App\Services;

use App\Models\Lesson;
use App\Services\Interfaces\LessonServiceInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\LessonRepositoryInterface;
use Illuminate\Support\Facades\Log;

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

    public function create(array $data)
    {
        try {
            Log::info('Creating lesson with data:', $data);

            // Kiểm tra các trường bắt buộc
            if (!isset($data['course_id'])) {
                return [
                    'status' => false,
                    'message' => 'Thiếu thông tin khóa học'
                ];
            }

            if (!isset($data['name']) || empty($data['name'])) {
                return [
                    'status' => false,
                    'message' => 'Thiếu tên bài học'
                ];
            }

            if (!isset($data['order_number'])) {
                return [
                    'status' => false,
                    'message' => 'Thiếu thứ tự bài học'
                ];
            }

            // Convert checkbox is_preview to boolean
            $data['is_preview'] = isset($data['is_preview']) ? true : false;

            $lesson = $this->repository->create($data);

            return [
                'status' => true,
                'message' => 'Thêm bài học thành công',
                'data' => $lesson
            ];
        } catch (\Exception $e) {
            Log::error('Error in LessonService create: ' . $e->getMessage());
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi thêm bài học'
            ];
        }
    }

    /**
     * Lấy danh sách bài học theo khóa học
     *
     * @param int $courseId
     * @return array
     */
    public function getLessonsByCourse($courseId)
    {
        try {
            $lessons = $this->repository->getByCourseId($courseId);

            return [
                'success' => true,
                'lessons' => $lessons
            ];
        } catch (\Exception $e) {
            Log::error('Error in LessonService getLessonsByCourse: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách bài học: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Lấy danh sách video của bài học
     *
     * @param int $lessonId
     * @return array
     */
    public function getVideosByLesson($lessonId)
    {
        try {
            $videos = $this->repository->getVideosByLessonId($lessonId);

            return [
                'success' => true,
                'message' => 'Lấy danh sách video thành công',
                'videos' => $videos
            ];
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error in LessonService getVideosByLesson: ' . $e->getMessage(), [
                'lesson_id' => $lessonId,
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Có lỗi xảy ra khi lấy danh sách video: ' . $e->getMessage()
            ];
        }
    }
}
