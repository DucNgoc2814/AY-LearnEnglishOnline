<!-- Key Phrases -->
<div class="key-phrases" data-key-phrase-id="{{ $step['phrases'][0]['id'] ?? '' }}">
    @if(empty($step['phrases']) || count($step['phrases']) === 0)
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>
            @if($current_lesson_id)
                Hiện tại chưa có key phrases cho bài học này.
            @else
                Vui lòng chọn một bài học để xem các key phrases.
            @endif
        </div>
    @else
    <div class="alert alert-info mb-4">
        <i class="fas fa-info-circle me-2"></i>
        Hãy dịch các từ được <span class="highlighted-word">highlight</span> sang tiếng Anh
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th class="text-center" style="width: 50%">English</th>
                    <th class="text-center" style="width: 50%">Vietnamese</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($step['phrases'] as $index => $phrase)
                    <tr class="phrase-row" data-complete="{{ $phrase['english']['complete'] }}">
                        <td>
                            <div class="d-flex flex-column gap-2">
                                <div class="phrase-content d-flex align-items-center flex-wrap gap-2">
                                    @php
                                        $parts = preg_split(
                                            '/([a-z]_+)/',
                                            $phrase['english']['incomplete'],
                                            -1,
                                            PREG_SPLIT_DELIM_CAPTURE,
                                        );
                                        $parts = array_filter($parts);
                                        $blanks = $phrase['english']['blanks'] ?? [];
                                    @endphp

                                    @foreach ($parts as $index => $part)
                                        @if (strpos($part, '_') !== false)
                                            <input type="text"
                                                class="form-control form-control-sm d-inline-block blank-input"
                                                style="width: 120px; min-width: 80px;"
                                                data-answer="{{ $blanks[floor($index / 2)] ?? '' }}"
                                                placeholder="Type here...">
                                        @else
                                            <span>{{ $part }}</span>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="answer-feedback" style="display: none;">
                                    <span class="text-success">
                                        <i class="fas fa-check-circle me-1"></i>
                                        {{ $phrase['english']['complete'] }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">
                            @php
                                $vietnameseText = $phrase['vietnamese'];
                                $highlightedWords = $phrase['highlighted_words'] ?? [];

                                if (!empty($highlightedWords)) {
                                    // Nếu là mảng đơn, chuyển thành mảng các phần tử
                                    if (!is_array(reset($highlightedWords))) {
                                        $highlightedWords = [$highlightedWords];
                                    }

                                    // Sắp xếp từ dài nhất đến ngắn nhất
                                    usort($highlightedWords, function($a, $b) {
                                        return strlen($b['word']) - strlen($a['word']);
                                    });

                                    foreach ($highlightedWords as $wordData) {
                                        if (isset($wordData['word'])) {
                                            $word = trim($wordData['word']);
                                            if (!empty($word)) {
                                                // Thêm boundary và escape các ký tự đặc biệt
                                                $pattern = '/\b' . preg_quote($word, '/') . '\b/ui';
                                                $vietnameseText = preg_replace($pattern, '[highlight]$0[/highlight]', $vietnameseText);
                                            }
                                        }
                                    }
                                }
                            @endphp

                            {!! preg_replace(
                                '/\[highlight\](.*?)\[\/highlight\]/',
                                '<span class="highlighted-word">$1</span>',
                                $vietnameseText
                            ) !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-center mt-4">
        <button class="btn btn-primary" id="checkPhrases" onclick="checkPhrases()">
            <i class="fas fa-check me-2"></i>Kiểm tra đáp án
        </button>
        <button class="btn btn-success ms-2 save-phrases-progress" onclick="savePhrasesProgress()">
            <i class="fas fa-save me-2"></i>Lưu tiến độ
        </button>
    </div>
    @endif
</div>

<style>
    .highlighted-word {
        font-weight: bold;
        background-color: #fff3cd;
        color: #dc3545;
        padding: 2px 4px;
        border-radius: 4px;
    }

    .key-phrases .table td {
        font-size: 1rem;
        line-height: 1.6;
    }

    .blank-input {
        border: 2px solid #dee2e6;
        transition: all 0.2s ease-in-out;
    }

    .blank-input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .blank-input.is-valid {
        border-color: #198754;
        background-color: #d1e7dd;
    }

    .blank-input.is-invalid {
        border-color: #dc3545;
        background-color: #f8d7da;
    }
</style>

@push('scripts')
<script>
function savePhrasesProgress() {
    const rows = document.querySelectorAll('.phrase-row');
    let totalPhrases = rows.length;
    let completedPhrases = 0;
    let completedItems = [];
    let totalScore = 0;

    // Kiểm tra xem có ít nhất một câu trả lời nào không
    let hasAnyAnswer = false;

    rows.forEach((row, index) => {
        const inputs = row.querySelectorAll('.blank-input');
        let rowAnswers = [];
        let rowScore = 0;
        let hasAnswer = false;

        inputs.forEach(input => {
            const userAnswer = input.value.trim().toLowerCase();
            if (userAnswer) {
                hasAnswer = true;
                hasAnyAnswer = true;
                const correctAnswer = input.dataset.answer.toLowerCase();
                rowAnswers.push({
                    user_answer: userAnswer,
                    correct_answer: correctAnswer,
                    is_correct: userAnswer === correctAnswer
                });

                if (userAnswer === correctAnswer) {
                    rowScore += 100 / inputs.length;
                }
            }
        });

        // Nếu có ít nhất một câu trả lời trong hàng này
        if (hasAnswer) {
            completedPhrases++;
            completedItems.push({
                phrase_index: index,
                answers: rowAnswers,
                score: rowScore
            });
            totalScore += rowScore;
        }
    });

    // Nếu không có câu trả lời nào, hiển thị thông báo
    if (!hasAnyAnswer) {
        Swal.fire({
            icon: 'warning',
            title: 'Chưa có câu trả lời!',
            text: 'Vui lòng điền ít nhất một câu trả lời trước khi lưu tiến độ.',
        });
        return;
    }

    const progress = (completedPhrases / totalPhrases) * 100;
    const averageScore = completedPhrases > 0 ? totalScore / completedPhrases : 0;

    // Get key_phrase_id from the data attribute
    const keyPhraseId = document.querySelector('.key-phrases').dataset.keyPhraseId;

    // Send data to server
    fetch('/online/classes/vocabulary-listening/phrases/save-progress', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            key_phrase_id: keyPhraseId,
            progress: progress,
            score: averageScore,
            completed_items: completedItems,
            current_position: completedPhrases
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: data.message,
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            throw new Error(data.message);
        }
    })
    .catch(error => {
        // Show error message
        Swal.fire({
            icon: 'error',
            title: 'Lỗi!',
            text: error.message || 'Có lỗi xảy ra khi lưu tiến độ',
        });
    });
}
</script>
@endpush
