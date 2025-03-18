<?php

namespace App\Repositories\Interfaces;

interface VideoLessonRepositoryInterface extends BaseRepositoryInterface
{
    public function searchByName($search);
}
