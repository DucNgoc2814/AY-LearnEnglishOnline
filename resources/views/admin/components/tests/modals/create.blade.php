<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="createTestModal" aria-labelledby="createTestModalLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="createTestModalLabel">Thêm bài test mới</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500"
                        onclick="modalHandler.close('createTestModal')" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form action="{{ route('admin.tests.store') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="testable_type" id="testable_type" value="">
                    <input type="hidden" name="testable_id" id="testable_id" value="">
                    <div class="grid grid-cols-2 gap-6 mt-4">
                        <!-- Thông tin cơ bản -->
                        <div>
                            <h4 class="font-medium text-gray-900 mb-4">Thông tin cơ bản</h4>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="testName">
                                    Tên bài test <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ session('errors') && session('errors')->has('name') ? 'border-red-500' : '' }}"
                                    id="testName" name="name" value="{{ old('name') }}" placeholder="Nhập tên bài test"
                                    required>
                                @if (session('errors') && session('errors')->has('name'))
                                    <p class="text-red-500 text-xs italic mt-1">{{ session('errors')->first('name') }}</p>
                                @endif
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                    Mô tả
                                </label>
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ session('errors') && session('errors')->has('description') ? 'border-red-500' : '' }}"
                                    id="description" name="description" rows="3" placeholder="Nhập mô tả bài test">{{ old('description') }}</textarea>
                                @if (session('errors') && session('errors')->has('description'))
                                    <p class="text-red-500 text-xs italic mt-1">{{ session('errors')->first('description') }}</p>
                                @endif
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                                    Loại bài test <span class="text-red-500">*</span>
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ session('errors') && session('errors')->has('type') ? 'border-red-500' : '' }}"
                                    id="type" name="type" required onchange="handleTestTypeChange()">
                                    <option value="">-- Chọn loại bài test --</option>
                                    <option value="lesson_test" {{ old('type') == 'lesson_test' ? 'selected' : '' }}>Bài kiểm tra bài học</option>
                                    <option value="final_exam" {{ old('type') == 'final_exam' ? 'selected' : '' }}>Bài thi cuối khóa</option>
                                    <option value="entrance_test" {{ old('type') == 'entrance_test' ? 'selected' : '' }}>Bài test đầu vào</option>
                                    <option value="session_test" {{ old('type') == 'session_test' ? 'selected' : '' }}>Bài kiểm tra buổi học</option>
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Chọn loại bài test để xác định liên kết với bài học hoặc khóa học</p>
                                @if (session('errors') && session('errors')->has('type'))
                                    <p class="text-red-500 text-xs italic mt-1">{{ session('errors')->first('type') }}</p>
                                @endif
                            </div>

                            <!-- Dropdown chọn Lesson cho lesson_test -->
                            <div class="mb-4" id="lessonSelectContainer" style="display: none;">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="lesson_id">
                                    Chọn bài học <span class="text-red-500">*</span>
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="lesson_id" onchange="updateTestableId('lesson')">
                                    <option value="">-- Chọn bài học --</option>
                                    @foreach(App\Models\Lesson::all() as $lesson)
                                        <option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-gray-500 mt-1">Bài test này sẽ được liên kết với bài học đã chọn</p>
                            </div>

                            <!-- Dropdown chọn Course cho final_exam -->
                            <div class="mb-4" id="courseSelectContainer" style="display: none;">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="course_id">
                                    Chọn khóa học <span class="text-red-500">*</span>
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="course_id" onchange="updateTestableId('course')">
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
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="duration">
                                    Thời gian làm bài (phút)
                                </label>
                                <input type="number"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ session('errors') && session('errors')->has('duration') ? 'border-red-500' : '' }}"
                                    id="duration" name="duration" value="{{ old('duration') }}" placeholder="Nhập thời gian làm bài">
                                @if (session('errors') && session('errors')->has('duration'))
                                    <p class="text-red-500 text-xs italic mt-1">{{ session('errors')->first('duration') }}</p>
                                @endif
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="min_score">
                                        Điểm tối thiểu <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ session('errors') && session('errors')->has('min_score') ? 'border-red-500' : '' }}"
                                        id="min_score" name="min_score" value="{{ old('min_score') }}" placeholder="Nhập điểm tối thiểu" required>
                                    @if (session('errors') && session('errors')->has('min_score'))
                                        <p class="text-red-500 text-xs italic mt-1">{{ session('errors')->first('min_score') }}</p>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="max_score">
                                        Điểm tối đa <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ session('errors') && session('errors')->has('max_score') ? 'border-red-500' : '' }}"
                                        id="max_score" name="max_score" value="{{ old('max_score') ?? 100 }}" placeholder="Nhập điểm tối đa" required>
                                    @if (session('errors') && session('errors')->has('max_score'))
                                        <p class="text-red-500 text-xs italic mt-1">{{ session('errors')->first('max_score') }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="max_attempt">
                                    Số lần làm lại tối đa
                                </label>
                                <input type="number"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ session('errors') && session('errors')->has('max_attempt') ? 'border-red-500' : '' }}"
                                    id="max_attempt" name="max_attempt" value="{{ old('max_attempt') }}" placeholder="Nhập số lần làm lại tối đa">
                                @if (session('errors') && session('errors')->has('max_attempt'))
                                    <p class="text-red-500 text-xs italic mt-1">{{ session('errors')->first('max_attempt') }}</p>
                                @endif
                                <p class="text-xs text-gray-500 mt-1">Để trống nếu không giới hạn số lần làm lại</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="is_required">
                                    Bắt buộc phải làm
                                </label>
                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio" name="is_required" value="1" {{ old('is_required', '1') == '1' ? 'checked' : '' }}>
                                        <span class="ml-2">Có</span>
                                    </label>
                                    <label class="inline-flex items-center ml-6">
                                        <input type="radio" class="form-radio" name="is_required" value="0" {{ old('is_required') == '0' ? 'checked' : '' }}>
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
                            onclick="modalHandler.close('createTestModal')">
                            Hủy
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Thêm mới
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function handleTestTypeChange() {
        const typeSelect = document.getElementById('type');
        const testableTypeInput = document.getElementById('testable_type');
        const testableIdInput = document.getElementById('testable_id');
        const lessonSelectContainer = document.getElementById('lessonSelectContainer');
        const courseSelectContainer = document.getElementById('courseSelectContainer');

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

    function updateTestableId(type) {
        const testableIdInput = document.getElementById('testable_id');

        if (type === 'lesson') {
            const lessonSelect = document.getElementById('lesson_id');
            testableIdInput.value = lessonSelect.value;
        } else if (type === 'course') {
            const courseSelect = document.getElementById('course_id');
            testableIdInput.value = courseSelect.value;
        }
    }

    // Kiểm tra form trước khi submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const typeSelect = document.getElementById('type');
        const testableIdInput = document.getElementById('testable_id');

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

    // Gọi hàm khi trang đã load để set giá trị ban đầu
    document.addEventListener('DOMContentLoaded', function() {
        handleTestTypeChange();
    });
</script>
