<?php

namespace App\Services\Interfaces;

interface LessonServiceInterface extends BaseServiceInterface
{
    public function searchByName($keyword);
}
