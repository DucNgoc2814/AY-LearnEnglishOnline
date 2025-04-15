<?php

namespace App\Repositories\Interfaces;

interface StudentRepositoryInterface extends BaseRepositoryInterface
{
    public function searchByName($search);
    public function findWithFullUrls($id);
}
