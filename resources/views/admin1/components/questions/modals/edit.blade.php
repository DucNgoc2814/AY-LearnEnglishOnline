<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="editQuestionModal" aria-labelledby="editQuestionModalLabel"
    aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="editQuestionModalLabel">Chỉnh sửa câu hỏi</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeEditQuestionModal()"
                        aria-label="Close">
                        <span class="sr-only">Đóng</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editQuestionForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="question_id" id="edit_questionId">
                    <input type="hidden" name="media_url" id="edit_media_url">

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-6">
                        <!-- Phần thông tin cơ bản -->
                        <div class="space-y-8">
                            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                                <h4 class="font-medium text-gray-900 mb-4 flex items-center">
                                    <span class="mr-2">1. Thông tin cơ bản</span>
                                    <span class="text-xs text-gray-500">(Các trường bắt buộc có dấu *)</span>
                                </h4>

                                <!-- Bài kiểm tra -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_test_id">
                                        Bài kiểm tra <span class="text-red-500">*</span>
                                        <span class="ml-1 text-xs text-gray-500">(Chọn bài kiểm tra để thêm câu hỏi vào)</span>
                                    </label>
                                    <select
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_test_id" name="test_id" required>
                                        <option value="">Chọn bài kiểm tra</option>
                                        @foreach (\App\Models\Test::all() as $test)
                                            <option value="{{ $test->id }}">
                                                {{ $test->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Loại câu hỏi -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_type">
                                        Loại câu hỏi <span class="text-red-500">*</span>
                                        <span class="ml-1 text-xs text-gray-500">(Chọn định dạng nội dung câu hỏi)</span>
                                    </label>
                                    <select
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_type" name="type" required>
                                        <option value="text">Văn bản (Chỉ chữ)</option>
                                        <option value="image">Hình ảnh</option>
                                        <option value="video">Video</option>
                                        <option value="audio">Âm thanh</option>
                                    </select>
                                </div>

                                <!-- Nội dung câu hỏi -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_question">
                                        Nội dung câu hỏi <span class="text-red-500">*</span>
                                        <span class="ml-1 text-xs text-gray-500">(Nhập câu hỏi chi tiết)</span>
                                    </label>
                                    <textarea
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_question" name="question" rows="3" required
                                        placeholder="VD: What is the capital of Vietnam?"></textarea>
                                </div>

                                <!-- Thứ tự -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_order_number">
                                        Thứ tự <span class="text-red-500">*</span>
                                        <span class="ml-1 text-xs text-gray-500">(Vị trí hiển thị trong bài kiểm tra)</span>
                                    </label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_order_number" name="order_number" min="1" required>
                                </div>
                            </div>

                            <!-- Phần media -->
                            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                                <h4 class="font-medium text-gray-900 mb-6">2. Tệp đính kèm</h4>

                                <!-- Media upload cho Image -->
                                <div class="mb-8 media-upload-container" id="edit_imageUploadContainer">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_image_file">
                                        Tệp Hình ảnh
                                        <span class="ml-1 text-xs text-gray-500">(JPG, PNG, GIF - Tối đa 5MB)</span>
                                    </label>
                                    <div class="preview-container mb-2">
                                        <div id="edit_imagePreviewContainer" class="hidden">
                                            <img id="edit_imagePreview" src=""
                                                class="max-w-xs h-auto rounded-lg shadow-md cursor-pointer"
                                                style="max-height: 200px; object-fit: contain;"
                                                onclick="openEditMediaModal(this.src)">
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button type="button" id="edit_chooseImageBtn"
                                            class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                                            Chọn tệp
                                        </button>
                                        <button type="button" onclick="clearEditMedia('image')"
                                            class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded">
                                            Xóa tệp
                                        </button>
                                    </div>
                                    <input type="file" class="hidden" id="edit_image_file" name="media_file"
                                        accept="image/*">
                                </div>

                                <!-- Media upload cho Video -->
                                <div class="mb-8 media-upload-container" id="edit_videoUploadContainer">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_video_file">
                                        Tệp Video
                                        <span class="ml-1 text-xs text-gray-500">(MP4, WebM - Tối đa 50MB)</span>
                                    </label>
                                    <div class="preview-container mb-2">
                                        <div id="edit_videoPreviewContainer" class="hidden">
                                            <video id="edit_videoPreview"
                                                class="max-w-xs rounded-lg shadow-md cursor-pointer"
                                                style="max-height: 200px; width: 100%;" controls>
                                                <source src="" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button type="button" id="edit_chooseVideoBtn"
                                            class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                                            Chọn tệp
                                        </button>
                                        <button type="button" onclick="clearEditMedia('video')"
                                            class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded">
                                            Xóa tệp
                                        </button>
                                    </div>
                                    <input type="file" class="hidden" id="edit_video_file" name="media_file"
                                        accept="video/*">
                                </div>

                                <!-- Media upload cho Audio -->
                                <div class="mb-8 media-upload-container" id="edit_audioUploadContainer">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_audio_file">
                                        Tệp Âm thanh
                                        <span class="ml-1 text-xs text-gray-500">(MP3, WAV - Tối đa 10MB)</span>
                                    </label>
                                    <div class="preview-container mb-2">
                                        <div id="edit_audioPreviewContainer" class="hidden">
                                            <audio id="edit_audioPreview" class="w-full" controls>
                                                <source src="" type="audio/mpeg">
                                            </audio>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button type="button" id="edit_chooseAudioBtn"
                                            class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                                            Chọn tệp
                                        </button>
                                        <button type="button" onclick="clearEditMedia('audio')"
                                            class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded">
                                            Xóa tệp
                                        </button>
                                    </div>
                                    <input type="file" class="hidden" id="edit_audio_file" name="media_file"
                                        accept="audio/*">
                                </div>
                            </div>
                        </div>

                        <!-- Phần bên phải -->
                        <div class="space-y-8">
                            <!-- Phần câu trả lời -->
                            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                                <div class="flex justify-between items-center mb-6">
                                    <h4 class="font-medium text-gray-900">3. Thiết lập câu trả lời</h4>
                                </div>

                                <!-- Loại câu trả lời - Moved to top -->
                                <div class="mb-6 bg-blue-50 p-4 rounded-lg border border-blue-200">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_answer_type">
                                        Loại câu trả lời <span class="text-red-500">*</span>
                                    </label>
                                    <div class="flex items-center space-x-4">
                                        <select class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline flex-grow"
                                            id="edit_answer_type" name="answer_type" required>
                                            <option value="single">Chọn một đáp án</option>
                                            <option value="multiple">Chọn nhiều đáp án</option>
                                        </select>
                                        <div class="text-sm text-blue-700">
                                            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Chọn kiểu đáp án phù hợp
                                        </div>
                                    </div>
                                </div>

                                <!-- Loại câu hỏi (Role) -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_role">
                                        Loại câu hỏi <span class="text-red-500">*</span>
                                        <span class="ml-1 text-xs text-gray-500">(Chọn hình thức trả lời)</span>
                                    </label>
                                    <select
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_role" name="role" required onchange="handleEditRoleChange(this.value)">
                                        <option value="1">Trắc nghiệm</option>
                                        <option value="2">Tự luận</option>
                                    </select>
                                </div>

                                <div class="flex justify-between items-center mb-4">
                                    <button type="button" id="edit_add_answer"
                                        class="bg-green-500 hover:bg-green-600 text-white text-sm font-bold py-2 px-4 rounded inline-flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Thêm câu trả lời
                                    </button>
                                </div>

                                <!-- Container chứa danh sách câu trả lời -->
                                <div id="edit_answers_container" class="space-y-4">
                                    <!-- Các câu trả lời sẽ được thêm vào đây -->
                                </div>

                                <!-- Hướng dẫn nhỏ -->
                                <div class="mt-4 text-sm text-gray-600">
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Mỗi câu hỏi cần có ít nhất một đáp án và phải có ít nhất một đáp án đúng
                                    </p>
                                </div>
                            </div>

                            <!-- Phần giải thích đáp án -->
                            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                                <h4 class="font-medium text-gray-900 mb-4">4. Giải thích đáp án</h4>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2"
                                        for="edit_correct_answer_explanation">
                                        Giải thích chi tiết
                                        <span class="ml-1 text-xs text-gray-500">(Sẽ hiển thị sau khi học viên làm xong)</span>
                                    </label>
                                    <textarea
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_correct_answer_explanation" name="correct_answer_explanation" rows="3"
                                        placeholder="VD: Hà Nội là thủ đô của Việt Nam từ năm 1010..."></textarea>
                                    <p class="text-xs text-gray-500 mt-1">Giải thích này giúp học viên hiểu rõ hơn về đáp án đúng</p>
                                </div>
                            </div>

                            <!-- Phần hướng dẫn -->
                            <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                                <h5 class="text-blue-800 font-medium mb-2">Lưu ý khi chỉnh sửa câu hỏi:</h5>
                                <ul class="list-disc pl-5 text-blue-700 text-sm space-y-1">
                                    <li>Nội dung câu hỏi cần rõ ràng, dễ hiểu</li>
                                    <li>Chọn loại câu hỏi phù hợp với nội dung bài kiểm tra</li>
                                    <li>Đối với câu hỏi có media, đảm bảo chất lượng tệp tốt</li>
                                    <li>Thứ tự câu hỏi nên sắp xếp theo độ khó tăng dần</li>
                                    <li>Cần có ít nhất một đáp án đúng cho mỗi câu hỏi</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-6 border-t mt-6">
                        <button type="button"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            onclick="closeEditQuestionModal()">
                            Hủy
                        </button>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal xem media cho edit -->
<div id="editMediaModal" class="fixed inset-0 z-[60] hidden overflow-y-auto" aria-labelledby="editMediaModalLabel"
    aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="relative bg-white rounded-lg max-w-3xl w-full mx-auto">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-xl font-semibold text-gray-900" id="editMediaModalLabel">Xem media</h3>
                <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeEditMediaModal()">
                    <span class="sr-only">Đóng</span>
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Body -->
            <div class="p-4">
                <div id="editMediaContent"></div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Khởi tạo các biến
        const editTypeSelect = document.getElementById('edit_type');
        const editImageUploadContainer = document.getElementById('edit_imageUploadContainer');
        const editVideoUploadContainer = document.getElementById('edit_videoUploadContainer');
        const editAudioUploadContainer = document.getElementById('edit_audioUploadContainer');
        const editQuestionForm = document.getElementById('editQuestionForm');

        // Ẩn tất cả media upload containers ban đầu
        function hideAllEditMediaContainers() {
            if (editImageUploadContainer) editImageUploadContainer.style.display = 'none';
            if (editVideoUploadContainer) editVideoUploadContainer.style.display = 'none';
            if (editAudioUploadContainer) editAudioUploadContainer.style.display = 'none';
        }

        // Hiển thị container dựa vào loại đã chọn
        window.showEditMediaContainer = function(type) {
            console.log('Showing media container for type:', type);
            hideAllEditMediaContainers();

            // Đảm bảo type là một trong các giá trị hợp lệ
            const validTypes = ['text', 'image', 'video', 'audio'];
            if (!validTypes.includes(type)) {
                type = 'text';
            }

            // Set giá trị cho select box
            if (editTypeSelect) {
                editTypeSelect.value = type;
            }

            // Hiển thị container tương ứng
            switch(type) {
                case 'image':
                    if (editImageUploadContainer) editImageUploadContainer.style.display = 'block';
                    break;
                case 'video':
                    if (editVideoUploadContainer) editVideoUploadContainer.style.display = 'block';
                    break;
                case 'audio':
                    if (editAudioUploadContainer) editAudioUploadContainer.style.display = 'block';
                    break;
                default:
                    // Nếu là text hoặc không có type, không hiển thị container nào
                    break;
            }
        }

        // Khởi tạo hiển thị
        hideAllEditMediaContainers();

        // Xử lý sự kiện change của select
        if (editTypeSelect) {
            editTypeSelect.addEventListener('change', function() {
                const selectedType = this.value;
                console.log('Type changed to:', selectedType);
                showEditMediaContainer(selectedType);
                // Reset file input và preview khi đổi loại
                clearEditMedia(selectedType);
            });
        }

        // Override hàm populateEditModal để đảm bảo type được set đúng
        window.populateEditModal = function(data) {
            console.log('Populating edit modal with data:', data);
            // Set các giá trị khác...

            // Set type và hiển thị container
            const type = data.type || 'text';
            if (editTypeSelect) {
                editTypeSelect.value = type;
                showEditMediaContainer(type);
            }
        }

        // Xử lý sự kiện click cho các nút "Chọn tệp"
        document.getElementById('edit_chooseImageBtn').addEventListener('click', function() {
            document.getElementById('edit_image_file').click();
        });

        document.getElementById('edit_chooseVideoBtn').addEventListener('click', function() {
            document.getElementById('edit_video_file').click();
        });

        document.getElementById('edit_chooseAudioBtn').addEventListener('click', function() {
            document.getElementById('edit_audio_file').click();
        });

        // Xử lý preview media
        function handleEditFileInput(fileInput, previewElement, previewContainer, type) {
            fileInput.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    const fileType = file.type;
                    const reader = new FileReader();

                    // Kiểm tra kích thước file
                    const maxSize = getMaxFileSize(type);
                    if (file.size > maxSize) {
                        alert(`File quá lớn. Kích thước tối đa cho ${getFileTypeLabel(type)} là ${formatFileSize(maxSize)}.`);
                        this.value = '';
                        return;
                    }

                    reader.onload = function(e) {
                        previewContainer.classList.remove('hidden');
                        if (type === 'image') {
                            previewElement.src = e.target.result;
                        } else if (type === 'video' || type === 'audio') {
                            previewElement.querySelector('source').src = e.target.result;
                            previewElement.load();
                        }
                    }

                    reader.readAsDataURL(file);
                }
            });
        }

        // Xử lý preview cho từng loại media
        handleEditFileInput(
            document.getElementById('edit_image_file'),
            document.getElementById('edit_imagePreview'),
            document.getElementById('edit_imagePreviewContainer'),
            'image'
        );
        handleEditFileInput(
            document.getElementById('edit_video_file'),
            document.getElementById('edit_videoPreview'),
            document.getElementById('edit_videoPreviewContainer'),
            'video'
        );
        handleEditFileInput(
            document.getElementById('edit_audio_file'),
            document.getElementById('edit_audioPreview'),
            document.getElementById('edit_audioPreviewContainer'),
            'audio'
        );

        // Xử lý thêm câu trả lời
        document.getElementById('edit_add_answer').addEventListener('click', function() {
            const container = document.getElementById('edit_answers_container');
            const answerCount = container.getElementsByClassName('answer-item').length;
            const answerType = document.getElementById('edit_answer_type').value;

            const template = `
                <div class="answer-item p-4 border rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                    <div class="space-y-4">
                        <!-- Nội dung câu trả lời -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Nội dung <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="answers[${answerCount}][answer]"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Nhập câu trả lời" required>
                        </div>

                        <!-- Đánh dấu đáp án đúng -->
                        <div>
                            <div class="flex items-center mb-4">
                                <input type="${answerType === 'single' ? 'radio' : 'checkbox'}"
                                    name="${answerType === 'single' ? 'correct_answer' : `answers[${answerCount}][is_correct]`}"
                                    value="${answerType === 'single' ? answerCount : '1'}"
                                    class="form-${answerType === 'single' ? 'radio' : 'checkbox'} h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Đánh dấu là đáp án đúng</span>
                            </div>
                        </div>

                        <!-- Phần upload ảnh cho câu trả lời -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Hình ảnh (Tùy chọn)
                            </label>
                            <div class="preview-container mb-2">
                                <div class="answer-image-preview-container hidden">
                                    <img class="answer-image-preview max-w-xs h-auto rounded-lg shadow-md cursor-pointer"
                                        src="" style="max-height: 100px; object-fit: contain;"
                                        onclick="openEditMediaModal(this.src)">
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button type="button"
                                    class="choose-answer-image-btn bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                                    Chọn ảnh
                                </button>
                                <button type="button" onclick="clearEditAnswerImage(this)"
                                    class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded">
                                    Xóa ảnh
                                </button>
                            </div>
                            <input type="file" class="answer-image-input hidden" name="answers[${answerCount}][url]"
                                accept="image/*">
                        </div>
                    </div>
                </div>
            `;

            container.insertAdjacentHTML('beforeend', template);
        });

        // Xử lý thay đổi loại câu trả lời
        document.getElementById('edit_answer_type').addEventListener('change', function() {
            const container = document.getElementById('edit_answers_container');
            const answerType = this.value;
            const correctInputs = container.querySelectorAll('input[type="radio"], input[type="checkbox"]');

            correctInputs.forEach((input, index) => {
                if (answerType === 'single') {
                    input.type = 'radio';
                    input.name = 'correct_answer';
                    input.value = index;
                } else {
                    input.type = 'checkbox';
                    input.name = `answers[${index}][is_correct]`;
                    input.value = '1';
                }
            });
        });

        // Xử lý form submit
        editQuestionForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const questionId = document.getElementById('edit_questionId').value;
            const formData = new FormData(this);

            // Gửi form bằng AJAX
            fetch(`/admin/questions/${questionId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Cập nhật thành công!');
                    closeEditQuestionModal();
                    window.location.reload();
                } else {
                    alert('Lỗi: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Đã xảy ra lỗi khi cập nhật');
            });
        });

        // Xử lý sự kiện click cho nút chọn ảnh câu trả lời trong form edit
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('choose-answer-image-btn')) {
                const answerItem = e.target.closest('.answer-item');
                const fileInput = answerItem.querySelector('.answer-image-input');
                fileInput.click();
            }
        });

        // Xử lý preview ảnh câu trả lời trong form edit
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('answer-image-input')) {
                const answerItem = e.target.closest('.answer-item');
                const previewContainer = answerItem.querySelector('.answer-image-preview-container');
                const preview = answerItem.querySelector('.answer-image-preview');

                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                    }
                    reader.readAsDataURL(e.target.files[0]);
                }
            }
        });

        // Khởi tạo giao diện dựa vào role ban đầu
        handleEditRoleChange(document.getElementById('edit_role').value);
    });

    function handleEditRoleChange(role) {
        const answerTypeContainer = document.getElementById('edit_answer_type_container');
        const addAnswerButton = document.getElementById('edit_add_answer');
        const answersContainer = document.getElementById('edit_answers_container');

        // Xóa tất cả câu trả lời hiện tại
        answersContainer.innerHTML = '';

        if (role === '2') { // Tự luận
            // Ẩn phần loại câu trả lời và nút thêm
            answerTypeContainer.style.display = 'none';
            addAnswerButton.style.display = 'none';

            // Thêm một câu trả lời duy nhất cho tự luận
            const essayAnswerTemplate = `
                <div class="answer-item p-4 border rounded-lg bg-gray-50">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Nội dung câu trả lời mẫu <span class="text-red-500">*</span>
                            </label>
                            <textarea name="answers[0][answer]" rows="3"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Nhập câu trả lời mẫu" required></textarea>
                            <input type="hidden" name="answers[0][is_correct]" value="1">
                        </div>
                    </div>
                </div>
            `;
            answersContainer.innerHTML = essayAnswerTemplate;
        } else { // Trắc nghiệm
            // Hiện phần loại câu trả lời và nút thêm
            answerTypeContainer.style.display = 'block';
            addAnswerButton.style.display = 'block';

            // Thêm câu trả lời mặc định cho trắc nghiệm
            const mcqAnswerTemplate = `
                <div class="answer-item p-4 border rounded-lg bg-gray-50">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Nội dung <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="answers[0][answer]"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Nhập câu trả lời" required>
                        </div>
                        <div>
                            <div class="flex items-center mb-4">
                                <input type="radio" name="correct_answer" value="0"
                                    class="form-radio h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Đánh dấu là đáp án đúng</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Hình ảnh (Tùy chọn)
                            </label>
                            <div class="preview-container mb-2">
                                <div class="answer-image-preview-container hidden">
                                    <img class="answer-image-preview max-w-xs h-auto rounded-lg shadow-md cursor-pointer"
                                        src="" style="max-height: 100px; object-fit: contain;"
                                        onclick="openEditMediaModal(this.src)">
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button type="button"
                                    class="choose-answer-image-btn bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                                    Chọn ảnh
                                </button>
                                <button type="button" onclick="clearEditAnswerImage(this)"
                                    class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded">
                                    Xóa ảnh
                                </button>
                            </div>
                            <input type="file" class="answer-image-input hidden" name="answers[0][url]"
                                accept="image/*">
                        </div>
                    </div>
                </div>
            `;
            answersContainer.innerHTML = mcqAnswerTemplate;
        }
    }

    // Các hàm tiện ích
    function getMaxFileSize(type) {
        if (type === 'image') return 5 * 1024 * 1024; // 5MB
        if (type === 'video') return 50 * 1024 * 1024; // 50MB
        if (type === 'audio') return 10 * 1024 * 1024; // 10MB
        return 5 * 1024 * 1024; // Default 5MB
    }

    function getFileTypeLabel(type) {
        if (type === 'image') return 'hình ảnh';
        if (type === 'video') return 'video';
        if (type === 'audio') return 'âm thanh';
        return 'file';
    }

    function formatFileSize(bytes) {
        if (bytes < 1024) return bytes + ' bytes';
        if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
        return (bytes / 1048576).toFixed(1) + ' MB';
    }

    function resetEditPreviews() {
        const types = ['image', 'video', 'audio'];
        types.forEach(type => {
            const container = document.getElementById(`edit_${type}PreviewContainer`);
            const preview = document.getElementById(`edit_${type}Preview`);
            container.classList.add('hidden');
            if (type === 'image') {
                preview.src = '';
            } else {
                preview.querySelector('source').src = '';
            }
        });
    }

    function clearEditMedia(type) {
        if (type === 'all' || !type) {
            document.getElementById('edit_media_file').value = '';
            document.getElementById('edit_media_url').value = '';
            resetEditPreviews();
        } else {
            const fileInput = document.getElementById(`edit_${type}_file`);
            const previewContainer = document.getElementById(`edit_${type}PreviewContainer`);
            fileInput.value = '';
            previewContainer.classList.add('hidden');
        }
    }

    function closeEditQuestionModal() {
        modalHandler.close('editQuestionModal');
        document.getElementById('editQuestionForm').reset();
        resetEditPreviews();
        clearEditMedia('all');
    }

    function openEditMediaModal(src) {
        const mediaModal = document.getElementById('editMediaModal');
        const mediaContent = document.getElementById('editMediaContent');
        const fileType = typeof src === 'string' && src.includes(';') ? src.split(';')[0].split(':')[1] : null;

        // Hiển thị nội dung phù hợp dựa vào loại tệp hoặc type của câu hỏi
        if (fileType && fileType.startsWith('image') || document.getElementById('edit_type').value === 'image') {
            mediaContent.innerHTML = `<img src="${src}" class="w-full h-auto" />`;
        } else if (fileType && fileType.startsWith('video') || document.getElementById('edit_type').value === 'video') {
            mediaContent.innerHTML = `<video src="${src}" controls class="w-full h-auto"></video>`;
        } else if (fileType && fileType.startsWith('audio') || document.getElementById('edit_type').value === 'audio') {
            mediaContent.innerHTML = `<audio src="${src}" controls class="w-full"></audio>`;
        }

        mediaModal.classList.remove('hidden');
    }

    function closeEditMediaModal() {
        const mediaModal = document.getElementById('editMediaModal');
        mediaModal.classList.add('hidden');
    }

    // Hàm xóa ảnh câu trả lời trong form edit
    function clearEditAnswerImage(button) {
        const answerItem = button.closest('.answer-item');
        const fileInput = answerItem.querySelector('.answer-image-input');
        const previewContainer = answerItem.querySelector('.answer-image-preview-container');
        const preview = answerItem.querySelector('.answer-image-preview');

        fileInput.value = '';
        preview.src = '';
        previewContainer.classList.add('hidden');
    }
</script>

<!-- Thêm styles -->
<style>
    .preview-container {
        min-height: 100px;
        border: 2px dashed #e2e8f0;
        border-radius: 0.5rem;
        padding: 0.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f8fafc;
    }

    .preview-container img,
    .preview-container video,
    .preview-container audio {
        max-width: 100%;
        border-radius: 0.375rem;
        transition: all 0.3s ease;
    }

    .preview-container img:hover,
    .preview-container video:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    /* Modal animation */
    .modal-content {
        animation: modalFadeIn 0.3s ease-out;
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>
