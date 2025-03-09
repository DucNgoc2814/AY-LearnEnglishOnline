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
            if (\Storage::exists("public/{$path}")) {
                \Storage::delete("public/{$path}");
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
}
