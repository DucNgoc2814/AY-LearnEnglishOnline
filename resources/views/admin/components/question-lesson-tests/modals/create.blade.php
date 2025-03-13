<div class="modal fade" id="createQuestionLessonTestModal" tabindex="-1" role="dialog"
    aria-labelledby="createQuestionLessonTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createQuestionLessonTestModalLabel">Thêm mới câu hỏi / câu trả lời</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="d-flex justify-content-between align-items-center pt-3 px-3">
                <h6 class="mb-0 fw-bold">Câu hỏi</h6>
            </div>
            <form action="{{ route('admin.question-lesson-tests.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="lessonTestId" id="lessonTestId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="type">Loại câu hỏi <span class="text-danger">*</span></label>
                        <select class="form-select {{ session('errors') && session('errors')->has('type') ? 'is-invalid' : '' }}"
                            id="type" name="type" required>
                            <option value="">Chọn loại câu hỏi</option>
                            <option value="text">Văn bản</option>
                            <option value="image">Hình ảnh</option>
                            <option value="video">Video</option>
                            <option value="audio">Âm thanh</option>
                        </select>
                        @if (session('errors') && session('errors')->has('type'))
                            <div class="invalid-feedback">{{ session('errors')->first('type') }}</div>
                        @endif
                    </div>

                    <div class="mb-3" id="questionTextGroup">
                        <label class="form-label" for="question">Câu hỏi <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control {{ session('errors') && session('errors')->has('question') ? 'is-invalid' : '' }}"
                            id="question" name="question" value="{{ old('question') }}"
                            placeholder="Nhập câu hỏi"
                            required>
                        @if (session('errors') && session('errors')->has('question'))
                            <div class="invalid-feedback">{{ session('errors')->first('question') }}</div>
                        @endif
                    </div>

                    <div class="mb-3 d-none" id="mediaUrlGroup">
                        <label class="form-label" for="mediaUrl">File <span class="text-danger">*</span></label>
                        <input type="file"
                            class="form-control {{ session('errors') && session('errors')->has('mediaUrl') ? 'is-invalid' : '' }}"
                            id="mediaUrl" name="mediaUrl">
                        <small class="form-text text-muted">
                            Hỗ trợ:
                            <span id="mediaTypeSupport"></span>
                        </small>
                        @if (session('errors') && session('errors')->has('mediaUrl'))
                            <div class="invalid-feedback">{{ session('errors')->first('mediaUrl') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="orderNumber">Thứ tự <span class="text-danger">*</span></label>
                        <input type="number"
                            class="form-control {{ session('errors') && session('errors')->has('orderNumber') ? 'is-invalid' : '' }}"
                            id="orderNumber" name="orderNumber" value="{{ old('orderNumber') }}"
                            placeholder="Nhập số thứ tự câu hỏi"
                            min="1"
                            required>
                        @if (session('errors') && session('errors')->has('orderNumber'))
                            <div class="invalid-feedback">{{ session('errors')->first('orderNumber') }}</div>
                        @endif
                    </div>

                    <!-- Thêm phần câu trả lời -->
                    <div class="answers-section mt-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0 fw-bold">Câu trả lời</h6>
                        </div>

                        <!-- Tách riêng phần chọn loại câu trả lời -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Loại câu trả lời <span class="text-danger">*</span></label>
                                    <select class="form-select" id="answerType" name="answerType" required>
                                        <option value="">Chọn loại đáp án</option>
                                        <option value="single_choice">Chọn một</option>
                                        <option value="multiple_choice">Chọn nhiều</option>
                                        <option value="fill_in_blank">Điền vào chỗ trống</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Phần danh sách câu trả lời -->
                        <div class="card answers-list d-none">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Danh sách câu trả lời</h6>
                                <button type="button" class="btn btn-primary btn-sm" id="add-answer">
                                    <i class="fas fa-plus"></i> Thêm câu trả lời
                                </button>
                            </div>
                            <div class="card-body">
                                <div id="answers-container">
                                    <div class="answer-item mb-4">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Nội dung câu trả lời <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control"
                                                    name="answers[0][answer]"
                                                    placeholder="Nhập câu trả lời" required>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Thứ tự</label>
                                                <input type="number" class="form-control"
                                                    name="answers[0][orderNumber]"
                                                    placeholder="Thứ tự" required min="1">
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Tùy chọn</label>
                                                <div class="d-flex gap-3 mt-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input answer-correct"
                                                            type="radio"
                                                            name="answers_correct"
                                                            value="0">
                                                        <label class="form-check-label">Đáp án đúng</label>
                                                    </div>
                                                    <div class="form-check case-sensitive-check d-none">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="answers[0][caseSensitive]" value="1">
                                                        <label class="form-check-label">Phân biệt hoa/thường</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 d-flex align-items-end">
                                                <button type="button" class="btn btn-outline-danger btn-sm remove-answer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row mt-3 alternative-answers-row d-none">
                                            <div class="col-md-11">
                                                <label class="form-label">Đáp án thay thế</label>
                                                <input type="text" class="form-control"
                                                    name="answers[0][alternativeAnswers]"
                                                    placeholder="Nhập các đáp án thay thế, phân cách bằng dấu |">
                                                <small class="text-muted">Ví dụ: đáp án 1 | đáp án 2 | đáp án 3</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.answer-item:not(:last-child) {
    border-bottom: 1px solid #dee2e6;
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
}

.answer-item:hover {
    background-color: #f8f9fa;
    border-radius: 0.25rem;
    padding: 1rem;
}

.remove-answer {
    width: 32px;
    height: 32px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.answers-section .card {
    border: 1px solid #e0e0e0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.form-label {
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #e0e0e0;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý hiển thị ô File dựa trên loại câu hỏi
    const typeSelect = document.getElementById('type');
    const mediaUrlGroup = document.getElementById('mediaUrlGroup');
    const mediaTypeSupport = document.getElementById('mediaTypeSupport');
    const mediaUrlInput = document.getElementById('mediaUrl');

    typeSelect.addEventListener('change', function() {
        const selectedType = this.value;

        // Hiển thị/ẩn ô File
        if (selectedType === 'text' || selectedType === '') {
            mediaUrlGroup.classList.add('d-none');
            mediaUrlInput.removeAttribute('required');
        } else {
            mediaUrlGroup.classList.remove('d-none');
            mediaUrlInput.setAttribute('required', 'required');

            switch(selectedType) {
                case 'image':
                    mediaUrlInput.setAttribute('accept', 'image/*');
                    mediaTypeSupport.textContent = '.jpg, .jpeg, .png, .gif';
                    break;
                case 'video':
                    mediaUrlInput.setAttribute('accept', 'video/*');
                    mediaTypeSupport.textContent = '.mp4, .webm, .ogg';
                    break;
                case 'audio':
                    mediaUrlInput.setAttribute('accept', 'audio/*');
                    mediaTypeSupport.textContent = '.mp3, .wav, .ogg';
                    break;
            }
        }
    });

    // Xử lý hiển thị form câu trả lời dựa trên loại câu trả lời
    const answerTypeSelect = document.getElementById('answerType');
    const answersListCard = document.querySelector('.answers-list');
    const answersContainer = document.getElementById('answers-container');

    answerTypeSelect.addEventListener('change', function() {
        const selectedAnswerType = this.value;
        const addAnswerBtn = document.getElementById('add-answer');

        // Hiển thị/ẩn card danh sách câu trả lời
        if (selectedAnswerType === '') {
            answersListCard.classList.add('d-none');
        } else {
            answersListCard.classList.remove('d-none');
        }

        // Ẩn/hiện nút thêm câu trả lời dựa vào loại
        if (selectedAnswerType === 'fill_in_blank') {
            addAnswerBtn.classList.add('d-none');

            // Nếu có nhiều hơn 1 câu trả lời, chỉ giữ lại câu đầu tiên
            const answerItems = document.querySelectorAll('.answer-item');
            if (answerItems.length > 1) {
                for (let i = 1; i < answerItems.length; i++) {
                    answerItems[i].remove();
                }
            }

            // Ẩn nút xóa của câu trả lời duy nhất
            const firstRemoveBtn = document.querySelector('.remove-answer');
            if (firstRemoveBtn) {
                firstRemoveBtn.classList.add('d-none');
            }
        } else {
            addAnswerBtn.classList.remove('d-none');
            // Hiện lại nút xóa
            const firstRemoveBtn = document.querySelector('.remove-answer');
            if (firstRemoveBtn) {
                firstRemoveBtn.classList.remove('d-none');
            }
        }

        // Cập nhật hiển thị các trường trong mỗi câu trả lời
        const answerItems = document.querySelectorAll('.answer-item');
        answerItems.forEach((item, index) => {
            const alternativeAnswersRow = item.querySelector('.alternative-answers-row');
            const caseSensitiveCheck = item.querySelector('.case-sensitive-check');
            const correctAnswerCheck = item.querySelector('.form-check');
            const isCorrectInput = item.querySelector('.answer-correct');

            if (selectedAnswerType === 'fill_in_blank') {
                alternativeAnswersRow?.classList.remove('d-none');
                caseSensitiveCheck?.classList.remove('d-none');
                correctAnswerCheck?.classList.add('d-none');
                // Tạo input hidden để đánh dấu đáp án đúng
                if (!item.querySelector('input[name="answers[' + index + '][isCorrect]"]')) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = `answers[${index}][isCorrect]`;
                    hiddenInput.value = '1';
                    item.appendChild(hiddenInput);
                }
            } else {
                alternativeAnswersRow?.classList.add('d-none');
                caseSensitiveCheck?.classList.add('d-none');
                correctAnswerCheck?.classList.remove('d-none');
                // Chuyển đổi giữa radio và checkbox dựa trên loại câu trả lời
                if (isCorrectInput) {
                    isCorrectInput.type = selectedAnswerType === 'single_choice' ? 'radio' : 'checkbox';
                    isCorrectInput.name = selectedAnswerType === 'single_choice' ? 'answers_correct' : `answers[${index}][isCorrect]`;
                }
            }
        });
    });

    // Xử lý thêm/xóa câu trả lời
    const addAnswerBtn = document.getElementById('add-answer');

    function createAnswerItem() {
        const answerCount = document.querySelectorAll('.answer-item').length;
        const answerType = document.getElementById('answerType').value;

        return `
            <div class="answer-item mb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nội dung câu trả lời <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"
                            name="answers[${answerCount}][answer]"
                            placeholder="Nhập câu trả lời" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Thứ tự</label>
                        <input type="number" class="form-control"
                            name="answers[${answerCount}][orderNumber]"
                            placeholder="Thứ tự" required min="1">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tùy chọn</label>
                        <div class="d-flex gap-3 mt-2">
                            <div class="form-check ${answerType === 'fill_in_blank' ? 'd-none' : ''}">
                                <input class="form-check-input answer-correct"
                                    type="${answerType === 'single_choice' ? 'radio' : 'checkbox'}"
                                    name="${answerType === 'single_choice' ? 'answers_correct' : `answers[${answerCount}][isCorrect]`}"
                                    value="${answerType === 'single_choice' ? answerCount : '1'}">
                                <label class="form-check-label">Đáp án đúng</label>
                            </div>
                            <div class="form-check case-sensitive-check ${answerType !== 'fill_in_blank' ? 'd-none' : ''}">
                                <input class="form-check-input" type="checkbox"
                                    name="answers[${answerCount}][caseSensitive]" value="1">
                                <label class="form-check-label">Phân biệt hoa/thường</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-answer">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                <div class="row mt-3 alternative-answers-row ${answerType !== 'fill_in_blank' ? 'd-none' : ''}">
                    <div class="col-md-11">
                        <label class="form-label">Đáp án thay thế</label>
                        <input type="text" class="form-control"
                            name="answers[${answerCount}][alternativeAnswers]"
                            placeholder="Nhập các đáp án thay thế, phân cách bằng dấu |">
                        <small class="text-muted">Ví dụ: đáp án 1 | đáp án 2 | đáp án 3</small>
                    </div>
                </div>
                ${answerType === 'fill_in_blank' ? `
                    <input type="hidden" name="answers[${answerCount}][isCorrect]" value="1">
                ` : ''}
            </div>
        `;
    }

    addAnswerBtn?.addEventListener('click', function() {
        const answerType = document.getElementById('answerType').value;
        // Không cho phép thêm nếu là loại điền vào chỗ trống
        if (answerType === 'fill_in_blank') {
            return;
        }

        answersContainer.insertAdjacentHTML('beforeend', createAnswerItem());
        const newRemoveBtn = answersContainer.lastElementChild.querySelector('.remove-answer');
        newRemoveBtn.addEventListener('click', handleRemoveAnswer);
    });

    // Xử lý xóa câu trả lời
    function handleRemoveAnswer() {
        const answerType = document.getElementById('answerType').value;
        // Không cho phép xóa nếu là loại điền vào chỗ trống
        if (answerType === 'fill_in_blank') {
            return;
        }

        if (document.querySelectorAll('.answer-item').length > 1) {
            this.closest('.answer-item').remove();

            // Cập nhật lại chỉ số của các phần tử sau khi xóa
            updateAnswerIndexes();
        } else {
            alert('Phải có ít nhất một câu trả lời!');
        }
    }

    // Cập nhật lại các chỉ số của các câu trả lời
    function updateAnswerIndexes() {
        const answerItems = document.querySelectorAll('.answer-item');
        const answerType = document.getElementById('answerType').value;

        answerItems.forEach((item, index) => {
            // Cập nhật name cho input answer
            const answerInput = item.querySelector('input[name^="answers"][name$="[answer]"]');
            if (answerInput) {
                answerInput.name = `answers[${index}][answer]`;
            }

            // Cập nhật name cho input orderNumber
            const orderInput = item.querySelector('input[name^="answers"][name$="[orderNumber]"]');
            if (orderInput) {
                orderInput.name = `answers[${index}][orderNumber]`;
            }

            // Cập nhật name cho radio/checkbox isCorrect
            const correctInput = item.querySelector('.answer-correct');
            if (correctInput) {
                if (answerType === 'single_choice') {
                    correctInput.name = 'answers_correct';
                    correctInput.value = index;
                } else {
                    correctInput.name = `answers[${index}][isCorrect]`;
                }
            }

            // Cập nhật name cho checkbox caseSensitive
            const caseSensitiveInput = item.querySelector('input[name^="answers"][name$="[caseSensitive]"]');
            if (caseSensitiveInput) {
                caseSensitiveInput.name = `answers[${index}][caseSensitive]`;
            }

            // Cập nhật name cho input alternativeAnswers
            const alternativeInput = item.querySelector('input[name^="answers"][name$="[alternativeAnswers]"]');
            if (alternativeInput) {
                alternativeInput.name = `answers[${index}][alternativeAnswers]`;
            }

            // Cập nhật input hidden isCorrect cho fill_in_blank
            const hiddenCorrectInput = item.querySelector('input[type="hidden"][name^="answers"][name$="[isCorrect]"]');
            if (hiddenCorrectInput) {
                hiddenCorrectInput.name = `answers[${index}][isCorrect]`;
            }
        });
    }

    // Add handler cho nút xóa ban đầu
    document.querySelector('.remove-answer')?.addEventListener('click', handleRemoveAnswer);

    // Thêm xử lý khi submit form
    document.querySelector('form').addEventListener('submit', function(e) {
        const answerType = document.getElementById('answerType').value;

        // Kiểm tra loại câu trả lời đã được chọn
        if (!answerType) {
            e.preventDefault();
            alert('Vui lòng chọn loại câu trả lời!');
            return;
        }

        // Kiểm tra xem có ít nhất một câu trả lời
        if (document.querySelectorAll('.answer-item').length === 0) {
            e.preventDefault();
            alert('Vui lòng thêm ít nhất một câu trả lời!');
            return;
        }

        // Xử lý cho loại "single_choice"
        if (answerType === 'single_choice') {
            const selectedCorrect = document.querySelector('input[name="answers_correct"]:checked');

            if (!selectedCorrect) {
                e.preventDefault();
                alert('Vui lòng chọn một câu trả lời đúng!');
                return;
            }

            const correctIndex = selectedCorrect.value;
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = `answers[${correctIndex}][isCorrect]`;
            hiddenInput.value = '1';
            this.appendChild(hiddenInput);
        }
        // Xử lý cho loại "multiple_choice"
        else if (answerType === 'multiple_choice') {
            const hasSelectedCorrect = document.querySelectorAll('input[type="checkbox"].answer-correct:checked').length > 0;

            if (!hasSelectedCorrect) {
                e.preventDefault();
                alert('Vui lòng chọn ít nhất một câu trả lời đúng!');
                return;
            }
        }
    });
});
</script>
