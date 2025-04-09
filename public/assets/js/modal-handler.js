class ModalHandler {
    constructor() {
        this.activeModals = new Set();
        this.eventListeners = {};
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        // Đóng modal khi click ra ngoài
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('fixed') && e.target.classList.contains('inset-0')) {
                this.closeActiveModals();
            }
        });

        // Đóng modal khi nhấn ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeActiveModals();
            }
        });
    }

    open(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            this.activeModals.add(modalId);
        }
    }

    close(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            // Trigger sự kiện 'hide'
            this.triggerEvent(modalId, 'hide');

            modal.classList.add('hidden');
            this.activeModals.delete(modalId);

            // Chỉ restore scroll khi không còn modal nào active
            if (this.activeModals.size === 0) {
                document.body.style.overflow = '';
            }
        }
    }

    closeActiveModals() {
        this.activeModals.forEach(modalId => this.close(modalId));
    }

    // Thêm phương thức đăng ký event listener
    addEventListener(modalId, eventType, callback) {
        if (!this.eventListeners[modalId]) {
            this.eventListeners[modalId] = {};
        }

        if (!this.eventListeners[modalId][eventType]) {
            this.eventListeners[modalId][eventType] = [];
        }

        this.eventListeners[modalId][eventType].push(callback);
    }

    // Phương thức kích hoạt sự kiện
    triggerEvent(modalId, eventType, data = {}) {
        if (this.eventListeners[modalId] && this.eventListeners[modalId][eventType]) {
            this.eventListeners[modalId][eventType].forEach(callback => {
                callback(data);
            });
        }
    }

    // Sửa lại phương thức setEditModalData
    setEditModalData(modalId, data) {
        const form = document.querySelector(`#${modalId} form`);
        if (!form) return;

        // Set action URL
        if (data.actionUrl) {
            form.action = data.actionUrl;
        }

        // Trigger sự kiện 'show' với dữ liệu
        this.triggerEvent(modalId, 'show', data);

        // Set các giá trị input
        Object.keys(data).forEach(key => {
            const input = form.querySelector(`[name="${key}"]`);
            if (input) {
                if (input.type === 'checkbox') {
                    input.checked = data[key];
                } else {
                    input.value = data[key];
                }
            }
        });

        // Xử lý preview ảnh nếu có
        if (data.thumbnail) {
            this.updateThumbnailPreview(data.thumbnail);
        }
    }

    // Thêm các phương thức xử lý ảnh
    showPreview(input) {
        const currentThumbnailDiv = document.getElementById('currentThumbnail');
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                currentThumbnailDiv.innerHTML = `
                    <div class="mt-2">
                        <p class="text-sm text-gray-600 mb-1">Ảnh đã chọn:</p>
                        <img src="${e.target.result}"
                             alt="Preview thumbnail"
                             class="h-20 w-20 object-cover rounded border border-gray-300">
                    </div>
                `;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    updateThumbnailPreview(thumbnailUrl) {
        const currentThumbnailDiv = document.getElementById('currentThumbnail');
        if (currentThumbnailDiv && thumbnailUrl) {
            currentThumbnailDiv.innerHTML = `
                <div class="mt-2">
                    <p class="text-sm text-gray-600 mb-1">Ảnh hiện tại:</p>
                    <img src="${thumbnailUrl}"
                         alt="Current thumbnail"
                         class="h-20 w-20 object-cover rounded border border-gray-300">
                </div>
            `;
        } else if (currentThumbnailDiv) {
            currentThumbnailDiv.innerHTML = '<p class="text-sm text-gray-500">Chưa có ảnh</p>';
        }
    }
}

// Khởi tạo instance và export
const modalHandler = new ModalHandler();

// Thêm event listener cho tất cả các modal khi DOM đã load
document.addEventListener('DOMContentLoaded', function() {
    // Tìm tất cả các modal
    const modals = document.querySelectorAll('.fixed.inset-0.z-50');

    // Thêm event listener cho mỗi modal
    modals.forEach(modal => {
        // Đóng modal khi click vào overlay
        modal.addEventListener('click', function(e) {
            if (e.target === this || e.target.classList.contains('absolute')) {
                modalHandler.close(modal.id);
            }
        });
    });
});
