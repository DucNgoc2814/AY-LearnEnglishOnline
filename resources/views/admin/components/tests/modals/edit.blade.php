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
                    <input type="hidden" name="lesson_id" id="edit_lesson_id" value="">
                    <div class="grid grid-cols-2 gap-6 mt-4">
                        <!-- Thông tin cơ bản -->
                        <div>
                            <h4 class="font-medium text-gray-900 mb-4">Thông tin cơ bản</h4>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_name">
                                    Tên bài test <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_name" name="name" placeholder="Nhập tên bài test" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_description">
                                    Mô tả
                                </label>
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_description" name="description" rows="3" placeholder="Nhập mô tả bài test"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_type">
                                    Loại bài test <span class="text-red-500">*</span>
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_type" name="type" required onchange="handleTestTypeChangeEdit()">
                                    <option value="">-- Chọn loại bài test --</option>
                                    <option value="lesson_test">Bài kiểm tra bài học</option>
                                    <option value="entrance_test">Bài test đầu vào</option>
                                    <option value="after_class">Bài kiểm tra sau buổi học</option>
                                    <option value="before_class">Bài kiểm tra trước buổi học</option>
                                </select>
                            </div>

                            <!-- Dropdown chọn Lesson cho lesson_test -->
                            <div class="mb-4" id="edit_lessonSelectContainer" style="display: none;">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_lesson_select">
                                    Chọn bài học <span class="text-red-500">*</span>
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_lesson_select" onchange="updateLessonIdEdit()">
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
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_duration">
                                    Thời gian làm bài (phút)
                                </label>
                                <input type="number"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_duration" name="duration" placeholder="Nhập thời gian làm bài">
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_min_score">
                                        Điểm tối thiểu <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_min_score" name="min_score" placeholder="Nhập điểm tối thiểu" required>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_max_score">
                                        Điểm tối đa <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_max_score" name="max_score" placeholder="Nhập điểm tối đa" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_max_attempt">
                                    Số lần được phép làm lại
                                </label>
                                <input type="number"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_max_attempt" name="max_attempt" placeholder="Nhập số lần làm lại tối đa">
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
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_role">
                                    Thứ tự sắp xếp
                                </label>
                                <input type="number"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_role" name="role" placeholder="Nhập thứ tự sắp xếp">
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
        const lessonSelectContainer = document.getElementById('edit_lessonSelectContainer');
        const lessonSelect = document.getElementById('edit_lesson_select');
        const lessonIdInput = document.getElementById('edit_lesson_id');

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

    function updateLessonIdEdit() {
        const lessonSelect = document.getElementById('edit_lesson_select');
        const lessonIdInput = document.getElementById('edit_lesson_id');
        lessonIdInput.value = lessonSelect.value;
    }

    document.addEventListener('DOMContentLoaded', function() {
        modalHandler.addEventListener('editTestModal', 'show', function(data) {
            document.getElementById('edit_name').value = data.name || '';

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

            // Set duration (convert from seconds to minutes)
            document.getElementById('edit_duration').value = data.duration ? Math.floor(data.duration / 60) : '';

            document.getElementById('edit_min_score').value = data.min_score || '';
            document.getElementById('edit_max_score').value = data.max_score || '';
            document.getElementById('edit_max_attempt').value = data.max_attempt || '';
            document.getElementById('edit_role').value = data.role || '';

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

            // Set lesson_id if available
            if (data.lesson_id) {
                document.getElementById('edit_lesson_id').value = data.lesson_id;
                document.getElementById('edit_lesson_select').value = data.lesson_id;
            }

            // Show appropriate containers based on test type
            handleTestTypeChangeEdit();

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

        // Validate form before submit
        document.getElementById('editTestForm').addEventListener('submit', function(e) {
            const typeSelect = document.getElementById('edit_type');
            const lessonSelect = document.getElementById('edit_lesson_select');

            // Validate lesson selection when type is not entrance_test
            if (typeSelect.value !== 'entrance_test' && typeSelect.value !== '' && !lessonSelect.value) {
                e.preventDefault();
                alert('Vui lòng chọn bài học cho bài kiểm tra');
                return false;
            }

            // Convert duration to seconds
            const durationInput = document.getElementById('edit_duration');
            if (durationInput.value) {
                durationInput.value = parseInt(durationInput.value) * 60;
            }
        });
    });
</script>
@endpush
