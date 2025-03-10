<?php

namespace App\Repositories\Interfaces;

interface LessonRepositoryInterface extends BaseRepositoryInterface
{
    public function searchByName($search);
}
