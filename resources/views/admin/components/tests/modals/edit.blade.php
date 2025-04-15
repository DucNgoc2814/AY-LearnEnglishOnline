<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="editTestModal" aria-labelledby="editTestModalLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="editTestModalLabel">Chỉnh sửa bài test</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500"
                        onclick="modalHandler.close('editTestModal')" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editTestForm" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="testable_type" id="edit_testable_type" value="">
                    <input type="hidden" name="testable_id" id="edit_testable_id" value="">
                    <div class="grid grid-cols-2 gap-6 mt-4">
                        <!-- Thông tin cơ bản -->
                        <div>
                            <h4 class="font-medium text-gray-900 mb-4">Thông tin cơ bản</h4>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_testName">
                                    Tên bài test <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ session('errors') && session('errors')->has('name') ? 'border-red-500' : '' }}"
                                    id="edit_testName" name="name" placeholder="Nhập tên bài test" required>
                                @if (session('errors') && session('errors')->has('name'))
                                    <p class="text-red-500 text-xs italic mt-1">{{ session('errors')->first('name') }}</p>
                                @endif
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_description">
                                    Mô tả
                                </label>
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ session('errors') && session('errors')->has('description') ? 'border-red-500' : '' }}"
                                    id="edit_description" name="description" rows="3" placeholder="Nhập mô tả bài test"></textarea>
                                @if (session('errors') && session('errors')->has('description'))
                                    <p class="text-red-500 text-xs italic mt-1">{{ session('errors')->first('description') }}</p>
                                @endif
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_type">
                                    Loại bài test <span class="text-red-500">*</span>
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ session('errors') && session('errors')->has('type') ? 'border-red-500' : '' }}"
                                    id="edit_type" name="type" required onchange="handleTestTypeChangeEdit()">
                                    <option value="">-- Chọn loại bài test --</option>
                                    <option value="lesson_test">Bài kiểm tra bài học</option>
                                    <option value="final_exam">Bài thi cuối khóa</option>
                                    <option value="entrance_test">Bài test đầu vào</option>
                                    <option value="session_test">Bài kiểm tra buổi học</option>
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Chọn loại bài test để xác định liên kết với bài học hoặc khóa học</p>
                                @if (session('errors') && session('errors')->has('type'))
                                    <p class="text-red-500 text-xs italic mt-1">{{ session('errors')->first('type') }}</p>
                                @endif
                            </div>

                            <!-- Dropdown chọn Lesson cho lesson_test -->
                            <div class="mb-4" id="edit_lessonSelectContainer" style="display: none;">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_lesson_id">
                                    Chọn bài học <span class="text-red-500">*</span>
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_lesson_id" onchange="updateTestableIdEdit('lesson')">
                                    <option value="">-- Chọn bài học --</option>
                                    @foreach(App\Models\Lesson::all() as $lesson)
                                        <option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Bài test này sẽ được liên kết với bài học đã chọn</p>
                            </div>

                            <!-- Dropdown chọn Course cho final_exam -->
                            <div class="mb-4" id="edit_courseSelectContainer" style="display: none;">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_course_id">
                                    Chọn khóa học <span class="text-red-500">*</span>
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_course_id" onchange="updateTestableIdEdit('course')">
                                    <option value="">-- Chọn khóa học --</option>
                                    @foreach(App\Models\Course::all() as $course)
                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Bài test này sẽ được liên kết với khóa học đã chọn</p>
                            </div>
                        </div>

                        <!-- Thông tin khác -->
                        <div>
                            <h4 class="font-medium text-gray-900 mb-4">Thông tin khác</h4>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_duration">
                                    Thời gian làm bài (phút)
                                </label>
                                <input type="number"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ session('errors') && session('errors')->has('duration') ? 'border-red-500' : '' }}"
                                    id="edit_duration" name="duration" placeholder="Nhập thời gian làm bài">
                                @if (session('errors') && session('errors')->has('duration'))
                                    <p class="text-red-500 text-xs italic mt-1">{{ session('errors')->first('duration') }}</p>
                                @endif
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_min_score">
                                        Điểm tối thiểu <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ session('errors') && session('errors')->has('min_score') ? 'border-red-500' : '' }}"
                                        id="edit_min_score" name="min_score" placeholder="Nhập điểm tối thiểu" required>
                                    @if (session('errors') && session('errors')->has('min_score'))
                                        <p class="text-red-500 text-xs italic mt-1">{{ session('errors')->first('min_score') }}</p>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_max_score">
                                        Điểm tối đa <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ session('errors') && session('errors')->has('max_score') ? 'border-red-500' : '' }}"
                                        id="edit_max_score" name="max_score" placeholder="Nhập điểm tối đa" required>
                                    @if (session('errors') && session('errors')->has('max_score'))
                                        <p class="text-red-500 text-xs italic mt-1">{{ session('errors')->first('max_score') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_max_attempt">
                                    Số lần làm lại tối đa
                                </label>
                                <input type="number"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ session('errors') && session('errors')->has('max_attempt') ? 'border-red-500' : '' }}"
                                    id="edit_max_attempt" name="max_attempt" placeholder="Nhập số lần làm lại tối đa">
                                @if (session('errors') && session('errors')->has('max_attempt'))
                                    <p class="text-red-500 text-xs italic mt-1">{{ session('errors')->first('max_attempt') }}</p>
                                @endif
                                <p class="text-xs text-gray-500 mt-1">Để trống nếu không giới hạn số lần làm lại</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_is_required">
                                    Bắt buộc phải làm
                                </label>
                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio" name="is_required" value="1" id="edit_is_required_yes">
                                        <span class="ml-2">Có</span>
                                    </label>
                                    <label class="inline-flex items-center ml-6">
                                        <input type="radio" class="form-radio" name="is_required" value="0" id="edit_is_required_no">
                                        <span class="ml-2">Không</span>
                                    </label>
                                </div>
                                @if (session('errors') && session('errors')->has('is_required'))
                                    <p class="text-red-500 text-xs italic mt-1">{{ session('errors')->first('is_required') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-2 border-t mt-6">
                        <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            onclick="modalHandler.close('editTestModal')">
                            Hủy
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function handleTestTypeChangeEdit() {
        const typeSelect = document.getElementById('edit_type');
        const testableTypeInput = document.getElementById('edit_testable_type');
        const testableIdInput = document.getElementById('edit_testable_id');
        const lessonSelectContainer = document.getElementById('edit_lessonSelectContainer');
        const courseSelectContainer = document.getElementById('edit_courseSelectContainer');

        const selectedType = typeSelect.value;

        // Reset values
        testableTypeInput.value = '';
        testableIdInput.value = '';

        // Hide all containers
        lessonSelectContainer.style.display = 'none';
        courseSelectContainer.style.display = 'none';

        // Set values based on test type
        if (selectedType === 'lesson_test') {
            testableTypeInput.value = 'App\\Models\\Lesson';
            lessonSelectContainer.style.display = 'block';
        } else if (selectedType === 'final_exam') {
            testableTypeInput.value = 'App\\Models\\Course';
            courseSelectContainer.style.display = 'block';
        }
        // entrance_test và session_test sẽ để null
    }

    function updateTestableIdEdit(type) {
        const testableIdInput = document.getElementById('edit_testable_id');

        if (type === 'lesson') {
            const lessonSelect = document.getElementById('edit_lesson_id');
            testableIdInput.value = lessonSelect.value;
        } else if (type === 'course') {
            const courseSelect = document.getElementById('edit_course_id');
            testableIdInput.value = courseSelect.value;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        modalHandler.addEventListener('editTestModal', 'show', function(data) {
            document.getElementById('edit_testName').value = data.name || '';

            // Xử lý mô tả với TinyMCE
            if (tinymce.get('edit_description')) {
                tinymce.get('edit_description').setContent(data.description || '');
            } else {
                document.getElementById('edit_description').value = data.description || '';
                setTimeout(function() {
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
                }, 100);
            }

            document.getElementById('edit_duration').value = data.duration ? Math.floor(data.duration / 60) : '';
            document.getElementById('edit_min_score').value = data.min_score || '';
            document.getElementById('edit_max_score').value = data.max_score || '';
            document.getElementById('edit_max_attempt').value = data.max_attempt || '';

            // Set testable type and id
            if (data.testable_type) {
                document.getElementById('edit_testable_type').value = data.testable_type;
            }

            if (data.testable_id) {
                document.getElementById('edit_testable_id').value = data.testable_id;
            }

            // Set type select option
            const typeSelect = document.getElementById('edit_type');
            if (data.type) {
                for (let i = 0; i < typeSelect.options.length; i++) {
                    if (typeSelect.options[i].value === data.type) {
                        typeSelect.selectedIndex = i;
                        break;
                    }
                }
            }

            // Show appropriate containers based on test type
            handleTestTypeChangeEdit();

            // Set selected lesson or course if available
            if (data.type === 'lesson_test' && data.testable_id) {
                document.getElementById('edit_lesson_id').value = data.testable_id;
            } else if (data.type === 'final_exam' && data.testable_id) {
                document.getElementById('edit_course_id').value = data.testable_id;
            }

            // Set is_required radio buttons
            if (typeof data.is_required !== 'undefined') {
                if (data.is_required) {
                    document.getElementById('edit_is_required_yes').checked = true;
                } else {
                    document.getElementById('edit_is_required_no').checked = true;
                }
            } else {
                document.getElementById('edit_is_required_yes').checked = true;
            }

            document.getElementById('editTestForm').action = data.actionUrl;
        });

        // Đảm bảo hủy TinyMCE khi đóng modal
        modalHandler.addEventListener('editTestModal', 'hide', function() {
            if (tinymce.get('edit_description')) {
                tinymce.get('edit_description').remove();
            }
        });

        // Kiểm tra form trước khi submit
        document.getElementById('editTestForm').addEventListener('submit', function(e) {
            const typeSelect = document.getElementById('edit_type');
            const testableIdInput = document.getElementById('edit_testable_id');

            if (typeSelect.value === 'lesson_test' && !testableIdInput.value) {
                e.preventDefault();
                alert('Vui lòng chọn bài học cho bài kiểm tra');
                return false;
            }

            if (typeSelect.value === 'final_exam' && !testableIdInput.value) {
                e.preventDefault();
                alert('Vui lòng chọn khóa học cho bài thi cuối khóa');
                return false;
            }
        });
    });
</script>
@endpush
