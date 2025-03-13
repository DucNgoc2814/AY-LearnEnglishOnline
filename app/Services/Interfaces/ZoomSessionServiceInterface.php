<?php

namespace App\Services\Interfaces;

interface ZoomSessionServiceInterface extends BaseServiceInterface
{
    public function searchByName($keyword);
}
