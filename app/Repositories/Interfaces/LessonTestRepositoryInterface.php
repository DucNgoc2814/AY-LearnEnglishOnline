<?php

namespace App\Repositories\Interfaces;

interface LessonTestRepositoryInterface extends BaseRepositoryInterface
{
    public function searchByName($search);
}
