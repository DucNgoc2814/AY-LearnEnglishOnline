<?php

namespace App\Repositories;

use App\Models\LessonVideo;
use App\Repositories\Interfaces\VideoLessonRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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

            // Handle thumbnail upload
            if (isset($data['thumbnail_url'])) {
                Log::info("Processing thumbnail upload", ['file' => $data['thumbnail_url']->getClientOriginalName()]);

                $cloudFrontUrl = $this->handleImage($data['thumbnail_url'], 'video-lessons');
                if (!$cloudFrontUrl) {
                    throw new \Exception('Failed to upload thumbnail');
                }
                $data['thumbnail_url'] = $cloudFrontUrl;
                Log::info("Thumbnail uploaded successfully", ['url' => $cloudFrontUrl]);
            }

            // Handle video upload if exists
            if (isset($data['video_url'])) {
                Log::info("Processing video upload", ['file' => $data['video_url']->getClientOriginalName()]);

                $videoUrl = $this->handleVideo($data['video_url'], 'video-lessons');
                if (!$videoUrl) {
                    throw new \Exception('Failed to upload video');
                }
                $data['video_url'] = $videoUrl;
                Log::info("Video uploaded successfully", ['url' => $videoUrl]);
            }

            // Generate slug from name
            $data['slug'] = Str::slug($data['name']);

            // Create video lesson record
            $videoLesson = $this->model->create($data);

            DB::commit();
            return $videoLesson;

        } catch (\Exception $e) {
            DB::rollBack();

            // Chuẩn bị thông tin log với kiểm tra kiểu dữ liệu
            $logData = ['exception' => $e];

            // Thêm thông tin về dữ liệu, kiểm tra kiểu dữ liệu cho thumbnail và video
            $dataLog = $data;

            // Xử lý thông tin thumbnail
            if (isset($data['thumbnail_url'])) {
                if ($data['thumbnail_url'] instanceof \Illuminate\Http\UploadedFile) {
                    $dataLog['thumbnail_info'] = [
                        'name' => $data['thumbnail_url']->getClientOriginalName(),
                        'type' => $data['thumbnail_url']->getMimeType()
                    ];
                } else {
                    $dataLog['thumbnail_info'] = [
                        'name' => 'Đã được xử lý thành đường dẫn',
                        'path' => $data['thumbnail_url']
                    ];
                }
            } else {
                $dataLog['thumbnail_info'] = null;
            }

            // Xử lý thông tin video
            if (isset($data['video_url'])) {
                if ($data['video_url'] instanceof \Illuminate\Http\UploadedFile) {
                    $dataLog['video_info'] = [
                        'name' => $data['video_url']->getClientOriginalName(),
                        'type' => $data['video_url']->getMimeType()
                    ];
                } else {
                    $dataLog['video_info'] = [
                        'name' => 'Đã được xử lý thành đường dẫn',
                        'path' => $data['video_url']
                    ];
                }
            } else {
                $dataLog['video_info'] = null;
            }

            $logData['data'] = $dataLog;

            Log::error('Video lesson creation error: ' . $e->getMessage(), $logData);
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
                'has_video' => isset($data['video_url']),
                'thumbnail_url_value' => isset($data['thumbnail_url']) ? (is_null($data['thumbnail_url']) ? 'null' : 'has value') : 'not set',
                'video_url_value' => isset($data['video_url']) ? (is_null($data['video_url']) ? 'null' : 'has value') : 'not set'
            ]);

            // Handle thumbnail
            if (array_key_exists('thumbnail_url', $data)) {
                if (is_null($data['thumbnail_url'])) {
                    // User wants to delete the thumbnail
                    if ($videoLesson->thumbnail_url) {
                        Log::info('Deleting thumbnail due to null value', ['path' => $videoLesson->thumbnail_url]);
                        $this->deleteFile($videoLesson->thumbnail_url);
                    }
                } else if ($data['thumbnail_url'] instanceof \Illuminate\Http\UploadedFile) {
                    Log::info('Processing new thumbnail upload', [
                        'original_name' => $data['thumbnail_url']->getClientOriginalName()
                    ]);

                    // Delete old thumbnail if exists
                    if ($videoLesson->thumbnail_url) {
                        Log::info('Deleting old thumbnail', ['path' => $videoLesson->thumbnail_url]);
                        $this->deleteFile($videoLesson->thumbnail_url);
                    }

                    // Upload new thumbnail
                    $thumbnailPath = $this->handleImage($data['thumbnail_url'], 'video-lessons');
                    if (!$thumbnailPath) {
                        Log::warning('Failed to upload thumbnail, keeping existing one', [
                            'file' => $data['thumbnail_url']->getClientOriginalName()
                        ]);
                        unset($data['thumbnail_url']);
                    } else {
                        $data['thumbnail_url'] = $thumbnailPath;
                        Log::info('New thumbnail uploaded', ['path' => $thumbnailPath]);
                    }
                }
            }

            // Handle video
            if (array_key_exists('video_url', $data)) {
                if (is_null($data['video_url'])) {
                    // User wants to delete the video
                    if ($videoLesson->video_url) {
                        Log::info('Deleting video due to null value', ['path' => $videoLesson->video_url]);
                        $this->deleteFile($videoLesson->video_url);
                    }
                } else if ($data['video_url'] instanceof \Illuminate\Http\UploadedFile) {
                    Log::info('Processing new video upload', [
                        'original_name' => $data['video_url']->getClientOriginalName()
                    ]);

                    // Delete old video if exists
                    if ($videoLesson->video_url) {
                        Log::info('Deleting old video', ['path' => $videoLesson->video_url]);
                        $this->deleteFile($videoLesson->video_url);
                    }

                    // Upload new video
                    $videoPath = $this->handleVideo($data['video_url'], 'video-lessons');
                    if (!$videoPath) {
                        Log::warning('Failed to upload video, keeping existing one', [
                            'file' => $data['video_url']->getClientOriginalName()
                        ]);
                        // Nếu upload thất bại, giữ nguyên video cũ
                        unset($data['video_url']);
                    } else {
                        $data['video_url'] = $videoPath;
                        Log::info('New video uploaded', ['path' => $videoPath]);
                    }
                }
            }

            // Update video lesson record
            $videoLesson->update($data);

            DB::commit();

            Log::info('Video lesson updated successfully', [
                'id' => $id,
                'thumbnail_url' => $videoLesson->thumbnail_url,
                'video_url' => $videoLesson->video_url
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

            // Delete associated files
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

    public function searchByName($search)
    {
        return $this->getQuery()
            ->where('name', 'like', "%{$search}%")
            ->paginate(config('crud.pagination.per_page'));
    }

    public function getAllWithTrashed()
    {
        return $this->model::onlyTrashed()->with('lesson');
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function findWithFullUrls($id)
    {
        $videoLesson = $this->findOrFail($id);

        // Add full URLs for image and video
        $videoLesson->thumbnail_url = $this->getFullUrl($videoLesson->thumbnail_url);
        $videoLesson->video_url = $this->getFullUrl($videoLesson->video_url);

        return $videoLesson;
    }

    /**
     * Get full URL for file path
     *
     * @param string|null $path
     * @return string|null
     */
    public function getFullUrl($path)
    {
        if (empty($path)) {
            return null;
        }

        // Nếu đã là URL đầy đủ, trả về nguyên dạng
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Đảm bảo path không có dấu / ở đầu
        $path = ltrim($path, '/');

        // Sử dụng CloudFront nếu có cấu hình
        $cloudFrontDomain = config('filesystems.disks.cloudfront.domain');
        if ($cloudFrontDomain) {
            return "https://{$cloudFrontDomain}/{$path}";
        }

        // Fallback to S3 URL or add domain if S3 URL generation not available
        $s3Domain = config('filesystems.disks.s3.url');
        if ($s3Domain) {
            return "{$s3Domain}/{$path}";
        }

        // Last resort
        return $path;
    }

    public function deleteFile($path)
    {
        try {
            if (empty($path)) {
                return true;
            }

            // If path is a full URL, extract just the path portion
            if (filter_var($path, FILTER_VALIDATE_URL)) {
                $cloudFrontDomain = config('filesystems.disks.cloudfront.domain');
                $path = str_replace("https://{$cloudFrontDomain}/", '', $path);
            }

            // Ensure the path doesn't start with a slash
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
}
