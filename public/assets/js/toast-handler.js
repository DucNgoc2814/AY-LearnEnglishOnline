/**
 * Toast Handler - Thư viện hiển thị thông báo đơn giản không phụ thuộc jQuery
 */
const ToastHandler = (function() {
    // Màu sắc cho các loại thông báo
    const COLORS = {
        success: '#28a745',
        error: '#dc3545',
        warning: '#ffc107',
        info: '#17a2b8'
    };

    // Các options mặc định
    const DEFAULT_OPTIONS = {
        duration: 5000,      // Thời gian hiển thị (ms)
        position: 'top-right',   // Vị trí hiển thị
        showProgress: true,  // Hiển thị thanh tiến trình
        closeButton: true    // Hiển thị nút đóng
    };

    // Khởi tạo container để chứa các toast
    function createContainer(position) {
        const container = document.createElement('div');
        container.className = 'toast-container toast-' + position;
        container.style.cssText = `
            position: fixed;
            z-index: 9999;
            padding: 15px;
            display: flex;
            flex-direction: column;
            max-width: 350px;
        `;

        // Đặt vị trí dựa trên tùy chọn
        switch(position) {
            case 'top-right':
                container.style.top = '1rem';
                container.style.right = '1rem';
                break;
            case 'top-left':
                container.style.top = '1rem';
                container.style.left = '1rem';
                break;
            case 'bottom-right':
                container.style.bottom = '1rem';
                container.style.right = '1rem';
                container.style.flexDirection = 'column-reverse';
                break;
            case 'bottom-left':
                container.style.bottom = '1rem';
                container.style.left = '1rem';
                container.style.flexDirection = 'column-reverse';
                break;
            case 'top-center':
                container.style.top = '1rem';
                container.style.left = '50%';
                container.style.transform = 'translateX(-50%)';
                break;
            case 'bottom-center':
                container.style.bottom = '1rem';
                container.style.left = '50%';
                container.style.transform = 'translateX(-50%)';
                container.style.flexDirection = 'column-reverse';
                break;
        }

        document.body.appendChild(container);
        return container;
    }

    // Lấy hoặc tạo container cho một vị trí cụ thể
    function getContainer(position) {
        const containerId = 'toast-container-' + position;
        let container = document.getElementById(containerId);

        if (!container) {
            container = createContainer(position);
            container.id = containerId;
        }

        return container;
    }

    // Tạo một toast element
    function createToast(message, type, options) {
        // Kết hợp options
        const opts = {...DEFAULT_OPTIONS, ...options};
        const color = COLORS[type] || COLORS.info;

        // Tạo toast element
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.style.cssText = `
            background-color: white;
            color: #333;
            border-radius: 4px;
            padding: 15px 20px 15px 15px;
            margin: 5px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            border-left: 5px solid ${color};
            width: 100%;
            max-width: 350px;
            display: flex;
            align-items: flex-start;
            opacity: 0;
            transform: translateX(20px);
        `;

        // Thêm icon dựa trên type
        let icon = '';
        switch(type) {
            case 'success':
                icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #28a745; margin-right: 10px;"><circle cx="12" cy="12" r="10"></circle><path d="M8 12l2 2 6-6"></path></svg>';
                break;
            case 'error':
                icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #dc3545; margin-right: 10px;"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>';
                break;
            case 'warning':
                icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #ffc107; margin-right: 10px;"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>';
                break;
            case 'info':
                icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #17a2b8; margin-right: 10px;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>';
                break;
        }

        // Nút đóng
        let closeButton = '';
        if (opts.closeButton) {
            closeButton = `
                <button class="toast-close" style="
                    position: absolute;
                    top: 10px;
                    right: 10px;
                    background: transparent;
                    border: none;
                    color: #999;
                    font-size: 16px;
                    cursor: pointer;
                ">×</button>
            `;
        }

        // Thanh tiến trình
        let progressBar = '';
        if (opts.showProgress) {
            progressBar = `
                <div class="toast-progress" style="
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    width: 100%;
                    height: 4px;
                    background-color: ${color};
                    opacity: 0.3;
                ">
                    <div class="toast-progress-bar" style="
                        height: 100%;
                        width: 100%;
                        background-color: ${color};
                        transition: width linear ${opts.duration}ms;
                    "></div>
                </div>
            `;
        }

        // Nội dung toast
        toast.innerHTML = `
            <div style="display: flex; align-items: flex-start;">
                ${icon}
                <div style="flex: 1; word-break: break-word;">${message}</div>
            </div>
            ${closeButton}
            ${progressBar}
        `;

        // Xử lý sự kiện đóng
        if (opts.closeButton) {
            const closeBtn = toast.querySelector('.toast-close');
            closeBtn.addEventListener('click', () => {
                closeToast(toast);
            });
        }

        return toast;
    }

    // Hiển thị toast
    function showToast(message, type, options = {}) {
        const opts = {...DEFAULT_OPTIONS, ...options};
        const toast = createToast(message, type, opts);
        const container = getContainer(opts.position);
        container.appendChild(toast);

        // Hiệu ứng hiển thị
        setTimeout(() => {
            toast.style.opacity = '1';
            toast.style.transform = 'translateX(0)';
        }, 10);

        // Ẩn thanh tiến trình
        if (opts.showProgress) {
            const progressBar = toast.querySelector('.toast-progress-bar');
            if (progressBar) {
                setTimeout(() => {
                    progressBar.style.width = '0';
                }, 10);
            }
        }

        // Tự động đóng sau một khoảng thời gian
        if (opts.duration > 0) {
            setTimeout(() => {
                closeToast(toast);
            }, opts.duration);
        }

        return toast;
    }

    // Đóng toast
    function closeToast(toast) {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(20px)';

        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }

    // API công khai
    return {
        success: function(message, options = {}) {
            return showToast(message, 'success', options);
        },
        error: function(message, options = {}) {
            return showToast(message, 'error', options);
        },
        warning: function(message, options = {}) {
            return showToast(message, 'warning', options);
        },
        info: function(message, options = {}) {
            return showToast(message, 'info', options);
        },
        show: function(message, type, options = {}) {
            return showToast(message, type, options);
        },
        close: function(toast) {
            closeToast(toast);
        },
        closeAll: function() {
            document.querySelectorAll('.toast-container').forEach(container => {
                container.querySelectorAll('.toast').forEach(toast => {
                    closeToast(toast);
                });
            });
        }
    };
})();

// Thêm toastr global để tương thích với các code cũ
window.toastr = {
    success: function(message, title, options) {
        return ToastHandler.success(message, options);
    },
    error: function(message, title, options) {
        return ToastHandler.error(message, options);
    },
    warning: function(message, title, options) {
        return ToastHandler.warning(message, options);
    },
    info: function(message, title, options) {
        return ToastHandler.info(message, options);
    },
    options: {
        closeButton: true,
        progressBar: true,
        positionClass: 'toast-top-right',
        timeOut: 5000
    }
};
