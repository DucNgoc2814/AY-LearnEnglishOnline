<?php

namespace App\Repositories\Interfaces;

interface AnswerLessonTestRepositoryInterface extends BaseRepositoryInterface
{
    public function searchByName($search);
}
