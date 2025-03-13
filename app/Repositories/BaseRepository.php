<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

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
    public function handleImage($image, string $path, ?string $oldImage = null)
    {
        try {
            // Delete old image if exists
            if ($oldImage) {
                $this->deleteImage($oldImage);
            }

            // Generate unique filename with timestamp
            $filename = time() . '_' . $image->getClientOriginalName();

            // Make sure the path exists
            $fullPath = public_path("uploads/{$path}");
            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0755, true);
            }

            // Move the uploaded file to the destination
            $image->move($fullPath, $filename);

            // Return relative path for database storage
            return "uploads/{$path}/{$filename}";

        } catch (\Exception $e) {
            return false;
        }
    }
    public function deleteImage(string $path)
    {
        try {
            $fullPath = public_path($path);
            if (file_exists($fullPath)) {
                unlink($fullPath);
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function handleMultipleImages(array $images, string $path)
    {
        try {
            $imagePaths = [];
            foreach ($images as $image) {
                $imagePath = $this->handleImage($image, $path);
                if ($imagePath) {
                    $imagePaths[] = $imagePath;
                }
            }
            return $imagePaths;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function updateImage($newImage, string $path, ?string $oldImagePath = null)
    {
        // dd([
        //     'new_image' => $newImage,
        //     'path' => $path,
        //     'old_image_path' => $oldImagePath
        // ]);

        try {
            // Handle the new image upload (this will also delete the old image)
            $newImagePath = $this->handleImage($newImage, $path, $oldImagePath);

            if (!$newImagePath) {
                throw new \Exception('Failed to upload new image');
            }

            return $newImagePath;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function handleVideo($video, string $path, ?string $oldVideo = null)
    {
        try {
            // Delete old video if exists
            if ($oldVideo) {
                $this->deleteVideo($oldVideo);
            }

            // Generate unique filename with timestamp
            $filename = time() . '_' . $video->getClientOriginalName();

            // Make sure the path exists
            $fullPath = public_path("uploads/{$path}");
            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0755, true);
            }

            // Move the uploaded file to the destination
            $video->move($fullPath, $filename);

            // Return relative path for database storage
            return "uploads/{$path}/{$filename}";

        } catch (\Exception $e) {
            return false;
        }
    }

    public function deleteVideo(string $path)
    {
        try {
            $fullPath = public_path($path);
            if (file_exists($fullPath)) {
                unlink($fullPath);
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function handleMultipleVideos(array $videos, string $path)
    {
        try {
            $videoPaths = [];
            foreach ($videos as $video) {
                $videoPath = $this->handleVideo($video, $path);
                if ($videoPath) {
                    $videoPaths[] = $videoPath;
                }
            }
            return $videoPaths;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateVideo($newVideo, string $path, ?string $oldVideoPath = null)
    {
        try {
            // Handle the new video upload (this will also delete the old video)
            $newVideoPath = $this->handleVideo($newVideo, $path, $oldVideoPath);

            if (!$newVideoPath) {
                throw new \Exception('Failed to upload new video');
            }

            return $newVideoPath;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function handleAudio($audio, string $path, ?string $oldAudio = null)
    {
        try {
            // Delete old audio if exists
            if ($oldAudio) {
                $this->deleteAudio($oldAudio);
            }

            // Generate unique filename with timestamp
            $filename = time() . '_' . $audio->getClientOriginalName();

            // Make sure the path exists
            $fullPath = public_path("uploads/{$path}");
            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0755, true);
            }

            // Move the uploaded file to the destination
            $audio->move($fullPath, $filename);

            // Return relative path for database storage
            return "uploads/{$path}/{$filename}";

        } catch (\Exception $e) {
            return false;
        }
    }

    public function deleteAudio(string $path)
    {
        try {
            $fullPath = public_path($path);
            if (file_exists($fullPath)) {
                unlink($fullPath);
                return true;
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateAudio($newAudio, string $path, ?string $oldAudioPath = null)
    {
        try {
            // Handle the new audio upload (this will also delete the old audio)
            $newAudioPath = $this->handleAudio($newAudio, $path, $oldAudioPath);

            if (!$newAudioPath) {
                throw new \Exception('Failed to upload new audio');
            }

            return $newAudioPath;
        } catch (\Exception $e) {
            return false;
        }
    }
}
