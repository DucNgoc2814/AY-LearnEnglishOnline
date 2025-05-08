<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasMedia
{
    /**
     * Get media configuration for the model
     * Override this method in your model to define which media types are supported
     */
    public static function getMediaConfig(): array
    {
        return [
            'image' => [
                'max_size' => 2048, // 2MB
                'mimes' => 'jpeg,png,jpg,gif',
            ],
            'video' => [
                'max_size' => 10240, // 10MB
                'mimes' => 'mp4,mov,avi',
            ],
            'audio' => [
                'max_size' => 5120, // 5MB
                'mimes' => 'mp3,wav',
            ]
        ];
    }

    /**
     * Get supported media types for the model
     */
    public static function getSupportedMediaTypes(): array
    {
        return array_keys(static::getMediaConfig());
    }

    /**
     * Get validation rules for media fields
     */
    public static function getMediaValidationRules(): array
    {
        $rules = [];
        $config = static::getMediaConfig();

        foreach ($config as $type => $settings) {
            $rules[$type] = [
                'nullable',
                'file',
                'mimes:' . $settings['mimes'],
                'max:' . $settings['max_size']
            ];
        }

        return $rules;
    }

    /**
     * Upload a file to S3 and return the path
     */
    protected function uploadFile(UploadedFile $file, string $type = 'image'): string
    {
        if (!in_array($type, static::getSupportedMediaTypes())) {
            throw new \InvalidArgumentException("Unsupported media type: {$type}");
        }

        // Get table name for folder structure
        $table = $this->getTable();

        // Generate unique filename
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        // Create path based on table and file type
        $path = "{$table}/{$type}/" . $filename;

        // Store file to S3
        Storage::disk('s3')->put($path, file_get_contents($file));

        return $path;
    }

    /**
     * Delete a file from S3
     */
    protected function deleteFile(string $path): bool
    {
        if ($path && Storage::disk('s3')->exists($path)) {
            return Storage::disk('s3')->delete($path);
        }
        return false;
    }

    /**
     * Get full URL for a file
     */
    protected function getFileUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        $s3Url = env('AWS_URL');
        if (!$s3Url) {
            throw new \RuntimeException('AWS_URL not configured');
        }

        return rtrim($s3Url, '/') . '/' . $path;
    }

    /**
     * Handle file upload for a field
     */
    public function handleFileUpload($field, UploadedFile $file, string $type = 'image'): string
    {
        if (!in_array($type, static::getSupportedMediaTypes())) {
            throw new \InvalidArgumentException("Unsupported media type: {$type}");
        }

        // Delete old file if exists
        if ($this->$field) {
            $this->deleteFile($this->$field);
        }

        // Upload new file
        return $this->uploadFile($file, $type);
    }

    /**
     * Register media URL accessors for the model
     */
    protected static function bootHasMedia()
    {
        foreach (static::getSupportedMediaTypes() as $type) {
            static::addMediaUrlAccessor($type);
        }
    }

    /**
     * Add URL accessor for a media type
     */
    protected static function addMediaUrlAccessor(string $type)
    {
        $method = 'get' . Str::studly($type) . 'UrlAttribute';

        if (!method_exists(static::class, $method)) {
            static::macro($method, function () use ($type) {
                return $this->getFileUrl($this->$type);
            });
        }
    }
}
