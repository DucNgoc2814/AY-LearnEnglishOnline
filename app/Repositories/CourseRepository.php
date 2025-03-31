<?php

namespace App\Repositories;

use App\Models\Course;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
                \Log::info("Processing thumbnail upload", ['file' => $data['thumbnail']->getClientOriginalName()]);

                $cloudFrontUrl = $this->handleImage($data['thumbnail'], 'courses');
                if (!$cloudFrontUrl) {
                    throw new \Exception('Failed to upload thumbnail');
                }
                $data['thumbnail'] = $cloudFrontUrl;
                \Log::info("Thumbnail uploaded successfully", ['url' => $cloudFrontUrl]);
            }

            // Handle preview video upload if exists
            if (isset($data['preview_video'])) {
                \Log::info("Processing preview video upload", ['file' => $data['preview_video']->getClientOriginalName()]);

                $videoUrl = $this->handleVideo($data['preview_video'], 'courses');
                if (!$videoUrl) {
                    throw new \Exception('Failed to upload preview video');
                }
                $data['preview_video'] = $videoUrl;
                \Log::info("Preview video uploaded successfully", ['url' => $videoUrl]);
            }

            // Generate slug from title
            $data['slug'] = Str::slug($data['title']);

            // Create course record
            $course = $this->model->create($data);

            DB::commit();
            return $course;

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Course creation error: ' . $e->getMessage(), [
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
            return $this->handleFileUpload($image, $folder, 'images');
        } catch (\Exception $e) {
            \Log::error('Image upload error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function handleVideo($video, string $folder)
    {
        try {
            return $this->handleFileUpload($video, $folder, 'videos');
        } catch (\Exception $e) {
            \Log::error('Video upload error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function update($id, array $data)
    {
        try {
            $course = $this->findById($id);
            if (!$course) {
                throw new \Exception('Course not found');
            }

            // Handle thumbnail update
            if (isset($data['thumbnail']) && $data['thumbnail'] && $data['thumbnail']->isValid()) {
                $newThumbnailUrl = $this->updateImage(
                    $data['thumbnail'],
                    'courses',
                    $course->thumbnail
                );

                if (!$newThumbnailUrl) {
                    throw new \Exception('Failed to upload thumbnail');
                }
                $data['thumbnail'] = $newThumbnailUrl;
            } else {
                unset($data['thumbnail']);
            }

            // Handle preview video update
            if (isset($data['preview_video']) && $data['preview_video'] && $data['preview_video']->isValid()) {
                $newVideoUrl = $this->updateVideo(
                    $data['preview_video'],
                    'courses',
                    $course->preview_video
                );

                if (!$newVideoUrl) {
                    throw new \Exception('Failed to upload preview video');
                }
                $data['preview_video'] = $newVideoUrl;
            } else {
                unset($data['preview_video']);
            }

            // Update slug if title changed
            if (isset($data['title']) && $data['title'] !== $course->title) {
                $data['slug'] = Str::slug($data['title']);
            }

            return parent::update($id, $data);
        } catch (\Exception $e) {
            \Log::error('Course update error: ' . $e->getMessage());
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
            \Log::error('Course deletion error: ' . $e->getMessage());
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
}
