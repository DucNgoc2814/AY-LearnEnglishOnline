<?php

namespace App\Services\Interfaces;

interface QuestionLessonTestServiceInterface extends BaseServiceInterface
{
    public function searchByName($keyword);
}
