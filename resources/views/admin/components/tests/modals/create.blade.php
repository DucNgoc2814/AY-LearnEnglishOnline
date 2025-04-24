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
                    <input type="hidden" name="lesson_id" id="lesson_id" value="">
                    <div class="grid grid-cols-2 gap-6 mt-4">
                        <!-- Thông tin cơ bản -->
                        <div>
                            <h4 class="font-medium text-gray-900 mb-4">Thông tin cơ bản</h4>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                    Tên bài test <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="name" name="name" value="{{ old('name') }}" placeholder="Nhập tên bài test"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                    Mô tả
                                </label>
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="description" name="description" rows="3" placeholder="Nhập mô tả bài test">{{ old('description') }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                                    Loại bài test <span class="text-red-500">*</span>
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="type" name="type" required onchange="handleTestTypeChange()">
                                    <option value="">-- Chọn loại bài test --</option>
                                    <option value="lesson_test">Bài kiểm tra bài học</option>
                                    <option value="entrance_test">Bài test đầu vào</option>
                                    <option value="after_class">Bài kiểm tra sau buổi học</option>
                                    <option value="before_class">Bài kiểm tra trước buổi học</option>
                                </select>
                            </div>

                            <!-- Dropdown chọn Lesson cho lesson_test -->
                            <div class="mb-4" id="lessonSelectContainer" style="display: none;">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="lesson_select">
                                    Chọn bài học <span class="text-red-500">*</span>
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="lesson_select" onchange="updateLessonId()">
                                    <option value="">-- Chọn bài học --</option>
                                    @foreach(App\Models\Lesson::all() as $lesson)
                                        <option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
                                    @endforeach
                                </select>
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
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="duration" name="duration" value="{{ old('duration') }}" placeholder="Nhập thời gian làm bài">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="min_score">
                                        Điểm tối thiểu <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="min_score" name="min_score" value="{{ old('min_score') }}" placeholder="Nhập điểm tối thiểu" required>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="max_score">
                                        Điểm tối đa <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="max_score" name="max_score" value="{{ old('max_score', 100) }}" placeholder="Nhập điểm tối đa" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="max_attempt">
                                    Số lần được phép làm lại
                                </label>
                                <input type="number"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="max_attempt" name="max_attempt" value="{{ old('max_attempt') }}" placeholder="Nhập số lần làm lại tối đa">
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
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
                                    Thứ tự sắp xếp
                                </label>
                                <input type="number"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="role" name="role" value="{{ old('role', 0) }}" placeholder="Nhập thứ tự sắp xếp">
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
        const lessonSelectContainer = document.getElementById('lessonSelectContainer');
        const lessonSelect = document.getElementById('lesson_select');
        const lessonIdInput = document.getElementById('lesson_id');

        // Reset values
        lessonIdInput.value = '';
        lessonSelect.required = false;

        // Hide all containers
        lessonSelectContainer.style.display = 'none';

        // Show relevant containers based on type
        if (typeSelect.value !== 'entrance_test' && typeSelect.value !== '') {
            lessonSelectContainer.style.display = 'block';
            lessonSelect.required = true;
        }
    }

    function updateLessonId() {
        const lessonSelect = document.getElementById('lesson_select');
        const lessonIdInput = document.getElementById('lesson_id');
        lessonIdInput.value = lessonSelect.value;
    }

    // Convert duration to seconds before submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const typeSelect = document.getElementById('type');
        const lessonSelect = document.getElementById('lesson_select');

        // Validate lesson selection when type is not entrance_test
        if (typeSelect.value !== 'entrance_test' && typeSelect.value !== '' && !lessonSelect.value) {
            e.preventDefault();
            alert('Vui lòng chọn bài học cho bài kiểm tra');
            return false;
        }

        const durationInput = document.getElementById('duration');
        if (durationInput.value) {
            durationInput.value = parseInt(durationInput.value) * 60;
        }
    });

    // Initialize form
    document.addEventListener('DOMContentLoaded', function() {
        handleTestTypeChange();
    });
</script>
