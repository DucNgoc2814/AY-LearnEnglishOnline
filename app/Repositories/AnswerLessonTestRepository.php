<?php

namespace App\Repositories;

use App\Models\AnswerLessonTest;
use App\Repositories\Interfaces\AnswerLessonTestRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AnswerLessonTestRepository extends BaseRepository implements AnswerLessonTestRepositoryInterface
{
    protected $table = 'answer_lesson_tests';
    protected $model;

    public function __construct()
    {
        $this->model = new AnswerLessonTest();
        parent::__construct($this->model);
    }

    public function deleteWhere(array $conditions)
    {
        return $this->model->where($conditions)->delete();
    }

    public function create(array $data)
    {
        // Chỉ tạo slug nếu có name
        if (isset($data['name'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['name']);
        }
        return parent::create($data);
    }

    public function update($id, array $data)
    {
        // Chỉ tạo slug nếu có name
        if (isset($data['name'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['name']);
        }
        return parent::update($id, $data);
    }

    public function searchByName($search)
    {
        return $this->getQuery()
            ->where('name', 'like', "%{$search}%")
            ->paginate(config('crud.pagination.per_page'));
    }
}
