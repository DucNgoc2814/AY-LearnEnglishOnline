<div class="test-container">
    @if ($currentTest)
        <div class="test-header">
            <h5 class="test-title mb-3">{{ $currentTest->name }}</h5>
            <div class="test-info mb-4">
                <span class="badge bg-info me-2">
                    <i class="fas fa-clock me-1"></i>{{ $currentTest->duration ?? 60 }} phút
                </span>
                <span class="badge bg-primary">
                    <i class="fas fa-question-circle me-1"></i>{{ $currentTest->questions->count() ?? 0 }} câu hỏi
                </span>
            </div>
        </div>

        <form id="testForm" action="" method="POST">
            @csrf
            <div class="questions-container">
                @forelse($currentTest->questions as $index => $question)
                    <div class="question-card mb-4">
                        <div class="question-header">
                            <h6 class="question-title">
                                Câu {{ $index + 1 }}: {{ $question->question }}
                            </h6>
                        </div>
                        <div class="answers-list mt-3">
                            @foreach($question->answers as $answer)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" 
                                        name="answers[{{ $question->id }}]" 
                                        id="answer{{ $answer->id }}" 
                                        value="{{ $answer->id }}">
                                    <label class="form-check-label" for="answer{{ $answer->id }}">
                                        {{ $answer->answer }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        Chưa có câu hỏi nào cho bài kiểm tra này
                    </div>
                @endforelse
            </div>

            <div class="test-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane me-2"></i>Nộp bài
                </button>
            </div>
        </form>
    @else
        <div class="no-content">
            <i class="fas fa-info-circle"></i>
            <p>Không tìm thấy bài kiểm tra</p>
        </div>
    @endif
</div>

<style>
.test-container {
    background: #fff;
    padding: 20px;
    height: 100%;
    overflow-y: auto;
}

.test-header {
    border-bottom: 1px solid #e5e7eb;
    padding-bottom: 15px;
    margin-bottom: 20px;
}

.test-title {
    color: #2c3e50;
    font-weight: 600;
}

.question-card {
    background: #f8f9fa;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 20px;
}

.question-title {
    color: #2c3e50;
    font-weight: 600;
    font-size: 1rem;
}

.answers-list {
    padding-left: 10px;
}

.form-check-label {
    color: #4a5568;
    font-size: 0.95rem;
}

.test-actions {
    margin-top: 30px;
    padding: 20px 0;
    border-top: 1px solid #e5e7eb;
    text-align: center;
}

.badge {
    padding: 8px 12px;
    font-weight: 500;
}

.no-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #6c757d;
    text-align: center;
    padding: 20px;
}

.no-content i {
    font-size: 3rem;
    margin-bottom: 1rem;
}
</style> 