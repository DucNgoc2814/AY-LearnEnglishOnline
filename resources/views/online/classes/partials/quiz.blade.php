@extends('online.layouts.master')

@section('title', $quizInfo['title'] ?? 'Bài trắc nghiệm')

@section('content')
<div class="quiz-container py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card quiz-card border-0 shadow">
                    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white p-3">
                        <h5 class="card-title mb-0 fw-bold">
                            <i class="fas fa-question-circle me-2"></i> {{ $quizInfo['title'] ?? 'Bài trắc nghiệm' }}
                        </h5>
                        <div class="quiz-timer bg-white text-dark px-3 py-2 rounded-pill shadow-sm">
                            <i class="fas fa-clock me-2 text-primary"></i> <span id="countdown" class="fw-bold">{{ floor($quizInfo['time']) }}:00</span>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">

                        <form id="quizForm">
                            <div class="progress mb-4 bg-light" style="height: 10px;">
                                <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">1/{{ $quizInfo['questions'] ?? 10 }}</div>
                            </div>

                            <div class="quiz-questions">
                                <!-- Câu hỏi 1 -->
                                <div class="question-item mb-4 active" id="question-1">
                                    <div class="question-header d-flex align-items-center mb-3">
                                        <div class="question-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                            <span>1</span>
                                        </div>
                                        <h5 class="question-text mb-0 fw-bold">She ________ to work by bus every day.</h5>
                                    </div>
                                    <div class="options">
                                        <div class="option-item mb-3" onclick="selectOption('q1-option1')">
                                            <input class="form-check-input" type="radio" name="question1" id="q1-option1" value="go">
                                            <div class="option-content">go</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q1-option2')">
                                            <input class="form-check-input" type="radio" name="question1" id="q1-option2" value="goes">
                                            <div class="option-content">goes</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q1-option3')">
                                            <input class="form-check-input" type="radio" name="question1" id="q1-option3" value="going">
                                            <div class="option-content">going</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q1-option4')">
                                            <input class="form-check-input" type="radio" name="question1" id="q1-option4" value="is going">
                                            <div class="option-content">is going</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Câu hỏi 2 -->
                                <div class="question-item mb-4" id="question-2" style="display: none;">
                                    <div class="question-header d-flex align-items-center mb-3">
                                        <div class="question-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                            <span>2</span>
                                        </div>
                                        <h5 class="question-text mb-0 fw-bold">My brother ________ football on weekends.</h5>
                                    </div>
                                    <div class="options">
                                        <div class="option-item mb-3" onclick="selectOption('q2-option1')">
                                            <input class="form-check-input" type="radio" name="question2" id="q2-option1" value="play">
                                            <div class="option-content">play</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q2-option2')">
                                            <input class="form-check-input" type="radio" name="question2" id="q2-option2" value="plays">
                                            <div class="option-content">plays</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q2-option3')">
                                            <input class="form-check-input" type="radio" name="question2" id="q2-option3" value="playing">
                                            <div class="option-content">playing</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q2-option4')">
                                            <input class="form-check-input" type="radio" name="question2" id="q2-option4" value="is playing">
                                            <div class="option-content">is playing</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Câu hỏi 3 -->
                                <div class="question-item mb-4" id="question-3" style="display: none;">
                                    <div class="question-header d-flex align-items-center mb-3">
                                        <div class="question-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                            <span>3</span>
                                        </div>
                                        <h5 class="question-text mb-0 fw-bold">We ________ English in this class.</h5>
                                    </div>
                                    <div class="options">
                                        <div class="option-item mb-3" onclick="selectOption('q3-option1')">
                                            <input class="form-check-input" type="radio" name="question3" id="q3-option1" value="learn">
                                            <div class="option-content">learn</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q3-option2')">
                                            <input class="form-check-input" type="radio" name="question3" id="q3-option2" value="learns">
                                            <div class="option-content">learns</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q3-option3')">
                                            <input class="form-check-input" type="radio" name="question3" id="q3-option3" value="learning">
                                            <div class="option-content">learning</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q3-option4')">
                                            <input class="form-check-input" type="radio" name="question3" id="q3-option4" value="are learning">
                                            <div class="option-content">are learning</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Câu hỏi 4 -->
                                <div class="question-item mb-4" id="question-4" style="display: none;">
                                    <div class="question-header d-flex align-items-center mb-3">
                                        <div class="question-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                            <span>4</span>
                                        </div>
                                        <h5 class="question-text mb-0 fw-bold">They ________ in a big house near the park.</h5>
                                    </div>
                                    <div class="options">
                                        <div class="option-item mb-3" onclick="selectOption('q4-option1')">
                                            <input class="form-check-input" type="radio" name="question4" id="q4-option1" value="live">
                                            <div class="option-content">live</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q4-option2')">
                                            <input class="form-check-input" type="radio" name="question4" id="q4-option2" value="lives">
                                            <div class="option-content">lives</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q4-option3')">
                                            <input class="form-check-input" type="radio" name="question4" id="q4-option3" value="living">
                                            <div class="option-content">living</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q4-option4')">
                                            <input class="form-check-input" type="radio" name="question4" id="q4-option4" value="are living">
                                            <div class="option-content">are living</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Câu hỏi 5 -->
                                <div class="question-item mb-4" id="question-5" style="display: none;">
                                    <div class="question-header d-flex align-items-center mb-3">
                                        <div class="question-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                            <span>5</span>
                                        </div>
                                        <h5 class="question-text mb-0 fw-bold">The sun ________ in the east.</h5>
                                    </div>
                                    <div class="options">
                                        <div class="option-item mb-3" onclick="selectOption('q5-option1')">
                                            <input class="form-check-input" type="radio" name="question5" id="q5-option1" value="rise">
                                            <div class="option-content">rise</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q5-option2')">
                                            <input class="form-check-input" type="radio" name="question5" id="q5-option2" value="rises">
                                            <div class="option-content">rises</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q5-option3')">
                                            <input class="form-check-input" type="radio" name="question5" id="q5-option3" value="rising">
                                            <div class="option-content">rising</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q5-option4')">
                                            <input class="form-check-input" type="radio" name="question5" id="q5-option4" value="is rising">
                                            <div class="option-content">is rising</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Câu hỏi 6 -->
                                <div class="question-item mb-4" id="question-6" style="display: none;">
                                    <div class="question-header d-flex align-items-center mb-3">
                                        <div class="question-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                            <span>6</span>
                                        </div>
                                        <h5 class="question-text mb-0 fw-bold">I ________ coffee every morning.</h5>
                                    </div>
                                    <div class="options">
                                        <div class="option-item mb-3" onclick="selectOption('q6-option1')">
                                            <input class="form-check-input" type="radio" name="question6" id="q6-option1" value="drink">
                                            <div class="option-content">drink</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q6-option2')">
                                            <input class="form-check-input" type="radio" name="question6" id="q6-option2" value="drinks">
                                            <div class="option-content">drinks</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q6-option3')">
                                            <input class="form-check-input" type="radio" name="question6" id="q6-option3" value="drinking">
                                            <div class="option-content">drinking</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q6-option4')">
                                            <input class="form-check-input" type="radio" name="question6" id="q6-option4" value="am drinking">
                                            <div class="option-content">am drinking</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Câu hỏi 7 -->
                                <div class="question-item mb-4" id="question-7" style="display: none;">
                                    <div class="question-header d-flex align-items-center mb-3">
                                        <div class="question-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                            <span>7</span>
                                        </div>
                                        <h5 class="question-text mb-0 fw-bold">He ________ to music before bed.</h5>
                                    </div>
                                    <div class="options">
                                        <div class="option-item mb-3" onclick="selectOption('q7-option1')">
                                            <input class="form-check-input" type="radio" name="question7" id="q7-option1" value="listen">
                                            <div class="option-content">listen</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q7-option2')">
                                            <input class="form-check-input" type="radio" name="question7" id="q7-option2" value="listens">
                                            <div class="option-content">listens</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q7-option3')">
                                            <input class="form-check-input" type="radio" name="question7" id="q7-option3" value="listening">
                                            <div class="option-content">listening</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q7-option4')">
                                            <input class="form-check-input" type="radio" name="question7" id="q7-option4" value="is listening">
                                            <div class="option-content">is listening</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Câu hỏi 8 -->
                                <div class="question-item mb-4" id="question-8" style="display: none;">
                                    <div class="question-header d-flex align-items-center mb-3">
                                        <div class="question-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                            <span>8</span>
                                        </div>
                                        <h5 class="question-text mb-0 fw-bold">The children ________ in the garden now.</h5>
                                    </div>
                                    <div class="options">
                                        <div class="option-item mb-3" onclick="selectOption('q8-option1')">
                                            <input class="form-check-input" type="radio" name="question8" id="q8-option1" value="play">
                                            <div class="option-content">play</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q8-option2')">
                                            <input class="form-check-input" type="radio" name="question8" id="q8-option2" value="plays">
                                            <div class="option-content">plays</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q8-option3')">
                                            <input class="form-check-input" type="radio" name="question8" id="q8-option3" value="playing">
                                            <div class="option-content">playing</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q8-option4')">
                                            <input class="form-check-input" type="radio" name="question8" id="q8-option4" value="are playing">
                                            <div class="option-content">are playing</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Câu hỏi 9 -->
                                <div class="question-item mb-4" id="question-9" style="display: none;">
                                    <div class="question-header d-flex align-items-center mb-3">
                                        <div class="question-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                            <span>9</span>
                                        </div>
                                        <h5 class="question-text mb-0 fw-bold">Water ________ at 100 degrees Celsius.</h5>
                                    </div>
                                    <div class="options">
                                        <div class="option-item mb-3" onclick="selectOption('q9-option1')">
                                            <input class="form-check-input" type="radio" name="question9" id="q9-option1" value="boil">
                                            <div class="option-content">boil</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q9-option2')">
                                            <input class="form-check-input" type="radio" name="question9" id="q9-option2" value="boils">
                                            <div class="option-content">boils</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q9-option3')">
                                            <input class="form-check-input" type="radio" name="question9" id="q9-option3" value="boiling">
                                            <div class="option-content">boiling</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q9-option4')">
                                            <input class="form-check-input" type="radio" name="question9" id="q9-option4" value="is boiling">
                                            <div class="option-content">is boiling</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Câu hỏi 10 -->
                                <div class="question-item mb-4" id="question-10" style="display: none;">
                                    <div class="question-header d-flex align-items-center mb-3">
                                        <div class="question-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                                            <span>10</span>
                                        </div>
                                        <h5 class="question-text mb-0 fw-bold">You ________ very happy today!</h5>
                                    </div>
                                    <div class="options">
                                        <div class="option-item mb-3" onclick="selectOption('q10-option1')">
                                            <input class="form-check-input" type="radio" name="question10" id="q10-option1" value="look">
                                            <div class="option-content">look</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q10-option2')">
                                            <input class="form-check-input" type="radio" name="question10" id="q10-option2" value="looks">
                                            <div class="option-content">looks</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q10-option3')">
                                            <input class="form-check-input" type="radio" name="question10" id="q10-option3" value="looking">
                                            <div class="option-content">looking</div>
                                        </div>
                                        <div class="option-item mb-3" onclick="selectOption('q10-option4')">
                                            <input class="form-check-input" type="radio" name="question10" id="q10-option4" value="are looking">
                                            <div class="option-content">are looking</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Thêm câu hỏi khác tương tự -->
                                <p class="text-center text-muted my-5 remaining-questions d-none">(Còn {{ $quizInfo['questions'] - 10 }} câu hỏi nữa)</p>
                            </div>

                            <div class="question-pagination mb-4 text-center">
                                <div class="d-flex flex-wrap justify-content-center" role="group">
                                    @for ($i = 1; $i <= $quizInfo['questions']; $i++)
                                        <button type="button" class="btn {{ $i == 1 ? 'btn-primary active' : 'btn-outline-primary' }} question-pill rounded-circle m-1 shadow-sm" data-question="{{ $i }}" style="width: 40px; height: 40px; font-weight: bold;">{{ $i }}</button>
                                    @endfor
                                </div>
                            </div>

                            <div class="quiz-navigation d-flex flex-wrap justify-content-between align-items-center mt-4 gap-3">
                                <button type="button" id="prevBtn" class="btn btn-outline-primary rounded-pill px-4 py-2 shadow-sm" disabled>
                                    <i class="fas fa-arrow-left me-2"></i> Câu trước
                                </button>
                                <div class="quiz-progress">
                                    <span class="badge bg-success rounded-pill px-3 py-2 shadow-sm">
                                        <i class="fas fa-check-circle me-1"></i> <span id="answeredCount">1</span>/{{ $quizInfo['questions'] }} câu đã trả lời
                                    </span>
                                </div>
                                <button type="button" id="nextBtn" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                                    Câu tiếp <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="card-footer d-flex justify-content-end align-items-center p-3 bg-light">
                        <button type="button" id="submitQuizBtn" class="btn btn-success rounded-pill px-4 py-2 shadow-sm">
                            <i class="fas fa-paper-plane me-2"></i> Nộp bài
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Xác nhận nộp bài -->
<div class="modal fade" id="submitConfirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-warning text-dark border-0">
                <h5 class="modal-title fw-bold"><i class="fas fa-exclamation-triangle me-2"></i> Xác nhận nộp bài</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p>Bạn có chắc chắn muốn nộp bài? Sau khi nộp, bạn sẽ không thể chỉnh sửa câu trả lời.</p>
                <div class="alert alert-info rounded-3 border-0 shadow-sm">
                    <h6 class="fw-bold mb-3">Thống kê làm bài:</h6>
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="p-3 bg-white rounded-3 shadow-sm">
                                <h3 class="text-success fw-bold mb-0"><span id="modalAnsweredCount">3</span>/{{ $quizInfo['questions'] }}</h3>
                                <p class="mb-0 text-muted">Đã trả lời</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-white rounded-3 shadow-sm">
                                <h3 class="text-danger fw-bold mb-0"><span id="modalUnansweredCount">{{ $quizInfo['questions'] - 3 }}</span>/{{ $quizInfo['questions'] }}</h3>
                                <p class="mb-0 text-muted">Chưa trả lời</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Kiểm tra lại</button>
                <button type="button" class="btn btn-success rounded-pill px-4" id="confirmSubmitBtn">Xác nhận nộp bài</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .quiz-card {
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .question-number {
        width: 45px;
        height: 45px;
        min-width: 45px;
        font-weight: bold;
        font-size: 18px;
    }
    
    .quiz-timer {
        font-weight: bold;
        box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
    }
    
    .question-pill {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .question-pill.answered {
        background-color: #16a34a !important;
        color: white !important;
        box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
    }
    
    /* Thiết lập style mới cho đáp án */
    .option-item {
        position: relative;
        background-color: #f8f9fa;
        border: 2px solid #f8f9fa;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        overflow: hidden;
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        padding: 0.5rem;
    }
    
    .option-item:hover {
        background-color: #e9ecef;
        border-color: #dee2e6;
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .option-item.selected {
        background-color: #e8f4fc;
        border-color: #2563eb;
        box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
    }
    
    .option-item .form-check-input {
        position: absolute;
        opacity: 0;
        z-index: -1;
    }
    
    .option-content {
        position: relative;
        width: 100%;
        padding: 0.75rem 0.75rem 0.75rem 2.5rem;
        font-size: 1rem;
        font-weight: 500;
    }
    
    .option-content::before {
        content: '';
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        border: 2px solid #adb5bd;
        border-radius: 50%;
        background-color: #fff;
        transition: all 0.2s ease;
    }
    
    .option-item.selected .option-content::before {
        border-color: #2563eb;
        background-color: #2563eb;
    }
    
    .option-item.selected .option-content::after {
        content: '';
        position: absolute;
        left: 1.05rem;
        top: 50%;
        transform: translateY(-50%);
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: white;
    }
    
    .progress {
        border-radius: 10px;
        overflow: hidden;
        height: 12px;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .alert {
        border-radius: 12px;
    }
    
    .btn-primary, .bg-primary {
        background-color: #2563eb !important;
        border-color: #2563eb !important;
    }
    
    .btn-primary:hover {
        background-color: #1d4ed8 !important;
        border-color: #1d4ed8 !important;
    }
    
    .btn-success, .bg-success {
        background-color: #16a34a !important;
        border-color: #16a34a !important;
    }
    
    .btn-success:hover {
        background-color: #15803d !important;
        border-color: #15803d !important;
    }
    
    .text-primary {
        color: #2563eb !important;
    }
    
    .text-success {
        color: #16a34a !important;
    }
    
    .remaining-questions {
        font-style: italic;
        color: #6b7280;
    }
    
    .question-text {
        font-size: 1.1rem;
        line-height: 1.5;
    }
    
    .btn {
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
    }
    
    .blink {
        animation: blink 1s linear infinite;
    }
    
    @keyframes blink {
        0% { opacity: 1; }
        50% { opacity: 0.5; }
        100% { opacity: 1; }
    }
    
    @media (max-width: 768px) {
        .question-number {
            width: 38px;
            height: 38px;
            min-width: 38px;
            font-size: 16px;
        }
        
        .option-content {
            padding: 0.5rem 0.5rem 0.5rem 2.25rem;
            font-size: 0.95rem;
        }
        
        .option-content::before {
            left: 0.5rem;
            width: 18px;
            height: 18px;
        }
        
        .option-item.selected .option-content::after {
            left: 0.8rem;
            width: 8px;
            height: 8px;
        }
        
        .question-text {
            font-size: 1rem;
        }
        
        .quiz-navigation {
            flex-direction: column;
            gap: 15px;
        }
        
        .quiz-navigation button {
            width: 100%;
        }
        
        .quiz-timer {
            font-size: 0.9rem;
            padding: 0.4rem 0.8rem !important;
        }
    }
    
    /* Xử lý đặc biệt cho nút số 10 */
    .question-pill[data-question="10"] {
        width: auto !important;
        min-width: 40px;
        height: 40px;
        padding-left: 10px;
        padding-right: 10px;
    }
</style>
@endpush

@push('scripts')
<script>
    function selectOption(optionId) {
        const option = document.getElementById(optionId);
        if (option) {
            // Thiết lập radio button là được chọn
            option.checked = true;
            
            // Lấy tên câu hỏi (question1, question2, etc.)
            const questionName = option.getAttribute('name');
            
            // Loại bỏ lớp selected từ tất cả các option trong cùng câu hỏi
            document.querySelectorAll(`input[name="${questionName}"]`).forEach(input => {
                input.closest('.option-item').classList.remove('selected');
            });
            
            // Thêm lớp selected vào option được chọn
            option.closest('.option-item').classList.add('selected');
            
            // Kích hoạt sự kiện change để cập nhật trạng thái
            const event = new Event('change');
            option.dispatchEvent(event);
        }
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        let currentQuestion = 1;
        const totalQuestions = {{ $quizInfo['questions'] }};
        let answeredQuestions = new Set();
        
        // Đánh dấu option đã chọn ban đầu
        document.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
            radio.closest('.option-item').classList.add('selected');
        });
        
        // Function to update the quiz progress UI
        function updateQuizProgress() {
            // Update progress bar
            const progressBar = document.querySelector('.progress-bar');
            const progressPercentage = (currentQuestion / totalQuestions) * 100;
            progressBar.style.width = progressPercentage + '%';
            progressBar.textContent = currentQuestion + '/' + totalQuestions;
            
            // Update question pills
            document.querySelectorAll('.question-pill').forEach(pill => {
                pill.classList.remove('active', 'btn-primary');
                pill.classList.add('btn-outline-primary');
                
                // Keep answered status
                const qNumber = parseInt(pill.getAttribute('data-question'));
                if (answeredQuestions.has(qNumber)) {
                    pill.classList.add('answered');
                    pill.classList.remove('btn-outline-primary');
                }
            });
            
            const activePill = document.querySelector(`.question-pill[data-question="${currentQuestion}"]`);
            if (activePill) {
                activePill.classList.remove('btn-outline-primary');
                activePill.classList.add('active', 'btn-primary');
            }
            
            // Update navigation buttons
            document.getElementById('prevBtn').disabled = currentQuestion === 1;
            document.getElementById('nextBtn').disabled = currentQuestion === totalQuestions;
            
            if (currentQuestion === totalQuestions) {
                document.getElementById('nextBtn').innerHTML = 'Câu cuối <i class="fas fa-check ms-2"></i>';
            } else {
                document.getElementById('nextBtn').innerHTML = 'Câu tiếp <i class="fas fa-arrow-right ms-2"></i>';
            }
            
            // Hide all questions and show current
            document.querySelectorAll('.question-item').forEach(q => {
                q.style.display = 'none';
            });
            document.getElementById(`question-${currentQuestion}`).style.display = 'block';
        }
        
        // Next button functionality
        document.getElementById('nextBtn').addEventListener('click', function() {
            if (currentQuestion < totalQuestions) {
                currentQuestion++;
                updateQuizProgress();
            }
        });
        
        // Previous button functionality
        document.getElementById('prevBtn').addEventListener('click', function() {
            if (currentQuestion > 1) {
                currentQuestion--;
                updateQuizProgress();
            }
        });
        
        // Submit quiz button
        document.getElementById('submitQuizBtn').addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('submitConfirmModal'));
            modal.show();
        });
        
        // Radio button change event to mark questions as answered
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const questionNumber = parseInt(this.name.replace('question', ''));
                answeredQuestions.add(questionNumber);
                
                const questionPill = document.querySelector(`.question-pill[data-question="${questionNumber}"]`);
                if (questionPill) {
                    questionPill.classList.remove('btn-outline-primary', 'btn-primary');
                    questionPill.classList.add('answered');
                }
                
                // Update answered count
                const totalAnswered = answeredQuestions.size;
                document.getElementById('answeredCount').textContent = totalAnswered;
                document.getElementById('modalAnsweredCount').textContent = totalAnswered;
                document.getElementById('modalUnansweredCount').textContent = totalQuestions - totalAnswered;
            });
        });
        
        // Question pills navigation
        document.querySelectorAll('.question-pill').forEach(pill => {
            pill.addEventListener('click', function() {
                const questionNumber = parseInt(this.getAttribute('data-question'));
                if (!isNaN(questionNumber) && questionNumber >= 1 && questionNumber <= totalQuestions) {
                    currentQuestion = questionNumber;
                    updateQuizProgress();
                }
            });
        });
        
        // Countdown timer
        let timeLeft = {{ $quizInfo['time'] }} * 60; // minutes in seconds
        function updateTimer() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            document.getElementById('countdown').textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            
            // Show warning when less than 2 minutes left
            if (timeLeft <= 120 && timeLeft > 0) {
                document.getElementById('countdown').classList.add('text-danger');
                document.getElementById('countdown').classList.add('blink');
                document.querySelector('.quiz-timer').classList.add('bg-warning');
                document.querySelector('.quiz-timer').classList.remove('bg-white');
            }
            
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                document.getElementById('countdown').textContent = '0:00';
                
                // Show modal for automatic submission
                const timeUpModal = new bootstrap.Modal(document.getElementById('submitConfirmModal'));
                document.querySelector('#submitConfirmModal .modal-title').innerHTML = '<i class="fas fa-clock me-2"></i> Hết thời gian';
                document.querySelector('#submitConfirmModal .modal-body p').textContent = 'Đã hết thời gian làm bài! Bài làm của bạn sẽ được tự động nộp.';
                timeUpModal.show();
                
                // Auto submit after 5 seconds
                setTimeout(() => {
                    document.getElementById('confirmSubmitBtn').click();
                }, 5000);
            } else {
                timeLeft--;
            }
        }
        
        const timerInterval = setInterval(updateTimer, 1000);
        updateTimer(); // Initialize timer display
        
        // Initial setup of answered questions
        document.querySelectorAll('input[type="radio"]:checked').forEach(radio => {
            const questionNumber = parseInt(radio.name.replace('question', ''));
            answeredQuestions.add(questionNumber);
            
            const questionPill = document.querySelector(`.question-pill[data-question="${questionNumber}"]`);
            if (questionPill) {
                questionPill.classList.add('answered');
            }
        });
        
        // Initialize answered count
        document.getElementById('answeredCount').textContent = answeredQuestions.size;
        document.getElementById('modalAnsweredCount').textContent = answeredQuestions.size;
        document.getElementById('modalUnansweredCount').textContent = totalQuestions - answeredQuestions.size;
        
        // Confirmation submit handler
        document.getElementById('confirmSubmitBtn').addEventListener('click', function() {
            // Simulate form submission with loading state
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Đang nộp bài...';
            this.disabled = true;
            
            // In a real app, we would submit the form here
            setTimeout(() => {
                window.location.href = '{{ route("online.classes.index") }}'; // Trở về trang danh sách lớp học sau khi nộp bài
            }, 2000);
        });
        
        // Keyboard navigation support
        document.addEventListener('keydown', function(e) {
            // Allow left/right arrow keys to navigate between questions
            if (document.activeElement.tagName !== 'INPUT') {
                if (e.key === 'ArrowRight' && currentQuestion < totalQuestions) {
                    document.getElementById('nextBtn').click();
                } else if (e.key === 'ArrowLeft' && currentQuestion > 1) {
                    document.getElementById('prevBtn').click();
                }
                
                // Allow number keys 1-9 to select options
                const num = parseInt(e.key);
                if (!isNaN(num) && num >= 1 && num <= 4) {
                    const optionId = `q${currentQuestion}-option${num}`;
                    selectOption(optionId);
                }
            }
        });
        
        // Run initial update
        updateQuizProgress();
    });
</script>
@endpush 