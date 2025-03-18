<?php

namespace App\Repositories\Interfaces;

interface QuestionLessonTestRepositoryInterface extends BaseRepositoryInterface
{
    public function searchByName($search);
}
