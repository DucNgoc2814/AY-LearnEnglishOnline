<?php

namespace App\Services\Interfaces;

interface TestServiceInterface extends BaseServiceInterface
{
    // Thêm các method đặc thù của Test (nếu có)
    // Các method cơ bản đã được kế thừa từ BaseServiceInterface
    public function searchByName($keyword);
}
