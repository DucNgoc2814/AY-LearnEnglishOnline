<?php

namespace App\Repositories\Interfaces;

interface BannerRepositoryInterface extends BaseRepositoryInterface
{
    public function searchByName($search);
    public function findWithFullUrls($id);
}
