<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class StudentRepository extends BaseRepository implements StudentRepositoryInterface
{
    protected $table = 'students';
    protected $model;

    public function __construct()
    {
        $this->model = new Student();
        parent::__construct($this->model);
    }

    public function getQuery()
    {
        return $this->model
            ->with('user')
            ->whereNull('deleted_at')
            ->latest('id');
    }

    public function create(array $data)
    {
        try {
            DB::beginTransaction();

            // Handle avatar upload
            if (isset($data['avatar'])) {
                Log::info("Processing avatar upload", ['file' => $data['avatar']->getClientOriginalName()]);

                $avatarPath = $this->handleImage($data['avatar'], 'students');
                if (!$avatarPath) {
                    throw new \Exception('Failed to upload avatar');
                }
                $data['avatar'] = $avatarPath;
                Log::info("Avatar uploaded successfully", ['url' => $avatarPath]);
            }

            // Create student record
            $student = $this->model->create($data);

            DB::commit();
            return $student;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Student creation error: ' . $e->getMessage(), [
                'exception' => $e,
                'data' => array_merge($data, [
                    'avatar_info' => isset($data['avatar']) ? [
                        'name' => $data['avatar']->getClientOriginalName(),
                        'type' => $data['avatar']->getMimeType()
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

    public function update($id, array $data)
    {
        try {
            DB::beginTransaction();

            $student = $this->findById($id);
            if (!$student) {
                throw new \Exception('Student not found');
            }

            Log::info('Starting student update:', [
                'id' => $id,
                'has_avatar' => isset($data['avatar'])
            ]);

            // Handle avatar
            if (isset($data['avatar'])) {
                if ($data['avatar'] instanceof \Illuminate\Http\UploadedFile) {
                    Log::info('Processing new avatar upload', [
                        'original_name' => $data['avatar']->getClientOriginalName()
                    ]);

                    // Delete old avatar if exists
                    if ($student->avatar) {
                        Log::info('Deleting old avatar', ['path' => $student->avatar]);
                        $this->deleteFile($student->avatar);
                    }

                    // Upload new avatar
                    $avatarPath = $this->handleImage($data['avatar'], 'students');
                    if (!$avatarPath) {
                        throw new \Exception('Failed to upload avatar');
                    }
                    $data['avatar'] = $avatarPath;

                    Log::info('New avatar uploaded', ['path' => $avatarPath]);
                }
            }

            // Update student record
            $student->update($data);

            DB::commit();

            Log::info('Student updated successfully', [
                'id' => $id,
                'avatar' => $student->avatar,
            ]);

            return $student;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Student update error:', [
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
            if ($course->avatar) {
                $this->deleteFile($course->avatar);
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
        $student = $this->model->with('user')->findOrFail($id);

        // Add full URLs for image and video
        $student->avatar = $this->getFullUrl($student->avatar);

        return $student;
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
