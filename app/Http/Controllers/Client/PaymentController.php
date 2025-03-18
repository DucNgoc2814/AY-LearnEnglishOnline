<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Models\Course;
use Illuminate\Http\Request;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Carbon\Carbon;
use App\Models\Payment;

/**
 * @package App\Http\Controllers\Client
 * @author Assistant
 * @description Handles course functionality for client users
 */
class PaymentController extends BaseController
{

    public function showQrPayment(Request $request, $course)
    {
        $sessionKey = "payment_state_{$course}";
        $paymentState = session($sessionKey);
        
        // Chỉ tạo mã mới nếu chưa có hoặc đã hết hạn
        if (!$paymentState || now()->timestamp * 1000 > $paymentState['expiryTime']) {
            // Tạo mã chuyển khoản ngẫu nhiên
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $transferCode = '';
            for ($i = 0; $i < 10; $i++) {
                $transferCode .= $characters[rand(0, strlen($characters) - 1)];
            }
            
            $paymentState = [
                'transferCode' => $transferCode,
                'startTime' => now()->timestamp * 1000,
                'expiryTime' => now()->addMinutes(15)->timestamp * 1000,
                'amount' => $request->amount
            ];
            
            session([$sessionKey => $paymentState]);
        }

        // Tạo QR code
        $qrCodeUrl = $this->generateQrCode([
            'amount' => $paymentState['amount'],
            'content' => $paymentState['transferCode']
        ]);

        return view('client.payment.qr-payment', [
            'qrCodeUrl' => $qrCodeUrl,
            'bankName' => 'MB Bank',
            'accountNumber' => '0989773571',
            'accountName' => 'PHUNG DUC NGOC',
            'amount' => $paymentState['amount'],
            'transferCode' => $paymentState['transferCode'],
            'courseId' => $course,
            'startTime' => $paymentState['startTime'],
            'expiryTime' => $paymentState['expiryTime']
        ]);
    }

    public function checkPaymentExpiry(Request $request)
    {
        $startTime = $request->input('start_time');
        $courseId = $request->input('course_id');
        
        if (!$startTime || !$courseId) {
            return response()->json(['expired' => true]);
        }

        $sessionKey = "payment_state_{$courseId}";
        $paymentState = session($sessionKey);
        
        // Kiểm tra xem session có tồn tại và còn hạn không
        if (!$paymentState || now()->timestamp * 1000 > $paymentState['expiryTime']) {
            session()->forget($sessionKey);
            return response()->json(['expired' => true]);
        }
        
        return response()->json([
            'expired' => false,
            'remaining' => max(0, ($paymentState['expiryTime'] - (now()->timestamp * 1000)) / 1000)
        ]);
    }

    protected function generateQrCode(array $data): string
    {
        $amount = preg_replace('/[^0-9]/', '', $data['amount']);
        $content = urlencode($data['content']);
        return sprintf(
            "https://api.vietqr.io/image/970422-%s-rWlQCwc.jpg?accountName=%s&amount=%s&addInfo=%s",
            "0989773571",              
            urlencode("PHUNG DUC NGOC"), 
            $amount,       
            $content
        );
    }
}
