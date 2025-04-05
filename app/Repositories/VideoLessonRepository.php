<?php

namespace App\Repositories;

use App\Models\LessonVideo;
use App\Repositories\Interfaces\VideoLessonRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VideoLessonRepository extends BaseRepository implements VideoLessonRepositoryInterface
{
    protected $table = 'lesson_videos';
    protected $model;

    public function __construct()
    {
        $this->model = new LessonVideo();
        parent::__construct($this->model);
    }

    public function getQuery()
    {
        return $this->model
            ->with('lesson')
            ->whereNull('deleted_at')
            ->latest('id');
    }

    public function create(array $data)
    {
        try {
            DB::beginTransaction();

            // Xử lý upload thumbnail
            if (isset($data['thumbnail_url']) && $data['thumbnail_url'] instanceof \Illuminate\Http\UploadedFile) {
                Log::info("Processing thumbnail upload", ['file' => $data['thumbnail_url']->getClientOriginalName()]);

                $thumbnailPath = $this->handleImage($data['thumbnail_url'], 'video-lessons');
                if (!$thumbnailPath) {
                    throw new \Exception('Failed to upload thumbnail image');
                }
                $data['thumbnail_url'] = $thumbnailPath;
                Log::info("Thumbnail uploaded successfully", ['url' => $thumbnailPath]);
            }

            // Xử lý upload video
            if (isset($data['video_url']) && $data['video_url'] instanceof \Illuminate\Http\UploadedFile) {
                Log::info("Processing video upload", ['file' => $data['video_url']->getClientOriginalName()]);

                $videoPath = $this->handleVideo($data['video_url'], 'video-lessons');
                if (!$videoPath) {
                    throw new \Exception('Failed to upload video file');
                }
                $data['video_url'] = $videoPath;
                Log::info("Video uploaded successfully", ['url' => $videoPath]);
            }

            // Đảm bảo duration là số nguyên
            $data['duration'] = isset($data['duration']) ? (int) $data['duration'] : 0;

            // Đảm bảo các trường boolean được xử lý đúng
            $data['is_downloadable'] = isset($data['is_downloadable']) ? true : false;
            $data['is_preview'] = isset($data['is_preview']) ? true : false;
            $data['view_count'] = 0; // Mặc định view_count là 0

            // Tạo record
            $videoLesson = parent::create($data);

            DB::commit();
            return $videoLesson;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Video lesson creation error: ' . $e->getMessage(), [
                'exception' => $e,
                'data' => $data
            ]);
            throw $e;
        }
    }

    public function update($id, array $data)
    {
        try {
            DB::beginTransaction();

            $videoLesson = $this->findById($id);
            if (!$videoLesson) {
                throw new \Exception('Video lesson not found');
            }

            Log::info('Starting video lesson update:', [
                'id' => $id,
                'has_thumbnail' => isset($data['thumbnail_url']),
                'has_video' => isset($data['video_url'])
            ]);

            // Xử lý thumbnail mới nếu có
            if (isset($data['thumbnail_url']) && $data['thumbnail_url'] instanceof \Illuminate\Http\UploadedFile) {
                Log::info('Processing new thumbnail upload', [
                    'original_name' => $data['thumbnail_url']->getClientOriginalName()
                ]);

                // Xóa thumbnail cũ nếu có
                if ($videoLesson->thumbnail_url) {
                    Log::info('Deleting old thumbnail', ['path' => $videoLesson->thumbnail_url]);
                    $this->deleteFile($videoLesson->thumbnail_url);
                }

                // Upload thumbnail mới
                $thumbnailPath = $this->handleImage($data['thumbnail_url'], 'video-lessons');
                if (!$thumbnailPath) {
                    throw new \Exception('Failed to upload thumbnail');
                }
                $data['thumbnail_url'] = $thumbnailPath;
                Log::info('New thumbnail uploaded', ['path' => $thumbnailPath]);
            }

            // Xử lý video mới nếu có
            if (isset($data['video_url']) && $data['video_url'] instanceof \Illuminate\Http\UploadedFile) {
                Log::info('Processing new video upload', [
                    'original_name' => $data['video_url']->getClientOriginalName()
                ]);

                // Xóa video cũ nếu có
                if ($videoLesson->video_url) {
                    Log::info('Deleting old video', ['path' => $videoLesson->video_url]);
                    $this->deleteFile($videoLesson->video_url);
                }

                // Upload video mới
                $videoPath = $this->handleVideo($data['video_url'], 'video-lessons');
                if (!$videoPath) {
                    throw new \Exception('Failed to upload video');
                }
                $data['video_url'] = $videoPath;
                Log::info('New video uploaded', ['path' => $videoPath]);
            }

            // Đảm bảo các trường boolean được xử lý đúng
            if (isset($data['is_downloadable'])) {
                $data['is_downloadable'] = filter_var($data['is_downloadable'], FILTER_VALIDATE_BOOLEAN);
            }

            if (isset($data['is_preview'])) {
                $data['is_preview'] = filter_var($data['is_preview'], FILTER_VALIDATE_BOOLEAN);
            }

            // Update video lesson
            $videoLesson->update($data);

            DB::commit();

            Log::info('Video lesson updated successfully', [
                'id' => $id
            ]);

            return $videoLesson;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Video lesson update error:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function delete($id)
    {
        try {
            $videoLesson = $this->findById($id);
            if (!$videoLesson) {
                throw new \Exception('Video lesson not found');
            }

            // Xóa các file liên quan
            if ($videoLesson->thumbnail_url) {
                $this->deleteFile($videoLesson->thumbnail_url);
            }
            if ($videoLesson->video_url) {
                $this->deleteFile($videoLesson->video_url);
            }

            return parent::delete($id);
        } catch (\Exception $e) {
            Log::error('Video lesson deletion error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function handleImage($image, string $folder)
    {
        try {
            if (!$image) {
                return null;
            }

            $filename = uniqid() . '_' . time();
            $extension = $image->getClientOriginalExtension();
            $path = $folder . '/images/' . $filename . '.' . $extension;

            // Upload to S3
            $result = Storage::disk('s3')->put($path, file_get_contents($image));

            if (!$result) {
                throw new \Exception('Failed to upload image to S3');
            }

            return $path;
        } catch (\Exception $e) {
            Log::error('Image upload error: ' . $e->getMessage(), [
                'file' => $image->getClientOriginalName()
            ]);
            throw $e;
        }
    }

    public function handleVideo($video, string $folder)
    {
        try {
            if (!$video) {
                return null;
            }

            $filename = uniqid() . '_' . time();
            $extension = $video->getClientOriginalExtension();
            $path = $folder . '/videos/' . $filename . '.' . $extension;

            // Upload to S3
            $result = Storage::disk('s3')->put($path, file_get_contents($video));

            if (!$result) {
                throw new \Exception('Failed to upload video to S3');
            }

            return $path;
        } catch (\Exception $e) {
            Log::error('Video upload error: ' . $e->getMessage(), [
                'file' => $video->getClientOriginalName()
            ]);
            throw $e;
        }
    }

    public function deleteFile($path)
    {
        try {
            if (empty($path)) {
                return true;
            }

            // Nếu path là URL đầy đủ, trích xuất chỉ phần path
            if (filter_var($path, FILTER_VALIDATE_URL)) {
                $cloudFrontDomain = config('filesystems.disks.cloudfront.domain');
                $path = str_replace("https://{$cloudFrontDomain}/", '', $path);
            }

            // Đảm bảo path không bắt đầu bằng dấu /
            $path = ltrim($path, '/');

            Log::info('Attempting to delete file from S3', ['path' => $path]);

            if (Storage::disk('s3')->exists($path)) {
                $result = Storage::disk('s3')->delete($path);
                Log::info('File deletion result', ['result' => $result]);
                return $result;
            }

            Log::warning('File not found for deletion', ['path' => $path]);
            return true;
        } catch (\Exception $e) {
            Log::error('File deletion error: ' . $e->getMessage(), [
                'path' => $path
            ]);
            return false;
        }
    }

    public function searchByName($search)
    {
        return $this->getQuery()
            ->where('name', 'like', "%{$search}%")
            ->paginate(config('crud.pagination.per_page'));
    }

    public function findWithFullUrls($id)
    {
        $videoLesson = $this->findOrFail($id);

        // Thêm URL đầy đủ cho ảnh và video
        $videoLesson->full_thumbnail = $this->getFullUrl($videoLesson->thumbnail_url);
        $videoLesson->full_video = $this->getFullUrl($videoLesson->video_url);

        return $videoLesson;
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getFullUrl($path)
    {
        if (empty($path)) {
            return null;
        }

        // Nếu path đã là URL đầy đủ, trả về luôn
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Tạo URL đầy đủ từ CloudFront
        $cloudFrontDomain = config('filesystems.disks.cloudfront.domain');
        return "https://{$cloudFrontDomain}/{$path}";
    }

    /**
     * Lấy danh sách video theo bài học
     *
     * @param int $lessonId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getVideosByLesson($lessonId)
    {
        return $this->model->where('lesson_id', $lessonId)->get();
    }
}
