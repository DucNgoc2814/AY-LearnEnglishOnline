document.addEventListener('DOMContentLoaded', function() {
    const containers = document.querySelectorAll('.words-container');

    containers.forEach(container => {
        new Sortable(container, {
            animation: 150,
            ghostClass: 'dragging',
            onEnd: function() {
                checkOrder(container);
            }
        });

        // Initial check
        checkOrder(container);
    });

    function checkOrder(container) {
        const correctOrder = container.dataset.correctOrder.split(',');
        const currentOrder = Array.from(container.children).map(word => word.textContent.trim());
        const isCorrect = arraysEqual(correctOrder, currentOrder);

        const feedbackMessage = container.parentElement.querySelector('.feedback-message');
        const recordButton = container.closest('.card-body').querySelector('.record-btn');

        if (isCorrect) {
            feedbackMessage.textContent = 'Tuyệt vời! Bạn đã sắp xếp đúng. Bây giờ bạn có thể ghi âm.';
            feedbackMessage.className = 'feedback-message mt-2 correct';
            recordButton.disabled = false;

            // Add success animation to words
            container.querySelectorAll('.word-box').forEach(box => {
                box.classList.add('highlight');
                setTimeout(() => box.classList.remove('highlight'), 2000);
            });
        } else {
            feedbackMessage.textContent = 'Chưa đúng. Hãy thử sắp xếp lại các từ.';
            feedbackMessage.className = 'feedback-message mt-2 incorrect';
            recordButton.disabled = true;
        }
    }

    function arraysEqual(arr1, arr2) {
        if (arr1.length !== arr2.length) return false;
        return arr1.every((value, index) => value === arr2[index]);
    }
});
