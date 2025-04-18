<?php

namespace App\Services\Interfaces;

interface BannerServiceInterface extends BaseServiceInterface
{
    public function searchByName($keyword);
    public function findWithFullUrls($id);
}
