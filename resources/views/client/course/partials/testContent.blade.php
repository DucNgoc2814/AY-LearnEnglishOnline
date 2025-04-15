<div class="test-container">
    @if (session('error'))
        <script nonce="{{ csrf_token() }}">
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Lỗi!',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    confirmButtonText: 'Đóng'
                });
            });
        </script>
    @endif

    @if (session('success') && session('test_result'))
        <script nonce="{{ csrf_token() }}">
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Nộp bài thành công!',
                    html: `
                        <div class="test-result">
                            <p>Điểm số: <strong>{{ session('test_result.score') }}/{{ session('test_result.total_questions') * 100 }}</strong></p>
                            <p>Số câu đúng: <strong>{{ session('test_result.correct_answers') }}/{{ session('test_result.total_questions') }}</strong></p>
                            <p>Kết quả: <strong>{{ session('test_result.passed') ? 'Đạt' : 'Chưa đạt' }}</strong></p>
                        </div>
                    `,
                    icon: 'success',
                    confirmButtonText: 'Xem chi tiết',
                    showCancelButton: true,
                    cancelButtonText: 'Đóng',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/test-results/{{ session('test_result.id') }}';
                    }
                });
            });
        </script>
    @endif

    @if ($currentTest)
        @php
            $latestResult = Auth::user()->testResults()
                ->where('test_id', $currentTest->id)
                ->latest()
                ->first();
            $isRetaking = session('retaking_test_' . $currentTest->id, false);
        @endphp

        <div class="content-header">
            <div class="test-title-container">
                <h3 class="test-title mb-0 fs-5">{{ $currentTest->name ?? 'Không tìm thấy tên bài kiểm tra' }}</h3>
                @if(!$latestResult || $isRetaking)
                    <div class="timer-display">
                        <i class="fas fa-clock me-2"></i><span id="timer">{{ $currentTest->duration ?? 30 }}:00</span>
                    </div>
                @endif
            </div>
        </div>

        @if($latestResult && !$isRetaking)
            <div class="test-result-container p-4">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4 class="mb-4">Kết quả bài kiểm tra</h4>
                                <div class="result-stats mb-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stat-item">
                                                <h5>Điểm số</h5>
                                                <p class="h2 mb-0">{{ $latestResult->score }}/{{ $currentTest->max_score }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="stat-item">
                                                <h5>Câu đúng</h5>
                                                <p class="h2 mb-0">{{ $latestResult->correct_answers }}/{{ $latestResult->total_questions }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="stat-item">
                                                <h5>Trạng thái</h5>
                                                <p class="h4 mb-0 {{ $latestResult->score >= $currentTest->min_score ? 'text-success' : 'text-danger' }}">
                                                    {{ $latestResult->score >= $currentTest->min_score ? 'Đạt' : 'Chưa đạt' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                @php
                                    $totalAttempts = Auth::user()->testResults()
                                        ->where('test_id', $currentTest->id)
                                        ->count();
                                    $canRetake = $latestResult->score < $currentTest->min_score && 
                                        (!$currentTest->max_attempt || $totalAttempts < $currentTest->max_attempt);
                                @endphp

                                @if($canRetake)
                                    <div class="retry-section mt-4">
                                        <p>Bạn có thể làm lại bài kiểm tra để cải thiện điểm số.</p>
                                        <a href="{{ route('test.retry', $currentTest->id) }}" class="btn btn-primary">
                                            Làm lại bài kiểm tra
                                        </a>
                                        @if($currentTest->max_attempt)
                                            <p class="mt-2 text-muted">
                                                Còn {{ $currentTest->max_attempt - $totalAttempts }} lần làm lại
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <form id="testForm" action="{{ route('test.submit', $currentTest->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="started_at" id="started_at_input">
                <input type="hidden" name="timeout" id="timeout_input" value="0">
                
                <div class="row mx-0 px-0">
                    <!-- Phần nội dung câu hỏi và câu trả lời bên trái -->
                    <div class="col-md-9">
                        <div class="question-area">
                            <!-- Di chuyển điều hướng lên đầu -->
                            <div class="question-navigation mb-4">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" id="prev-question-btn" class="btn btn-outline-secondary w-100" disabled onclick="navigateToPrevQuestion()">
                                            <i class="fas fa-arrow-left me-2"></i>Câu trước
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" id="next-question-btn" class="btn btn-outline-primary w-100" onclick="navigateToNextQuestion()">
                                            Câu tiếp theo<i class="fas fa-arrow-right ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Hiển thị số câu hỏi hiện tại -->
                            <div class="question-counter mb-3">
                                Câu <span id="current-question-num">1</span>/{{ $currentTest->questions->count() }}
                            </div>
                            
                            <!-- Container chứa nội dung câu hỏi -->
                            <div class="questions-container">
                                @foreach($currentTest->questions as $index => $question)
                                    <div class="question-slide" id="question-slide-{{ $index }}" style="{{ $index > 0 ? 'display: none;' : '' }}">
                                        <div class="question-text mb-4">
                                            <h5 class="fw-bold">Câu {{ $index + 1 }}: {{ $question->question }}</h5>
                                        </div>
                                        
                                        @if ($question->image)
                                            <div class="question-image mb-3">
                                                <img src="{{ asset($question->image) }}" alt="Hình ảnh câu hỏi" class="img-fluid rounded">
                                            </div>
                                        @endif
                                        
                                        @if ($question->audio)
                                            <div class="question-audio mb-3">
                                                <audio controls class="w-100">
                                                    <source src="{{ asset($question->audio) }}" type="audio/mpeg">
                                                    Trình duyệt của bạn không hỗ trợ phát âm thanh.
                                                </audio>
                                            </div>
                                        @endif
                                        
                                        <div class="answers-list">
                                            @foreach ($question->answers as $answerIndex => $answer)
                                                <div class="answer-option mb-3 ps-1">
                                                    <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]"
                                                        id="answer{{ $answer->id }}" value="{{ $answer->id }}">
                                                    <label class="form-check-label ms-2" for="answer{{ $answer->id }}">
                                                        <span class="answer-letter">{{ chr(65 + $answerIndex) }}</span> {{ $answer->answer }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <!-- Phần danh sách câu hỏi bên phải -->
                    <div class="col-md-3">
                        <div class="sidebar-content mb-4">
                            <div class="sidebar-header mb-3">
                                <h6 class="fw-bold mb-3">Danh sách câu hỏi</h6>
                                
                                <div class="question-grid">
                                    <div class="row row-cols-4 g-2">
                                        @foreach($currentTest->questions as $index => $question)
                                            <div class="col">
                                                <button type="button" 
                                                        class="question-number{{ $index == 0 ? ' active' : '' }}" 
                                                        id="question-number-{{ $index }}" 
                                                        onclick="showQuestion({{ $index }})">
                                                    {{ $index + 1 }}
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            
                            <button type="button" id="submit-test-btn" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane me-2"></i>Nộp bài
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            @if($isRetaking)
                @php
                    // Clear the retaking flag after showing the form
                    session()->forget('retaking_test_' . $currentTest->id);
                @endphp
            @endif
        @endif
    @else
        <div class="no-content">
            <i class="fas fa-info-circle"></i>
            <p>Không tìm thấy bài kiểm tra</p>
        </div>
    @endif
</div>

<!-- Thêm SweetAlert2 library từ CDN -->
<script nonce="{{ csrf_token() }}" src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    .test-container {
        background: #fff;
        height: 100%;
        overflow-y: auto;
        overflow-x: hidden; /* Giữ lại */
        width: 100%;
        max-width: 100%;
        position: relative;
    }

    body {
        overflow-x: hidden; /* Giữ lại */
        max-width: 100%;
    }

    html {
        overflow-x: hidden; /* Giữ lại */
        max-width: 100%;
    }

    .row {
        margin-right: 0 !important;
        margin-left: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    .question-slide {
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
    }

    /* Đảm bảo form không bị overflow */
    #testForm {
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
    }

    /* Fix cho đáp án không bị tràn */
    .answer-option {
        width: 100%;
        word-break: break-word;
        overflow-wrap: break-word;
    }

    /* Đảm bảo các phần tử con không vượt quá chiều rộng của phần tử cha */
    .question-area,
    .answers-list,
    .question-content-container,
    .question-text,
    .form-check-label {
        max-width: 100%;
        overflow-wrap: break-word;
        word-wrap: break-word;
    }

    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #1e40af;
        color: white;
        padding: 15px 20px;
        margin-bottom: 20px;
    }

    .test-title-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        width: 100%;
    }

    .test-title {
        color: white;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 80%;
    }
    
    .question-area {
        display: flex;
        flex-direction: column;
        height: 100%;
        padding-bottom: 80px;
    }
    
    .question-counter {
        color: #6b7280;
        font-size: 0.9rem;
        margin-top: 10px;
    }
    
    .question-slide {
        background-color: #fff;
        border-radius: 8px;
    }
    
    .question-text h5 {
        color: #111827;
        font-size: 1.1rem;
        line-height: 1.5;
    }

    .answers-list {
        margin-top: 20px;
    }
    
    .answer-option {
        display: flex;
        align-items: flex-start;
        padding: 12px 16px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        transition: background-color 0.2s;
        margin-bottom: 10px;
    }
    
    .answer-option:hover {
        background-color: #f3f4f6;
    }
    
    .answer-letter {
        font-weight: 600;
        color: #3b82f6;
        margin-right: 8px;
    }

    .form-check-input {
        margin-top: 3px;
    }

    .form-check-label {
        color: #4b5563;
        font-size: 1rem;
        cursor: pointer;
    }

    .question-navigation {
        margin-bottom: 20px;
        padding: 15px 0;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .sidebar-content {
        background: #f8fafc;
        border-radius: 8px;
        padding: 20px;
        height: 100%;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .question-grid {
        margin-bottom: 20px;
    }
    
    /* Thiết kế mới cho các số câu hỏi trong sidebar */
    .question-number {
        width: 100%;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 5px;
        color: #4b5563;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .question-number:hover {
        background: #e2e8f0;
    }
    
    .question-number.active {
        background: #4299e1;
        color: #000000;
        border-color: #4299e1;
        font-weight: 600;
        box-shadow: 0 2px 4px rgba(66, 153, 225, 0.3);
    }
    
    .question-number.answered {
        background: #34d399;
        color: #000000;
        border-color: #34d399;
        font-weight: 600;
    }
    
    .timer-display {
        background-color: rgba(255, 255, 255, 0.2);
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: 600;
        color: white;
        display: inline-flex;
        align-items: center;
    }

    .no-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 300px;
        color: #6c757d;
        text-align: center;
        padding: 20px;
    }

    .no-content i {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
    
    /* SweetAlert custom styles */
    .swal2-popup {
        font-size: 1rem;
    }
    
    .swal2-title {
        font-size: 1.4rem;
    }
    
    /* Thiết lập padding cho màn hình PC */
    @media (min-width: 992px) {
        .row.mx-0.px-0 {
            padding: 0 20px !important;
        }
        
        .question-area {
            padding-right: 20px;
        }
        
        .question-slide {
            padding: 20px 15px;
        }
        
        .answer-option {
            padding: 12px 16px;
            margin-bottom: 12px;
        }
        
        .question-navigation {
            margin-top: 30px;
            padding-top: 20px;
        }
    }
    
    /* Thiết lập cho tablet */
    @media (max-width: 991px) and (min-width: 768px) {
        .row.mx-0.px-0 {
            padding: 0 15px !important;
        }
        
        .question-area {
            padding-right: 15px;
        }
        
        .question-slide {
            padding: 15px 10px;
        }
        
        .sidebar-content {
            margin-top: 0;
            margin-bottom: 20px;
        }
    }
    
    /* CSS cho điện thoại */
    @media (max-width: 767px) {
        .content-header {
            padding: 12px 15px;
            margin-bottom: 15px;
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
        
        .row.mx-0.px-0 {
            padding: 0 !important;
        }
        
        .question-slide {
            padding: 8px 5px !important;
        }
        
        .answer-option {
            padding: 8px 5px !important;
        }
        
        .col-md-9, 
        .col-md-3 {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        
        .container-fluid,
        .container {
            max-width: 100%;
            overflow-x: hidden;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
    }
    
    /* Điện thoại nhỏ */
    @media (max-width: 576px) {
        .row-cols-4 {
            --bs-gutter-x: 0.4rem;
        }
        
        .question-number {
            height: 30px;
            font-size: 0.85rem;
        }
        
        .question-navigation .btn {
            padding: 5px 8px;
            font-size: 0.8rem;
        }
        
        .sidebar-header h6 {
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        
        .timer-display {
            padding: 5px !important;
            font-size: 0.9rem;
        }
        
        #submit-test-btn {
            font-size: 0.9rem;
            padding: 8px 10px;
        }
    }

    /* Ngăn chặn vuốt ngang - thêm vào cuối file CSS */
    html, body {
        overflow-x: hidden;
        max-width: 100%;
        position: relative;
    }

    /* Sửa lớp container và row */
    .container-fluid,
    .container {
        overflow-x: hidden;
        max-width: 100%;
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    /* Đảm bảo row không gây overflow */
    .row {
        margin-left: 0 !important;
        margin-right: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    /* Đảm bảo tất cả các cột không overflow */
    .col-md-9, 
    .col-md-3 {
        padding-right: 0 !important;
        padding-left: 0 !important;
    }

    /* Fix container chính */
    .test-container {
        width: 100% !important;
        max-width: 100% !important;
        overflow-x: hidden !important;
        padding: 0 !important;
    }

    /* Sửa content-header để không vượt quá chiều rộng */
    .content-header {
        width: 100% !important;
        max-width: 100% !important;
        box-sizing: border-box !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
    }

    /* Đảm bảo không có padding không cần thiết */
    @media (max-width: 767px) {
        .row.mx-0.px-0 {
            padding: 0 !important;
        }
        
        .question-slide {
            padding: 8px 5px !important;
        }
        
        .answer-option {
            padding: 8px 5px !important;
        }
        
        .col-md-9, 
        .col-md-3 {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
    }

    /* Đảm bảo phần nội dung câu hỏi không gây overflow */
    .question-content-container {
        width: 100% !important;
        max-width: 100% !important;
        overflow-x: hidden !important;
    }

    /* Sửa vấn đề với inline styles */
    [style*="width:"] {
        max-width: 100% !important;
    }

    /* Thêm styles cho phần kết quả */
    .test-result-container {
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    .stat-item {
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .stat-item h5 {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .stat-item .h2 {
        color: #2d3748;
        font-weight: 600;
    }

    .retry-section {
        border-top: 1px solid #dee2e6;
        padding-top: 20px;
    }

    .retry-section p {
        color: #6c757d;
        margin-bottom: 15px;
    }
</style>

<script nonce="{{ csrf_token() }}">
// Biến lưu trữ chỉ mục câu hỏi hiện tại
let currentQuestionIndex = 0;
const totalQuestions = {{ $currentTest->questions->count() }};

document.addEventListener('DOMContentLoaded', function() {
    // Đếm thời gian làm bài
    const timerElement = document.getElementById('timer');
    const testDuration = {{ $currentTest->duration ?? 30 }} * 60; // Đổi phút sang giây
    let timeRemaining = testDuration;
    
    const timerInterval = setInterval(function() {
        timeRemaining--;
        
        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;
        
        timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        
        if (timeRemaining <= 0) {
            clearInterval(timerInterval);
            submitTest(true); // Tự động nộp bài khi hết thời gian
        }
    }, 1000);
    
    // Cập nhật trạng thái câu hỏi đã trả lời
    const radioInputs = document.querySelectorAll('input[type="radio"]');
    
    radioInputs.forEach(input => {
        input.addEventListener('change', function() {
            updateAnsweredStatus();
        });
    });
    
    // Làm cho cả label và radio đều có thể chọn
    const answerOptions = document.querySelectorAll('.answer-option');
    answerOptions.forEach(option => {
        option.addEventListener('click', function(e) {
            // Không kích hoạt khi đã click vào input
            if (e.target.tagName !== 'INPUT') {
                const input = this.querySelector('input[type="radio"]');
                input.checked = true;
                
                // Kích hoạt sự kiện change
                const event = new Event('change');
                input.dispatchEvent(event);
            }
        });
    });
    
    // Xử lý nút nộp bài
    document.getElementById('submit-test-btn').addEventListener('click', function() {
        confirmSubmitTest();
    });
    
    // Hiển thị câu hỏi đầu tiên khi trang tải xong
    showQuestion(0);
    updateNavigationButtons();
});

// Hàm xác nhận nộp bài
function confirmSubmitTest() {
    // Đếm số câu hỏi đã trả lời
    const answeredQuestions = document.querySelectorAll('.question-number.answered').length;
    
    // Hiển thị thông báo xác nhận với SweetAlert2
    Swal.fire({
        title: 'Xác nhận nộp bài?',
        html: `Bạn đã trả lời <b>${answeredQuestions}/${totalQuestions}</b> câu hỏi.<br>Bạn có chắc chắn muốn nộp bài?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý, nộp bài!',
        cancelButtonText: 'Không, tôi cần kiểm tra lại',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            submitTest();
        }
    });
}

// Thay thế hàm submitTest cũ
function submitTest(isTimeout = false) {
    // Cập nhật trường ẩn trước khi submit
    document.getElementById('started_at_input').value = window.testStartTime;
    
    // Đảm bảo token CSRF được cập nhật
    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
    if (tokenMeta) {
        const tokenInput = document.querySelector('input[name="_token"]');
        if (tokenInput) {
            tokenInput.value = tokenMeta.content;
        }
    }
    
    if (isTimeout) {
        document.getElementById('timeout_input').value = '1';
        Swal.fire({
            title: 'Hết thời gian!',
            text: 'Thời gian làm bài đã hết. Bài làm của bạn sẽ được nộp tự động.',
            icon: 'info',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true
        }).then(() => {
            document.getElementById('testForm').submit();
        });
    } else {
        // Hiển thị thông báo đang xử lý
        Swal.fire({
            title: 'Đang nộp bài...',
            text: 'Vui lòng đợi trong giây lát',
            icon: 'info',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
                // Submit form sau một khoảng thời gian ngắn để đảm bảo Sweet Alert hiển thị
                setTimeout(function() {
                    document.getElementById('testForm').submit();
                }, 500);
            }
        });
    }
}

// Thêm biến lưu thời gian bắt đầu làm bài
window.testStartTime = new Date().toISOString();

// Hàm hiển thị câu hỏi được chọn
function showQuestion(index) {
    // Ẩn tất cả câu hỏi
    document.querySelectorAll('.question-slide').forEach(slide => {
        slide.style.display = 'none';
    });
    
    // Hiển thị câu hỏi được chọn
    document.getElementById('question-slide-' + index).style.display = 'block';
    
    // Cập nhật số câu hỏi hiện tại
    document.getElementById('current-question-num').textContent = index + 1;
    
    // Cập nhật trạng thái active cho câu hỏi trong danh sách
    document.querySelectorAll('.question-number').forEach(btn => {
        btn.classList.remove('active');
    });
    
    document.getElementById('question-number-' + index).classList.add('active');
    
    // Cập nhật chỉ mục câu hỏi hiện tại
    currentQuestionIndex = index;
    
    // Cập nhật trạng thái của các nút điều hướng
    updateNavigationButtons();
    
    // Cuộn lên đầu trang khi chuyển câu hỏi trên thiết bị di động
    if (window.innerWidth <= 768) {
        window.scrollTo(0, 0);
    }
}

// Cập nhật trạng thái của các nút điều hướng
function updateNavigationButtons() {
    const prevButton = document.getElementById('prev-question-btn');
    const nextButton = document.getElementById('next-question-btn');
    
    // Vô hiệu hóa nút "Câu trước" nếu đang ở câu đầu tiên
    if (currentQuestionIndex === 0) {
        prevButton.setAttribute('disabled', 'disabled');
    } else {
        prevButton.removeAttribute('disabled');
    }
    
    // Vô hiệu hóa nút "Câu tiếp theo" nếu đang ở câu cuối cùng
    if (currentQuestionIndex === totalQuestions - 1) {
        nextButton.setAttribute('disabled', 'disabled');
    } else {
        nextButton.removeAttribute('disabled');
    }
}

// Hàm điều hướng đến câu hỏi trước
function navigateToPrevQuestion() {
    if (currentQuestionIndex > 0) {
        showQuestion(currentQuestionIndex - 1);
    }
}

// Hàm điều hướng đến câu hỏi tiếp theo
function navigateToNextQuestion() {
    if (currentQuestionIndex < totalQuestions - 1) {
        showQuestion(currentQuestionIndex + 1);
    }
}

// Hàm cập nhật trạng thái câu hỏi đã trả lời
function updateAnsweredStatus() {
    const questions = document.querySelectorAll('.question-slide');
    
    questions.forEach((question, index) => {
        const isAnswered = question.querySelector('input[type="radio"]:checked') !== null;
        
        if (isAnswered) {
            document.getElementById('question-number-' + index).classList.add('answered');
        }
    });
}
</script>
