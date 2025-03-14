<?php

namespace App\Services\Interfaces;

interface LessonTestServiceInterface extends BaseServiceInterface
{
    public function searchByName($keyword);
}
