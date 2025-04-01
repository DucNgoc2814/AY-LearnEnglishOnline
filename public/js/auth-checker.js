/**
 * Auth checker script for device restriction
 *
 * This script periodically checks if the user is still authenticated
 * and if they are logged in from the current device.
 */
document.addEventListener('DOMContentLoaded', function() {
    // Only run the checker if the user is logged in
    if (document.body.classList.contains('user-logged-in')) {
        // Check auth status every 15 seconds
        setInterval(checkAuthStatus, 15000);
    }
});

/**
 * Check the user's authentication status
 */
function checkAuthStatus() {
    fetch('/check-auth', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        if (!data.authenticated) {
            // Check if someone is trying to login from another device
            if (data.message && data.message.includes('thiết bị khác')) {
                showLogoutNotification(
                    'Có người đang cố gắng đăng nhập vào tài khoản của bạn từ thiết bị khác.<br>Bạn cần đăng xuất nếu muốn đăng nhập ở thiết bị khác.',
                    'danger',
                    'Cảnh báo bảo mật'
                );
            } else {
                showLogoutNotification(
                    data.message || 'Phiên đăng nhập của bạn đã hết hạn. Vui lòng đăng nhập lại.',
                    'info',
                    'Phiên đăng nhập hết hạn'
                );
            }
        }
    })
    .catch(error => {
        console.error('Error checking auth status:', error);
    });
}

/**
 * Display notification and redirect to login page
 *
 * @param {string} message - Message to display
 * @param {string} type - Type of notification (warning, info, error)
 * @param {string} title - Title of the notification
 */
function showLogoutNotification(message, type = 'warning', title = 'Thông báo đăng nhập') {
    // Create modal or notification
    const modalHtml = `
        <div class="modal fade show" id="auth-notification-modal" style="display: block; background: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-${type}">
                        <h5 class="modal-title">${title}</h5>
                    </div>
                    <div class="modal-body">
                        <p>${message}</p>
                        <p>Bạn sẽ được chuyển đến trang đăng nhập trong <span id="countdown">5</span> giây.</p>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Insert modal
    const modalElement = document.createElement('div');
    modalElement.innerHTML = modalHtml;
    document.body.appendChild(modalElement);

    // Clear any session storage
    sessionStorage.removeItem('temp_password');

    // Countdown timer
    let countdown = 5;
    const countdownElement = document.getElementById('countdown');
    const countdownTimer = setInterval(() => {
        countdown--;
        if (countdownElement) {
            countdownElement.textContent = countdown;
        }
        if (countdown <= 0) {
            clearInterval(countdownTimer);
            window.location.href = '/dang-nhap';
        }
    }, 1000);
}
