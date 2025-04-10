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
                    <input type="hidden" id="questionTestId" name="test_id" value="">
                    <div class="grid grid-cols-2 gap-6 mt-4">
                        <!-- Thông tin cơ bản -->
                        <div>
                            <h4 class="font-medium text-gray-900 mb-4">Thông tin cơ bản</h4>

                            <!-- Bài kiểm tra -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Bài kiểm tra:
                                </label>
                                <div class="py-2 px-3 bg-gray-100 rounded font-medium" id="testNameDisplay">Chọn bài kiểm tra</div>
                            </div>

                            <!-- Nội dung câu hỏi -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="question">
                                    Nội dung câu hỏi <span class="text-red-500">*</span>
                                </label>
                                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="question" name="question" rows="3" required>{{ old('question') }}</textarea>
                            </div>

                            <!-- Thứ tự -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="question_order_number">
                                    Thứ tự <span class="text-red-500">*</span>
                                </label>
                                <input type="number"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="question_order_number" name="order_number" value="{{ old('order_number', 1) }}" min="0" required>
                            </div>

                            <!-- Loại câu hỏi -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                                    Loại câu hỏi <span class="text-red-500">*</span>
                                </label>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="type" name="type" required onchange="showUploadContainer(this.value)">
                                    <option value="text" {{ old('type', 'text') == 'text' ? 'selected' : '' }}>Văn bản</option>
                                    <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>Hình ảnh</option>
                                    <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>Video</option>
                                    <option value="audio" {{ old('type') == 'audio' ? 'selected' : '' }}>Âm thanh</option>
                                </select>
                            </div>
                        </div>

                        <!-- Media và thông tin bổ sung -->
                        <div>
                            <h4 class="font-medium text-gray-900 mb-4">Media</h4>

                            <!-- Media upload cho Image -->
                            <div class="mb-6 media-upload-container" id="imageUploadContainer">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="image_file">
                                    Tệp Hình ảnh
                                </label>
                                <div class="preview-container mb-2">
                                    <div id="imagePreviewContainer" class="hidden">
                                        <img id="imagePreview" src="" class="max-w-xs h-auto rounded-lg shadow-md cursor-pointer"
                                            style="max-height: 200px; object-fit: contain;" onclick="openMediaModal(this.src)">
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
                                <input type="file" class="hidden" id="image_file" name="media_file" accept="image/*">
                                <div class="mt-2 text-sm text-gray-500">
                                    <p>Hỗ trợ các định dạng sau: JPG, PNG, GIF (tối đa 5MB)</p>
                                </div>
                            </div>

                            <!-- Media upload cho Video -->
                            <div class="mb-6 media-upload-container" id="videoUploadContainer">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="video_file">
                                    Tệp Video
                                </label>
                                <div class="preview-container mb-2">
                                    <div id="videoPreviewContainer" class="hidden">
                                        <video id="videoPreview" class="max-w-xs rounded-lg shadow-md cursor-pointer"
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
                                <input type="file" class="hidden" id="video_file" name="media_file" accept="video/*">
                                <div class="mt-2 text-sm text-gray-500">
                                    <p>Hỗ trợ các định dạng sau: MP4, WebM (tối đa 50MB)</p>
                                </div>
                            </div>

                            <!-- Media upload cho Audio -->
                            <div class="mb-6 media-upload-container" id="audioUploadContainer">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="audio_file">
                                    Tệp Âm thanh
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
                                <input type="file" class="hidden" id="audio_file" name="media_file" accept="audio/*">
                                <div class="mt-2 text-sm text-gray-500">
                                    <p>Hỗ trợ các định dạng sau: MP3, WAV (tối đa 10MB)</p>
                                </div>
                            </div>

                            <h4 class="font-medium text-gray-900 mb-4 mt-6">Hướng dẫn</h4>
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                <h5 class="text-blue-800 font-medium mb-2">Lưu ý khi tạo câu hỏi:</h5>
                                <ul class="list-disc pl-5 text-blue-700 text-sm">
                                    <li>Nội dung câu hỏi nên rõ ràng, dễ hiểu</li>
                                    <li>Chọn loại câu hỏi phù hợp với nội dung</li>
                                    <li>Đối với câu hỏi có media, hãy đảm bảo chất lượng media tốt</li>
                                    <li>Thứ tự câu hỏi nên sắp xếp theo độ khó tăng dần</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t mt-6">
                        <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            onclick="modalHandler.close('createQuestionModal')">
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

        handleFileInput(imageFileInput, imagePreview, imagePreviewContainer, 'image');
        handleFileInput(videoFileInput, videoPreview, videoPreviewContainer, 'video');
        handleFileInput(audioFileInput, audioPreview, audioPreviewContainer, 'audio');

        // Xử lý form submit để chỉ gửi file từ input file tương ứng
        createQuestionForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Lấy loại câu hỏi hiện tại
            const questionType = typeSelect.value;

            // Tạo FormData mới
            const formData = new FormData(this);

            // Xóa tất cả các file media khỏi FormData
            formData.delete('media_file');

            // Thêm file đúng loại theo loại câu hỏi
            if (questionType === 'image' && imageFileInput.files.length > 0) {
                formData.append('media_file', imageFileInput.files[0]);
            } else if (questionType === 'video' && videoFileInput.files.length > 0) {
                formData.append('media_file', videoFileInput.files[0]);
            } else if (questionType === 'audio' && audioFileInput.files.length > 0) {
                formData.append('media_file', audioFileInput.files[0]);
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
    });

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

    function showUploadContainer(type, prefix = '') {
        // Prefix là để sử dụng cho cả create và edit modal
        prefix = prefix || '';

        // Ẩn tất cả các container trước
        document.querySelectorAll('.media-upload-container').forEach(el => {
            el.classList.add('hidden');
        });

        // Hiển thị container tương ứng
        switch (type) {
            case 'image':
                document.getElementById(prefix + 'imageUploadContainer').classList.remove('hidden');
                break;
            case 'video':
                document.getElementById(prefix + 'videoUploadContainer').classList.remove('hidden');
                break;
            case 'audio':
                document.getElementById(prefix + 'audioUploadContainer').classList.remove('hidden');
                break;
            default:
                // Không hiển thị container nào cho loại text
                break;
        }
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
