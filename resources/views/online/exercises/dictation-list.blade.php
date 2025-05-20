@extends('online.layouts.master')

@section('title', 'Danh sách bài tập')

@section('styles')
<style>
    .exercise-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .page-header {
        background: linear-gradient(135deg, #0061f2 0%, #6e00ff 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .nav-tabs {
        border: none;
        margin-bottom: 2rem;
        background: white;
        padding: 1rem;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .nav-tabs .nav-link {
        border: none;
        color: #6b7280;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .nav-tabs .nav-link:hover {
        color: #4f46e5;
        background: #f3f4f6;
    }

    .nav-tabs .nav-link.active {
        color: #4f46e5;
        background: #eef2ff;
        border: none;
    }

    .exercise-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .exercise-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .exercise-card .card-body {
        padding: 1.5rem;
    }

    .exercise-number {
        font-size: 1.5rem;
        font-weight: 600;
        color: #4f46e5;
        margin-bottom: 0.5rem;
    }

    .exercise-status {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .status-new {
        background-color: #ecfdf5;
        color: #065f46;
    }

    .status-completed {
        background-color: #eff6ff;
        color: #1e40af;
    }

    .video-card {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
    }

    .video-thumbnail {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .video-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.2s ease;
    }

    .video-card:hover .video-overlay {
        opacity: 1;
    }

    .play-button {
        width: 60px;
        height: 60px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4f46e5;
        font-size: 24px;
    }

    .progress-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .progress-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .progress-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1f2937;
        margin: 0;
    }

    .progress-status {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .progress-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .progress-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f3f4f6;
    }

    .progress-item:last-child {
        border-bottom: none;
    }

    .progress-checkbox {
        margin-right: 1rem;
    }

    .progress-checkbox input[type="checkbox"] {
        width: 1.2rem;
        height: 1.2rem;
        border-radius: 4px;
        border: 2px solid #d1d5db;
        cursor: pointer;
    }

    .progress-checkbox input[type="checkbox"]:checked {
        background-color: #4f46e5;
        border-color: #4f46e5;
    }

    .progress-info {
        flex-grow: 1;
    }

    .progress-name {
        font-weight: 500;
        color: #1f2937;
        margin-bottom: 0.25rem;
    }

    .progress-description {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .progress-date {
        font-size: 0.875rem;
        color: #9ca3af;
    }

    .progress-bar-container {
        height: 4px;
        background: #e5e7eb;
        border-radius: 2px;
        margin-top: 1rem;
    }

    .progress-bar {
        height: 100%;
        background: #4f46e5;
        border-radius: 2px;
        transition: width 0.3s ease;
    }
</style>
@endsection

@section('content')
<div class="exercise-container">
    <div class="page-header">
        <h2 class="text-2xl font-bold mb-2">Bài tập luyện tập</h2>
        <p class="text-white-600">Luyện tập kỹ năng nghe, nói và phát âm tiếng Anh.</p>
    </div>

    <!-- Navigation Tabs -->
    <ul class="nav nav-tabs" id="exerciseTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="dictation-tab" data-bs-toggle="tab" data-bs-target="#dictation" type="button" role="tab">
                <i class="fas fa-headphones me-2"></i>Bài tập Dictation
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#video" type="button" role="tab">
                <i class="fas fa-video me-2"></i>Xem video và lồng tiếng
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="progress-tab" data-bs-toggle="tab" data-bs-target="#progress" type="button" role="tab">
                <i class="fas fa-chart-line me-2"></i>Tiến độ học tập
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="exerciseTabsContent">
        <!-- Dictation Exercises Tab -->
        <div class="tab-pane fade show active" id="dictation" role="tabpanel">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($dictations as $dictation)
                <div class="col">
                    <div class="exercise-card h-100">
                        <div class="card-body">
                            <div class="exercise-number">Bài {{ $dictation->id }}</div>
                            <div class="mb-3">
                                <span class="exercise-status status-new">Mới</span>
                            </div>
                            <p class="text-gray-600 mb-4">
                                Luyện nghe và viết theo đoạn hội thoại.
                            </p>
                            <a href="{{ route('exercises.dictation', ['id' => $dictation->id]) }}"
                               class="btn btn-primary d-block">
                                Bắt đầu
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Video Dubbing Tab -->
        <div class="tab-pane fade" id="video" role="tabpanel">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @for($i = 1; $i <= 6; $i++)
                <div class="col">
                    <div class="exercise-card h-100">
                        <div class="video-card">
                            <img src="https://via.placeholder.com/640x360?text=Video+{{$i}}" alt="Video thumbnail" class="video-thumbnail">
                            <div class="video-overlay">
                                <div class="play-button">
                                    <i class="fas fa-play"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-2">Video Practice {{$i}}</h5>
                            <p class="text-gray-600 mb-4">
                                Xem video và thực hành lồng tiếng theo nhân vật.
                            </p>
                            <a href="{{ route('exercises.video-dubbing.show', ['id' => $i]) }}" class="btn btn-primary d-block">
                                Bắt đầu
                            </a>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>

        <!-- Progress Tab -->
        <div class="tab-pane fade" id="progress" role="tabpanel">
            <!-- Video Progress Card -->
            <div class="progress-card">
                <div class="progress-header">
                    <h3 class="progress-title">Tiến độ xem video và lồng tiếng</h3>
                    <span class="progress-status">2/6 hoàn thành</span>
                </div>
                <ul class="progress-list">
                    @for($i = 1; $i <= 6; $i++)
                    <li class="progress-item">
                        <label class="progress-checkbox">
                            <input type="checkbox" name="video_progress[]" value="{{ $i }}"
                                   {{ in_array($i, [1, 3]) ? 'checked' : '' }}
                                   onchange="updateProgress(this)">
                        </label>
                        <div class="progress-info">
                            <div class="progress-name">Video Practice {{ $i }}</div>
                            <div class="progress-description">Xem video và thực hành lồng tiếng theo nhân vật</div>
                        </div>
                        <div class="progress-date">
                            {{ in_array($i, [1, 3]) ? '20/03/2024' : '' }}
                        </div>
                    </li>
                    @endfor
                </ul>
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: 33%"></div>
                </div>
            </div>

            <!-- Dictation Progress Card -->
            <div class="progress-card">
                <div class="progress-header">
                    <h3 class="progress-title">Tiến độ bài tập Dictation</h3>
                    <span class="progress-status">{{ $dictations->where('completed', true)->count() }}/{{ $dictations->count() }} hoàn thành</span>
                </div>
                <ul class="progress-list">
                    @foreach($dictations as $dictation)
                    <li class="progress-item">
                        <label class="progress-checkbox">
                            <input type="checkbox" name="dictation_progress[]" value="{{ $dictation->id }}"
                                   {{ $dictation->completed ? 'checked' : '' }}
                                   onchange="updateProgress(this)">
                        </label>
                        <div class="progress-info">
                            <div class="progress-name">Bài {{ $dictation->id }}</div>
                            <div class="progress-description">Luyện nghe và viết theo đoạn hội thoại</div>
                        </div>
                        <div class="progress-date">
                            {{ $dictation->completed_at ? date('d/m/Y', strtotime($dictation->completed_at)) : '' }}
                        </div>
                    </li>
                    @endforeach
                </ul>
                <div class="progress-bar-container">
                    <div class="progress-bar" style="width: {{ ($dictations->where('completed', true)->count() / $dictations->count()) * 100 }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Bootstrap tabs
        var triggerTabList = [].slice.call(document.querySelectorAll('#exerciseTabs button'))
        triggerTabList.forEach(function (triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)
            triggerEl.addEventListener('click', function (event) {
                event.preventDefault()
                tabTrigger.show()
            })
        })
    });

    function updateProgress(checkbox) {
        const progressType = checkbox.name.includes('video') ? 'video' : 'dictation';
        const exerciseId = checkbox.value;
        const completed = checkbox.checked;

        // Gửi AJAX request để cập nhật tiến độ
        fetch('/exercises/progress/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                type: progressType,
                exercise_id: exerciseId,
                completed: completed
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Cập nhật UI
                const dateElement = checkbox.closest('.progress-item').querySelector('.progress-date');
                if (completed) {
                    dateElement.textContent = new Date().toLocaleDateString('vi-VN');
                } else {
                    dateElement.textContent = '';
                }

                // Cập nhật progress bar
                updateProgressBar(progressType);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Revert checkbox state if error
            checkbox.checked = !completed;
        });
    }

    function updateProgressBar(type) {
        const container = document.querySelector(`#${type}-progress`);
        const checkboxes = container.querySelectorAll('input[type="checkbox"]');
        const total = checkboxes.length;
        const completed = Array.from(checkboxes).filter(cb => cb.checked).length;
        const percentage = (completed / total) * 100;

        container.querySelector('.progress-bar').style.width = `${percentage}%`;
        container.querySelector('.progress-status').textContent = `${completed}/${total} hoàn thành`;
    }
</script>
@endpush
