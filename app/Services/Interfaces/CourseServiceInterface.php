<?php

namespace App\Services\Interfaces;

interface CourseServiceInterface extends BaseServiceInterface
{
    public function searchByName($keyword);
    public function findWithFullUrls($id);
}
