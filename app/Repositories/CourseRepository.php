<?php

namespace App\Repositories;

use App\Models\Course;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Support\Str;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    protected $table = 'courses';
    protected $model;

    public function __construct()
    {
        $this->model = new Course();
        parent::__construct($this->model);
    }

    public function getQuery()
    {
        return $this->model
            ->with('category')
            ->whereNull('deleted_at')
            ->latest('id');
    }

    public function create(array $data)
    {
        if (isset($data['thumbnail'])) {
            $data['thumbnail'] = $this->handleImage($data['thumbnail'], 'courses');
            if (!$data['thumbnail']) {
                throw new \Exception('Failed to upload image');
            }
        }

        $data['slug'] = Str::slug($data['name']);
        return parent::create($data);
    }

    public function update($id, array $data)
    {
        $course = $this->findById($id);

        if (isset($data['thumbnail'])) {
            $data['thumbnail'] = $this->handleImage(
                $data['thumbnail'],
                'courses',
                $course->thumbnail
            );
            if (!$data['thumbnail']) {
                throw new \Exception('Failed to upload image');
            }
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
        return $this->model::onlyTrashed()->with('category');
    }
}
