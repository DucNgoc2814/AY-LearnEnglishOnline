<?php

namespace App\Repositories;

use App\Models\Lesson;
use App\Repositories\Interfaces\LessonRepositoryInterface;
use Illuminate\Support\Str;

class LessonRepository extends BaseRepository implements LessonRepositoryInterface
{
    protected $table = 'lessons';
    protected $model;

    public function __construct()
    {
        $this->model = new Lesson();
        parent::__construct($this->model);
    }

    public function getQuery()
    {
        $query = $this->model
            ->with('course')
            ->whereNull('deleted_at')
            ->latest('id');

        if (request()->route('courseId')) {
            $query->where('courseId', request()->route('courseId'));
        }

        return $query;
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

    public function getAllWithTrashed()
    {
        return $this->model::onlyTrashed()->with('course');
    }
}
