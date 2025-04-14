<?php

namespace App\Repositories;

use App\Models\Answer;
use App\Repositories\Interfaces\AnswerRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AnswerRepository extends BaseRepository implements AnswerRepositoryInterface
{
    protected $table = 'answers';
    protected $model;

    public function __construct()
    {
        $this->model = new Answer();
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
            ->where('answer', 'like', "%{$search}%")
            ->paginate(config('crud.pagination.per_page'));
    }

    public function getAllWithTrashed()
    {
        return $this->model::onlyTrashed();
    }
}
