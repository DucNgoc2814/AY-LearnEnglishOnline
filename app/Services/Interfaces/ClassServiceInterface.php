<?php

namespace App\Services\Interfaces;

interface ClassServiceInterface extends BaseServiceInterface
{
    public function searchByName($keyword);
}