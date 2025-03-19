<?php

namespace App\Repositories;

use App\Models\LessonVideo;
use App\Repositories\Interfaces\VideoLessonRepositoryInterface;
use Illuminate\Support\Str;

class VideoLessonRepository extends BaseRepository implements VideoLessonRepositoryInterface
{
    protected $table = 'video_lessons';
    protected $model;

    public function __construct()
    {
        $this->model = new LessonVideo();
        parent::__construct($this->model);
    }

    public function getQuery()
    {
        return $this->model
            ->with('category')
            ->whereNull('deleted_at')
            ->latest('id');
    }

    public function create(array $data)
    {
        // Xử lý upload thumbnail
        if (isset($data['thumbnail'])) {
            $thumbnailPath = $this->handleImage($data['thumbnail'], 'video-lessons/thumbnails');
            if (!$thumbnailPath) {
                throw new \Exception('Failed to upload thumbnail image');
            }
            $data['thumbnailUrl'] = $thumbnailPath;
            unset($data['thumbnail']);
        }

        // Xử lý upload video
        if (isset($data['videoUrl'])) {
            $videoPath = $this->handleVideo($data['videoUrl'], 'video-lessons/videos');
            if (!$videoPath) {
                // Nếu upload video thất bại, xóa thumbnail đã upload (nếu có)
                if (isset($data['thumbnailUrl'])) {
                    $this->deleteImage($data['thumbnailUrl']);
                }
                throw new \Exception('Failed to upload video file');
            }
            $data['videoUrl'] = $videoPath;
        }

        // Tạo slug từ tên
        $data['slug'] = Str::slug($data['name']);

        // Đảm bảo duration là số nguyên giây
        $data['duration'] = isset($data['duration']) ? (int) $data['duration'] : 0;

        try {
            return parent::create($data);
        } catch (\Exception $e) {
            // Nếu tạo record thất bại, xóa cả file đã upload
            if (isset($data['thumbnailUrl'])) {
                $this->deleteImage($data['thumbnailUrl']);
            }
            if (isset($data['videoUrl'])) {
                $this->deleteVideo($data['videoUrl']);
            }
            throw $e;
        }
    }

    public function update($id, array $data)
    {
        $videoLesson = $this->findById($id);

        if (!$videoLesson) {
            throw new \Exception('Video lesson not found');
        }

        try {
            // Xử lý upload thumbnail mới nếu có
            if (isset($data['thumbnail']) && $data['thumbnail']->isValid()) {
                $thumbnailPath = $this->handleImage($data['thumbnail'], 'video-lessons/thumbnails', $videoLesson->thumbnailUrl);
                if (!$thumbnailPath) {
                    throw new \Exception('Failed to upload thumbnail image');
                }
                $data['thumbnailUrl'] = $thumbnailPath;
            }
            unset($data['thumbnail']); // Loại bỏ file khỏi data array

            // Xử lý upload video mới nếu có
            if (isset($data['videoUrl']) && $data['videoUrl']->isValid()) {
                $videoPath = $this->handleVideo($data['videoUrl'], 'video-lessons/videos', $videoLesson->videoUrl);
                if (!$videoPath) {
                    throw new \Exception('Failed to upload video file');
                }
                $data['videoUrl'] = $videoPath;
            }
            unset($data['video']); // Loại bỏ file khỏi data array

            return parent::update($id, $data);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function searchByName($search)
    {
        return $this->getQuery()
            ->where('name', 'like', "%{$search}%")
            ->paginate(config('crud.pagination.per_page'));
    }
}
