<?php

namespace App\Services\Interfaces;

interface StudentServiceInterface extends BaseServiceInterface
{
    public function searchByName($keyword);
    public function findWithFullUrls($id);
}
