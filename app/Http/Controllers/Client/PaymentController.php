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

    public function showQrPayment(Request $request, $courseSlug = null)
    {
        try {
            // Check if user is authenticated, if not redirect to login with return URL
            if (!session('jwt_token')) {
                // Store the intended URL to return to after login
                session(['intended_url' => url()->current()]);
                return redirect()->route('login')
                    ->with('notification', [
                        'message' => 'Vui lòng đăng nhập để thanh toán khóa học.',
                        'type' => 'info'
                    ]);
            }

            // Kiểm tra nếu không có slug, có thể là tham số rỗng
            if (empty($courseSlug)) {
                \Illuminate\Support\Facades\Log::error('Slug khóa học rỗng');
                return redirect()->route('home')
                    ->with('notification', [
                        'message' => 'Đường dẫn khóa học không hợp lệ.',
                        'type' => 'error'
                    ]);
            }

            // Lấy thông tin khóa học để có giá chính xác
            $course = Course::where('slug', $courseSlug)->first();
            if (!$course) {
                \Illuminate\Support\Facades\Log::error('Không tìm thấy khóa học với slug: ' . $courseSlug);
                return redirect()->route('home')
                    ->with('notification', [
                        'message' => 'Không tìm thấy khóa học với mã: ' . $courseSlug,
                        'type' => 'error'
                    ]);
            }

            // Lấy giá từ course
            $amount = $course->sale_price > 0 ? $course->sale_price : $course->price;

            $sessionKey = "payment_state_{$courseSlug}";
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
                    'amount' => $amount,
                    'courseSlug' => $courseSlug,
                    'courseName' => $course->title
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
                'courseId' => $courseSlug,
                'courseName' => $course->title,
                'startTime' => $paymentState['startTime'],
                'expiryTime' => $paymentState['expiryTime']
            ]);
        } catch (\Exception $e) {
            // Log lỗi chi tiết
            \Illuminate\Support\Facades\Log::error('Lỗi hiển thị trang thanh toán: ' . $e->getMessage());
            \Illuminate\Support\Facades\Log::error('Chi tiết lỗi: ' . $e->getTraceAsString());

            // Nếu có courseSlug, thử redirect về trang chi tiết
            if (!empty($courseSlug)) {
                return redirect()->route('detailCourse', $courseSlug)
                    ->with('notification', [
                        'message' => 'Đã xảy ra lỗi khi tải trang thanh toán. Vui lòng thử lại sau.',
                        'type' => 'error'
                    ]);
            }

            // Nếu không có slug hợp lệ, về trang chủ
            return redirect()->route('home')
                ->with('notification', [
                    'message' => 'Không thể tải trang thanh toán. Vui lòng thử lại sau.',
                    'type' => 'error'
                ]);
        }
    }

    public function checkPaymentExpiry(Request $request)
    {
        // Dùng API nên không cần kiểm tra CSRF
        // Chỉ cần đảm bảo format hợp lệ
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
