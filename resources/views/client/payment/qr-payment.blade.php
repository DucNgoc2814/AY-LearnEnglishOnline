@extends('client.layouts.master')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-header bg-warning bg-opacity-10">
                        <div class="d-flex align-items-center">
                            <span class="me-2">⏰</span>
                            <span>Đơn hàng sẽ hết hạn sau: <span id="countdown" class="fw-bold">15:00</span></span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 text-center mb-4 mb-md-0">
                                <h4 class="mb-3">Quét mã QR để thanh toán</h4>
                                <img src="{{ $qrCodeUrl }}" alt="QR Code" class="img-fluid" style="max-width: 200px;">
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="list-group">
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Ngân hàng: {{ $bankName }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Số tài khoản: {{ $accountNumber }}</span>
                                        <button class="btn btn-sm btn-outline-secondary" onclick="copyToClipboard('{{ $accountNumber }}')">
                                            <i class="far fa-copy"></i>
                                        </button>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Chủ tài khoản: {{ $accountName }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Số tiền: {{ number_format($amount) }}đ</span>
                                        <button class="btn btn-sm btn-outline-secondary" onclick="copyToClipboard('{{ $amount }}')">
                                            <i class="far fa-copy"></i>
                                        </button>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>Nội dung: {{ $transferCode }}</span>
                                        <button class="btn btn-sm btn-outline-secondary" onclick="copyToClipboard('{{ $transferCode }}')">
                                            <i class="far fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <small class="text-muted">
                                    Lưu ý: Nếu đơn hàng không tự kích hoạt sau 5 phút, vui lòng liên hệ 0989.773.571
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const countdownElement = document.getElementById('countdown');
            const courseId = '{{ $courseId }}';
            const transferCode = '{{ $transferCode }}';
            const serverStartTime = {{ $startTime }};
            const serverExpiryTime = {{ $expiryTime }};
            
            // Hàm để lưu trạng thái thanh toán
            function savePaymentState() {
                const paymentState = {
                    startTime: serverStartTime,
                    expiryTime: serverExpiryTime,
                    courseId: courseId,
                    transferCode: transferCode,
                    previousUrl: document.referrer && !document.referrer.includes(window.location.pathname) 
                        ? document.referrer 
                        : localStorage.getItem(`previous_url_${courseId}`) || '/'
                };
                
                // Lưu state vào localStorage
                localStorage.setItem('payment_state', JSON.stringify(paymentState));
                return paymentState;
            }

            // Hàm để lấy trạng thái thanh toán
            function getPaymentState() {
                const stateStr = localStorage.getItem('payment_state');
                if (!stateStr) return null;
                
                try {
                    const state = JSON.parse(stateStr);
                    // Kiểm tra xem state có khớp với phiên hiện tại không
                    if (state.courseId === courseId && 
                        state.transferCode === transferCode && 
                        state.startTime === serverStartTime) {
                        return state;
                    }
                    return null;
                } catch (e) {
                    return null;
                }
            }

            // Lấy hoặc tạo state
            let paymentState = getPaymentState() || savePaymentState();

            function updateCountdown() {
                const now = Date.now();
                const timeLeft = paymentState.expiryTime - now;
                
                if (timeLeft <= 0) {
                    clearInterval(interval);
                    clearInterval(checkPaymentStatus);
                    
                    // Xóa state khi hết hạn
                    localStorage.removeItem('payment_state');
                    
                    alert('Phiên thanh toán đã hết hạn!');
                    window.location.href = paymentState.previousUrl;
                    return;
                }

                const minutes = Math.floor(timeLeft / 60000);
                const seconds = Math.floor((timeLeft % 60000) / 1000);
                countdownElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
            }

            // Cập nhật countdown mỗi giây
            const interval = setInterval(updateCountdown, 1000);
            updateCountdown();

            // Kiểm tra trạng thái thanh toán mỗi 30 giây
            const checkPaymentStatus = setInterval(async () => {
                try {
                    const response = await fetch('{{ route('payment.check-expiry') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            start_time: paymentState.startTime,
                            course_id: courseId
                        })
                    });
                    
                    const data = await response.json();
                    
                    if (data.expired) {
                        clearInterval(checkPaymentStatus);
                        clearInterval(interval);
                        
                        // Xóa state
                        localStorage.removeItem('payment_state');
                        
                        alert('Phiên thanh toán đã hết hạn!');
                        window.location.href = paymentState.previousUrl;
                    }
                } catch (error) {
                    console.error('Error checking payment status:', error);
                }
            }, 30000);

            // Cleanup khi rời trang
            window.addEventListener('beforeunload', (event) => {
                // Chỉ xóa state khi thực sự rời khỏi trang (không phải refresh)
                if (!event.currentTarget.performance.navigation.back_forward && 
                    !document.hidden && 
                    !window.location.href.includes(window.location.pathname)) {
                    localStorage.removeItem('payment_state');
                }
            });

            // Hàm copy text được cải tiến
            window.copyToClipboard = function(text) {
                // Phương pháp 1: Sử dụng Clipboard API
                if (navigator.clipboard && window.isSecureContext) {
                    navigator.clipboard.writeText(text).then(() => {
                        showNotification('Đã sao chép!', 'success');
                    }).catch(() => {
                        // Nếu Clipboard API thất bại, thử phương pháp 2
                        fallbackCopyToClipboard(text);
                    });
                } else {
                    // Nếu không có Clipboard API, sử dụng phương pháp 2
                    fallbackCopyToClipboard(text);
                }
            }

            // Phương pháp fallback sử dụng textarea
            function fallbackCopyToClipboard(text) {
                try {
                    // Tạo element textarea tạm thời
                    const textArea = document.createElement('textarea');
                    textArea.value = text;
                    
                    // Đảm bảo textarea không hiển thị
                    textArea.style.position = 'fixed';
                    textArea.style.left = '-999999px';
                    textArea.style.top = '-999999px';
                    document.body.appendChild(textArea);
                    
                    // Lưu vị trí focus hiện tại
                    const focused = document.activeElement;
                    
                    // Select và copy text
                    textArea.focus();
                    textArea.select();
                    
                    try {
                        document.execCommand('copy');
                        textArea.remove();
                        showNotification('Đã sao chép!', 'success');
                        
                        // Khôi phục focus
                        if (focused && typeof focused.focus === 'function') {
                            focused.focus();
                        }
                    } catch (err) {
                        textArea.remove();
                        showNotification('Không thể sao chép. Vui lòng thử lại!', 'error');
                    }
                } catch (err) {
                    showNotification('Không thể sao chép. Vui lòng thử lại!', 'error');
                }
            }

            // Thêm hàm showNotification nếu chưa có
            function showNotification(message, type = 'success') {
                const notification = document.createElement('div');
                notification.className = `notification ${type}`;
                notification.textContent = message;
                
                // Style cho notification
                Object.assign(notification.style, {
                    position: 'fixed',
                    top: '20px',
                    right: '20px',
                    padding: '12px 24px',
                    borderRadius: '4px',
                    zIndex: '9999',
                    backgroundColor: type === 'success' ? '#4caf50' : '#f44336',
                    color: 'white',
                    boxShadow: '0 2px 5px rgba(0,0,0,0.2)',
                    transition: 'opacity 0.3s ease-in-out'
                });

                document.body.appendChild(notification);

                // Tự động ẩn sau 3 giây
                setTimeout(() => {
                    notification.style.opacity = '0';
                    setTimeout(() => {
                        notification.remove();
                    }, 300);
                }, 3000);
            }
        });
    </script>

    <style>
        .notification {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
@endpush
