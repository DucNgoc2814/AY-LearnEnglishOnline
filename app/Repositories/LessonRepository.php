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

    public function delete($id)
    {
        try {
            $lesson = $this->findById($id);
            if ($lesson) {
                $courseId = $lesson->courseId; // Lưu courseId trước khi xóa
                $lesson->delete();
                return [
                    'status' => true,
                    'message' => 'Xóa bài học thành công',
                    'data' => [
                        'courseId' => $courseId
                    ]
                ];
            }
            return [
                'status' => false,
                'message' => 'Không tìm thấy bài học'
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi xóa bài học'
            ];
        }
    }

    public function restore($id)
    {
        try {
            $lesson = $this->findWithTrashed($id);
            if ($lesson) {
                $courseId = $lesson->courseId; // Lưu courseId trước khi khôi phục
                $lesson->restore();
                return [
                    'status' => true,
                    'message' => 'Khôi phục bài học thành công',
                    'data' => [
                        'courseId' => $courseId
                    ]
                ];
            }
            return [
                'status' => false,
                'message' => 'Không tìm thấy bài học'
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'Có lỗi xảy ra khi khôi phục bài học'
            ];
        }
    }
}
