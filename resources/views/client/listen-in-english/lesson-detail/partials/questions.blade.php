<div class="questions-section">
    <form id="questionsForm" class="needs-validation" novalidate>
        <div class="questions-list">
            <!-- Question 1 -->
            <div class="question-item mb-4">
                <p class="mb-2">1. Rob is from _____.</p>
                <div class="ms-4">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="question1" id="q1_option1" value="Poland">
                        <label class="form-check-label" for="q1_option1">Poland</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question1" id="q1_option2" value="England">
                        <label class="form-check-label answer-label" for="q1_option2">England</label>
                    </div>
                </div>
            </div>

            <!-- Question 2 -->
            <div class="question-item mb-4">
                <p class="mb-2">2. Rob is _____.</p>
                <div class="ms-4">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="question2" id="q2_option1" value="a journalist">
                        <label class="form-check-label answer-label" for="q2_option1">a journalist</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question2" id="q2_option2" value="a photographer">
                        <label class="form-check-label" for="q2_option2">a photographer</label>
                    </div>
                </div>
            </div>

            <!-- Question 3 -->
            <div class="question-item mb-4">
                <p class="mb-2">3. Rob is visiting Poland _____.</p>
                <div class="ms-4">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="question3" id="q3_option1" value="for work">
                        <label class="form-check-label answer-label" for="q3_option1">for work</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question3" id="q3_option2" value="on holiday">
                        <label class="form-check-label" for="q3_option2">on holiday</label>
                    </div>
                </div>
            </div>

            <!-- Question 4 -->
            <div class="question-item mb-4">
                <p class="mb-2">4. Rob _____ a hotel reservation.</p>
                <div class="ms-4">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="question4" id="q4_option1" value="has">
                        <label class="form-check-label answer-label" for="q4_option1">has</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question4" id="q4_option2" value="doesn't have">
                        <label class="form-check-label" for="q4_option2">doesn't have</label>
                    </div>
                </div>
            </div>

            <!-- Question 5 -->
            <div class="question-item mb-4">
                <p class="mb-2">5. Rob's _____ is Walker.</p>
                <div class="ms-4">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="question5" id="q5_option1" value="given name">
                        <label class="form-check-label" for="q5_option1">given name</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question5" id="q5_option2" value="surname">
                        <label class="form-check-label answer-label" for="q5_option2">surname</label>
                    </div>
                </div>
            </div>

            <!-- Question 6 -->
            <div class="question-item mb-4">
                <p class="mb-2">6. The woman _____ how to spell Walker.</p>
                <div class="ms-4">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="question6" id="q6_option1" value="knows">
                        <label class="form-check-label" for="q6_option1">knows</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question6" id="q6_option2" value="doesn't know">
                        <label class="form-check-label answer-label" for="q6_option2">doesn't know</label>
                    </div>
                </div>
            </div>

            <!-- Question 7 -->
            <div class="question-item mb-4">
                <p class="mb-2">7. Rob will stay in Room _____.</p>
                <div class="ms-4">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="question7" id="q7_option1" value="301">
                        <label class="form-check-label" for="q7_option1">301</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="question7" id="q7_option2" value="321">
                        <label class="form-check-label answer-label" for="q7_option2">321</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="button" class="btn btn-primary" id="showAnswers">Show Answers</button>
            <button type="button" class="btn btn-secondary" id="hideAnswers" style="display: none;">Hide Answers</button>
        </div>
    </form>
</div>

@push('styles')
<style>
    .question-item {
        border-bottom: 1px solid #eee;
        padding-bottom: 1rem;
    }

    .question-item:last-child {
        border-bottom: none;
    }

    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .answer-label {
        transition: color 0.3s ease;
    }
</style>
@endpush

@push('scripts')
<script>
// Đợi cho đến khi document hoàn toàn được load
window.addEventListener('load', function() {
    // Kiểm tra xem các elements có tồn tại không
    const showAnswersBtn = document.getElementById('showAnswers');
    const hideAnswersBtn = document.getElementById('hideAnswers');

    if (showAnswersBtn && hideAnswersBtn) {
        const answerLabels = document.querySelectorAll('.answer-label');

        showAnswersBtn.addEventListener('click', function() {
            answerLabels.forEach(label => {
                label.style.color = '#dc3545';
            });
            showAnswersBtn.style.display = 'none';
            hideAnswersBtn.style.display = 'block';
        });

        hideAnswersBtn.addEventListener('click', function() {
            answerLabels.forEach(label => {
                label.style.color = 'inherit';
            });
            hideAnswersBtn.style.display = 'none';
            showAnswersBtn.style.display = 'block';
        });
    }
});
</script>
@endpush
