@extends('online.layouts.master')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">{{ $title }}</h4>

            <ul class="nav nav-tabs" id="exerciseTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="step1-tab" data-bs-toggle="tab" data-bs-target="#step1" type="button" role="tab">
                        <span class="badge bg-primary me-2">1</span>XEM VIDEO CÁCH LÀM "REFLECTION"
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="step2-tab" data-bs-toggle="tab" data-bs-target="#step2" type="button" role="tab">
                        <span class="badge bg-primary me-2">2</span>VIẾT USEFUL SENTENCE STRUCTURES
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="step3-tab" data-bs-toggle="tab" data-bs-target="#step3" type="button" role="tab">
                        <span class="badge bg-primary me-2">3</span>VIẾT REFLECTION
                    </button>
                </li>
            </ul>

            <div class="tab-content pt-4" id="exerciseTabContent">
                <!-- Step 1: Watch Video -->
                <div class="tab-pane fade show active" id="step1" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-body p-0">
                                    <div class="ratio ratio-16x9">
                                        <iframe src="https://www.youtube.com/embed/your-video-id" title="How to Write a Reflection" allowfullscreen class="rounded"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-lightbulb me-2 text-warning"></i>Hướng dẫn Bước 1
                                    </h5>
                                    <div class="card-text">
                                        <p class="mb-3">Xem video hướng dẫn cách viết Reflection và ghi chú những điểm quan trọng:</p>
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Cấu trúc của một bài Reflection</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Các điểm cần đề cập</li>
                                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Cách trình bày ý tưởng</li>
                                            <li><i class="fas fa-check text-success me-2"></i>Các lỗi cần tránh</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Useful Sentence Structures -->
                <div class="tab-pane fade" id="step2" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">
                                        <i class="fas fa-pen me-2 text-primary"></i>Useful Sentence Structures
                                    </h5>
                                    <div class="sentence-patterns">
                                        <!-- Pattern 1 -->
                                        <div class="pattern-item mb-4">
                                            <div class="pattern-number mb-2">1.</div>
                                            <div class="pattern-content">
                                                <p class="mb-2">
                                                    <span class="text-primary">X is a nice place</span>, but sometimes ...
                                                </p>
                                                <p class="text-muted mb-2">(X là một nơi dễ chịu, nhưng thỉnh thoảng...)</p>
                                                <p class="example mb-2">E.g: Banbury's nice, but sometimes I find it a bit boring</p>
                                                <div class="practice-section">
                                                    <p class="text-warning mb-1">> Hãy viết câu của bạn:</p>
                                                    <textarea class="form-control" rows="2" data-pattern="1"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pattern 2 -->
                                        <div class="pattern-item mb-4">
                                            <div class="pattern-number mb-2">2.</div>
                                            <div class="pattern-content">
                                                <p class="mb-2">
                                                    <span class="text-primary">I find it</span> + (tính từ)
                                                </p>
                                                <p class="text-muted mb-2">(Mình thấy (điều này) + tính từ)</p>
                                                <p class="example mb-2">E.g: I find it a bit boring.</p>
                                                <div class="practice-section">
                                                    <p class="text-warning mb-1">> Hãy viết câu của bạn:</p>
                                                    <textarea class="form-control" rows="2" data-pattern="2"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pattern 3 -->
                                        <div class="pattern-item mb-4">
                                            <div class="pattern-number mb-2">3.</div>
                                            <div class="pattern-content">
                                                <p class="mb-2">
                                                    <span class="text-primary">I am not very keen on</span> + V-ing/cụm danh từ
                                                </p>
                                                <p class="text-muted mb-2">(Mình không thích + V-ing/cụm danh từ)</p>
                                                <p class="example mb-2">E.g: I'm not very keen on the hot weather</p>
                                                <div class="practice-section">
                                                    <p class="text-warning mb-1">> Hãy viết câu của bạn:</p>
                                                    <textarea class="form-control" rows="2" data-pattern="3"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Pattern 4 -->
                                        <div class="pattern-item mb-4">
                                            <div class="pattern-number mb-2">4.</div>
                                            <div class="pattern-content">
                                                <p class="mb-2">
                                                    ... <span class="text-primary">is something I don't like</span>.
                                                </p>
                                                <p class="text-muted mb-2">(... là điều mình không thích)</p>
                                                <p class="example mb-2">E.g: The hot wind from the desert is something I don't like.</p>
                                                <div class="practice-section">
                                                    <p class="text-warning mb-1">> Hãy viết câu của bạn:</p>
                                                    <textarea class="form-control" rows="2" data-pattern="4"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Write Reflection -->
                <div class="tab-pane fade" id="step3" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">
                                        <i class="fas fa-edit me-2 text-success"></i>Write Your Reflection
                                    </h5>
                                    <form id="reflectionForm">
                                        <!-- Question 1 -->
                                        <div class="mb-4">
                                            <label class="form-label fw-bold">1. Where is your hometown?</label>
                                            <textarea class="form-control" rows="3" name="question1" data-question="1"></textarea>
                                        </div>

                                        <!-- Question 2 -->
                                        <div class="mb-4">
                                            <label class="form-label fw-bold">2. What do you like most about living there?</label>
                                            <textarea class="form-control" rows="3" name="question2" data-question="2"></textarea>
                                        </div>

                                        <!-- Question 3 -->
                                        <div class="mb-4">
                                            <label class="form-label fw-bold">3. Is there anything you don't like about your hometown?</label>
                                            <textarea class="form-control" rows="3" name="question3" data-question="3"></textarea>
                                        </div>

                                        <!-- Question 4 -->
                                        <div class="mb-4">
                                            <label class="form-label fw-bold">4. What kinds of things can visitors to your hometown do and see?</label>
                                            <textarea class="form-control" rows="3" name="question4" data-question="4"></textarea>
                                        </div>

                                        <!-- Question 5 -->
                                        <div class="mb-4">
                                            <label class="form-label fw-bold">5. How is your hometown changing?</label>
                                            <textarea class="form-control" rows="3" name="question5" data-question="5"></textarea>
                                        </div>

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-2"></i>Save Reflection
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-list-check me-2 text-primary"></i>Lưu ý
                                    </h5>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-2">
                                            <i class="far fa-square text-primary me-2"></i>
                                            Đưa vào <a href="https://padlet.com/quynhndhmazingyou/reflection-unit-1-hometown-hvgtkdqmm9r1vfpz" target="_blank" class="text-decoration-none">Padlet</a> sau để viết Reflection
                                        </li>
                                        <li class="mb-2">
                                            <i class="far fa-square text-primary me-2"></i>
                                            Các bạn <strong>cần sử dụng các cụm từ đã học</strong> trong Active Listening & <strong>hãy gạch chân</strong> các cụm từ đó trong bài Reflection của bạn
                                        </li>
                                        <li class="mb-2">
                                            <i class="far fa-square text-primary me-2"></i>
                                            Dùng từ điển Oxford, <strong>tra phiên âm</strong> những từ bạn chưa tự tin đọc.
                                            <a href="https://www.oxfordlearnersdictionaries.com/" target="_blank" class="text-decoration-none">Oxford Dictionary</a>
                                        </li>
                                        <li class="mb-2">
                                            <i class="far fa-square text-primary me-2"></i>
                                            Xem bài làm mẫu:
                                            <a href="https://docs.google.com/document/d/1xJPBN9rYQCrYB6srnQbzox3-nYk6MFQz/edit?usp=sharing&ouid=108291581882921431091&rtpof=true&sd=true" target="_blank" class="text-decoration-none">Sample Answer</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .nav-tabs {
        border-bottom: 2px solid #e9ecef;
    }
    .nav-tabs .nav-link {
        border: none;
        border-bottom: 2px solid transparent;
        padding: 1rem 1.5rem;
        margin-bottom: -2px;
        font-weight: 500;
        color: #6c757d;
    }
    .nav-tabs .nav-link:hover {
        border-color: transparent;
        color: #0d6efd;
    }
    .nav-tabs .nav-link.active {
        color: #0d6efd;
        border-bottom: 2px solid #0d6efd;
    }
    .structure-group .list-group-item {
        border-left: none;
        border-right: none;
    }
    .structure-group .list-group-item:first-child {
        border-top: none;
    }
    .structure-group .list-group-item:last-child {
        border-bottom: none;
    }
    .pattern-item {
        padding: 20px;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        background-color: #fff;
    }
    .pattern-number {
        font-weight: bold;
        font-size: 1.1rem;
    }
    .pattern-content {
        padding-left: 20px;
    }
    .example {
        font-style: italic;
        color: #495057;
    }
    .practice-section {
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px dashed #dee2e6;
    }
    .text-primary {
        font-weight: 500;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle reflection form
    const reflectionForm = document.getElementById('reflectionForm');
    const questionTextareas = document.querySelectorAll('textarea[data-question]');

    if (reflectionForm && questionTextareas) {
        // Load saved answers
        questionTextareas.forEach(textarea => {
            const questionId = textarea.dataset.question;
            const savedAnswer = localStorage.getItem(`reflection_q${questionId}`);
            if (savedAnswer) {
                textarea.value = savedAnswer;
            }
        });

        // Save answers while typing
        questionTextareas.forEach(textarea => {
            textarea.addEventListener('input', function() {
                const questionId = this.dataset.question;
                localStorage.setItem(`reflection_q${questionId}`, this.value);
            });
        });

        // Handle form submission
        reflectionForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Save all answers
            questionTextareas.forEach(textarea => {
                const questionId = textarea.dataset.question;
                localStorage.setItem(`reflection_q${questionId}`, textarea.value);
            });

            alert('Reflection saved successfully!');
        });
    }

    // Handle pattern exercises (existing code)
    const patternTextareas = document.querySelectorAll('.practice-section textarea');
    patternTextareas.forEach(textarea => {
        const patternId = textarea.dataset.pattern;

        // Load saved answer
        const savedAnswer = localStorage.getItem(`pattern_${patternId}`);
        if (savedAnswer) {
            textarea.value = savedAnswer;
        }

        // Save answer while typing
        textarea.addEventListener('input', function() {
            localStorage.setItem(`pattern_${patternId}`, this.value);
        });
    });
});
</script>
@endpush
@endsection
