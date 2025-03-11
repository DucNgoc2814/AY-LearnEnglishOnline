<?php

namespace App\Repositories;

use App\Models\ZoomSession;
use App\Repositories\Interfaces\ZoomSessionRepositoryInterface;
use Illuminate\Support\Str;

class ZoomSessionRepository extends BaseRepository implements ZoomSessionRepositoryInterface
{
    protected $table = 'zoom_sessions';
    protected $model;

    public function __construct()
    {
        $this->model = new ZoomSession();
        parent::__construct($this->model);
    }

    public function getQuery()
    {
        return $this->model
            ->with('course')
            ->whereNull('deleted_at')
            ->latest('id');
    }

    public function create(array $data)
    {
        if (isset($data['thumbnail'])) {
            $data['thumbnail'] = $this->handleImage($data['thumbnail'], 'zoom-sessions');
            if (!$data['thumbnail']) {
                throw new \Exception('Failed to upload image');
            }
        }

        $data['slug'] = Str::slug($data['name']);
        return parent::create($data);
    }

    public function update($id, array $data)
    {
        $zoomSession = $this->findById($id);

        if (!$zoomSession) {
            throw new \Exception('Zoom session not found');
        }

        if (isset($data['thumbnail']) && $data['thumbnail'] && $data['thumbnail']->isValid()) {
            $newThumbnail = $this->updateImage(
                $data['thumbnail'],
                'zoom-sessions',
                $zoomSession->thumbnail
            );

            if (!$newThumbnail) {
                throw new \Exception('Failed to upload image');
            }

            $data['thumbnail'] = $newThumbnail;
        } else {
            unset($data['thumbnail']);
        }

        return parent::update($id, $data);
    }

    public function searchByName($search)
    {
        return $this->getQuery()
            ->where('name', 'like', "%{$search}%")
            ->paginate(config('crud.pagination.per_page'));
    }

    public function getAllWithTrashed()
    {
        return $this->model::onlyTrashed()->with('course');
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }
}
