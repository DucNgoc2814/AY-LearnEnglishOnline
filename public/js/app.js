// Show toast notification
function showToast(message, type = 'success') {
    const toast = document.getElementById('liveToast');
    const toastMessage = document.getElementById('toast-message');
    const toastInstance = bootstrap.Toast.getOrCreateInstance(toast);

    // Set message
    toastMessage.textContent = message;

    // Set toast color based on type
    toast.classList.remove('bg-success', 'bg-danger', 'bg-warning', 'bg-info');
    toast.querySelector('.toast-header').innerHTML = '';

    switch (type) {
        case 'success':
            toast.classList.add('bg-success', 'text-white');
            toast.querySelector('.toast-header').innerHTML = '<i class="fas fa-check-circle me-2"></i><strong class="me-auto">Thành công</strong>';
            break;
        case 'error':
            toast.classList.add('bg-danger', 'text-white');
            toast.querySelector('.toast-header').innerHTML = '<i class="fas fa-exclamation-circle me-2"></i><strong class="me-auto">Lỗi</strong>';
            break;
        case 'warning':
            toast.classList.add('bg-warning', 'text-dark');
            toast.querySelector('.toast-header').innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i><strong class="me-auto">Cảnh báo</strong>';
            break;
        case 'info':
            toast.classList.add('bg-info', 'text-white');
            toast.querySelector('.toast-header').innerHTML = '<i class="fas fa-info-circle me-2"></i><strong class="me-auto">Thông báo</strong>';
            break;
    }

    // Show toast
    toastInstance.show();
}

// Global AJAX setup for notifications
$(document).ready(function() {
    // Check if we have a notification from server
    if (typeof serverNotification !== 'undefined' && serverNotification) {
        showToast(serverNotification.message, serverNotification.type);
    }
});