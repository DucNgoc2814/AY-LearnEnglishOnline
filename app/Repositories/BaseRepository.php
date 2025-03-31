<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Support\Facades\Storage;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;
    protected $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    protected $allowedVideoExtensions = ['mp4', 'mov', 'avi', 'wmv', 'webm'];
    protected $allowedAudioExtensions = ['mp3', 'wav', 'ogg', 'm4a'];

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
    public function getQuery()
    {
        return $this->model;
    }
    public function update($id, array $data)
    {

        $record = $this->findById($id);
        if ($record) {
            $record->update($data);
            return $record;
        }
        return false;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function getAllWithTrashed()
    {
        return $this->model->onlyTrashed();
    }

    public function findWithTrashed($id)
    {
        return $this->model->withTrashed()->find($id);
    }

    public function restore($id)
    {
        $record = $this->findWithTrashed($id);
        if ($record) {
            $record->restore();
            return $record;
        }
        return false;
    }

    public function forceDelete($id)
    {
        $record = $this->findWithTrashed($id);
        if ($record) {
            return $record->forceDelete();
        }
        return false;
    }

    /**
     * Get CloudFront URL from path
     */
    public function getCloudFrontUrl($path)
    {
        if (config('filesystems.disks.cloudfront.domain')) {
            return 'https://' . config('filesystems.disks.cloudfront.domain') . '/' . $path;
        }

        // Fallback to S3 URL if CloudFront is not configured
        return Storage::disk('s3')->url($path);
    }

    /**
     * Validate file extension
     */
    public function validateFileExtension($file, array $allowedExtensions)
    {
        $extension = strtolower($file->getClientOriginalExtension());
        if (!in_array($extension, $allowedExtensions)) {
            throw new \Exception("File type not allowed. Allowed types: " . implode(', ', $allowedExtensions));
        }
        return $extension;
    }

    /**
     * Handle generic file upload
     */
    public function handleFileUpload($file, string $folder, string $type)
    {
        try {
            if (!$file) {
                throw new \Exception("No file provided");
            }

            // Get correct extension from original filename
            $originalName = $file->getClientOriginalName();
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);

            // If no extension found, try to get from mime type
            if (empty($extension)) {
                $mimeType = $file->getMimeType();
                $extension = match($mimeType) {
                    'image/jpeg' => 'jpg',
                    'image/png' => 'png',
                    'image/gif' => 'gif',
                    'image/webp' => 'webp',
                    'video/mp4' => 'mp4',
                    'video/webm' => 'webm',
                    'video/ogg' => 'ogg',
                    default => throw new \Exception("Unsupported mime type: {$mimeType}")
                };
            }

            // Validate extension
            $allowedExtensions = match($type) {
                'images' => $this->allowedImageExtensions,
                'videos' => $this->allowedVideoExtensions,
                'sounds' => $this->allowedAudioExtensions,
                default => throw new \Exception("Invalid file type")
            };

            if (!in_array(strtolower($extension), $allowedExtensions)) {
                throw new \Exception("File type not allowed. Allowed types: " . implode(', ', $allowedExtensions));
            }

            // Generate unique filename
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $path = "{$folder}/{$type}/{$filename}";

            // Get file content
            $content = file_get_contents($file->getRealPath());
            if (!$content) {
                throw new \Exception("Could not read file content");
            }

            // Upload to S3
            $uploaded = Storage::disk('s3')->put($path, $content, 'public');

            if (!$uploaded) {
                throw new \Exception("Failed to upload file to S3: {$path}");
            }

            // Return CloudFront URL
            return $this->getCloudFrontUrl($path);

        } catch (\Exception $e) {
            \Log::error("File upload error ({$type}): " . $e->getMessage(), [
                'exception' => $e,
                'folder' => $folder,
                'type' => $type,
                'file_info' => $file ? [
                    'name' => $file->getClientOriginalName(),
                    'mime' => $file->getMimeType(),
                    'size' => $file->getSize()
                ] : null
            ]);
            throw $e;
        }
    }

    /**
     * Handle image upload
     */
    public function handleImage($image, string $folder)
    {
        return $this->handleFileUpload($image, $folder, 'images');
    }

    /**
     * Handle video upload
     */
    public function handleVideo($video, string $folder)
    {
        if (!$video || !$video->isValid()) {
            return null;
        }
        return $this->handleFileUpload($video, $folder, 'videos');
    }

    /**
     * Handle audio upload
     */
    public function handleAudio($audio, string $folder)
    {
        return $this->handleFileUpload($audio, $folder, 'sounds');
    }

    /**
     * Handle multiple file uploads
     */
    public function handleMultipleFiles(array $files, string $folder, string $type)
    {
        try {
            $paths = [];
            foreach ($files as $file) {
                $path = $this->handleFileUpload($file, $folder, $type);
                if ($path) {
                    $paths[] = $path;
                }
            }
            return $paths;
        } catch (\Exception $e) {
            \Log::error("Multiple files upload error ({$type}): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Handle multiple images upload
     */
    public function handleMultipleImages(array $images, string $folder)
    {
        return $this->handleMultipleFiles($images, $folder, 'images');
    }

    /**
     * Handle multiple videos upload
     */
    public function handleMultipleVideos(array $videos, string $folder)
    {
        return $this->handleMultipleFiles($videos, $folder, 'videos');
    }

    /**
     * Handle multiple audios upload
     */
    public function handleMultipleAudios(array $audios, string $folder)
    {
        return $this->handleMultipleFiles($audios, $folder, 'sounds');
    }

    /**
     * Update file with deletion of old file
     */
    public function updateFile($newFile, string $folder, string $type, ?string $oldFilePath = null)
    {
        try {
            // Delete old file if exists
            if (!empty($oldFilePath)) {
                $this->deleteFile($oldFilePath);
            }

            // Upload new file
            return $this->handleFileUpload($newFile, $folder, $type);
        } catch (\Exception $e) {
            \Log::error("File update error ({$type}): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Update image
     */
    public function updateImage($newImage, string $folder, ?string $oldImagePath = null)
    {
        return $this->updateFile($newImage, $folder, 'images', $oldImagePath);
    }

    /**
     * Update video
     */
    public function updateVideo($newVideo, string $folder, ?string $oldVideoPath = null)
    {
        return $this->updateFile($newVideo, $folder, 'videos', $oldVideoPath);
    }

    /**
     * Update audio
     */
    public function updateAudio($newAudio, string $folder, ?string $oldAudioPath = null)
    {
        return $this->updateFile($newAudio, $folder, 'sounds', $oldAudioPath);
    }

    /**
     * Delete file from S3
     */
    public function deleteFile(string $url)
    {
        try {
            // Extract path from CloudFront URL
            $cloudFrontDomain = config('filesystems.disks.cloudfront.domain');
            $path = str_replace("https://{$cloudFrontDomain}/", '', $url);

            // Delete from S3
            return Storage::disk('s3')->delete($path);
        } catch (\Exception $e) {
            \Log::error('File deletion error: ' . $e->getMessage());
            return false;
        }
    }
}
