document.addEventListener('DOMContentLoaded', function() {
    const mysteryBoxes = document.querySelectorAll('.mystery-box');
    let openedBoxes = 0;
    let correctAnswers = 0;

    mysteryBoxes.forEach(box => {
        box.addEventListener('click', function() {
            if (this.classList.contains('opened')) return;

            // Mở hộp
            this.classList.add('opened');
            const boxContent = this.querySelector('.box-content');
            boxContent.classList.remove('d-none');
            this.querySelector('.box-front').classList.add('d-none');
            openedBoxes++;

            // Xử lý các nút trong hộp
            const buttons = boxContent.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    if (this.classList.contains('clicked')) return;

                    // Đánh dấu tất cả các nút đã được click
                    buttons.forEach(btn => btn.classList.add('clicked'));

                    // Kiểm tra đáp án
                    const isCorrect = this.dataset.correct === 'true';
                    if (isCorrect) {
                        this.classList.remove('btn-outline-primary');
                        this.classList.add('btn-success');
                        correctAnswers++;
                    } else {
                        this.classList.remove('btn-outline-primary');
                        this.classList.add('btn-danger');

                        // Hiển thị đáp án đúng
                        buttons.forEach(btn => {
                            if (btn.dataset.correct === 'true') {
                                btn.classList.remove('btn-outline-primary');
                                btn.classList.add('btn-success');
                            }
                        });
                    }

                    // Kiểm tra nếu đã mở hết các hộp
                    if (openedBoxes === mysteryBoxes.length) {
                        setTimeout(() => {
                            showFinalResult();
                        }, 1000);
                    }
                });
            });
        });
    });

    function showFinalResult() {
        const resultHTML = `
            <div class="text-center mt-4">
                <div class="result-icon mb-3">
                    <i class="fas fa-trophy fa-3x ${correctAnswers >= 3 ? 'text-warning' : 'text-secondary'}"></i>
                </div>
                <h4>Kết quả của bạn</h4>
                <p class="mb-3">Số câu đúng: ${correctAnswers}/${mysteryBoxes.length}</p>
                <button class="btn btn-primary" onclick="location.reload()">
                    <i class="fas fa-redo me-2"></i>Chơi lại
                </button>
            </div>
        `;

        const resultElement = document.createElement('div');
        resultElement.innerHTML = resultHTML;
        document.querySelector('.mystery-boxes-grid').appendChild(resultElement);
    }
});
