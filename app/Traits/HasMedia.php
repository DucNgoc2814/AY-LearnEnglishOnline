<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait HasMedia
{
    /**
     * Get the table name for the model
     */
    protected function getTableNameForMedia(): string
    {
        return $this->getTable();
    }

    /**
     * Handle file upload to S3
     *
     * @param string $field Field name
     * @param UploadedFile $file The uploaded file
     * @return string The file path that was stored
     */
    public function handleMediaUpload(string $field, UploadedFile $file): string
    {
        if (!static::isMediaField($field)) {
            throw new \InvalidArgumentException("Field {$field} is not configured as a media field");
        }

        $type = static::getMediaType($field);
        if (!in_array($type, ['image', 'video', 'audio'])) {
            throw new \InvalidArgumentException('Invalid media type');
        }

        // Delete old file if exists
        if ($this->$field) {
            $this->deleteMedia($this->$field);
        }

        // Generate unique filename
        $extension = $file->getClientOriginalExtension();
        $filename = Str::uuid() . '.' . $extension;

        // Create path based on table name and media type
        $path = $this->getTableNameForMedia() . '/' . $type . '/' . $filename;

        // Store file to S3
        Storage::disk('s3')->put($path, file_get_contents($file));

        return $path;
    }

    /**
     * Delete media from S3
     *
     * @param string $path Path to the file
     * @return bool
     */
    public function deleteMedia(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        return Storage::disk('s3')->delete($path);
    }

    /**
     * Get media URL
     *
     * @param string $field Field name containing the media path
     * @return string|null
     */
    public function getMediaUrl(?string $field): ?string
    {
        if (!$this->$field) {
            return null;
        }

        return Storage::disk('s3')->temporaryUrl(
            $this->$field,
            now()->addMinutes(5)
        );
    }

    /**
     * Delete all media files for the model
     */
    public function deleteAllMedia(): void
    {
        foreach (static::mediaFields() as $field => $config) {
            if ($this->$field) {
                $this->deleteMedia($this->$field);
            }
        }
    }
}
