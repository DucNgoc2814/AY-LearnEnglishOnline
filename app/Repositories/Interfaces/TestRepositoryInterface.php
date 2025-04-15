<?php

namespace App\Repositories\Interfaces;

interface TestRepositoryInterface extends BaseRepositoryInterface
{
    public function searchByName($search);

    /**
     * Lấy danh sách câu hỏi theo bài test
     *
     * @param int $testId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getQuestionsByTestId($testId);
}
