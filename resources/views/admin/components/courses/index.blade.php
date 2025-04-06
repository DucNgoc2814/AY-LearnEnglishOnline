@extends('admin.layouts.master')
@section('title', 'Quản lý khóa học')
@section('content')
    <main class="flex-grow">
        <div class="flex justify-between items-center p-2 border-bottom">
            <h1 class="text-2xl font-bold">Khóa học <span class="text-gray-500">({{ $pagination['total'] }})</span></h1>
            <div class="flex space-x-2">
                <button class="bg-blue-500 text-white px-2 py-1 rounded" onclick="modalHandler.open('createCourseModal')">
                    <i class="fas fa-plus"></i> Thêm mới
                </button>
                <button class="border border-blue-500 text-blue-500 px-2 py-1 rounded"
                    onclick="modalHandler.open('trashCourseModal')">
                    <i class="fas fa-trash"></i> Xem khóa học đã xóa
                </button>
            </div>
        </div>

        <div class="flex justify-between items-center ms-2 mb-1">
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <button class="bg-gray-200 px-1 py-1 rounded">Bộ lọc</button>
                    <ul class="absolute hidden bg-white shadow-lg rounded mt-2">
                        <li><a class="block px-1 py-1 text-gray-800 hover:bg-gray-200" href="#">Tạo mới</a></li>
                    </ul>
                </div>
                <div class="relative w-300">
                    <form action="{{ route('admin.courses.index') }}" method="GET">
                        <input type="text" name="search" class="border border-gray-300 rounded w-full px-1 py-1 w-3xl"
                            placeholder="Tìm kiếm..." value="{{ request('search') }}">
                        <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="flex space-x-2">
                <button class="bg-gray-200 px-2 rounded" title="Làm mới"><i class="fas fa-sync-alt"></i></button>
                <button class="bg-gray-200 px-2 me-2 rounded" title="Tùy chọn hiển thị"><i
                        class="fas fa-th-large"></i></button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300" data-table="courses">
                <thead>
                    <tr>
                        <th class="border ps-1 py-1 border-gray-300 text-center">
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600">
                        </th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="index">STT</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="category_id">Danh mục</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="title">Tiêu đề</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="course_type">Loại khóa học
                        </th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="course_format">Hình thức</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="price">Giá gốc</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="sale_price">Giá khuyến mãi
                        </th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="total_students">Số học viên
                        </th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="rating">Đánh giá</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center" data-column="is_active">Trạng thái</th>
                        <th class="border ps-1 py-1 border-gray-300 text-center">
                            <button class="p-2 hover:bg-gray-100 rounded">
                                <i class="fas fa-cog"></i>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $key => $item)
                        <tr class="hover:bg-gray-100 transition-colors duration-150 text-center">
                            <td class="ps-1 pt-1">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                    data-id="{{ $item->id }}">
                            </td>
                            <td class="ps-1 pt-1" data-column="index">
                                {{ ($pagination['current_page'] - 1) * $pagination['per_page'] + $key + 1 }}
                            </td>
                            <td class="ps-1 pt-1" data-column="category_id">{{ $item->category->name ?? 'N/A' }}</td>
                            <td class="ps-1 pt-1" data-column="title">
                                <div class="flex items-center">
                                    <i class="fas fa-caret-right mr-2 toggle-lessons"
                                        data-course-id="{{ $item->id }}"></i>
                                    <a href="javascript:void(0)" class="text-blue-500 course-title"
                                        data-course-id="{{ $item->id }}">{{ $item->title }}</a>
                                </div>
                            </td>
                            <td class="ps-1 pt-1" data-column="course_type">
                                @switch($item->course_type)
                                    @case('self_paced')
                                        <span class="text-green-600">Tự học</span>
                                    @break

                                    @case('instructor_led')
                                        <span class="text-blue-600">Có giảng viên</span>
                                    @break

                                    @case('hybrid')
                                        <span class="text-purple-600">Kết hợp</span>
                                    @break
                                @endswitch
                            </td>
                            <td class="ps-1 pt-1" data-column="course_format">
                                @switch($item->course_format)
                                    @case('online')
                                        <span class="text-blue-600">Trực tuyến</span>
                                    @break

                                    @case('offline')
                                        <span class="text-orange-600">Trực tiếp</span>
                                    @break

                                    @case('hybrid')
                                        <span class="text-purple-600">Kết hợp</span>
                                    @break
                                @endswitch
                            </td>
                            <td class="ps-1 pt-1" data-column="price">{{ number_format($item->price) }}đ</td>
                            <td class="ps-1 pt-1" data-column="sale_price">
                                {{ $item->sale_price ? number_format($item->sale_price) . 'đ' : 'N/A' }}
                            </td>
                            <td class="ps-1 pt-1" data-column="total_students">{{ number_format($item->total_students) }}
                            </td>
                            <td class="ps-1 pt-1" data-column="rating">
                                <div class="flex items-center">
                                    {{ number_format($item->rating, 1) }}
                                    <i class="fas fa-star text-yellow-400 ml-1"></i>
                                    <span class="text-gray-500 text-sm ml-1">({{ $item->total_ratings }})</span>
                                </div>
                            </td>
                            <td class="ps-1 pt-1" data-column="is_active">
                                <span
                                    class="px-2 py-1 rounded-full text-sm {{ $item->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $item->is_active ? 'Hoạt động' : 'Không hoạt động' }}
                                </span>
                            </td>
                            <td class="ps-1 pt-1 text-center">
                                <div class="flex justify-center space-x-2">
                                    <form action="{{ route('admin.lessons.store') }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="course_id" value="{{ $item->id }}">
                                        <button type="button"
                                            onclick="addLesson(this, '{{ $item->title }}', {{ $item->id }})"
                                            class="text-blue-500 hover:text-blue-700" title="Thêm bài học">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </form>
                                    <button class="text-blue-500 hover:text-blue-700"
                                        onclick="editCourse({{ $item->id }})" title="Chỉnh sửa">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.courses.destroy', $item->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa khóa học này?')"
                                            title="Xóa">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr class="lesson-list" id="lessons-{{ $item->id }}">
                            <td colspan="12" class="p-0">
                                <div class="lesson-content">
                                    <h3 class="text-lg font-semibold mb-2">Danh sách bài học</h3>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full bg-white border border-gray-300">
                                            <thead>
                                                <tr>
                                                    <th class="border ps-1 py-1 text-center">STT</th>
                                                    <th class="border ps-1 py-1 text-center">Tên bài học</th>
                                                    <th class="border ps-1 py-1 text-center">Thứ tự</th>
                                                    <th class="border ps-1 py-1 text-center">Xem thử</th>
                                                    <th class="border ps-1 py-1 text-center">Lượt xem</th>
                                                    <th class="border ps-1 py-1 text-center">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody class="lessons-data" data-course-id="{{ $item->id }}">
                                                <tr>
                                                    <td colspan="6" class="text-center py-4">
                                                        <i class="fas fa-spinner fa-spin mr-2"></i>
                                                        Đang tải dữ liệu...
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if (count($courses) == 0)
                        <tr>
                            <td colspan="10" class="text-center ps-1 pt-1">Không có dữ liệu</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <div class="flex justify-between items-center p-4 bg-white border-t border-gray-200">
                <div class="text-sm text-gray-600">
                    Hiển thị từ <span
                        class="font-medium">{{ ($pagination['current_page'] - 1) * $pagination['per_page'] + 1 }}</span>
                    đến <span
                        class="font-medium">{{ min($pagination['current_page'] * $pagination['per_page'], $pagination['total']) }}</span>
                    của <span class="font-medium">{{ $pagination['total'] }}</span> bản ghi
                </div>
                <div class="flex items-center space-x-1">
                    @if ($pagination['current_page'] > 1)
                        <a href="{{ request()->url() }}?page=1{{ !empty(request('search')) ? '&search=' . request('search') : '' }}"
                            class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <a href="{{ request()->url() }}?page={{ $pagination['current_page'] - 1 }}{{ !empty(request('search')) ? '&search=' . request('search') : '' }}"
                            class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                            <i class="fas fa-angle-left"></i>
                        </a>
                    @else
                        <span
                            class="px-3 py-1 bg-gray-100 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed">
                            <i class="fas fa-angle-double-left"></i>
                        </span>
                        <span
                            class="px-3 py-1 bg-gray-100 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed">
                            <i class="fas fa-angle-left"></i>
                        </span>
                    @endif

                    @php
                        $start = max(1, $pagination['current_page'] - 2);
                        $end = min($pagination['last_page'], $pagination['current_page'] + 2);
                    @endphp

                    @if ($start > 1)
                        <span class="px-3 py-1 border border-gray-300 rounded-md text-gray-600">...</span>
                    @endif

                    @for ($i = $start; $i <= $end; $i++)
                        @if ($i == $pagination['current_page'])
                            <span
                                class="px-3 py-1 bg-blue-600 text-white border border-blue-600 rounded-md font-medium shadow-sm">
                                {{ $i }}
                            </span>
                        @else
                            <a href="{{ request()->url() }}?page={{ $i }}{{ !empty(request('search')) ? '&search=' . request('search') : '' }}"
                                class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                                {{ $i }}
                            </a>
                        @endif
                    @endfor

                    @if ($end < $pagination['last_page'])
                        <span class="px-3 py-1 border border-gray-300 rounded-md text-gray-600">...</span>
                    @endif

                    @if ($pagination['current_page'] < $pagination['last_page'])
                        <a href="{{ request()->url() }}?page={{ $pagination['current_page'] + 1 }}{{ !empty(request('search')) ? '&search=' . request('search') : '' }}"
                            class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                            <i class="fas fa-angle-right"></i>
                        </a>
                        <a href="{{ request()->url() }}?page={{ $pagination['last_page'] }}{{ !empty(request('search')) ? '&search=' . request('search') : '' }}"
                            class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                            <i class="fas fa-angle-double-right"></i>
                        </a>
                    @else
                        <span
                            class="px-3 py-1 bg-gray-100 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed">
                            <i class="fas fa-angle-right"></i>
                        </span>
                        <span
                            class="px-3 py-1 bg-gray-100 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed">
                            <i class="fas fa-angle-double-right"></i>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </main>

    @include('admin.components.courses.modals.create')
    @include('admin.components.courses.modals.edit')
    @include('admin.components.courses.modals.trash')
    @include('admin.components.lessons.modals.create')
    @include('admin.components.video-lessons.modals.create')
    @include('admin.components.video-lessons.modals.edit')

    <!-- Modal xem ảnh cho index -->
    <div id="imageVideoModal" class="fixed inset-0 z-[60] hidden overflow-y-auto" aria-labelledby="imageVideoModalLabel"
        aria-hidden="true">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="relative bg-white rounded-lg max-w-3xl w-full mx-auto">
                <!-- Header -->
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-xl font-semibold text-gray-900" id="imageVideoModalLabel">Xem ảnh</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeImageModal()">
                        <span class="sr-only">Đóng</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Body -->
                <div class="p-4">
                    <img id="modalImage" src="" alt="Preview" class="w-full h-auto">
                </div>
            </div>
        </div>
    </div>

    <style>
        .lesson-list {
            display: none;
            background-color: #f9fafb;
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .lesson-list.active {
            display: table-row;
            opacity: 1;
            transform: translateY(0);
        }

        .lesson-content {
            padding: 1rem;
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.5s ease-in-out;
        }

        .lesson-list.active .lesson-content {
            max-height: 2000px;
        }

        .toggle-lessons {
            cursor: pointer;
            transition: transform 0.3s ease;
            color: #9333ea;
        }

        .toggle-lessons.active {
            transform: rotate(90deg);
            color: #7e22ce;
        }

        .course-title {
            color: #9333ea !important;
            transition: color 0.2s;
        }

        .course-title:hover {
            color: #7e22ce !important;
            text-decoration: underline;
        }

        .video-list {
            display: none;
            background-color: #f3f4f6;
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
            z-index: 10;
        }

        .video-list.active {
            display: table-row;
            opacity: 1;
            transform: translateY(0);
        }

        .video-content {
            padding: 0.5rem;
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.5s ease-in-out;
        }

        .video-list.active .video-content {
            max-height: 1000px;
        }

        .toggle-videos {
            cursor: pointer;
            transition: transform 0.3s ease;
            color: #9333ea;
        }

        .toggle-videos.active {
            transform: rotate(90deg);
            color: #7e22ce;
        }

        .lesson-title {
            color: #9333ea;
            cursor: pointer;
            transition: color 0.2s;
        }

        .lesson-title:hover {
            color: #7e22ce;
            text-decoration: underline;
        }
    </style>

    <script>
        function addLesson(button, courseTitle, courseId) {
            // Mở modal
            const modal = document.getElementById('createLessonModal');
            modal.classList.remove('hidden');

            // Cập nhật thông tin trong modal
            document.getElementById('lessonCourseId').value = courseId;
            document.getElementById('courseTitleDisplay').textContent = courseTitle;
            document.getElementById('createLessonModalLabel').innerHTML = 'Thêm bài học cho khóa học';

            // Đặt giá trị mặc định
            document.getElementById('order_number').value = 1;

            // Setup form submit
            const modalForm = document.getElementById('createLessonForm');
            modalForm.action = "{{ route('admin.lessons.store') }}";
        }

        function addVideoLesson(lessonId, lessonName) {
            // Mở modal
            const modal = document.getElementById('createVideoLessonModal');
            modal.classList.remove('hidden');

            // Cập nhật thông tin trong modal
            document.getElementById('lessonId').value = lessonId;
            document.getElementById('createVideoLessonModalLabel').innerHTML = `Thêm video cho bài học: ${lessonName}`;

            // Reset form
            document.getElementById('createVideoLessonForm').reset();

            // Gọi hàm setLessonIdForVideo từ modal
            setLessonIdForVideo(lessonId);
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý đóng/mở danh sách bài học
            const toggleButtons = document.querySelectorAll('.toggle-lessons');
            const courseTitles = document.querySelectorAll('.course-title');

            // Hàm xử lý toggle
            function toggleLessonList(courseId) {
                const toggleButton = document.querySelector(`.toggle-lessons[data-course-id="${courseId}"]`);
                const lessonRow = document.getElementById('lessons-' + courseId);

                // Thêm hiệu ứng mượt mà khi toggle
                if (lessonRow.classList.contains('active')) {
                    // Đang mở -> đóng
                    const lessonContent = lessonRow.querySelector('.lesson-content');
                    lessonContent.style.maxHeight = '0';

                    // Đóng tất cả các video đang mở trong lesson này
                    const openVideos = lessonRow.querySelectorAll('.video-list.active');
                    openVideos.forEach(videoRow => {
                        const videoToggle = videoRow.previousElementSibling.querySelector('.toggle-videos');
                        const videoContent = videoRow.querySelector('.video-content');
                        videoContent.style.maxHeight = '0';

                        setTimeout(() => {
                            videoToggle.classList.remove('active');
                            videoRow.classList.remove('active');
                        }, 200);
                    });

                    // Delay để animation chạy trước khi ẩn row
                    setTimeout(() => {
                        toggleButton.classList.remove('active');
                        lessonRow.classList.remove('active');
                    }, 250);
                } else {
                    // Đang đóng -> mở
                    toggleButton.classList.add('active');
                    lessonRow.classList.add('active');

                    if (!lessonRow.getAttribute('data-loaded')) {
                        loadLessons(courseId);
                    }

                    // Set max-height để animation chạy
                    setTimeout(() => {
                        const lessonContent = lessonRow.querySelector('.lesson-content');
                        lessonContent.style.maxHeight = (lessonContent.scrollHeight + 500) + 'px';
                    }, 10);
                }
            }

            // Áp dụng sự kiện cho nút toggle
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const courseId = this.getAttribute('data-course-id');
                    toggleLessonList(courseId);
                });
            });

            // Áp dụng sự kiện cho tiêu đề khóa học
            courseTitles.forEach(title => {
                title.addEventListener('click', function(e) {
                    e.preventDefault();
                    const courseId = this.getAttribute('data-course-id');
                    toggleLessonList(courseId);
                });
            });

            // Hàm để tải dữ liệu bài học của khóa học
            function loadLessons(courseId) {
                const lessonContainer = document.querySelector(`.lessons-data[data-course-id="${courseId}"]`);
                const lessonRow = document.getElementById('lessons-' + courseId);

                // Kiểm tra xem đã tải dữ liệu chưa
                if (lessonRow.getAttribute('data-loaded') === 'true') {
                    return;
                }

                // Gọi API để lấy dữ liệu
                fetch(`/admin/courses/${courseId}/lessons`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && data.lessons && data.lessons.length > 0) {
                            let html = '';
                            data.lessons.forEach((lesson, index) => {
                                html += `
                                <tr>
                                    <td class="border ps-1 py-1 text-center">${index + 1}</td>
                                    <td class="border ps-1 py-1">
                                        <div class="flex items-center">
                                            <i class="fas fa-caret-right mr-2 toggle-videos" data-lesson-id="${lesson.id}"></i>
                                            <a href="javascript:void(0)" class="lesson-title" data-lesson-id="${lesson.id}">${lesson.name}</a>
                                        </div>
                                    </td>
                                    <td class="border ps-1 py-1 text-center">${lesson.order_number}</td>
                                    <td class="border ps-1 py-1 text-center">${lesson.is_preview ? '<span class="text-green-600">Có</span>' : '<span class="text-red-600">Không</span>'}</td>
                                    <td class="border ps-1 py-1 text-center">${lesson.total_view}</td>
                                    <td class="border ps-1 py-1 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <button type="button" class="text-purple-600 hover:text-purple-800"
                                                onclick="addVideoLesson(${lesson.id}, '${lesson.name}')"
                                                title="Thêm video">
                                                <i class="fas fa-video"></i>
                                            </button>
                                            <a href="/admin/lessons/${lesson.id}/edit" class="text-purple-600 hover:text-purple-800">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <form action="/admin/lessons/${lesson.id}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa bài học này?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="video-list" id="videos-${lesson.id}">
                                    <td colspan="6" class="p-0">
                                        <div class="video-content">
                                            <h4 class="text-md font-semibold mb-2 ml-4">Danh sách video</h4>
                                            <div class="overflow-x-auto ml-4 mr-4">
                                                <table class="min-w-full bg-white border border-gray-300">
                                                    <thead>
                                                        <tr>
                                                            <th class="border ps-1 py-1 text-center">STT</th>
                                                            <th class="border ps-1 py-1 text-center">Tiêu đề</th>
                                                            <th class="border ps-1 py-1 text-center">Thời lượng</th>
                                                            <th class="border ps-1 py-1 text-center">Định dạng</th>
                                                            <th class="border ps-1 py-1 text-center">Thao tác</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="videos-data" data-lesson-id="${lesson.id}">
                                                        <tr>
                                                            <td colspan="5" class="text-center py-4">
                                                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                                                Đang tải dữ liệu...
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                `;
                            });
                            lessonContainer.innerHTML = html;
                        } else {
                            lessonContainer.innerHTML =
                                '<tr><td colspan="6" class="text-center py-4">Chưa có bài học nào cho khóa học này</td></tr>';
                        }

                        // Cập nhật maxHeight sau khi tải dữ liệu
                        setTimeout(() => {
                            const lessonContent = lessonRow.querySelector('.lesson-content');
                            lessonContent.style.maxHeight = lessonContent.scrollHeight + 'px';
                        }, 100);

                        // Đánh dấu đã tải dữ liệu
                        lessonRow.setAttribute('data-loaded', 'true');
                    })
                    .catch(error => {
                        console.error('Lỗi khi tải bài học:', error);
                        lessonContainer.innerHTML =
                            '<tr><td colspan="6" class="text-center py-4 text-red-500">Lỗi khi tải dữ liệu bài học</td></tr>';
                        lessonRow.setAttribute('data-loaded', 'error');
                    });
            }

            // Hàm để xử lý toggle cho video lessons
            function setupVideoToggle() {
                const videoToggles = document.querySelectorAll('.toggle-videos');
                videoToggles.forEach(button => {
                    button.addEventListener('click', function() {
                        const lessonId = this.getAttribute('data-lesson-id');
                        toggleVideoList(lessonId);
                    });
                });
            }

            // Hàm xử lý toggle cho video
            function toggleVideoList(lessonId) {
                const toggleButton = document.querySelector(`.toggle-videos[data-lesson-id="${lessonId}"]`);
                const videoRow = document.getElementById('videos-' + lessonId);
                const lessonRow = videoRow.closest('.lesson-list');
                const lessonContent = lessonRow.querySelector('.lesson-content');

                if (videoRow.classList.contains('active')) {
                    // Đang mở -> đóng
                    const videoContent = videoRow.querySelector('.video-content');
                    videoContent.style.maxHeight = '0';

                    setTimeout(() => {
                        toggleButton.classList.remove('active');
                        videoRow.classList.remove('active');

                        // Cập nhật lại max-height của lesson content
                        lessonContent.style.maxHeight = (lessonContent.scrollHeight - videoContent
                            .scrollHeight) + 'px';
                    }, 250);
                } else {
                    // Đang đóng -> mở
                    toggleButton.classList.add('active');
                    videoRow.classList.add('active');

                    if (!videoRow.getAttribute('data-loaded')) {
                        loadVideos(lessonId);
                    }

                    setTimeout(() => {
                        const videoContent = videoRow.querySelector('.video-content');
                        videoContent.style.maxHeight = videoContent.scrollHeight + 'px';

                        // Cập nhật lại max-height của lesson content để có thể hiển thị video
                        lessonContent.style.maxHeight = (lessonContent.scrollHeight + videoContent
                            .scrollHeight + 200) + 'px';
                    }, 10);
                }
            }

            // Hàm để tải dữ liệu video của bài học
            function loadVideos(lessonId) {
                const videoContainer = document.querySelector(`.videos-data[data-lesson-id="${lessonId}"]`);
                const videoRow = document.getElementById('videos-' + lessonId);
                const lessonRow = videoRow.closest('.lesson-list');
                const lessonContent = lessonRow.querySelector('.lesson-content');

                if (videoRow.getAttribute('data-loaded') === 'true') {
                    return;
                }

                console.log(`Đang tải videos cho bài học ID: ${lessonId}`);
                fetch(`/admin/lessons/${lessonId}/videos`)
                    .then(response => {
                        console.log('API Response status:', response.status);
                        return response.json();
                    })
                    .then(data => {
                        console.log('API Response data:', data);
                        if (data.success && data.videos && data.videos.length > 0) {
                            let html = '';
                            data.videos.forEach((video, index) => {
                                html += `
                                <tr>
                                    <td class="border ps-1 py-1 text-center">${index + 1}</td>
                                    <td class="border ps-1 py-1">${video.name || 'Không có tiêu đề'}</td>
                                    <td class="border ps-1 py-1 text-center">${video.duration || 'N/A'}</td>
                                    <td class="border ps-1 py-1 text-center">${video.video_type || 'N/A'}</td>
                                    <td class="border ps-1 py-1 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700"
                                                onclick="editVideoLesson(${video.id})" title="Chỉnh sửa">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <form action="/admin/video-lessons/${video.id}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa video này?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                `;
                            });
                            videoContainer.innerHTML = html;
                        } else {
                            videoContainer.innerHTML =
                                '<tr><td colspan="5" class="text-center py-4">Chưa có video nào cho bài học này</td></tr>';
                        }

                        setTimeout(() => {
                            const videoContent = videoRow.querySelector('.video-content');
                            videoContent.style.maxHeight = videoContent.scrollHeight + 'px';

                            // Cập nhật lại max-height của lesson content
                            lessonContent.style.maxHeight = (lessonContent.scrollHeight + videoContent
                                .scrollHeight + 200) + 'px';
                        }, 100);

                        videoRow.setAttribute('data-loaded', 'true');
                    })
                    .catch(error => {
                        console.error('Lỗi khi tải video:', error);
                        videoContainer.innerHTML =
                            '<tr><td colspan="5" class="text-center py-4 text-red-500">Lỗi khi tải dữ liệu video</td></tr>';
                        videoRow.setAttribute('data-loaded', 'error');
                    });
            }

            // Thêm vào ngay sau hàm setupVideoToggle
            function setupLessonTitleClick() {
                const lessonTitles = document.querySelectorAll('.lesson-title');
                lessonTitles.forEach(title => {
                    title.addEventListener('click', function(e) {
                        e.preventDefault();
                        const lessonId = this.getAttribute('data-lesson-id');
                        toggleVideoList(lessonId);
                    });
                });
            }

            // Cập nhật observer để cũng thiết lập sự kiện click cho lesson title
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                        setupVideoToggle();
                        setupLessonTitleClick();
                    }
                });
            });

            const lessonsContainers = document.querySelectorAll('.lessons-data');
            lessonsContainers.forEach(container => {
                observer.observe(container, {
                    childList: true
                });
            });

            // Thêm các hàm cho modal hỗ trợ edit video
            function openImageModal(src) {
                const modal = document.getElementById('imageVideoModal');
                const modalImage = document.getElementById('modalImage');
                modalImage.src = src;
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeImageModal() {
                const modal = document.getElementById('imageVideoModal');
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });
    </script>
@endsection
