<?php

namespace App\Repositories;

use App\Models\Classes;
use App\Repositories\Interfaces\ClassRepositoryInterface;

class ClassRepository extends BaseRepository implements ClassRepositoryInterface
{
    protected $table = 'classes';
    protected $model;

    public function __construct()
    {
        $this->model = new Classes();
        parent::__construct($this->model);
    }
    public function getQuery()
    {
        return $this->model
            ->whereNull('deleted_at')
            ->latest('id');
    }


    public function create(array $data)
    {
        return parent::create($data);
    }

    public function update($id, array $data)
    {
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
        return $this->model::onlyTrashed();
    }
}
