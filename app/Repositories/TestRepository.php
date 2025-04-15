<?php

namespace App\Repositories;

use App\Models\Test;
use App\Models\Question;
use App\Repositories\Interfaces\TestRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TestRepository extends BaseRepository implements TestRepositoryInterface
{
    protected $table = 'tests';
    protected $model;

    public function __construct()
    {
        $this->model = new Test();
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
        return $this->model::onlyTrashed();
    }

    /**
     * Lấy danh sách câu hỏi theo bài test
     *
     * @param int $testId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getQuestionsByTestId($testId)
    {
        try {
            Log::info('TestRepository: getQuestionsByTestId called with ID: ' . $testId);
            $questions = Question::where('test_id', $testId)
                ->with('answers')
                ->orderBy('order_number', 'asc')
                ->get();

            Log::info('TestRepository: questions count: ' . count($questions));
            return $questions;
        } catch (\Exception $e) {
            Log::error('Error in TestRepository getQuestionsByTestId: ' . $e->getMessage(), [
                'test_id' => $testId,
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
