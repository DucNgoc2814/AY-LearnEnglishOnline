<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="createQuestionModal" aria-labelledby="createQuestionModalLabel"
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
                    <h3 class="text-lg font-medium text-gray-900" id="createQuestionModalLabel">Thêm câu hỏi mới</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500"
                        onclick="modalHandler.close('createQuestionModal')" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form action="{{ route('admin.questions.store') }}" method="POST" enctype="multipart/form-data"
                    id="createQuestionForm">
                    @csrf
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
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="test_id">
                                        Bài kiểm tra <span class="text-red-500">*</span>
                                        <span class="ml-1 text-xs text-gray-500">(Chọn bài kiểm tra để thêm câu hỏi
                                            vào)</span>
                                    </label>
                                    <select
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="test_id" name="test_id" required>
                                        <option value="">Chọn bài kiểm tra</option>
                                        @foreach (\App\Models\Test::all() as $test)
                                            <option value="{{ $test->id }}"
                                                {{ old('test_id') == $test->id ? 'selected' : '' }}>
                                                {{ $test->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Loại câu hỏi -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                                        Loại câu hỏi <span class="text-red-500">*</span>
                                        <span class="ml-1 text-xs text-gray-500">(Chọn định dạng nội dung câu
                                            hỏi)</span>
                                    </label>
                                    <select
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="type" name="type" required>
                                        <option value="text" {{ old('type', 'text') == 'text' ? 'selected' : '' }}>Văn
                                            bản (Chỉ chữ)</option>
                                        <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Hình ảnh
                                            (Câu hỏi kèm hình)</option>
                                        <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video (Câu
                                            hỏi kèm video)</option>
                                        <option value="audio" {{ old('type') == 'audio' ? 'selected' : '' }}>Âm thanh
                                            (Câu hỏi kèm audio)</option>
                                    </select>
                                </div>

                                <!-- Loại câu hỏi (Role) -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
                                        Loại câu hỏi <span class="text-red-500">*</span>
                                        <span class="ml-1 text-xs text-gray-500">(Chọn hình thức trả lời)</span>
                                    </label>
                                    <select
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="role" name="role" required onchange="handleRoleChange(this.value)">
                                        <option value="1" {{ old('role', 1) == 1 ? 'selected' : '' }}>Trắc nghiệm</option>
                                        <option value="2" {{ old('role') == 2 ? 'selected' : '' }}>Tự luận</option>
                                    </select>
                                </div>

                                <!-- Nội dung câu hỏi -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="question">
                                        Nội dung câu hỏi <span class="text-red-500">*</span>
                                        <span class="ml-1 text-xs text-gray-500">(Nhập câu hỏi chi tiết)</span>
                                    </label>
                                    <textarea
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="question" name="question" rows="3" required placeholder="VD: What is the capital of Vietnam?">{{ old('question') }}</textarea>
                                </div>

                                <!-- Thứ tự -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="order_number">
                                        Thứ tự <span class="text-red-500">*</span>
                                        <span class="ml-1 text-xs text-gray-500">(Vị trí hiển thị trong bài kiểm
                                            tra)</span>
                                    </label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="order_number" name="order_number" value="{{ old('order_number', 1) }}"
                                        min="1" required>
                                </div>
                            </div>
                            <!-- Phần media -->
                            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mt-6">
                                <h4 class="font-medium text-gray-900 mb-6">2. Tệp đính kèm</h4>

                                <!-- Media upload cho Image -->
                                <div class="mb-8 media-upload-container" id="imageUploadContainer">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="image_file">
                                        Tệp Hình ảnh
                                        <span class="ml-1 text-xs text-gray-500">(JPG, PNG, GIF - Tối đa 5MB)</span>
                                    </label>
                                    <div class="preview-container mb-2">
                                        <div id="imagePreviewContainer" class="hidden">
                                            <img id="imagePreview" src=""
                                                class="max-w-xs h-auto rounded-lg shadow-md cursor-pointer"
                                                style="max-height: 200px; object-fit: contain;"
                                                onclick="openMediaModal(this.src)">
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button type="button" id="chooseImageBtn"
                                            class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                                            Chọn tệp
                                        </button>
                                        <button type="button" onclick="clearMedia('image')"
                                            class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded">
                                            Xóa tệp
                                        </button>
                                    </div>
                                    <input type="file" class="hidden" id="image_file" name="media_file"
                                        accept="image/*">
                                </div>

                                <!-- Media upload cho Video -->
                                <div class="mb-8 media-upload-container" id="videoUploadContainer">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="video_file">
                                        Tệp Video
                                        <span class="ml-1 text-xs text-gray-500">(MP4, WebM - Tối đa 50MB)</span>
                                    </label>
                                    <div class="preview-container mb-2">
                                        <div id="videoPreviewContainer" class="hidden">
                                            <video id="videoPreview"
                                                class="max-w-xs rounded-lg shadow-md cursor-pointer"
                                                style="max-height: 200px; width: 100%;" controls>
                                                <source src="" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button type="button" id="chooseVideoBtn"
                                            class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                                            Chọn tệp
                                        </button>
                                        <button type="button" onclick="clearMedia('video')"
                                            class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded">
                                            Xóa tệp
                                        </button>
                                    </div>
                                    <input type="file" class="hidden" id="video_file" name="media_file"
                                        accept="video/*">
                                </div>

                                <!-- Media upload cho Audio -->
                                <div class="mb-8 media-upload-container" id="audioUploadContainer">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="audio_file">
                                        Tệp Âm thanh
                                        <span class="ml-1 text-xs text-gray-500">(MP3, WAV - Tối đa 10MB)</span>
                                    </label>
                                    <div class="preview-container mb-2">
                                        <div id="audioPreviewContainer" class="hidden">
                                            <audio id="audioPreview" class="w-full" controls>
                                                <source src="" type="audio/mpeg">
                                            </audio>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        <button type="button" id="chooseAudioBtn"
                                            class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                                            Chọn tệp
                                        </button>
                                        <button type="button" onclick="clearMedia('audio')"
                                            class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded">
                                            Xóa tệp
                                        </button>
                                    </div>
                                    <input type="file" class="hidden" id="audio_file" name="media_file"
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
                                    <button type="button" id="add_answer"
                                        class="bg-green-500 hover:bg-green-600 text-white text-sm font-bold py-2 px-4 rounded inline-flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Thêm câu trả lời
                                    </button>
                                </div>

                                <!-- Loại câu trả lời - Chỉ hiển thị cho câu hỏi trắc nghiệm -->
                                <div id="answer_type_container" class="mb-6 bg-blue-50 p-4 rounded-lg border border-blue-200">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="answer_type">
                                        Loại câu trả lời <span class="text-red-500">*</span>
                                    </label>
                                    <div class="flex items-center space-x-4">
                                        <select class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline flex-grow"
                                            id="answer_type" name="answer_type" required>
                                            <option value="single" selected>Chọn một đáp án</option>
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

                                <!-- Container chứa danh sách câu trả lời -->
                                <div id="answers_container" class="space-y-4">
                                    <!-- Template câu trả lời mặc định sẽ được thêm vào đây -->
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
                            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mt-6">
                                <h4 class="font-medium text-gray-900 mb-4">4. Giải thích đáp án</h4>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2"
                                        for="correct_answer_explanation">
                                        Giải thích chi tiết
                                        <span class="ml-1 text-xs text-gray-500">(Sẽ hiển thị sau khi học viên làm
                                            xong)</span>
                                    </label>
                                    <textarea
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="correct_answer_explanation" name="correct_answer_explanation" rows="3"
                                        placeholder="VD: Hà Nội là thủ đô của Việt Nam từ năm 1010...">{{ old('correct_answer_explanation') }}</textarea>
                                    <p class="text-xs text-gray-500 mt-1">Giải thích này giúp học viên hiểu rõ hơn về
                                        đáp án đúng</p>
                                </div>
                            </div>

                            <!-- Phần hướng dẫn -->
                            <div class="bg-blue-50 p-6 rounded-lg border border-blue-200 mt-6">
                                <h5 class="text-blue-800 font-medium mb-2">Lưu ý khi tạo câu hỏi:</h5>
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

                    <div class="flex justify-end pt-6 border-t mt-6 mb-6">
                        <button type="button"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2 mt-2"
                            onclick="modalHandler.close('createQuestionModal')">
                            Hủy
                        </button>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">
                            Thêm mới
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal xem media -->
<div id="mediaModal" class="fixed inset-0 z-[60] hidden overflow-y-auto" aria-labelledby="mediaModalLabel"
    aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="relative bg-white rounded-lg max-w-3xl w-full mx-auto">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-xl font-semibold text-gray-900" id="mediaModalLabel">Xem media</h3>
                <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeMediaModal()">
                    <span class="sr-only">Đóng</span>
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Body -->
            <div class="p-4">
                <div id="mediaContent"></div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Khởi tạo các biến
        const typeSelect = document.getElementById('type');
        const imageFileInput = document.getElementById('image_file');
        const videoFileInput = document.getElementById('video_file');
        const audioFileInput = document.getElementById('audio_file');
        const imagePreview = document.getElementById('imagePreview');
        const videoPreview = document.getElementById('videoPreview');
        const audioPreview = document.getElementById('audioPreview');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const videoPreviewContainer = document.getElementById('videoPreviewContainer');
        const audioPreviewContainer = document.getElementById('audioPreviewContainer');
        const imageUploadContainer = document.getElementById('imageUploadContainer');
        const videoUploadContainer = document.getElementById('videoUploadContainer');
        const audioUploadContainer = document.getElementById('audioUploadContainer');
        const createQuestionForm = document.getElementById('createQuestionForm');

        // Ẩn tất cả media upload containers ban đầu
        function hideAllMediaContainers() {
            imageUploadContainer.style.display = 'none';
            videoUploadContainer.style.display = 'none';
            audioUploadContainer.style.display = 'none';
        }

        // Hiển thị container dựa vào loại đã chọn
        function showMediaContainer(type) {
            hideAllMediaContainers();
            if (type === 'image') {
                imageUploadContainer.style.display = 'block';
            } else if (type === 'video') {
                videoUploadContainer.style.display = 'block';
            } else if (type === 'audio') {
                audioUploadContainer.style.display = 'block';
            }
        }

        // Khởi tạo hiển thị
        hideAllMediaContainers();
        showMediaContainer(typeSelect.value);

        // Xử lý sự kiện thay đổi loại câu hỏi
        typeSelect.addEventListener('change', function() {
            const selectedType = this.value;
            showMediaContainer(selectedType);
            clearMedia('all');
        });

        // Xử lý sự kiện click cho các nút "Chọn tệp"
        document.getElementById('chooseImageBtn').addEventListener('click', function() {
            imageFileInput.click();
        });

        document.getElementById('chooseVideoBtn').addEventListener('click', function() {
            videoFileInput.click();
        });

        document.getElementById('chooseAudioBtn').addEventListener('click', function() {
            audioFileInput.click();
        });

        // Xử lý preview media
        function handleFileInput(fileInput, previewElement, previewContainer, type) {
            fileInput.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    const fileType = file.type;
                    const reader = new FileReader();

                    // Kiểm tra kích thước file
                    const maxSize = getMaxFileSize(type);
                    if (file.size > maxSize) {
                        alert(
                            `File quá lớn. Kích thước tối đa cho ${getFileTypeLabel(type)} là ${formatFileSize(maxSize)}.`);
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

        handleFileInput(imageFileInput, imagePreview, imagePreviewContainer, 'image');
        handleFileInput(videoFileInput, videoPreview, videoPreviewContainer, 'video');
        handleFileInput(audioFileInput, audioPreview, audioPreviewContainer, 'audio');

        // Xử lý form submit để chỉ gửi file từ input file tương ứng
        createQuestionForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Xử lý đáp án đúng cho single choice
            if (document.getElementById('answer_type').value === 'single') {
                const selectedRadio = document.querySelector('input[name="correct_answer"]:checked');
                if (selectedRadio) {
                    const answerIndex = selectedRadio.getAttribute('data-answer-index');
                    const answerItems = document.querySelectorAll('.answer-item');

                    answerItems.forEach((item, index) => {
                        const isCorrectInput = item.querySelector(`input[name="answers[${index}][is_correct]"]`);
                        if (isCorrectInput) {
                            isCorrectInput.value = (index.toString() === answerIndex) ? "1" : "0";
                        }
                    });
                }
            }

            // Tạo FormData mới
            const formData = new FormData(this);

            // Xóa tất cả các file media khỏi FormData
            formData.delete('media_file');

            // Thêm file đúng loại theo loại câu hỏi
            if (typeSelect.value === 'image' && imageFileInput.files.length > 0) {
                formData.append('media_file', imageFileInput.files[0]);
            } else if (typeSelect.value === 'video' && videoFileInput.files.length > 0) {
                formData.append('media_file', videoFileInput.files[0]);
            } else if (typeSelect.value === 'audio' && audioFileInput.files.length > 0) {
                formData.append('media_file', audioFileInput.files[0]);
            }

            // Xử lý file cho các câu trả lời
            const answerItems = document.querySelectorAll('.answer-item');
            answerItems.forEach((item, index) => {
                const fileInput = item.querySelector('.answer-image-input');
                if (fileInput && fileInput.files.length > 0) {
                    formData.append(`answers[${index}][url]`, fileInput.files[0]);
                }
            });

            // Log FormData để debug
            for (let pair of formData.entries()) {
                console.log(pair[0] + ': ' + pair[1]);
            }

            // Gửi request bằng fetch API
            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Đóng modal
                        modalHandler.close('createQuestionModal');

                        // Hiển thị thông báo thành công
                        alert('Tạo câu hỏi mới thành công!');

                        // Tải lại trang để cập nhật danh sách
                        window.location.reload();
                    } else {
                        // Hiển thị lỗi
                        alert('Có lỗi xảy ra: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi gửi form');
                });
        });

        // Lấy kích thước tối đa cho từng loại file
        function getMaxFileSize(type) {
            if (type === 'image') {
                return 5 * 1024 * 1024; // 5MB
            } else if (type === 'video') {
                return 50 * 1024 * 1024; // 50MB
            } else if (type === 'audio') {
                return 10 * 1024 * 1024; // 10MB
            }
            return 5 * 1024 * 1024; // Mặc định 5MB
        }

        // Lấy nhãn cho loại file
        function getFileTypeLabel(type) {
            if (type === 'image') {
                return 'hình ảnh';
            } else if (type === 'video') {
                return 'video';
            } else if (type === 'audio') {
                return 'âm thanh';
            }
            return 'file';
        }

        // Format kích thước file
        function formatFileSize(bytes) {
            if (bytes < 1024) return bytes + ' bytes';
            else if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
            else return (bytes / 1048576).toFixed(1) + ' MB';
        }

        // Xử lý thêm câu trả lời
        document.getElementById('add_answer').addEventListener('click', function() {
            const container = document.getElementById('answers_container');
            const answerCount = container.getElementsByClassName('answer-item').length;
            const answerType = document.getElementById('answer_type').value;

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
                                    name="correct_answer"
                                    value="${answerCount}"
                                    class="answer-correct-input form-${answerType === 'single' ? 'radio' : 'checkbox'} h-5 w-5 text-blue-600 rounded focus:ring-blue-500"
                                    onchange="updateIsCorrect(this)">
                                <input type="hidden" name="answers[${answerCount}][is_correct]" value="0" class="answer-is-correct-input">
                                <span class="ml-2 text-sm text-gray-700">Đánh dấu là đáp án đúng</span>
                            </div>
                        </div>

                        <!-- Thứ tự câu trả lời -->
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Thứ tự <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="answers[${answerCount}][order_number]"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                value="${answerCount + 1}" min="1" required>
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
                                        onclick="openMediaModal(this.src)">
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button type="button"
                                    class="choose-answer-image-btn bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                                    Chọn ảnh
                                </button>
                                <button type="button" onclick="clearAnswerImage(this)"
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

            // Thêm hàm xử lý cập nhật is_correct
            window.updateIsCorrect = function(radio) {
                // Lấy tất cả các input hidden is_correct
                const allIsCorrectInputs = document.querySelectorAll('.answer-is-correct-input');

                // Reset tất cả về 0
                allIsCorrectInputs.forEach(input => {
                    input.value = "0";
                });

                // Tìm input hidden tương ứng với radio được chọn và set giá trị 1
                if (radio.checked) {
                    const answerItem = radio.closest('.answer-item');
                    const isCorrectInput = answerItem.querySelector('.answer-is-correct-input');
                    if (isCorrectInput) {
                        isCorrectInput.value = "1";
                    }
                }
            };
        });

        // Xử lý thay đổi loại câu trả lời
        document.getElementById('answer_type').addEventListener('change', function() {
            const container = document.getElementById('answers_container');
            const answerType = this.value;
            const answers = container.getElementsByClassName('answer-item');

            Array.from(answers).forEach((answer, index) => {
                const input = answer.querySelector('input[type="radio"], input[type="checkbox"]');
                const newType = answerType === 'single' ? 'radio' : 'checkbox';
                const newName = answerType === 'single' ? 'correct_answer' : `answers[${index}][is_correct]`;
                const newValue = answerType === 'single' ? index : '1';

                // Tạo input mới để thay thế input cũ
                const newInput = document.createElement('input');
                newInput.type = newType;
                newInput.name = newName;
                newInput.value = newValue;
                newInput.className = `form-${newType} h-5 w-5 text-blue-600 rounded focus:ring-blue-500`;

                // Thay thế input cũ bằng input mới
                input.parentNode.replaceChild(newInput, input);
            });
        });

        // Hàm lấy số thứ tự tiếp theo
        function getNextOrderNumber() {
            const container = document.getElementById('answers_container');
            const orderInputs = container.querySelectorAll('input[type="number"]');
            let maxOrder = 0;

            orderInputs.forEach(input => {
                const value = parseInt(input.value);
                if (value > maxOrder) {
                    maxOrder = value;
                }
            });

            return maxOrder + 1;
        }

        // Hàm cập nhật lại số thứ tự khi có thay đổi
        function updateAnswerNumbers() {
            const container = document.getElementById('answers_container');
            const orderInputs = container.querySelectorAll('input[type="number"]');

            orderInputs.forEach((input, index) => {
                input.addEventListener('change', function() {
                    const newValue = parseInt(this.value);
                    if (newValue < 1) {
                        this.value = 1;
                    }
                });
            });
        }

        // Khởi tạo số thứ tự ban đầu
        updateAnswerNumbers();

        // Khởi tạo giao diện dựa vào role ban đầu
        handleRoleChange(document.getElementById('role').value);
    });

    function handleRoleChange(role) {
        const answerTypeContainer = document.getElementById('answer_type_container');
        const addAnswerButton = document.getElementById('add_answer');
        const answersContainer = document.getElementById('answers_container');

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
                            <input type="hidden" name="answers[0][order_number]" value="1">
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
                                Thứ tự <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="answers[0][order_number]"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                value="1" min="1" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Hình ảnh (Tùy chọn)
                            </label>
                            <div class="preview-container mb-2">
                                <div class="answer-image-preview-container hidden">
                                    <img class="answer-image-preview max-w-xs h-auto rounded-lg shadow-md cursor-pointer"
                                        src="" style="max-height: 100px; object-fit: contain;"
                                        onclick="openMediaModal(this.src)">
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button type="button"
                                    class="choose-answer-image-btn bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                                    Chọn ảnh
                                </button>
                                <button type="button" onclick="clearAnswerImage(this)"
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

    // Mở modal xem media
    function openMediaModal(src) {
        const mediaModal = document.getElementById('mediaModal');
        const mediaContent = document.getElementById('mediaContent');
        const fileType = src.split(';')[0].split(':')[1];

        // Hiển thị nội dung phù hợp
        if (fileType.startsWith('image')) {
            mediaContent.innerHTML = `<img src="${src}" class="w-full h-auto" />`;
        } else if (fileType.startsWith('video')) {
            mediaContent.innerHTML = `<video src="${src}" controls class="w-full h-auto"></video>`;
        } else if (fileType.startsWith('audio')) {
            mediaContent.innerHTML = `<audio src="${src}" controls class="w-full"></audio>`;
        }

        mediaModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    // Đóng modal xem media
    function closeMediaModal() {
        const mediaModal = document.getElementById('mediaModal');
        mediaModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Hàm xóa media
    function clearMedia(type) {
        if (type === 'image' || type === 'all') {
            document.getElementById('image_file').value = '';
            document.getElementById('imagePreviewContainer').classList.add('hidden');
        }

        if (type === 'video' || type === 'all') {
            document.getElementById('video_file').value = '';
            document.getElementById('videoPreviewContainer').classList.add('hidden');
        }

        if (type === 'audio' || type === 'all') {
            document.getElementById('audio_file').value = '';
            document.getElementById('audioPreviewContainer').classList.add('hidden');
        }
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const mediaModal = document.getElementById('mediaModal');
        if (event.target === mediaModal) {
            closeMediaModal();
        }
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeMediaModal();
        }
    });

    // Xử lý sự kiện click cho nút chọn ảnh câu trả lời
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('choose-answer-image-btn')) {
            const answerItem = e.target.closest('.answer-item');
            const fileInput = answerItem.querySelector('.answer-image-input');
            fileInput.click();
        }
    });

    // Xử lý preview ảnh câu trả lời
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

    // Hàm xóa ảnh câu trả lời
    function clearAnswerImage(button) {
        const answerItem = button.closest('.answer-item');
        const fileInput = answerItem.querySelector('.answer-image-input');
        const previewContainer = answerItem.querySelector('.answer-image-preview-container');
        const preview = answerItem.querySelector('.answer-image-preview');

        fileInput.value = '';
        preview.src = '';
        previewContainer.classList.add('hidden');
    }
</script>

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

