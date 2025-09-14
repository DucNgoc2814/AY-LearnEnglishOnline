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

// Sortable initialization for sentence practice
document.addEventListener('DOMContentLoaded', function() {
    const sortableContainer = document.getElementById('sortable-sentences');
    if (!sortableContainer) return;

    // Initialize Sortable
    new Sortable(sortableContainer, {
        animation: 150,
        handle: '.drag-handle',
        ghostClass: 'dragging',
        onEnd: function() {
            // Remove any existing feedback classes
            document.querySelectorAll('.sentence-item').forEach(item => {
                item.classList.remove('correct', 'incorrect');
            });
        }
    });

    // Handle order checking
    const checkOrderBtn = document.getElementById('check-order-btn');
    if (checkOrderBtn) {
        checkOrderBtn.addEventListener('click', function() {
            const sentenceItems = document.querySelectorAll('.sentence-item');
            let isCorrect = true;

            // Check if sentences are in correct order
            sentenceItems.forEach((item, index) => {
                const correctOrder = parseInt(item.dataset.sentenceOrder);
                const isItemCorrect = correctOrder === (index + 1);

                // Add visual feedback
                item.classList.remove('correct', 'incorrect');
                item.classList.add(isItemCorrect ? 'correct' : 'incorrect');

                if (!isItemCorrect) {
                    isCorrect = false;
                }
            });

            // Enable/disable controls based on order correctness
            const audioPlayers = document.querySelectorAll('.original-audio');
            const recordButtons = document.querySelectorAll('.record-btn');
            const historyButtons = document.querySelectorAll('.history-btn');

            audioPlayers.forEach(player => player.disabled = !isCorrect);
            recordButtons.forEach(button => button.disabled = !isCorrect);
            historyButtons.forEach(button => button.disabled = !isCorrect);

            // Show feedback message
            Swal.fire({
                icon: isCorrect ? 'success' : 'error',
                title: isCorrect ? 'Correct!' : 'Try Again!',
                text: isCorrect
                    ? 'Great job! Now you can practice pronouncing the sentences.'
                    : 'The sentences are not in the correct order. Please try again.',
                confirmButtonText: 'OK'
            });
        });
    }
});

function initializeSortable() {
    const container = document.getElementById('sortable-sentences');
    if (!container) return;

    const items = container.getElementsByClassName('sortable-item');
    const correctOrder = Array.from(items).map(item => item.dataset.id);

    // Store original order for reset
    window.originalOrder = Array.from(items).map(item => item.outerHTML);

    for (const item of items) {
        item.addEventListener('dragstart', handleDragStart);
        item.addEventListener('dragend', handleDragEnd);
        item.addEventListener('dragover', handleDragOver);
        item.addEventListener('drop', handleDrop);
    }
}

function handleDragStart(e) {
    this.classList.add('dragging');
    e.dataTransfer.setData('text/plain', this.dataset.id);
}

function handleDragEnd(e) {
    this.classList.remove('dragging');
}

function handleDragOver(e) {
    e.preventDefault();
    const draggingItem = document.querySelector('.dragging');
    const container = document.getElementById('sortable-sentences');
    const afterElement = getDragAfterElement(container, e.clientY);

    if (afterElement) {
        container.insertBefore(draggingItem, afterElement);
    } else {
        container.appendChild(draggingItem);
    }
}

function handleDrop(e) {
    e.preventDefault();
}

function getDragAfterElement(container, y) {
    const draggableElements = [...container.querySelectorAll('.sortable-item:not(.dragging)')];

    return draggableElements.reduce((closest, child) => {
        const box = child.getBoundingClientRect();
        const offset = y - box.top - box.height / 2;

        if (offset < 0 && offset > closest.offset) {
            return { offset: offset, element: child };
        } else {
            return closest;
        }
    }, { offset: Number.NEGATIVE_INFINITY }).element;
}

function checkSentenceOrder() {
    const container = document.getElementById('sortable-sentences');
    const items = container.getElementsByClassName('sortable-item');
    const currentOrder = Array.from(items).map(item => item.dataset.id);
    const correctOrder = ['1', '2', '3']; // Thứ tự đúng của các câu

    let isCorrect = true;
    items.forEach((item, index) => {
        const isItemCorrect = item.dataset.id === correctOrder[index];
        item.classList.remove('correct', 'incorrect', 'feedback');
        item.classList.add(isItemCorrect ? 'correct' : 'incorrect');
        item.classList.add('feedback');
        if (!isItemCorrect) isCorrect = false;
    });

    // Hiển thị thông báo
    const message = isCorrect ?
        'Chúc mừng! Bạn đã sắp xếp đúng thứ tự các câu.' :
        'Chưa đúng. Hãy thử lại!';

    Swal.fire({
        icon: isCorrect ? 'success' : 'error',
        title: isCorrect ? 'Tuyệt vời!' : 'Cố gắng thêm',
        text: message,
        confirmButtonText: 'Đóng'
    });
}

function resetSentenceOrder() {
    const container = document.getElementById('sortable-sentences');
    if (!window.originalOrder) return;

    container.innerHTML = window.originalOrder.join('');
    initializeSortable();

    // Xóa các class feedback
    const items = container.getElementsByClassName('sortable-item');
    Array.from(items).forEach(item => {
        item.classList.remove('correct', 'incorrect', 'feedback');
    });
}
