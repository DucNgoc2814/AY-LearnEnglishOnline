// Show notification using Toastify
function showNotification(message, type = 'success') {
    // Định nghĩa màu sắc cho các loại thông báo
    const colors = {
        'success': '#22c55e', // Green
        'error': '#ef4444',   // Red
        'warning': '#f59e0b', // Yellow/Amber
        'info': '#3b82f6'     // Blue
    };

    // Định nghĩa icon cho các loại thông báo
    const icons = {
        'success': '<i class="fas fa-check-circle me-2"></i>',
        'error': '<i class="fas fa-exclamation-circle me-2"></i>',
        'warning': '<i class="fas fa-exclamation-triangle me-2"></i>',
        'info': '<i class="fas fa-info-circle me-2"></i>'
    };

    // Cấu hình và hiển thị thông báo
    Toastify({
        text: message,
        duration: 3000,
        close: true,
        gravity: "top", // Hiển thị ở trên cùng
        position: "right", // Hiển thị bên phải
        backgroundColor: colors[type] || colors.success,
        stopOnFocus: true,
        className: "toastify-custom",
        onClick: function(){} // Callback khi click vào thông báo
    }).showToast();
}

// Check for notification in meta tag
document.addEventListener('DOMContentLoaded', function() {
    const notificationMeta = document.querySelector('meta[name="notification"]');
    if (notificationMeta) {
        try {
            const notification = JSON.parse(notificationMeta.content);
            showNotification(notification.message, notification.type);
        } catch (e) {
            console.error('Error parsing notification:', e);
        }
    }
});

// Expose function globally
window.showNotification = showNotification;