<?php

namespace App\Services\Interfaces;

interface VoucherServiceInterface extends BaseServiceInterface
{
    // Thêm các method đặc thù của Voucher
    public function searchByCode($keyword);
    public function checkValidVoucher($code); // Kiểm tra voucher còn hạn không
} 