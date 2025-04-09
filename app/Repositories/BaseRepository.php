<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
        $bucket = config('filesystems.disks.s3.bucket');
        $region = config('filesystems.disks.s3.region');
        return "https://{$bucket}.s3.{$region}.amazonaws.com/" . ltrim($path, '/');
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
    public function handleFileUpload($file, string $folder, $type)
    {
        try {
            if (!$file || !$file->isValid()) {
                throw new \Exception('Invalid file');
            }

            $fileName = uniqid() . '_' . time();
            $extension = $file->getClientOriginalExtension();
            $path = "$folder/$type/$fileName.$extension";

            // Log thông tin trước khi upload
            Log::info("Attempting to upload file to S3", [
                'path' => $path,
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
                'extension' => $extension,
                'type' => $type,
                'folder' => $folder
            ]);

            // Upload file to S3
            $fileContent = file_get_contents($file);

            $options = [
                'ContentType' => $file->getMimeType(),
                'ACL' => 'public-read'
            ];

            // Log chi tiết options
            Log::info("S3 upload options", [
                'options' => $options
            ]);

            $result = Storage::disk('s3')->put($path, $fileContent, $options);

            if (!$result) {
                throw new \Exception('Failed to upload file to S3');
            }

            Log::info("File uploaded successfully", [
                'path' => $path,
                'type' => $type,
                'size' => $file->getSize(),
                'mime' => $file->getMimeType()
            ]);

            return $path;
        } catch (\Exception $e) {
            Log::error("File upload error: " . $e->getMessage(), [
                'file' => $file ? $file->getClientOriginalName() : null,
                'file_size' => $file ? $file->getSize() : null,
                'mime_type' => $file ? $file->getMimeType() : null,
                'folder' => $folder,
                'type' => $type,
                'exception' => $e->getTraceAsString()
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
            Log::error("Multiple files upload error ({$type}): " . $e->getMessage());
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
            Log::error("File update error ({$type}): " . $e->getMessage());
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
    public function deleteFile(string $path)
    {
        try {
            // If the path is a full URL, extract just the path portion
            if (filter_var($path, FILTER_VALIDATE_URL)) {
                $cloudFrontDomain = config('filesystems.disks.cloudfront.domain');
                $path = str_replace("https://{$cloudFrontDomain}/", '', $path);
            }

            // Ensure the path doesn't start with a slash
            $path = ltrim($path, '/');

            Log::info('Attempting to delete file', ['path' => $path]);

            if (Storage::disk('s3')->exists($path)) {
                $result = Storage::disk('s3')->delete($path);
                Log::info('File deletion result', ['result' => $result]);
                return $result;
            }

            Log::warning('File not found for deletion', ['path' => $path]);
            return false;

        } catch (\Exception $e) {
            Log::error('File deletion error: ' . $e->getMessage(), [
                'path' => $path,
                'exception' => $e
            ]);
            return false;
        }
    }

    public function getFullUrl($path)
    {
        if (empty($path)) {
            return null;
        }

        // Check if path is already a full URL
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        // Use CloudFront URL if configured, otherwise fallback to S3
        $cloudFrontUrl = config('filesystems.disks.cloudfront.url');
        $cloudFrontDomain = config('filesystems.disks.cloudfront.domain');

        if ($cloudFrontUrl) {
            return rtrim($cloudFrontUrl, '/') . '/' . ltrim($path, '/');
        } else if ($cloudFrontDomain) {
            return 'https://' . $cloudFrontDomain . '/' . ltrim($path, '/');
        }

        // Fallback to S3 bucket URL
        $bucket = config('filesystems.disks.s3.bucket');
        $region = config('filesystems.disks.s3.region');
        return "https://{$bucket}.s3.{$region}.amazonaws.com/" . ltrim($path, '/');
    }
}
