<?php

namespace App\Repositories\Interfaces;

interface TestRepositoryInterface extends BaseRepositoryInterface
{
    public function searchByName($search);
}