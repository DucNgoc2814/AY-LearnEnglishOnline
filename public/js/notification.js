const showNotification = (message, type = 'success') => {
    Toastify({
        text: message,
        duration: 3000,
        gravity: "top",
        position: "right",
        stopOnFocus: true,
        className: `custom-toast ${type}`,
        style: {
            background: type === 'success' 
                ? "linear-gradient(to right, #28a745, #218838)"
                : "linear-gradient(to right, #dc3545, #c82333)",
            borderRadius: "8px",
            padding: "12px 24px",
            fontSize: "14px",
            fontWeight: "500",
            boxShadow: "0 3px 10px rgba(0,0,0,0.1)"
        }
    }).showToast();
};

// Expose to window object to use globally
window.showNotification = showNotification;

document.addEventListener('DOMContentLoaded', function() {
    const notification = document.querySelector('meta[name="notification"]');
    if (notification) {
        try {
            const data = JSON.parse(notification.getAttribute('content'));
            if (data && data.message) {
                showNotification(data.message, data.type || 'success');
            }
        } catch (error) {
            console.error('Error parsing notification:', error);
        }
    }
});