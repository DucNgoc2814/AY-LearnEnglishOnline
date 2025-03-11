@extends('admin.layouts.master')
@section('title', isset($course) ? "Danh sách bài học - {$course->name}" : 'Quản lý bài học')
@section('content')
    <div class="main_content_iner">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>
                                @if (!empty($course))
                                    Khóa học: {{ $course->name }}
                                @else
                                    Bài học
                                @endif
                            </h4>
                            <div class="box_right d-flex lms_block">
                                <div class="add_button me-2">
                                    <a href="{{ route('admin.courses.index') }}" class="btn_1">
                                        <i class="fas fa-arrow-left"></i> Quay lại
                                    </a>
                                </div>
                                <div class="serach_field_2">
                                    <div class="search_inner">
                                        <form action="{{ route('admin.lessons.index') }}" method="GET">
                                            <div class="search_field">
                                                <input type="text" name="search" placeholder="Tìm kiếm..."
                                                    value="{{ request('search') }}">
                                            </div>
                                            <button type="submit"> <i class="ti-search"></i> </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="add_button ms-2">
                                    <button type="button" class="btn_1" data-bs-toggle="modal"
                                        data-bs-target="#trashLessonModal">
                                        Xem bài học đã xóa
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if (!empty($course))
                            <div class="white_box mb_30">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="course-info-item">
                                            <h5>Thông tin khóa học</h5>
                                            <div class="course-image mt-3">
                                                @if ($course->thumbnail)
                                                    <img src="{{ asset($course->thumbnail) }}" alt="{{ $course->name }}"
                                                        class="img-fluid rounded" style="max-width: 200px">
                                                @else
                                                    <div class="no-image">Chưa có ảnh</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="course-details">
                                            <table class="table">
                                                <tr>
                                                    <th width="200">Tên khóa học:</th>
                                                    <td>{{ $course->name }}</td>
                                                    <th>Tổng số đăng ký:</th>
                                                    <td>{{ $course->totalEnrollments() }}</td>
                                                </tr>
                                                <tr>
                                                    <th width="200">Giá gốc:</th>
                                                    <td>{{ number_format($course->price) }}đ</td>
                                                    <th>Tổng số bài học:</th>
                                                    <td>{{ $course->totalLessons() }} bài</td>
                                                </tr>
                                                <tr>
                                                    <th>Giá khuyến mãi:</th>
                                                    <td>{{ number_format($course->sale_price) }}đ</td>
                                                    <th>Tổng doanh thu:</th>
                                                    <td>{{ number_format($course->totalRevenue()) }}đ</td>
                                                </tr>
                                                <tr>
                                                    <th>Tổng thời lượng:</th>
                                                    <td>{{ $course->totalDuration() }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="QA_table mb_30">
                            <div class="d-flex justify-content-end align-items-center mb-3">
                                <div class="add_button me-2">
                                    <button type="button" class="btn_1" data-bs-toggle="modal"
                                        data-bs-target="#createLessonModal">
                                        <i class="fas fa-plus"></i> Thêm mới bài học
                                    </button>
                                </div>
                                <div class="add_button">
                                    <button type="button" class="btn_1" data-bs-toggle="modal"
                                        data-bs-target="#trashVideoLessonModal">
                                        Xem video/zoom bài học đã xóa
                                    </button>
                                </div>
                            </div>
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">STT</th>
                                        <th class="text-center align-middle">Tên bài học</th>
                                        <th class="text-center align-middle">Miêu tả</th>
                                        <th class="text-center align-middle">Xem Free</th>
                                        <th class="text-center align-middle">Tổng View</th>
                                        <th class="text-center align-middle">Tổng comment</th>
                                        <th class="text-center align-middle">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lessons as $key => $item)
                                        <tr>
                                            <td class="text-center align-middle">
                                                {{ ($pagination['current_page'] - 1) * $pagination['per_page'] + $key + 1 }}
                                            </td>
                                            <td class="text-center align-middle">{{ $item->name }}</td>
                                            <td class="text-center align-middle">{{ Str::limit($item->description, 50) }}
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="badge {{ $item->isPreview ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $item->isPreview ? 'Có' : 'Không' }}
                                                </span>
                                            </td>
                                            <td class="text-center align-middle">{{ number_format($item->totalView) }}</td>
                                            <td class="text-center align-middle">{{ number_format($item->totalComment) }}
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="action_btns d-flex justify-content-center">

                                                    <div class="dropdown d-inline-block">
                                                        <button type="button"
                                                            class="action_btn mr_10 btn btn-outline-info btn-sm"
                                                            data-bs-toggle="dropdown" aria-expanded="false"
                                                            title="Thêm mới video/zoom bài học">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item" href="#"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#createVideoLessonModal"
                                                                    onclick="setLessonIdForVideo({{ $item->id }})">
                                                                    <i class="fas fa-video me-2"></i>Bài học video
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#createZoomSessionModal">
                                                                    <i class="fas fa-chalkboard-teacher me-2"></i>Bài học
                                                                    zoom
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <button type="button"
                                                        class="action_btn mr_10 btn btn-outline-primary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#editLessonModal"
                                                        onclick="populateEditModal({{ json_encode($item) }})"
                                                        title="Chỉnh sửa">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('admin.lessons.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="action_btn btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa bài học này?')"
                                                            title="Xóa">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    <div class="dropdown d-inline-block me-2">
                                                        <button type="button" class="btn btn-outline-info btn-sm"
                                                            onclick="toggleVideoList({{ $item->id }})"
                                                            title="Xem danh sách video">
                                                            <i class="fas fa-chevron-down"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        {{-- Video Lessons Table --}}
                                        @if ($item->videoLessons && $item->videoLessons->count() > 0)
                                            <tr id="video-list-{{ $item->id }}">
                                                <td colspan="7" class="p-0">
                                                    <div class="video-list-container">
                                                        <div class="ms-5 me-4 mb-3">
                                                            <table class="table table-bordered table-sm table-hover-none">
                                                                <tbody>
                                                                    @foreach ($item->videoLessons as $index => $video)
                                                                        <tr>
                                                                            <td>{{ $video->name }}</td>
                                                                            <td class="text-center">
                                                                                <button type="button"
                                                                                    class="btn btn-info btn-sm text-white"
                                                                                    onclick="showVideo('{{ $video->videoUrl }}')"
                                                                                    title="Xem video">
                                                                                    <i class="fas fa-play me-1 text-white"></i>
                                                                                    XEM VIDEO BÀI HỌC
                                                                                </button>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                @if($video->duration)
                                                                                    @php
                                                                                        $minutes = floor($video->duration / 60);
                                                                                        $seconds = $video->duration % 60;
                                                                                        $durationText = $minutes . ' phút ' . $seconds . ' giây';
                                                                                    @endphp
                                                                                    {{ $durationText }}
                                                                                @else
                                                                                    N/A
                                                                                @endif
                                                                            </td>
                                                                            <td class="text-center">{{ $video->videoType }}
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <div
                                                                                    class="action_btns d-flex justify-content-center">
                                                                                    <button type="button"
                                                                                        class="action_btn mr_10 btn btn-outline-primary btn-sm"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#editVideoLessonModal"
                                                                                        onclick="populateEditVideoModal({{ json_encode($video) }})"
                                                                                        title="Chỉnh sửa">
                                                                                        <i class="far fa-edit"></i>
                                                                                    </button>
                                                                                    <form
                                                                                        action="{{ route('admin.video-lessons.destroy', $video->id) }}"
                                                                                        method="POST" class="d-inline">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="submit"
                                                                                            class="action_btn btn btn-outline-danger btn-sm"
                                                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa video này?')"
                                                                                            title="Xóa">
                                                                                            <i class="fas fa-trash"></i>
                                                                                        </button>
                                                                                    </form>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @if (count($lessons) == 0)
                                        <tr>
                                            <td colspan="8" class="text-center">Không có dữ liệu</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>


                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    Hiển thị từ {{ ($pagination['current_page'] - 1) * $pagination['per_page'] + 1 }}
                                    đến
                                    {{ min($pagination['current_page'] * $pagination['per_page'], $pagination['total']) }}
                                    của {{ $pagination['total'] }} bản ghi
                                </div>
                                <div>
                                    {{ $pagination['links'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Create Modal -->
    @include('admin.components.lessons.modals.create')

    <!-- Include Edit Modal -->
    @include('admin.components.lessons.modals.edit')

    <!-- Include Trash Modal -->
    @include('admin.components.lessons.modals.trash')

    <!-- Include Video Lesson Modal -->
    @include('admin.components.video-lessons.modals.create')

    <!-- Include Zoom Session Modal -->
    @include('admin.components.zoom-sessions.modals.create')

    <!-- Video Modal -->
    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Xem Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <video id="videoPlayer" class="w-100" controls>
                        <source src="" type="video/mp4">
                        Trình duyệt của bạn không hỗ trợ thẻ video.
                    </video>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Video Lesson Edit Modal -->
    @include('admin.components.video-lessons.modals.edit')
    @include('admin.components.video-lessons.modals.trash')

    <style>
        .video-list-container {
            overflow: hidden;
            transition: max-height 0.3s ease-in-out;
            max-height: 0;
        }

        .video-list-container.show {
            max-height: 1000px; /* Đủ cao để chứa nội dung */
        }

        .rotate-icon {
            transform: rotate(180deg);
            transition: transform 0.3s ease;
        }
    </style>
@endsection

@push('scripts')
    <script>
        function populateEditModal(item) {
            // Populate basic fields
            document.querySelector('#editLessonModal #lessonName').value = item.name;
            document.querySelector('#editLessonModal #orderNumber').value = item.orderNumber;
            document.querySelector('#editLessonModal #description').value = item.description || '';

            // Set checkbox state for preview
            document.querySelector('#editLessonModal #isPreview').checked = item.isPreview;

            // Update form action
            const form = document.querySelector('#editLessonModal form');
            form.action = "{{ route('admin.lessons.update', '') }}/" + item.id;
        }

        function showLessonDetails(id) {
            fetch(`/admin/lessons/${id}`)
                .then(response => response.json())
                .then(response => {
                    if (response.status && response.data) {
                        const lesson = response.data;
                        document.querySelector('#show-name').textContent = lesson.name;
                        document.querySelector('#show-category').textContent = lesson.category ? lesson.category.name :
                            'N/A';
                        document.querySelector('#show-price').textContent = lesson.price ? new Intl.NumberFormat(
                            'vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            }).format(lesson.price) : 'N/A';
                        const modal = new bootstrap.Modal(document.querySelector('#showLessonModal'));
                        modal.show();
                    }
                });
        }

        function setLessonIdForVideo(lessonId) {
            document.getElementById('lessonId').value = lessonId;
        }

        function showVideo(videoUrl) {
            const videoPlayer = document.getElementById('videoPlayer');
            videoPlayer.src = '/' + videoUrl;
            const videoModal = new bootstrap.Modal(document.getElementById('videoModal'));
            videoModal.show();

            // Dừng video khi đóng modal
            document.getElementById('videoModal').addEventListener('hidden.bs.modal', function() {
                videoPlayer.pause();
                videoPlayer.currentTime = 0;
            });
        }

        function toggleVideoList(lessonId) {
            const videoRow = document.querySelector(`#video-list-${lessonId}`);
            const button = event.currentTarget;
            const icon = button.querySelector('i');
            const container = videoRow.querySelector('.video-list-container');

            if (videoRow) {
                container.classList.toggle('show');
                icon.classList.toggle('rotate-icon');
            }
        }

        function populateEditVideoModal(video) {
            // Clear previous video info and thumbnail if exists
            const previousVideoInfo = document.querySelector('#editVideoLessonModal .video-info');
            if (previousVideoInfo) {
                previousVideoInfo.remove();
            }

            // Populate basic fields
            document.querySelector('#editVideoLessonModal #videoLessonName').value = video.name;
            document.querySelector('#editVideoLessonModal #duration').value = video.duration;

            // Update form action
            const form = document.querySelector('#editVideoLessonModal form');
            form.action = `/admin/video-lessons/${video.id}`;

            // Set lesson ID
            document.querySelector('#editVideoLessonModal #lessonId').value = video.lessonId;

            // Display current duration
            updateDurationDisplay(video.duration);

            // Display current thumbnail if exists
            const currentThumbnailDiv = document.querySelector('#editVideoLessonModal #currentThumbnail');
            currentThumbnailDiv.innerHTML = ''; // Clear previous content

            if (video.thumbnailUrl) {
                currentThumbnailDiv.innerHTML = `
                    <div class="mt-2">
                        <p>Ảnh thumbnail hiện tại:</p>
                        <img src="/${video.thumbnailUrl}"
                             alt="Current thumbnail"
                             class="img-thumbnail"
                             style="max-width: 200px">
                    </div>
                `;
            } else {
                currentThumbnailDiv.innerHTML = '<p class="text-muted">Chưa có ảnh thumbnail</p>';
            }

            // Display current video info if exists
            if (video.videoUrl) {
                const videoUrlInfo = document.createElement('div');
                videoUrlInfo.className = 'mt-2 video-info';
                videoUrlInfo.innerHTML = `
                    <p class="text-muted">Video hiện tại: ${video.videoUrl}</p>
                    <button type="button" class="btn btn-sm btn-info text-white"
                            onclick="showVideo('${video.videoUrl}')">
                        <i class="fas fa-play me-1"></i> Xem video
                    </button>
                `;
                const videoUrlContainer = document.querySelector('#editVideoLessonModal #videoUrl').parentNode;
                // Chỉ thêm thông tin video nếu chưa tồn tại
                if (!videoUrlContainer.querySelector('.video-info')) {
                    videoUrlContainer.appendChild(videoUrlInfo);
                }
            }
        }
    </script>
@endpush
