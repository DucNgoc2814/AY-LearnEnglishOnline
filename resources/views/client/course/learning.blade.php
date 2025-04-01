@extends('client.layouts.master')

@section('title', $course->title . ' - Learning')

@section('content')
    <div class="learning-container">
        <!-- Sidebar -->
        <div class="course-sidebar d-none d-lg-flex flex-column"> <!-- Ẩn trên mobile/tablet, hiện từ lg trở lên -->
            <div class="sidebar-header d-flex justify-content-between">
                <div class="">
                    <h4 class="course-title">{{ $course->title ?? 'Không tìm thấy tên khóa học' }}</h4>
                    <p class="course-stats">
                        <i class="fas fa-book-open me-1"></i>
                        <span>{{ $course->totalLessons() }} bài học</span>
                    </p>
                </div>
                <div class="course-title">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-home"></i>
                        Trang chủ
                    </a>
                </div>
            </div>

            <div class="lesson-list">
                @foreach ($course->lessons as $lesson)
                    <div class="lesson-item">
                        <div class="lesson-header d-flex justify-content-between align-items-center {{ isset($currentLesson) && $currentLesson->id === $lesson->id ? 'active' : '' }}"
                            data-bs-toggle="dropdown" data-bs-target="#lesson{{ $lesson->id }}"
                            data-lesson-id="{{ $lesson->id }}" data-lesson-slug="{{ $lesson->slug }}"
                            data-course-slug="{{ $course->slug }}"
                            aria-expanded="{{ isset($currentLesson) && $currentLesson->id === $lesson->id ? 'true' : 'false' }}">
                            <div class="d-flex align-items-center flex-grow-1">
                                <i class="fas fa-chevron-right lesson-icon me-2 text-dark"></i>
                                <span class="lesson-name">{{ $lesson->name }}</span>
                            </div>
                            <div class="lesson-meta d-flex align-items-center">
                                <span class="lesson-duration">
                                    <i class="far fa-clock me-1"></i>
                                    @php
                                        // Calculate total seconds for this lesson
                                        $totalSeconds = $lesson->videoLessons->sum('duration');
                                        $hours = floor($totalSeconds / 3600);
                                        $minutes = floor(($totalSeconds % 3600) / 60);
                                        $seconds = $totalSeconds % 60;

                                        if ($hours > 0) {
                                            echo sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                                        } else {
                                            echo sprintf('%02d:%02d', $minutes, $seconds);
                                    } @endphp
                                </span>
                            </div>
                        </div>

                        <div id="lesson{{ $lesson->id }}"
                            class="lesson-content-dropdown {{ isset($currentLesson) && $currentLesson->id === $lesson->id ? 'show' : '' }}">
                            <div class="lesson-content">
                                @if ($lesson->videoLessons && $lesson->videoLessons->count() > 0)
                                    @foreach ($lesson->videoLessons as $videoLesson)
                                        <a href="{{ route('course.learning.video', ['courseSlug' => $course->slug, 'lessonSlug' => $lesson->slug, 'videoSlug' => $videoLesson->slug]) }}"
                                            class="content-item {{ (isset($currentVideo) && $currentVideo->id === $videoLesson->id) || (request()->route()->getName() === 'course.learning.video' && request()->route('videoSlug') === $videoLesson->slug) ? 'active' : '' }}"
                                            onclick="activateItem(this)">
                                            <div class="d-flex align-items-center">
                                                <i
                                                    class="fa-regular fa-circle-play me-2 {{ isset($completedVideos) && in_array($videoLesson->id, $completedVideos) ? 'text-success' : '' }}"></i>
                                                <span class="video-title text-truncate" title="{{ $videoLesson->name ?? 'Không tìm thấy tên video' }}">
                                                    {{ $videoLesson->name ?? 'Không tìm thấy tên video' }}
                                                </span>
                                            </div>
                                            <span class="duration">
                                                @php
                                                    $time = $videoLesson->duration;
                                                    $hours = floor($time / 3600);
                                                    $minutes = floor(($time % 3600) / 60);
                                                    $seconds = $time % 60;

                                                    if ($hours > 0) {
                                                        echo sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                                                    } else {
                                                        echo sprintf('%02d:%02d', $minutes, $seconds);
                                                } @endphp
                                            </span>
                                        </a>
                                    @endforeach
                                @endif

                                @if ($lesson->lessonTests && $lesson->lessonTests->count() > 0)
                                    @foreach ($lesson->lessonTests as $test)
                                        <a href="{{ route('course.learning.test', ['courseSlug' => $course->slug, 'lessonSlug' => $lesson->slug, 'testSlug' => $test->slug]) }}"
                                            class="content-item {{ isset($currentTest) && $currentTest->id === $test->id ? 'active' : '' }}"
                                            onclick="activateItem(this)">
                                            <div class="d-flex align-items-center">
                                                <i class="fa-solid fa-file-pen text-success me-2"></i>
                                                <span class="test-title">{{ $test->name }}</span>
                                            </div>
                                            <span class="badge bg-success p-1">Bài kiểm tra</span>
                                        </a>
                                    @endforeach
                                @endif

                                @if (
                                    (!$lesson->videoLesson || $lesson->videoLesson->count() === 0) &&
                                        (!$lesson->lessonTests || $lesson->lessonTests->count() === 0))
                                    <div class="content-item text-muted">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <span>Chưa có nội dung cho bài học này</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

          
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1">
            <div class="content-wrapper h-100">
                @if (request()->route()->getName() === 'course.learning.test')
                    @include('client.course.partials.testContent')
                @elseif(request()->route()->getName() === 'course.learning.video')
                    @include('client.course.partials.videoContent')
                @else
                    @include('client.course.partials.videoContent')
                @endif

                <!-- Tab cho bình luận -->
                <div class="comments-section mt-3 p-3 bg-white">
                    <ul class="nav nav-tabs" id="learningTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="learning-comments-tab" data-bs-toggle="tab"
                                data-bs-target="#learning-comments" type="button" role="tab" aria-controls="learning-comments"
                                aria-selected="true">
                                <i class="far fa-comments me-1"></i> Bình luận
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content p-3 border border-top-0 rounded-bottom">
                        <div class="tab-pane fade show active" id="learning-comments" role="tabpanel" aria-labelledby="learning-comments-tab">
                            <div class="comments mt-1">
                                @auth
                                    <div class="comment-form mb-2">
                                        <form action="{{ route('client.comments.store') }}" method="POST" class="ajaxForm" id="learningCommentForm">
                                            @csrf
                                            <input type="hidden" name="commentable_type" value="App\Models\Course">
                                            <input type="hidden" name="commentable_id" value="{{ $course->id }}">
                                            <div class="form-group position-relative">
                                                <textarea name="content" class="form-control pr-5" placeholder="Viết bình luận của bạn..." rows="2" id="learningCommentContent"></textarea>
                                                <button type="submit" class="btn btn-link position-absolute send-icon" id="submitLearningComment">
                                                    <i class="fas fa-paper-plane text-primary"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @else
                                    <div class="alert alert-info py-2 mb-2">
                                        Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để bình luận
                                    </div>
                                @endauth

                                <div class="learning-comments-list">
                                    <!-- Bình luận sẽ được tải qua AJAX -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        /* Container Layout */
        .learning-container {
            display: flex;
            height: 100vh;
            background: #fff;
        }

        .content-header {
            padding: 20px;
            background: #1769c7;
        }

        /* Sidebar Styles */
        .course-sidebar {
            width: 320px;
            min-width: 320px;
            height: 100vh;
            display: flex;
            flex-direction: column;
            border-right: 1px solid #e5e7eb;
            background: #fff;
        }

        .sidebar-header {
            padding: 12px;
            background: #f8f9fa;
            border-bottom: 1px solid #e5e7eb;
        }

        .course-title {
            padding-top: 10px;
            padding-left: 12px;
            font-size: 1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 4px;
        }

        .course-stats {
            padding-left: 12px;
            font-size: 0.75rem;
            color: #6c757d;
            margin: 0;
        }

        /* Lesson List Styles */
        .lesson-list {
            flex: 1;
            overflow-y: auto;
            max-height: calc(100vh - 80px);
        }

        .lesson-item {
            border-bottom: 1px solid #f1f1f1;
            overflow: hidden;
        }

        .lesson-header {
            padding: 10px 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            user-select: none;
        }

        .lesson-header.active {
            background: #e3f2fd;
            color: #0d6efd;
        }

        .lesson-header.active .lesson-name {
            color: #0d6efd;
        }

        .lesson-name {
            font-size: 0.8rem;
            font-weight: 600;
            color: #000000;
        }

        .lesson-meta {
            font-size: 0.7rem;
            color: #6c757d;
        }

        .lesson-icon {
            font-size: 9px;
            transition: transform 0.2s ease;
            color: #0d6efd;
            display: inline-block;
        }

        /* Lesson Content Styles */
        .content-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 7px 12px 7px 30px;
            color: #2c3e50;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.85rem;
            gap: 8px;
        }

        .content-item:hover {
            background: #f1f1f1;
        }

        /* .video-info {
                                    flex: 1;
                                    min-width: 0;
                                }

                                .video-info:hover {
                                    color: var(--color-4);

                                } */

        .test-title {
            font-size: 0.75rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 180px;
        }

        .video-duration {
            font-size: 0.65rem;
            color: #6c757d;
            white-space: nowrap;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #000;
        }

        .video-title {
            font-size: 0.75rem;
            white-space: nowrap;
            /* overflow: hidden; */
            /* text-overflow: ellipsis; */
            max-width: 180px;
        }

        .video-description {
            font-size: 0.85rem;
            color: #6c757d;
            margin: 0;
        }

        .video-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #000;
        }

        .video-wrapper {
            width: 100%;
            height: 100%;
        }

        .video-wrapper iframe,
        .video-wrapper video {
            width: 100%;
            height: 100%;
            background: #000;
        }

        .no-video {
            text-align: center;
            color: #6c757d;
        }

        .no-video i {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
        }

        /* Scrollbar Styles */
        .lesson-list::-webkit-scrollbar {
            width: 6px;
        }

        .lesson-list::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .lesson-list::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        .lesson-list::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Animation for collapse */
        .collapse {
            transition: height 0.3s ease-in-out !important;
        }

        .lesson-content {
            background: #ffffff;
            transition: all 0.3s ease-in-out;
        }

        .lesson-content a:active {
            background: #f1f1f1;
        }

        /* Animation improvements */
        .lesson-icon {
            transition: transform 0.3s ease-in-out !important;
            display: inline-block;
        }

        .content-item {
            transition: all 0.2s ease-in-out !important;
        }

        /* Hover effect improvements */
        .lesson-header:hover {
            background: #f1f4f8;
        }

        .lesson-header:hover .lesson-name {
            color: var(--color-4);
        }

        /* Active state improvements */
        .content-item.active {
            background-color: rgba(186, 230, 253, 0.4) !important;
        }

        .content-item.active:hover {
            background: #d4e5ff;
        }


        .content-item .fa-file-pen {
            color: #198754 !important; /* Màu xanh lá giống với Bootstrap */
        }

        .content-item .test-title {
            color: #2c3e50 !important; /* Màu giống với video-title */
        }

        .content-item.active .test-title {
            color: #000 !important;
        }

        /* Style cho icon trong mục active */
        .content-item.active i.fa-file-pen {
            color: #22c55e !important; /* Màu xanh lá cho icon */
        }
        
        /* Style cho title trong mục active */
        .content-item.active .test-title {
            color: #000 !important;
        }

        /* Add visual feedback for clickable items */
        .lesson-header {
            position: relative;
            overflow: hidden;
        }

        .lesson-header::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            background: rgba(13, 110, 253, 0.1);
            border-radius: 50%;
            transform: translate(-50%, -50%) scale(0);
            transition: transform 0.4s ease-out;
            pointer-events: none;
        }

        .lesson-header:active::after {
            transform: translate(-50%, -50%) scale(2);
            opacity: 0;
        }

        /* Dropdown Styles */
        .lesson-content-dropdown {
            display: none;
            background: #ffffff;
            transition: all 0.3s ease;
            border-top: 1px solid #eee;
        }

        .lesson-content-dropdown.show {
            display: block;
        }

        /* Badge styling */
        .badge.bg-success {
            font-size: 0.65rem;
            font-weight: normal;
            padding: 0.2em 0.5em;
        }

        /* Icon styling */
        .total-items i,
        .lesson-duration i {
            font-size: 0.7rem;
        }

        /* Làm nhỏ icon */
        .content-item i {
            font-size: 0.75rem;
        }

        /* Add this to your CSS styles */
        .video-info {
            max-width: 200px; /* Adjust this value based on your sidebar width */
            overflow: hidden;
        }

        .video-title {
            max-width: 170px; /* Adjust based on your layout */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý dropdown menu cho bài học
            const lessonHeaders = document.querySelectorAll('.lesson-header');

            lessonHeaders.forEach(header => {
                header.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('data-bs-target');
                    const targetElement = document.querySelector(targetId);
                    const icon = this.querySelector('.lesson-icon');

                    // Đóng tất cả các dropdown khác
                    document.querySelectorAll('.lesson-content-dropdown.show').forEach(el => {
                        if (el.id !== targetId.substring(1)) {
                            el.classList.remove('show');
                            const otherHeader = document.querySelector(
                                `[data-bs-target="#${el.id}"]`);
                            if (otherHeader) {
                                otherHeader.setAttribute('aria-expanded', 'false');
                                const otherIcon = otherHeader.querySelector('.lesson-icon');
                                if (otherIcon) otherIcon.style.transform = 'rotate(0deg)';
                            }
                        }
                    });

                    // Toggle dropdown hiện tại
                    if (targetElement) {
                        targetElement.classList.toggle('show');
                        const isExpanded = targetElement.classList.contains('show');
                        this.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');

                        if (icon) {
                            icon.style.transform = isExpanded ? 'rotate(90deg)' : 'rotate(0deg)';
                        }

                        // Cuộn đến header khi mở dropdown
                        if (isExpanded) {
                            setTimeout(() => {
                                this.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'start'
                                });
                            }, 150);
                        }
                    }
                });
            });

            // Mở dropdown cho bài học hiện tại
            const activeItem = document.querySelector('.content-item.active');
            if (activeItem) {
                const parentDropdown = activeItem.closest('.lesson-content-dropdown');
                if (parentDropdown) {
                    parentDropdown.classList.add('show');

                    const header = document.querySelector(`[data-bs-target="#${parentDropdown.id}"]`);
                    if (header) {
                        header.setAttribute('aria-expanded', 'true');
                        const icon = header.querySelector('.lesson-icon');
                        if (icon) {
                            icon.style.transform = 'rotate(90deg)';
                        }
                    }

                    // Cuộn đến mục đang active
                    setTimeout(() => {
                        activeItem.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }, 300);
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="{{ asset('js/notification.js') }}"></script>

    <script>
    $(function() {
        // Kiểm tra thông báo từ session và hiển thị alert
        @if(session('notification'))
        if (typeof showNotification === 'function') {
            showNotification("{{ session('notification.message') }}", "{{ session('notification.type') }}");
        }
        @endif

        // Load bình luận khi trang được tải
        loadLearningComments(1);
        
        // Xử lý phân trang cho comments
        $(document).on('click', '.learning-comments-list .pagination a', function(e) {
            e.preventDefault();
            var page = $(this).data('page');
            loadLearningComments(page);
        });
        
        // Function để tải bình luận
        function loadLearningComments(page) {
            $.ajax({
                url: '/courses/{{ $course->id }}/comments?page=' + page,
                type: 'GET',
                beforeSend: function() {
                    $('.learning-comments-list').html('<div class="text-center py-3"><i class="fas fa-spinner fa-spin"></i> Đang tải bình luận...</div>');
                },
                success: function(response) {
                    $('.learning-comments-list').html(response.html);
                },
                error: function() {
                    $('.learning-comments-list').html('<div class="alert alert-danger">Có lỗi xảy ra khi tải bình luận.</div>');
                }
            });