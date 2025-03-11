<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\LessonTest;
use App\Repositories\Interfaces\LessonTestRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class LessonTestRepository extends BaseRepository implements LessonTestRepositoryInterface
{
    protected $table = 'lesson_tests';
    protected $model;

    public function __construct()
    {
        $this->model = new LessonTest();
        parent::__construct($this->model);
    }

    public function create(array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        return parent::create($data);
    }

    public function update($id, array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        return parent::update($id, $data);
    }

    public function searchByName($search)
    {
        return $this->getQuery()
            ->where('name', 'like', "%{$search}%")
            ->paginate(config('crud.pagination.per_page'));
    }
}
