<?php

namespace App\Repositories\Interfaces;

interface BaseRepositoryInterface
{
    // Basic CRUD methods
    public function getAll();
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getQuery();
    public function getAllWithTrashed();
    public function findWithTrashed($id);
    public function restore($id);
    public function forceDelete($id);

    // Single file handling methods
    public function handleImage($image, string $folder);
    public function handleVideo($video, string $folder);
    public function handleAudio($audio, string $folder);

    // Generic file handling methods
    public function handleFileUpload($file, string $folder, string $type);
    public function validateFileExtension($file, array $allowedExtensions);
    public function getCloudFrontUrl($path);
    public function deleteFile(string $url);

    // Multiple files handling methods
    public function handleMultipleFiles(array $files, string $folder, string $type);
    public function handleMultipleImages(array $images, string $folder);
    public function handleMultipleVideos(array $videos, string $folder);
    public function handleMultipleAudios(array $audios, string $folder);

    // File update methods
    public function updateFile($newFile, string $folder, string $type, ?string $oldFilePath = null);
    public function updateImage($newImage, string $folder, ?string $oldImagePath = null);
    public function updateVideo($newVideo, string $folder, ?string $oldVideoPath = null);
    public function updateAudio($newAudio, string $folder, ?string $oldAudioPath = null);
}
