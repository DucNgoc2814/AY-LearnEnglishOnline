<?php

namespace App\Services\Interfaces;

interface AnswerLessonTestServiceInterface extends BaseServiceInterface
{
    public function searchByName($keyword);
}
