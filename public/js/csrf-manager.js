/**
 * CSRF Token Manager
 * Handles preservation and restoration of CSRF tokens across page transitions
 */

(function() {
    // Save current CSRF token before leaving the page
    function saveCsrfToken() {
        const metaToken = document.querySelector('meta[name="csrf-token"]');
        if (metaToken && metaToken.content) {
            sessionStorage.setItem('saved_csrf_token', metaToken.content);
        }
    }

    // Restore CSRF token if available
    function restoreCsrfToken() {
        const savedToken = sessionStorage.getItem('saved_csrf_token');
        if (!savedToken) return;

        // Update meta tag
        const metaTag = document.querySelector('meta[name="csrf-token"]');
        if (metaTag) {
            metaTag.content = savedToken;
        }

        // Update all CSRF input fields in forms
        const csrfInputs = document.querySelectorAll('input[name="_token"]');
        csrfInputs.forEach(input => {
            input.value = savedToken;
        });

        // Don't remove the token yet - we'll keep it until form submission
    }

    // Handle page unload events
    window.addEventListener('beforeunload', function() {
        saveCsrfToken();
    });

    // Form submission handler to ensure fresh CSRF tokens
    function handleFormSubmit(e) {
        // Remove saved token after form is submitted
        // This ensures we don't reuse the same token multiple times
        sessionStorage.removeItem('saved_csrf_token');
    }

    // Check if we should prevent page refresh loops
    function shouldPreventRefresh() {
        const lastRefreshTime = sessionStorage.getItem('last_refresh_time');
        const now = Date.now();

        if (lastRefreshTime) {
            const timeSinceLastRefresh = now - parseInt(lastRefreshTime);
            // Nếu đã refresh trong vòng 3 giây qua, ngăn refresh tiếp
            if (timeSinceLastRefresh < 3000) {
                console.log('Preventing refresh loop - last refresh was ' + (timeSinceLastRefresh/1000) + ' seconds ago');
                return true;
            }
        }

        // Cập nhật thời gian refresh gần nhất
        sessionStorage.setItem('last_refresh_time', now.toString());
        return false;
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        // First restore any saved token
        restoreCsrfToken();

        // Attach submit handler to all forms
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', handleFormSubmit);
        });

        // Kiểm tra nếu đang ở trang mua khóa học hoặc đăng nhập, đừng làm gì cả để tránh vòng lặp
        const currentUrl = window.location.href;
        if (currentUrl.includes('dang-nhap') ||
            currentUrl.includes('thanh-toan') ||
            currentUrl.includes('khoa-hoc') ||
            document.getElementById('payment-container') !== null) {
            console.log('On course, payment or login page, skipping refresh checks');
            return;
        }

        // If we're on a page with a 419 status, refresh to get a new token
        if (document.title.includes('419') ||
            document.body.textContent.includes('PAGE EXPIRED') ||
            document.body.textContent.includes('419')) {

            console.log('Detected 419 PAGE EXPIRED...');

            // Kiểm tra số lần đã refresh để tránh lặp vô hạn
            const refreshCount = parseInt(sessionStorage.getItem('csrf_refresh_count') || '0');

            if (refreshCount >= 2 || shouldPreventRefresh()) {
                console.log('Too many refresh attempts, redirecting to home...');
                sessionStorage.removeItem('csrf_refresh_count');
                sessionStorage.removeItem('last_refresh_time');
                window.location.href = '/';
                return;
            }

            // Tăng số lần refresh
            sessionStorage.setItem('csrf_refresh_count', (refreshCount + 1).toString());

            // Không chuyển hướng nếu đang trong quá trình thanh toán
            if (sessionStorage.getItem('in_payment_process') === 'true') {
                console.log('In payment process, staying on current page');
                window.location.reload();
                return;
            }

            // Use the home page as a safe redirect
            console.log('Redirecting to home page to get fresh tokens');
            window.location.href = '/';
        } else {
            // Đã tải trang thành công, reset counter
            sessionStorage.removeItem('csrf_refresh_count');
            sessionStorage.removeItem('last_refresh_time');

            // Nếu trang hợp lệ, lưu URL vào sessionStorage
            if (!window.location.href.includes('419') &&
                !window.location.href.includes('expired') &&
                !window.location.href.includes('dang-xuat')) {
                sessionStorage.setItem('last_valid_url', window.location.href);
            }
        }
    });

    // Xử lý tất cả các request AJAX để bắt lỗi 419
    const originalXHR = window.XMLHttpRequest;
    window.XMLHttpRequest = function() {
        const xhr = new originalXHR();

        // Override the original open method
        const originalOpen = xhr.open;
        xhr.open = function() {
            const result = originalOpen.apply(xhr, arguments);

            // Listen for 419 response
            xhr.addEventListener('load', function() {
                if (xhr.status === 419) {
                    console.log('XHR request failed with 419 - not redirecting');

                    // Save current CSRF token
                    saveCsrfToken();

                    // Không tự động chuyển hướng nữa, chỉ lưu token
                    // Nếu cần refresh thì comment 2 dòng dưới và uncomment đoạn code chuyển hướng

                    // if (!shouldPreventRefresh()) {
                    //     window.location.href = '/';
                    // }
                }
            });

            return result;
        };

        return xhr;
    };

    // Cải thiện fetch override để bắt lỗi 419
    const originalFetch = window.fetch;
    window.fetch = function(url, options = {}) {
        // Chỉ thêm token cho các request POST, PUT, DELETE
        if (options.method && ['POST', 'PUT', 'DELETE'].includes(options.method.toUpperCase())) {
            // Lấy token từ meta tag
            const token = document.querySelector('meta[name="csrf-token"]')?.content;

            if (token) {
                // Khởi tạo headers nếu chưa có
                if (!options.headers) {
                    options.headers = {};
                }

                // Chuyển đổi Headers object thành object thông thường nếu cần
                if (options.headers instanceof Headers) {
                    const originalHeaders = options.headers;
                    options.headers = {};

                    for (const [key, value] of originalHeaders.entries()) {
                        options.headers[key] = value;
                    }
                }

                // Thêm CSRF token vào headers
                options.headers['X-CSRF-TOKEN'] = token;
            }
        }

        // Wrap the original fetch to catch 419 responses
        return originalFetch(url, options).then(response => {
            if (response.status === 419) {
                console.log('Fetch request failed with 419 - not redirecting');

                // Save current CSRF token
                saveCsrfToken();

                // Không tự động chuyển hướng nữa, chỉ lưu token
                // if (!shouldPreventRefresh()) {
                //     window.location.href = '/';
                // }

                // Reject with error
                return Promise.reject(new Error('CSRF token mismatch'));
            }
            return response;
        });
    };
})();
