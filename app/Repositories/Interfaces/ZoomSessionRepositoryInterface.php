<?php

namespace App\Repositories\Interfaces;

interface ZoomSessionRepositoryInterface extends BaseRepositoryInterface
{
    public function searchByName($search);
}
