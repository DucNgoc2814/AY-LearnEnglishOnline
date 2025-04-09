<?php

namespace App\Services\Interfaces;

interface VideoLessonServiceInterface extends BaseServiceInterface
{
    public function searchByName($keyword);
    public function findWithFullUrls($id);
}
