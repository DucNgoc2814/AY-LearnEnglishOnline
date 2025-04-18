<?php

namespace App\Repositories\Interfaces;

interface ClassRepositoryInterface extends BaseRepositoryInterface
{
    public function searchByName($search);
}