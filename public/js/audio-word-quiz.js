document.addEventListener('DOMContentLoaded', function() {
    // Dữ liệu câu hỏi
    const questions = [
        {
            audio: '/audio/short-u/bug.mp3',
            options: ['bag', 'bug'],
            correctAnswer: 'bug'
        },
        {
            audio: '/audio/short-u/cup.mp3',
            options: ['cap', 'cup'],
            correctAnswer: 'cup'
        },
        {
            audio: '/audio/short-u/rug.mp3',
            options: ['rag', 'rug'],
            correctAnswer: 'rug'
        },
        {
            audio: '/audio/short-u/uncle.mp3',
            options: ['ankle', 'uncle'],
            correctAnswer: 'uncle'
        },
        {
            audio: '/audio/short-u/cut.mp3',
            options: ['cat', 'cut'],
            correctAnswer: 'cut'
        }
    ];

    let currentQuestionIndex = 0;

    // Hiển thị câu hỏi đầu tiên
    showQuestion(currentQuestionIndex);

    // Hàm hiển thị câu hỏi theo index
    function showQuestion(index) {
        const container = document.getElementById('audio-quiz-container');
        container.innerHTML = ''; // Xóa câu hỏi cũ

        const question = questions[index];
        const questionElement = createQuestionElement(question, index);
        container.appendChild(questionElement);

        // Tự động phát audio khi hiển thị câu hỏi mới
        const audio = container.querySelector('audio');
        if (audio) {
            audio.play();
        }
    }

    // Tạo phần tử HTML cho mỗi câu hỏi
    function createQuestionElement(question, index) {
        const div = document.createElement('div');
        div.className = 'audio-question mb-4';
        div.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="audio-player flex-grow-1">
                    <audio class="w-100" controls>
                        <source src="${question.audio}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
                <div class="question-counter ms-3">
                    <span class="badge bg-primary">${index + 1}/${questions.length}</span>
                </div>
            </div>
            <div class="options-container">
                <div class="d-flex justify-content-center gap-3">
                    ${question.options.map(option => `
                        <button type="button"
                                class="btn btn-outline-primary word-option px-5 py-2"
                                data-correct="${option === question.correctAnswer}"
                                onclick="checkAnswer(this, '${option}')">
                            ${option}
                        </button>
                    `).join('')}
                </div>
            </div>
        `;
        return div;
    }

    // Đặt hàm checkAnswer vào window để có thể gọi từ onclick
    window.checkAnswer = function(button, correctAnswer) {
        const optionsContainer = button.closest('.options-container');
        const allOptions = optionsContainer.querySelectorAll('.word-option');

        // Vô hiệu hóa tất cả các nút trong câu hỏi này
        allOptions.forEach(option => {
            option.disabled = true;
        });

        // Kiểm tra đáp án và hiển thị kết quả
        if (button.textContent.trim() === correctAnswer) {
            button.classList.remove('btn-outline-primary');
            button.classList.add('btn-success');
        } else {
            button.classList.remove('btn-outline-primary');
            button.classList.add('btn-danger');

            // Hiển thị đáp án đúng
            allOptions.forEach(option => {
                if (option.textContent.trim() === correctAnswer) {
                    option.classList.remove('btn-outline-primary');
                    option.classList.add('btn-success');
                }
            });
        }

        // Đợi 1 giây rồi chuyển sang câu tiếp theo
        setTimeout(() => {
            currentQuestionIndex++;
            if (currentQuestionIndex < questions.length) {
                showQuestion(currentQuestionIndex);
            } else {
                // Hiển thị thông báo hoàn thành
                const container = document.getElementById('audio-quiz-container');
                container.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                        <h4>Bạn đã hoàn thành bài tập!</h4>
                        <button onclick="location.reload()" class="btn btn-primary mt-3">
                            <i class="fas fa-redo me-2"></i>Làm lại
                        </button>
                    </div>
                `;
            }
        }, 1000);
    };
});
