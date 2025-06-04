<!-- Key Phrases -->
<div class="key-phrases">
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
                                // Highlight các từ cần thiết
                                $patterns = [
                                    '/\b(địa danh|landmarks)\b/i' => '[highlight]$1[/highlight]',
                                    '/\b(ẩm thực|food)\b/i' => '[highlight]$1[/highlight]',
                                    '/\b(thành phố|city)\b/i' => '[highlight]$1[/highlight]',
                                    '/\b(nổi tiếng|famous)\b/i' => '[highlight]$1[/highlight]',
                                    '/\b(rộng lớn|big)\b/i' => '[highlight]$1[/highlight]',
                                    '/\b(đa quốc tích|multicultural)\b/i' => '[highlight]$1[/highlight]',
                                ];

                                foreach ($patterns as $pattern => $replacement) {
                                    $vietnameseText = preg_replace($pattern, $replacement, $vietnameseText);
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
