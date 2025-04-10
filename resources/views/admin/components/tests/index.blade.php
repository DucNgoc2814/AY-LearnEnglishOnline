@extends('admin.layouts.master')
@section('title', 'Quản lý bài test')
@section('content')
    <main class="flex-grow">
        <div class="flex justify-between items-center p-2 border-bottom">
            <h1 class="text-2xl font-bold">Bài test <span class="text-gray-500">({{ $pagination['total'] }})</span></h1>
            <div class="flex space-x-2">
                <button class="bg-blue-500 text-white px-2 py-1 rounded" onclick="modalHandler.open('createTestModal')">
                    <i class="fas fa-plus"></i> Thêm mới
                </button>
                <button class="border border-blue-500 text-blue-500 px-2 py-1 rounded" onclick="modalHandler.open('trashTestModal')">
                    <i class="fas fa-trash"></i> Xem bài test đã xóa
                </button>
            </div>
        </div>

        <div class="flex justify-between items-cente ms-2 mb-1">
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <button class="bg-gray-200 px-1 py-1 rounded">Bộ lọc</button>
                    <ul class="absolute hidden bg-white shadow-lg rounded mt-2">
                        <li><a class="block px-1 py-1 text-gray-800 hover:bg-gray-200" href="#">Tạo mới</a>
                        </li>
                    </ul>
                </div>
                <div class="relative w-300">
                    <form action="{{ route('admin.tests.index') }}" method="GET">
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
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="border ps-1 py-1 border-gray-300 text-start">
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out">
                        </th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">STT</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Tên bài test</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Loại test</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Liên kết với</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Điểm tối thiểu</th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Thời gian <i class="fas fa-sort"></i></th>
                        <th class="border ps-1 py-1 border-gray-300 text-start">Ngày tạo <i class="fas fa-sort"></i></th>
                        <th class="border ps-1 py-1 border-gray-300 text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tests as $key => $item)
                        <tr class="hover:bg-gray-100 transition-colors duration-150">
                            <td class="ps-1 pt-1">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out" data-id="{{ $item->id }}">
                            </td>
                            <td class="ps-1 pt-1">
                                {{ ($pagination['current_page'] - 1) * $pagination['per_page'] + $key + 1 }}
                            </td>
                            <td class="ps-1 pt-1">
                                <div class="flex items-center">
                                    <i class="fas fa-caret-right mr-2 toggle-questions" data-test-id="{{ $item->id }}"></i>
                                    <a href="javascript:void(0)" class="text-blue-500 test-title" data-test-id="{{ $item->id }}">{{ $item->name }}</a>
                                </div>
                            </td>
                            <td class="ps-1 pt-1">
                                @switch($item->type)
                                    @case('lesson_test')
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded">Bài học</span>
                                        @break
                                    @case('final_exam')
                                        <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2 py-0.5 rounded">Thi cuối khóa</span>
                                        @break
                                    @case('entrance_test')
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded">Test đầu vào</span>
                                        @break
                                    @case('session_test')
                                        <span class="bg-orange-100 text-orange-800 text-xs font-medium px-2 py-0.5 rounded">Buổi học</span>
                                        @break
                                    @default
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded">{{ $item->type }}</span>
                                @endswitch
                            </td>
                            <td class="ps-1 pt-1">
                                @if($item->testable_type == 'App\Models\Lesson' && $item->testable_id)
                                    @php
                                        $lesson = App\Models\Lesson::find($item->testable_id);
                                    @endphp
                                    @if($lesson)
                                        <span class="bg-blue-50 text-blue-700 text-xs font-medium px-2 py-0.5 rounded">
                                            Bài học: {{ $lesson->name }}
                                        </span>
                                    @else
                                        <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2 py-0.5 rounded">
                                            Bài học không tồn tại
                                        </span>
                                    @endif
                                @elseif($item->testable_type == 'App\Models\Course' && $item->testable_id)
                                    @php
                                        $course = App\Models\Course::find($item->testable_id);
                                    @endphp
                                    @if($course)
                                        <span class="bg-purple-50 text-purple-700 text-xs font-medium px-2 py-0.5 rounded">
                                            Khóa học: {{ $course->title }}
                                        </span>
                                    @else
                                        <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2 py-0.5 rounded">
                                            Khóa học không tồn tại
                                        </span>
                                    @endif
                                @else
                                    <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2 py-0.5 rounded">
                                        Không liên kết
                                    </span>
                                @endif
                            </td>
                            <td class="ps-1 pt-1">{{ $item->min_score }}/{{ $item->max_score }}</td>
                            <td class="ps-1 pt-1">{{ $item->duration ? floor($item->duration/60).' phút' : 'Không giới hạn' }}</td>
                            <td class="ps-1 pt-1">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                            <td class="ps-1 pt-1 text-center">
                                <div class="flex justify-center space-x-2">
                                    <button type="button"
                                        onclick="addQuestion({{ $item->id }}, '{{ $item->name }}')"
                                        class="text-purple-500 hover:text-purple-700" title="Thêm câu hỏi">
                                        <i class="fas fa-question"></i>
                                    </button>
                                    <button class="text-blue-500 hover:text-blue-700" data-bs-toggle="modal"
                                        data-bs-target="#editTestModal"
                                        onclick="populateEditModal({{ json_encode($item) }})" title="Chỉnh sửa">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <form action="{{ route('admin.tests.destroy', $item->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" title="Xóa"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa bài test này?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr class="question-list" id="questions-{{ $item->id }}">
                            <td colspan="9" class="p-0">
                                <div class="question-content">
                                    <h3 class="text-lg font-semibold mb-2">Danh sách câu hỏi</h3>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full bg-white border border-gray-300">
                                            <thead>
                                                <tr>
                                                    <th class="border ps-1 py-1 text-center">STT</th>
                                                    <th class="border ps-1 py-1 text-center">Nội dung câu hỏi</th>
                                                    <th class="border ps-1 py-1 text-center">Loại câu hỏi</th>
                                                    <th class="border ps-1 py-1 text-center">Media</th>
                                                    <th class="border ps-1 py-1 text-center">Thứ tự</th>
                                                    <th class="border ps-1 py-1 text-center">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody class="questions-data" data-test-id="{{ $item->id }}">
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

                    @if (count($tests) == 0)
                        <tr>
                            <td colspan="9" class="text-center ps-1 pt-1">Không có dữ liệu</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <div class="flex justify-between items-center p-4 bg-white border-t border-gray-200">
                <div class="text-sm text-gray-600">
                    Hiển thị từ <span class="font-medium">{{ ($pagination['current_page'] - 1) * $pagination['per_page'] + 1 }}</span>
                    đến <span class="font-medium">{{ min($pagination['current_page'] * $pagination['per_page'], $pagination['total']) }}</span>
                    của <span class="font-medium">{{ $pagination['total'] }}</span> bản ghi
                </div>
                <div class="flex items-center space-x-1">
                    @if($pagination['current_page'] > 1)
                        <a href="{{ request()->url() }}?page=1{{ !empty(request('search')) ? '&search='.request('search') : '' }}"
                           class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                            <i class="fas fa-angle-double-left"></i>
                        </a>
                        <a href="{{ request()->url() }}?page={{ $pagination['current_page'] - 1 }}{{ !empty(request('search')) ? '&search='.request('search') : '' }}"
                           class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                            <i class="fas fa-angle-left"></i>
                        </a>
                    @else
                        <span class="px-3 py-1 bg-gray-100 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed">
                            <i class="fas fa-angle-double-left"></i>
                        </span>
                        <span class="px-3 py-1 bg-gray-100 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed">
                            <i class="fas fa-angle-left"></i>
                        </span>
                    @endif

                    @php
                        $start = max(1, $pagination['current_page'] - 2);
                        $end = min($pagination['last_page'], $pagination['current_page'] + 2);
                    @endphp

                    @if($start > 1)
                        <span class="px-3 py-1 border border-gray-300 rounded-md text-gray-600">...</span>
                    @endif

                    @for($i = $start; $i <= $end; $i++)
                        @if($i == $pagination['current_page'])
                            <span class="px-3 py-1 bg-blue-600 text-white border border-blue-600 rounded-md font-medium shadow-sm">
                                {{ $i }}
                            </span>
                        @else
                            <a href="{{ request()->url() }}?page={{ $i }}{{ !empty(request('search')) ? '&search='.request('search') : '' }}"
                               class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                                {{ $i }}
                            </a>
                        @endif
                    @endfor

                    @if($end < $pagination['last_page'])
                        <span class="px-3 py-1 border border-gray-300 rounded-md text-gray-600">...</span>
                    @endif

                    @if($pagination['current_page'] < $pagination['last_page'])
                        <a href="{{ request()->url() }}?page={{ $pagination['current_page'] + 1 }}{{ !empty(request('search')) ? '&search='.request('search') : '' }}"
                           class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                            <i class="fas fa-angle-right"></i>
                        </a>
                        <a href="{{ request()->url() }}?page={{ $pagination['last_page'] }}{{ !empty(request('search')) ? '&search='.request('search') : '' }}"
                           class="px-3 py-1 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-300 transition-colors duration-150">
                            <i class="fas fa-angle-double-right"></i>
                        </a>
                    @else
                        <span class="px-3 py-1 bg-gray-100 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed">
                            <i class="fas fa-angle-right"></i>
                        </span>
                        <span class="px-3 py-1 bg-gray-100 border border-gray-300 rounded-md text-gray-400 cursor-not-allowed">
                            <i class="fas fa-angle-double-right"></i>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </main>
    @include('admin.components.tests.modals.create')
    @include('admin.components.tests.modals.edit')
    @include('admin.components.tests.modals.trash')
    @include('admin.components.questions.modals.create')
    @include('admin.components.questions.modals.edit')

    <div class="flex items-center space-x-2 mt-2 hidden" id="bulkActionButtons">
        <button class="bg-red-500 text-white px-2 py-1 rounded" onclick="confirmBulkDelete()">
            <i class="fas fa-trash"></i> Xóa đã chọn
        </button>
    </div>

    <style>
        .question-list {
            display: none;
            background-color: #f9fafb;
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .question-list.active {
            display: table-row;
            opacity: 1;
            transform: translateY(0);
        }

        .question-content {
            padding: 1rem;
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.5s ease-in-out;
        }

        .question-list.active .question-content {
            max-height: 2000px;
        }

        .toggle-questions {
            cursor: pointer;
            transition: transform 0.3s ease;
            color: #9333ea;
        }

        .toggle-questions.active {
            transform: rotate(90deg);
            color: #7e22ce;
        }

        .test-title {
            color: #9333ea !important;
            transition: color 0.2s;
        }

        .test-title:hover {
            color: #7e22ce !important;
            text-decoration: underline;
        }
    </style>
@endsection

@push('scripts')
    <script>
        function populateEditModal(item) {
            modalHandler.open('editTestModal');

            modalHandler.setEditModalData('editTestModal', {
                name: item.name,
                description: item.description,
                duration: item.duration,
                min_score: item.min_score,
                max_score: item.max_score,
                is_required: item.is_required,
                max_attempt: item.max_attempt,
                type: item.type,
                testable_type: item.testable_type,
                testable_id: item.testable_id,
                settings: item.settings,
                actionUrl: '{{ url('admin/tests') }}/' + item.id
            });
        }

        function addQuestion(testId, testName) {
            // Mở modal tạo câu hỏi
            modalHandler.open('createQuestionModal');

            // Cập nhật thông tin trong modal
            document.getElementById('questionTestId').value = testId;
            document.getElementById('testNameDisplay').textContent = testName;
            document.getElementById('createQuestionModalLabel').innerHTML = 'Thêm câu hỏi cho bài test';

            // Đặt giá trị mặc định
            document.getElementById('question_order_number').value = 1;

            // Setup form submit
            const modalForm = document.getElementById('createQuestionForm');
            modalForm.action = "{{ route('admin.questions.store') }}";
        }

        function editQuestion(questionId) {
            fetch(`/admin/questions/${questionId}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        const question = data.data;

                        // Mở modal chỉnh sửa câu hỏi
                        modalHandler.open('editQuestionModal');

                        // Cập nhật dữ liệu vào form
                        document.getElementById('edit_question_id').value = question.id;
                        document.getElementById('edit_test_id').value = question.test_id;
                        document.getElementById('edit_question').value = question.question;
                        document.getElementById('edit_order_number').value = question.order_number;
                        document.getElementById('edit_type').value = question.type;

                        // Cập nhật hình ảnh preview nếu có
                        if (question.media_url) {
                            if (question.type === 'image') {
                                document.getElementById('edit_imagePreview').src = question.full_media_url;
                                document.getElementById('edit_imagePreviewContainer').classList.remove('hidden');
                            } else if (question.type === 'video') {
                                document.getElementById('edit_videoPreview').src = question.full_media_url;
                                document.getElementById('edit_videoPreviewContainer').classList.remove('hidden');
                            } else if (question.type === 'audio') {
                                document.getElementById('edit_audioPreview').src = question.full_media_url;
                                document.getElementById('edit_audioPreviewContainer').classList.remove('hidden');
                            }
                        }

                        // Hiển thị container upload phù hợp với loại câu hỏi
                        showUploadContainer(question.type, 'edit_');
                    } else {
                        alert('Có lỗi xảy ra khi tải thông tin câu hỏi');
                    }
                })
                .catch(error => {
                    console.error('Error fetching question:', error);
                    alert('Có lỗi xảy ra khi tải thông tin câu hỏi');
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý đóng/mở danh sách câu hỏi
            const toggleButtons = document.querySelectorAll('.toggle-questions');
            const testTitles = document.querySelectorAll('.test-title');

            // Hàm xử lý toggle
            function toggleQuestionList(testId) {
                const toggleButton = document.querySelector(`.toggle-questions[data-test-id="${testId}"]`);
                const questionRow = document.getElementById('questions-' + testId);

                // Thêm hiệu ứng mượt mà khi toggle
                if (questionRow.classList.contains('active')) {
                    // Đang mở -> đóng
                    const questionContent = questionRow.querySelector('.question-content');
                    questionContent.style.maxHeight = '0';

                    // Delay để animation chạy trước khi ẩn row
                    setTimeout(() => {
                        toggleButton.classList.remove('active');
                        questionRow.classList.remove('active');
                    }, 250);
                } else {
                    // Đang đóng -> mở
                    toggleButton.classList.add('active');
                    questionRow.classList.add('active');

                    if (!questionRow.getAttribute('data-loaded')) {
                        loadQuestions(testId);
                    }

                    // Set max-height để animation chạy
                    setTimeout(() => {
                        const questionContent = questionRow.querySelector('.question-content');
                        questionContent.style.maxHeight = (questionContent.scrollHeight + 500) + 'px';
                    }, 10);
                }
            }

            // Áp dụng sự kiện cho nút toggle
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const testId = this.getAttribute('data-test-id');
                    toggleQuestionList(testId);
                });
            });

            // Áp dụng sự kiện cho tiêu đề bài test
            testTitles.forEach(title => {
                title.addEventListener('click', function(e) {
                    e.preventDefault();
                    const testId = this.getAttribute('data-test-id');
                    toggleQuestionList(testId);
                });
            });

            // Hàm để tải dữ liệu câu hỏi của bài test
            function loadQuestions(testId) {
                const questionContainer = document.querySelector(`.questions-data[data-test-id="${testId}"]`);
                const questionRow = document.getElementById('questions-' + testId);

                // Kiểm tra xem đã tải dữ liệu chưa
                if (questionRow.getAttribute('data-loaded') === 'true') {
                    return;
                }

                // Gọi API để lấy dữ liệu
                fetch(`/admin/tests/${testId}/questions`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && data.questions && data.questions.length > 0) {
                            let html = '';
                            data.questions.forEach((question, index) => {
                                const typeLabels = {
                                    'text': 'Văn bản',
                                    'image': 'Hình ảnh',
                                    'video': 'Video',
                                    'audio': 'Âm thanh'
                                };

                                const typeClasses = {
                                    'text': 'bg-blue-100 text-blue-800',
                                    'image': 'bg-green-100 text-green-800',
                                    'video': 'bg-purple-100 text-purple-800',
                                    'audio': 'bg-orange-100 text-orange-800'
                                };

                                let mediaHtml = '';
                                if (question.media_url) {
                                    if (question.type === 'image') {
                                        mediaHtml = `<img src="/${question.media_url}" alt="Media" class="h-10 w-10 object-cover rounded mx-auto">`;
                                    } else if (question.type === 'video') {
                                        mediaHtml = `<i class="fas fa-video text-blue-500 text-xl"></i>`;
                                    } else if (question.type === 'audio') {
                                        mediaHtml = `<i class="fas fa-volume-up text-green-500 text-xl"></i>`;
                                    } else {
                                        mediaHtml = `<i class="fas fa-file-alt text-gray-500 text-xl"></i>`;
                                    }
                                } else {
                                    mediaHtml = `<span class="text-gray-500">N/A</span>`;
                                }

                                html += `
                                <tr>
                                    <td class="border ps-1 py-1 text-center">${index + 1}</td>
                                    <td class="border ps-1 py-1 max-w-xs truncate">${question.question}</td>
                                    <td class="border ps-1 py-1 text-center">
                                        <span class="px-2 py-1 rounded-full text-sm ${typeClasses[question.type] || 'bg-gray-100 text-gray-800'}">
                                            ${typeLabels[question.type] || question.type}
                                        </span>
                                    </td>
                                    <td class="border ps-1 py-1 text-center">${mediaHtml}</td>
                                    <td class="border ps-1 py-1 text-center">${question.order_number}</td>
                                    <td class="border ps-1 py-1 text-center">
                                        <div class="flex justify-center space-x-2">
                                            <button class="text-blue-500 hover:text-blue-700"
                                                onclick="editQuestion(${question.id})" title="Chỉnh sửa">
                                                <i class="far fa-edit"></i>
                                            </button>
                                            <form action="/admin/questions/${question.id}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa câu hỏi này?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                `;
                            });
                            questionContainer.innerHTML = html;
                        } else {
                            questionContainer.innerHTML =
                                '<tr><td colspan="6" class="text-center py-4">Chưa có câu hỏi nào cho bài test này</td></tr>';
                        }

                        // Cập nhật maxHeight sau khi tải dữ liệu
                        setTimeout(() => {
                            const questionContent = questionRow.querySelector('.question-content');
                            questionContent.style.maxHeight = questionContent.scrollHeight + 'px';
                        }, 100);

                        // Đánh dấu đã tải dữ liệu
                        questionRow.setAttribute('data-loaded', 'true');
                    })
                    .catch(error => {
                        console.error('Lỗi khi tải câu hỏi:', error);
                        questionContainer.innerHTML =
                            '<tr><td colspan="6" class="text-center py-4 text-red-500">Lỗi khi tải dữ liệu câu hỏi</td></tr>';
                        questionRow.setAttribute('data-loaded', 'error');
                    });
            }
        });
    </script>
@endpush
