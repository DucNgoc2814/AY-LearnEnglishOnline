<?php

namespace App\Services;

use App\Services\Interfaces\VoucherServiceInterface;
use App\Repositories\Interfaces\VoucherRepositoryInterface;

class VoucherService extends BaseService implements VoucherServiceInterface
{
    public function __construct(VoucherRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function searchByCode($keyword)
    {
        try {
            $vouchers = $this->repository->searchByCode($keyword);
            return $this->successResponse($vouchers, 'Tìm kiếm thành công');
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi tìm kiếm');
        }
    }

    public function checkValidVoucher($code)
    {
        try {
            $voucher = $this->repository->findByCode($code);
            if (!$voucher) {
                return $this->errorResponse('Mã giảm giá không tồn tại');
            }
            
            // Kiểm tra hạn sử dụng
            if ($voucher->isExpired()) {
                return $this->errorResponse('Mã giảm giá đã hết hạn');
            }

            return $this->successResponse($voucher, 'Mã giảm giá hợp lệ');
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi kiểm tra mã');
        }
    }
} 