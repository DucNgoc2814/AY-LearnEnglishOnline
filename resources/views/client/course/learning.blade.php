@extends('client.layouts.master')

@section('title', $course->name . ' - Learning')

@section('content')
    <div class="learning-container">
        <!-- Sidebar -->
        <div class="course-sidebar d-none d-lg-flex flex-column"> <!-- Ẩn trên mobile/tablet, hiện từ lg trở lên -->
            <div class="sidebar-header">
                <h4 class="course-title">{{ $course->name ?? 'Không tìm thấy tên khóa học' }}</h4>
                <p class="course-stats">
                    <i class="fas fa-book-open me-1"></i>
                    <span>{{ $course->totalLessons() }} bài học</span>
                </p>
            </div>

            <div class="lesson-list">
                @foreach ($course->lessons as $lesson)
                    <div class="lesson-item">
                        <div class="lesson-header d-flex justify-content-between align-items-center" data-bs-toggle="dropdown"
                            data-bs-target="#lesson{{ $lesson->id }}" data-lesson-id="{{ $lesson->id }}"
                            data-lesson-slug="{{ $lesson->slug }}" data-course-slug="{{ $course->slug }}"
                            aria-expanded="{{ isset($currentLesson) && $currentLesson->id === $lesson->id ? 'true' : 'false' }}">
                            <div class="d-flex align-items-center flex-grow-1">
                                <i class="fas fa-chevron-right lesson-icon me-2 text-dark"></i>
                                <span class="lesson-name">{{ $lesson->name }}</span>
                            </div>
                            <div class="lesson-meta d-flex align-items-center">
                                <span class="lesson-duration">
                                    <i class="fa-regular fa-clock me-1"></i><span>{{ $lesson->totalVideoDuration() }}</span>
                                </span>
                            </div>
                        </div>

                        <div id="lesson{{ $lesson->id }}"
                            class="lesson-content-dropdown {{ isset($currentLesson) && $currentLesson->id === $lesson->id ? 'show' : '' }}">
                            <div class="lesson-content">
                                @if ($lesson->videoLesson && $lesson->videoLesson->count() > 0)
                                    @foreach ($lesson->videoLesson as $index => $video)
                                        <a href="{{ route('course.learning', ['courseSlug' => $course->slug, 'bai-hoc' => $lesson->slug, 'video' => $video->id]) }}"
                                            class="content-item {{ isset($currentVideo) && $currentVideo->id === $video->id ? 'active' : '' }}">
                                            <div class="d-flex align-items-center video-info">
                                                <i
                                                    class="fa-regular fa-circle-play me-2 {{ isset($completedVideos) && in_array($video->id, $completedVideos) ? 'text-success' : '' }}"></i>
                                                <div class="video-title-wrapper">
                                                    {{ $video->name ?? 'Không tìm thấy tên video' }}</div>
                                            </div>
                                            <span class="video-duration">{{ $video->totalDuration() }}</span>
                                        </a>
                                    @endforeach
                                @endif

                                @if ($lesson->lessonTests && $lesson->lessonTests->count() > 0)
                                    @foreach ($lesson->lessonTests as $test)
                                        <a href="{{ route('course.learning', ['courseSlug' => $course->slug, 'bai-hoc' => $lesson->slug, 'bai-kiem-tra' => $test->id]) }}"
                                            class="content-item {{ isset($currentTest) && $currentTest->id === $test->id ? 'active' : '' }}">
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

        <!-- Mobile/Tablet Sidebar Toggle Button -->
        <div class="d-lg-none position-fixed top-0 start-0 p-2 z-3">
            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mobileSidebar">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Mobile/Tablet Sidebar -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">{{ $course->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body p-0">
                <!-- Copy nội dung từ sidebar chính -->
                <div class="course-sidebar w-100 h-100">
                    <div class="sidebar-header">
                        <h4 class="course-title">{{ $course->name ?? 'Không tìm thấy tên khóa học' }}</h4>
                        <p class="course-stats">
                            <i class="fas fa-book-open me-1"></i>
                            <span>{{ $course->totalLessons() }} bài học</span>
                        </p>
                    </div>
                    <div class="lesson-list">
                        <!-- Copy nội dung lesson list -->
                        @foreach ($course->lessons as $lesson)
                            <div class="lesson-item">
                                <div class="lesson-header d-flex justify-content-between align-items-center"
                                    data-bs-toggle="dropdown" data-bs-target="#lesson{{ $lesson->id }}"
                                    data-lesson-id="{{ $lesson->id }}" data-lesson-slug="{{ $lesson->slug }}"
                                    data-course-slug="{{ $course->slug }}"
                                    aria-expanded="{{ isset($currentLesson) && $currentLesson->id === $lesson->id ? 'true' : 'false' }}">
                                    <div class="d-flex align-items-center flex-grow-1">
                                        <i class="fas fa-chevron-right lesson-icon me-2"></i>
                                        <span class="lesson-name">{{ $lesson->name }}</span>
                                    </div>
                                    <div class="lesson-meta d-flex align-items-center">
                                        <span class="lesson-duration">
                                            <i
                                                class="fa-regular fa-clock me-1"></i><span>{{ $lesson->totalVideoDuration() }}</span>
                                        </span>
                                    </div>
                                </div>

                                <div id="lesson{{ $lesson->id }}"
                                    class="lesson-content-dropdown {{ isset($currentLesson) && $currentLesson->id === $lesson->id ? 'show' : '' }}">
                                    <div class="lesson-content">
                                        @if ($lesson->videoLesson && $lesson->videoLesson->count() > 0)
                                            @foreach ($lesson->videoLesson as $index => $video)
                                                <a href="{{ route('course.learning', ['courseSlug' => $course->slug, 'bai-hoc' => $lesson->slug, 'video' => $video->id]) }}"
                                                    class="content-item {{ isset($currentVideo) && $currentVideo->id === $video->id ? 'active' : '' }}">
                                                    <div class="d-flex align-items-center video-info">
                                                        <i
                                                            class="fa-regular fa-circle-play me-2 {{ isset($completedVideos) && in_array($video->id, $completedVideos) ? 'text-success' : '' }}"></i>
                                                        <div class="video-title-wrapper">
                                                            {{ $video->name ?? 'Không tìm thấy tên video' }}</div>
                                                    </div>
                                                    <span class="video-duration">{{ $video->totalDuration() }}</span>
                                                </a>
                                            @endforeach
                                        @endif

                                        @if ($lesson->lessonTests && $lesson->lessonTests->count() > 0)
                                            @foreach ($lesson->lessonTests as $test)
                                                <a href="{{ route('course.learning', ['courseSlug' => $course->slug, 'bai-hoc' => $lesson->slug, 'bai-kiem-tra' => $test->id]) }}"
                                                    class="content-item {{ isset($currentTest) && $currentTest->id === $test->id ? 'active' : '' }}">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-file-pen text-success me-2"></i>
                                                        <span class="test-title">{{ $test->name }}</span>
                                                    </div>
                                                    <span class="badge bg-success">Bài kiểm tra</span>
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
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content flex-grow-1">
            <div class="content-header">
                <h4 class="video-title">{{ $currentLesson->name ?? 'Không tìm thấy tên bài học' }}</h4>
            </div>

            <div class="video-container">
                @if ($video)
                    @if ($video->videoType === 'youtube')
                        <div class="video-wrapper">
                            <iframe src="{{ $video->videoUrl }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    @else
                        <div class="video-wrapper">
                            <video controls src="{{ $video->videoUrl }}" poster="{{ $video->thumbnailUrl }}">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @endif
                @else
                    <div class="no-video">
                        <i class="fas fa-video"></i>
                        <p>Không có video cho bài học này</p>
                    </div>
                @endif
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

        .video-info {
            flex: 1;
            min-width: 0;
        }

        .video-info:hover {
            color: var(--color-4);

        }

        .video-title-wrapper {
            font-size: 0.75rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 100%;
        }

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

        .content-header {
            padding-top: 10px;
            padding: 15px;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
        }

        .video-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 6px;
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
            background: #ffffff;
            color: #0d6efd;
            border-left: 3px solid #0d6efd;
            font-weight: 500;
        }

        .content-item.active:hover {
            background: #d4e5ff;
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
    </style>
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
@endpush
