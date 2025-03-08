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
}
