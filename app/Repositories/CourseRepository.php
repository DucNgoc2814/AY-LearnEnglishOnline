<?php

namespace App\Repositories;

use App\Models\Course;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    protected $table = 'courses';
    protected $model;

    public function __construct()
    {
        $this->model = new Course();
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
        try {
            DB::beginTransaction();

            // Handle thumbnail upload
            if (isset($data['thumbnail'])) {
                Log::info("Processing thumbnail upload", ['file' => $data['thumbnail']->getClientOriginalName()]);

                $cloudFrontUrl = $this->handleImage($data['thumbnail'], 'courses');
                if (!$cloudFrontUrl) {
                    throw new \Exception('Failed to upload thumbnail');
                }
                $data['thumbnail'] = $cloudFrontUrl;
                Log::info("Thumbnail uploaded successfully", ['url' => $cloudFrontUrl]);
            }

            // Handle preview video upload if exists
            if (isset($data['preview_video'])) {
                Log::info("Processing preview video upload", ['file' => $data['preview_video']->getClientOriginalName()]);

                $videoUrl = $this->handleVideo($data['preview_video'], 'courses');
                if (!$videoUrl) {
                    throw new \Exception('Failed to upload preview video');
                }
                $data['preview_video'] = $videoUrl;
                Log::info("Preview video uploaded successfully", ['url' => $videoUrl]);
            }

            // Generate slug from title
            $data['slug'] = Str::slug($data['title']);

            // Create course record
            $course = $this->model->create($data);

            DB::commit();
            return $course;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Course creation error: ' . $e->getMessage(), [
                'exception' => $e,
                'data' => array_merge($data, [
                    'thumbnail_info' => isset($data['thumbnail']) ? [
                        'name' => $data['thumbnail']->getClientOriginalName(),
                        'type' => $data['thumbnail']->getMimeType()
                    ] : null,
                    'video_info' => isset($data['preview_video']) ? [
                        'name' => $data['preview_video']->getClientOriginalName(),
                        'type' => $data['preview_video']->getMimeType()
                    ] : null
                ])
            ]);
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

            $course = $this->findById($id);
            if (!$course) {
                throw new \Exception('Course not found');
            }

            Log::info('Starting course update:', [
                'id' => $id,
                'has_thumbnail' => isset($data['thumbnail']),
                'has_video' => isset($data['preview_video'])
            ]);

            // Handle thumbnail
            if (isset($data['thumbnail'])) {
                if ($data['thumbnail'] instanceof \Illuminate\Http\UploadedFile) {
                    Log::info('Processing new thumbnail upload', [
                        'original_name' => $data['thumbnail']->getClientOriginalName()
                    ]);

                    // Delete old thumbnail if exists
                    if ($course->thumbnail) {
                        Log::info('Deleting old thumbnail', ['path' => $course->thumbnail]);
                        $this->deleteFile($course->thumbnail);
                    }

                    // Upload new thumbnail
                    $thumbnailPath = $this->handleImage($data['thumbnail'], 'courses');
                    if (!$thumbnailPath) {
                        throw new \Exception('Failed to upload thumbnail');
                    }
                    $data['thumbnail'] = $thumbnailPath;

                    Log::info('New thumbnail uploaded', ['path' => $thumbnailPath]);
                }
            }

            // Handle preview video
            if (isset($data['preview_video'])) {
                if ($data['preview_video'] instanceof \Illuminate\Http\UploadedFile) {
                    Log::info('Processing new video upload', [
                        'original_name' => $data['preview_video']->getClientOriginalName()
                    ]);

                    // Delete old video if exists
                    if ($course->preview_video) {
                        Log::info('Deleting old video', ['path' => $course->preview_video]);
                        $this->deleteFile($course->preview_video);
                    }

                    // Upload new video
                    $videoPath = $this->handleVideo($data['preview_video'], 'courses');
                    if (!$videoPath) {
                        throw new \Exception('Failed to upload video');
                    }
                    $data['preview_video'] = $videoPath;

                    Log::info('New video uploaded', ['path' => $videoPath]);
                }
            }

            // Update course record
            $course->update($data);

            DB::commit();

            Log::info('Course updated successfully', [
                'id' => $id,
                'thumbnail' => $course->thumbnail,
                'preview_video' => $course->preview_video
            ]);

            return $course;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Course update error:', [
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
            $course = $this->findById($id);
            if (!$course) {
                throw new \Exception('Course not found');
            }

            // Delete associated files
            if ($course->thumbnail) {
                $this->deleteFile($course->thumbnail);
            }
            if ($course->preview_video) {
                $this->deleteFile($course->preview_video);
            }

            return parent::delete($id);
        } catch (\Exception $e) {
            Log::error('Course deletion error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function searchByName($search)
    {
        return $this->getQuery()
            ->where('title', 'like', "%{$search}%")
            ->paginate(config('crud.pagination.per_page'));
    }

    public function getAllWithTrashed()
    {
        return $this->model::onlyTrashed()->with('category');
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function findWithFullUrls($id)
    {
        $course = $this->findOrFail($id);

        // Add full URLs for image and video
        $course->thumbnail = $this->getFullUrl($course->thumbnail);
        $course->preview_video = $this->getFullUrl($course->preview_video);

        return $course;
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
