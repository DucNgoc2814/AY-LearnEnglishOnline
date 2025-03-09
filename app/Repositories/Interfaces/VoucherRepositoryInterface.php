<?php

namespace App\Repositories\Interfaces;

interface VoucherRepositoryInterface extends BaseRepositoryInterface
{
    public function searchByCode($search);  // Tìm kiếm theo mã voucher
} 