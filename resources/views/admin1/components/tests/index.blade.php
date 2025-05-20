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
                                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded">Kiểm tra của bài học</span>
                                        @break
                                    @case('entrance_test')
                                        <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2 py-0.5 rounded">Test đầu vào</span>
                                        @break
                                    @case('after_class')
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded">Bài kiểm tra sau buổi học</span>
                                        @break
                                    @case('before_class')
                                        <span class="bg-orange-100 text-orange-800 text-xs font-medium px-2 py-0.5 rounded">Bài kiểm tra trước buổi học</span>
                                        @break
                                    @default
                                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded">{{ $item->type }}</span>
                                @endswitch
                            </td>
                            <td class="ps-1 pt-1">
                                @if($item->lesson_id)
                                    @php
                                        $lesson = App\Models\Lesson::find($item->lesson_id);
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
                                @else
                                    @if($item->type === 'entrance_test')
                                        <span class="bg-purple-50 text-purple-700 text-xs font-medium px-2 py-0.5 rounded">
                                            Bài test đầu vào
                                        </span>
                                    @else
                                        <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2 py-0.5 rounded">
                                            Chưa liên kết với bài học
                                        </span>
                                    @endif
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
                                    <button class="text-blue-500 hover:text-blue-700"
                                        onclick="openEditModal({{ json_encode($item) }})" title="Chỉnh sửa">
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
    @include('admin.components.questions.modals.answers')

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

        #mediaContainer {
            min-height: 200px;
        }

        #mediaContainer video,
        #mediaContainer audio {
            max-width: 100%;
        }

        #mediaContainer img {
            max-height: 80vh;
            object-fit: contain;
        }
    </style>

    <!-- Modal xem media -->
    <div id="mediaPreviewModal" class="fixed inset-0 z-[60] hidden overflow-y-auto" aria-labelledby="mediaPreviewModalLabel" aria-hidden="true">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeMediaPreviewModal()"></div>

            <div class="relative bg-white rounded-lg max-w-4xl w-full mx-auto">
                <!-- Header -->
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-xl font-semibold text-gray-900" id="mediaPreviewModalLabel">Xem media</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeMediaPreviewModal()">
                        <span class="sr-only">Đóng</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Body -->
                <div class="p-4">
                    <div id="mediaContainer" class="flex justify-center items-center">
                        <!-- Media content will be inserted here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

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

        function populateEditQuestionModal(question) {
            // Mở modal
            modalHandler.open('editQuestionModal');

            // Điền thông tin cơ bản của câu hỏi
            document.getElementById('edit_questionId').value = question.id;
            document.getElementById('edit_test_id').value = question.test_id;
            document.getElementById('edit_type').value = question.type || 'text';
            document.getElementById('edit_question').value = question.question;
            document.getElementById('edit_order_number').value = question.order_number;
            document.getElementById('edit_correct_answer_explanation').value = question.correct_answer_explanation || '';
            document.getElementById('edit_answer_type').value = question.answer_type || 'single';

            // Hiển thị container media tương ứng
            if (typeof window.showEditMediaContainer === 'function') {
                window.showEditMediaContainer(question.type);
            }

            // Xử lý hiển thị media nếu có
            if (question.media_url) {
                document.getElementById('edit_media_url').value = question.media_url;
                const mediaUrl = question.full_media_url || question.media_url;
                const mediaType = question.type;
                const previewContainer = document.getElementById(`edit_${mediaType}PreviewContainer`);
                const preview = document.getElementById(`edit_${mediaType}Preview`);

                if (mediaType === 'image') {
                    preview.src = mediaUrl;
                } else if (mediaType === 'video' || mediaType === 'audio') {
                    const source = preview.querySelector('source');
                    source.src = mediaUrl;
                    preview.load();
                }

                previewContainer.classList.remove('hidden');
                if (typeof window.showEditMediaContainer === 'function') {
                    window.showEditMediaContainer(mediaType);
                }
            }

            // Xóa các câu trả lời cũ
            const answersContainer = document.getElementById('edit_answers_container');
            answersContainer.innerHTML = '';

            // Thêm các câu trả lời mới
            if (question.answers && question.answers.length > 0) {
                question.answers.forEach((answer, index) => {
                    const answerType = question.answer_type || 'single';
                    const template = `
                        <div class="answer-item p-4 border rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                            <div class="space-y-4">
                                <div class="grid grid-cols-12 gap-4">
                                    <div class="col-span-8">
                                        <label class="block text-gray-700 text-sm font-bold mb-2">
                                            Nội dung <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="answers[${index}][answer]"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500"
                                            value="${answer.answer}"
                                            placeholder="Nhập câu trả lời" required>
                                    </div>
                                    <div class="col-span-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2">
                                            Thứ tự
                                        </label>
                                        <input type="number" name="answers[${index}][order_number]"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500"
                                            value="${answer.order_number}" min="1" required>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex items-center">
                                        <input type="${answerType === 'single' ? 'radio' : 'checkbox'}"
                                            name="${answerType === 'single' ? 'correct_answer' : `answers[${index}][is_correct]`}"
                                            value="${answerType === 'single' ? index : '1'}"
                                            ${answer.is_correct ? 'checked' : ''}
                                            class="form-radio h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                                        <span class="ml-2 text-sm text-gray-700">Đánh dấu là đáp án đúng</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    answersContainer.insertAdjacentHTML('beforeend', template);
                });
            } else {
                // Thêm một câu trả lời mặc định nếu không có câu trả lời nào
                const template = `
                    <div class="answer-item p-4 border rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                        <div class="space-y-4">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-8">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        Nội dung <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="answers[0][answer]"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500"
                                        placeholder="Nhập câu trả lời" required>
                                </div>
                                <div class="col-span-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">
                                        Thứ tự
                                    </label>
                                    <input type="number" name="answers[0][order_number]"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-blue-500"
                                        value="1" min="1" required>
                                </div>
                            </div>
                            <div>
                                <div class="flex items-center">
                                    <input type="radio" name="correct_answer" value="0"
                                        class="form-radio h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Đánh dấu là đáp án đúng</span>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                answersContainer.insertAdjacentHTML('beforeend', template);
            }
        }

        function viewAnswers(questionId, questionText) {
            // Hiển thị modal
            modalHandler.open('answersModal');

            // Cập nhật nội dung câu hỏi
            document.getElementById('questionText').textContent = questionText;

            // Lấy dữ liệu answers từ API
            fetch(`/admin/questions/${questionId}/answers`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Cập nhật phần giải thích
                        document.getElementById('explanationText').textContent = data.explanation || 'Không có giải thích cho câu hỏi này';

                        if (data.answers) {
                            let html = '';
                            data.answers.forEach((answer, index) => {
                                const typeLabels = {
                                    'single': 'Một đáp án',
                                    'multiple': 'Nhiều đáp án'
                                };

                                html += `
                                <tr>
                                    <td class="border ps-1 py-1 text-center">${index + 1}</td>
                                    <td class="border ps-1 py-1">${answer.answer}</td>
                                    <td class="border ps-1 py-1 text-center">
                                        <span class="${answer.is_correct ? 'text-green-500' : 'text-red-500'}">
                                            <i class="fas ${answer.is_correct ? 'fa-check' : 'fa-times'}"></i>
                                        </span>
                                    </td>
                                    <td class="border ps-1 py-1 text-center">
                                        <span class="px-2 py-1 rounded-full text-sm ${answer.type === 'single' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800'}">
                                            ${typeLabels[answer.type]}
                                        </span>
                                    </td>
                                    <td class="border ps-1 py-1 text-center">${answer.order_number}</td>
                                </tr>
                                `;
                            });
                            document.getElementById('answersTableBody').innerHTML = html;
                        } else {
                            document.getElementById('answersTableBody').innerHTML = '<tr><td colspan="5" class="text-center py-4">Không có câu trả lời nào</td></tr>';
                        }
                    } else {
                        document.getElementById('answersTableBody').innerHTML = '<tr><td colspan="5" class="text-center py-4 text-red-500">Lỗi khi tải dữ liệu</td></tr>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching answers:', error);
                    document.getElementById('answersTableBody').innerHTML = '<tr><td colspan="5" class="text-center py-4 text-red-500">Lỗi khi tải dữ liệu</td></tr>';
                });
        }

        function editQuestion(questionId) {
            // Mở modal chỉnh sửa câu hỏi ngay lập tức
            modalHandler.open('editQuestionModal');

            // Fetch dữ liệu câu hỏi từ API
            fetch(`/admin/questions/${questionId}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        populateEditQuestionModal(data.data);
                    } else {
                        throw new Error(data.message || 'Không thể tải thông tin câu hỏi');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Đã xảy ra lỗi khi tải dữ liệu: ' + error.message);
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
                                    const mediaUrl = question.full_media_url;
                                    if (question.type === 'image') {
                                        mediaHtml = `<img src="${mediaUrl}" alt="Media" class="h-10 w-10 object-cover rounded mx-auto cursor-pointer hover:opacity-75 transition-opacity" onclick="openMediaPreviewModal('${mediaUrl}', 'image')">`;
                                    } else if (question.type === 'video') {
                                        mediaHtml = `<button class="text-blue-500 hover:text-blue-700 transition-colors" onclick="openMediaPreviewModal('${mediaUrl}', 'video')"><i class="fas fa-video text-xl"></i></button>`;
                                    } else if (question.type === 'audio') {
                                        mediaHtml = `<button class="text-green-500 hover:text-green-700 transition-colors" onclick="openMediaPreviewModal('${mediaUrl}', 'audio')"><i class="fas fa-volume-up text-xl"></i></button>`;
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
                                            <button class="text-yellow-500 hover:text-yellow-700"
                                                onclick="viewAnswers(${question.id}, question.question)" title="Xem câu trả lời">
                                                <i class="fas fa-list-ul"></i>
                                            </button>
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

        // Thêm các hàm xử lý modal xem media
        function openMediaPreviewModal(mediaUrl, type) {
            const modal = document.getElementById('mediaPreviewModal');
            const container = document.getElementById('mediaContainer');
            const modalLabel = document.getElementById('mediaPreviewModalLabel');

            // Xóa nội dung cũ
            container.innerHTML = '';

            // Tạo nội dung mới dựa trên loại media
            switch(type) {
                case 'image':
                    modalLabel.textContent = 'Xem hình ảnh';
                    container.innerHTML = `<img src="${mediaUrl}" alt="Preview" class="max-w-full h-auto">`;
                    break;
                case 'video':
                    modalLabel.textContent = 'Xem video';
                    container.innerHTML = `
                        <video controls class="max-w-full h-auto">
                            <source src="${mediaUrl}" type="video/mp4">
                            Trình duyệt của bạn không hỗ trợ xem video.
                        </video>`;
                    break;
                case 'audio':
                    modalLabel.textContent = 'Nghe audio';
                    container.innerHTML = `
                        <audio controls class="w-full">
                            <source src="${mediaUrl}" type="audio/mpeg">
                            Trình duyệt của bạn không hỗ trợ nghe audio.
                        </audio>`;
                    break;
            }

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeMediaPreviewModal() {
            const modal = document.getElementById('mediaPreviewModal');
            const container = document.getElementById('mediaContainer');

            // Dừng phát media nếu đang phát
            const video = container.querySelector('video');
            const audio = container.querySelector('audio');
            if (video) video.pause();
            if (audio) audio.pause();

            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Đóng modal khi nhấn phím Esc
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeMediaPreviewModal();
            }
        });

        function openEditModal(item) {
            // Mở modal edit
            modalHandler.open('editTestModal');

            // Điền dữ liệu vào form
            document.getElementById('edit_name').value = item.name || '';

            // Xử lý mô tả với TinyMCE
            if (tinymce.get('edit_description')) {
                tinymce.get('edit_description').setContent(item.description || '');
            } else {
                document.getElementById('edit_description').value = item.description || '';
                initTinyMCE();
            }

            // Set duration (chuyển đổi từ giây sang phút)
            document.getElementById('edit_duration').value = item.duration ? Math.floor(item.duration / 60) : '';

            // Set các trường dữ liệu khác
            document.getElementById('edit_min_score').value = item.min_score || '';
            document.getElementById('edit_max_score').value = item.max_score || '';
            document.getElementById('edit_max_attempt').value = item.max_attempt || '';
            document.getElementById('edit_role').value = item.role || '0';

            // Set loại test
            const typeSelect = document.getElementById('edit_type');
            if (item.type) {
                typeSelect.value = item.type;
                handleTestTypeChangeEdit(); // Gọi hàm để xử lý hiển thị các trường phụ thuộc
            }

            // Set lesson_id nếu có
            if (item.lesson_id) {
                document.getElementById('edit_lesson_id').value = item.lesson_id;
                document.getElementById('edit_lesson_select').value = item.lesson_id;
            }

            // Set trạng thái bắt buộc
            if (typeof item.is_required !== 'undefined') {
                if (item.is_required) {
                    document.getElementById('edit_is_required_yes').checked = true;
                } else {
                    document.getElementById('edit_is_required_no').checked = true;
                }
            } else {
                document.getElementById('edit_is_required_yes').checked = true;
            }

            // Set action URL cho form
            document.getElementById('editTestForm').action = `/admin/tests/${item.id}`;
        }

        function initTinyMCE() {
            tinymce.init({
                selector: '#edit_description',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                height: 300,
                image_title: true,
                automatic_uploads: true,
                file_picker_types: 'image',
                entity_encoding: 'raw',
                encoding: 'UTF-8'
            });
        }
    </script>
@endpush
