<?php

namespace App\Services\Interfaces;

interface CategoryServiceInterface extends BaseServiceInterface
{
    // Thêm các method đặc thù của Category (nếu có)
    // Các method cơ bản đã được kế thừa từ BaseServiceInterface
    public function searchByName($keyword);
}