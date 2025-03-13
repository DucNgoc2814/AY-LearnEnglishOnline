<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Models\Course;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * @package App\Http\Controllers\Client
 * @author Assistant
 * @description Handles course functionality for client users
 */
class VoucherController extends BaseController
{
    /**
     * Display the homepage
     *
     * @return \Illuminate\View\View
     */
    public function applyCoupon(Request $request)
    {
        try {
            $request->validate([
                'coupon_code' => 'required|string',
                'slug' => 'required|string'
            ]);

            // Kiểm tra mã giảm giá
            $voucher = Voucher::where('code', $request->coupon_code)
                ->whereNull('deleted_at')
                ->where('startDate', '<=', now())
                ->where('endDate', '>=', now())
                ->first();

            if (!$voucher) {
                return response()->json([
                    'status' => false,
                    'message' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn'
                ]);
            }

            $course = Course::where('slug', $request->slug)->first();
            $originalPrice = $course->salePrice;
            
            // Tính giá sau khi giảm
            $discountAmount = ($originalPrice * $voucher->sale) / 100;
            $finalPrice = $originalPrice - $discountAmount;

            // Kiểm tra số lần sử dụng nếu có giới hạn
            if ($voucher->maxUsage && $voucher->usageCount >= $voucher->maxUsage) {
                return response()->json([
                    'status' => false,
                    'message' => 'Mã giảm giá đã hết lượt sử dụng'
                ]);
            }

            // Cập nhật số lần sử dụng
            $voucher->increment('usageCount');

            return response()->json([
                'status' => true,
                'message' => 'Áp dụng mã giảm giá thành công!',
                'data' => [
                    'final_price' => $finalPrice,
                    'discount_amount' => $discountAmount,
                    'discount_percent' => $voucher->sale
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Voucher application error: ' . $e->getMessage());
            
            return response()->json([
                'status' => false,
                'message' => 'Có lỗi xảy ra khi áp dụng mã giảm giá'
            ]);
        }
    }

   
}
