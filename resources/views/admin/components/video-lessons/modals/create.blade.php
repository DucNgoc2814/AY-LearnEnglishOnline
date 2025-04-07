<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="createVideoLessonModal"
    aria-labelledby="createVideoLessonModalLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="createVideoLessonModalLabel">Thêm bài giảng video
                        mới</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeVideoLessonModal()"
                        aria-label="Close">
                        <span class="sr-only">Đóng</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('admin.video-lessons.store') }}" method="POST" enctype="multipart/form-data"
                    id="createVideoLessonForm">
                    @csrf
                    <input type="hidden" name="lesson_id" id="lessonId">

                    <div class="mt-4">
                        <!-- Thông tin cơ bản -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-900 mb-4">Thông tin cơ bản</h4>

                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="videoLessonName">
                                        Tên video <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="videoLessonName" name="name" required>
                                </div>

                                <div class="flex flex-col justify-center">
                                    <label class="flex items-center mb-2">
                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                            id="is_preview" name="is_preview" value="1">
                                        <span class="ml-2 text-gray-700">Cho phép xem thử</span>
                                    </label>

                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                            id="is_downloadable" name="is_downloadable" value="1">
                                        <span class="ml-2 text-gray-700">Cho phép tải xuống</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin media -->
                        <div>
                            <h4 class="font-medium text-gray-900 mb-4">Nội dung Video</h4>

                            <div class="grid grid-cols-2 gap-6">
                                <!-- Video upload -->
                                <div class="mb-6">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="videoUrlInput">
                                        File Video <span class="text-red-500">*</span>
                                    </label>
                                    <div class="preview-container mb-2">
                                        <video id="videoPreview"
                                            class="hidden max-w-xs rounded-lg shadow-md cursor-pointer"
                                            style="max-height: 200px; width: 100%;" controls>
                                            <source src="" type="video/mp4">
                                        </video>
                                    </div>
                                    <div class="flex space-x-2">
                                        <input type="file" class="hidden" id="videoUrlInput" name="video_url"
                                            accept="video/*,.mp4,.mov,.wmv,.avi,.flv"
                                            onchange="handleVideoUpload(this.files[0])">
                                        <label for="videoUrlInput"
                                            class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded cursor-pointer">
                                            Chọn video
                                        </label>
                                        <button type="button" onclick="clearVideoUpload()"
                                            class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded">
                                            Xóa video
                                        </button>
                                    </div>

                                    <!-- Duration -->
                                    <div class="mt-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="duration">
                                            Thời lượng <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100"
                                            id="duration" name="duration" placeholder="Thời lượng video (giây)"
                                            min="1" required readonly>
                                        <p class="mt-1 text-sm text-gray-500 duration-display"></p>
                                    </div>
                                </div>

                                <!-- Thumbnail upload -->
                                <div class="mb-6">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnailInput">
                                        Ảnh thumbnail <span class="text-red-500">*</span>
                                    </label>
                                    <div class="preview-container mb-2">
                                        <img id="thumbnailPreview" src=""
                                            class="hidden max-w-xs h-auto rounded-lg shadow-md cursor-pointer"
                                            style="max-height: 150px; object-fit: contain;"
                                            onclick="openImageModal(this.src)">
                                    </div>
                                    <div class="flex space-x-2">
                                        <input type="file" class="hidden" id="thumbnailInput"
                                            name="thumbnail_url" accept="image/*"
                                            onchange="handleThumbnailUpload(this)">
                                        <label for="thumbnailInput"
                                            class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded cursor-pointer">
                                            Chọn ảnh
                                        </label>
                                        <button type="button" onclick="clearThumbnailUpload()"
                                            class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded">
                                            Xóa ảnh
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" id="video_type" name="video_type">
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t mt-6">
                        <button type="button"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            onclick="closeVideoLessonModal()">
                            Hủy
                        </button>
                        <button type="submit" id="submitBtn"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Thêm mới
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Thêm modal xem ảnh -->
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

<script>
    function detectVideoType(file) {
        const videoTypeInput = document.getElementById('video_type');

        if (!file) {
            videoTypeInput.value = '';
            return;
        }

        const extension = file.name.split('.').pop().toLowerCase();
        if (['mp4', 'mov', 'wmv', 'avi', 'flv'].includes(extension)) {
            videoTypeInput.value = extension;
        } else {
            videoTypeInput.value = ''; // Không xác định được loại video
        }
    }

    // Thêm hàm để set lessonId khi mở modal
    function setLessonIdForVideo(lessonId) {
        document.getElementById('lessonId').value = lessonId;
        // Hiển thị modal
        modalHandler.open('createVideoLessonModal');
    }

    function handleVideoUpload(file) {
        if (!file) {
            document.getElementById('duration').value = '';
            document.querySelector('.duration-display').textContent = '';
            return;
        }

        // Nhận diện loại video
        detectVideoType(file);

        // Tạo URL cho file và hiển thị video
        const fileURL = URL.createObjectURL(file);
        const preview = document.getElementById('videoPreview');
        const videoSource = preview.querySelector('source');

        // Hiển thị video preview
        videoSource.src = fileURL;
        preview.load();
        preview.classList.remove('hidden');

        // Tạo một phần tử video mới để lấy thời lượng
        const tempVideo = document.createElement('video');
        tempVideo.src = fileURL;

        tempVideo.onloadedmetadata = function() {
            // Làm tròn thời lượng thành số nguyên giây
            const durationInSeconds = Math.max(1, Math.round(tempVideo.duration));
            document.getElementById('duration').value = durationInSeconds;

            // Hiển thị thời lượng dạng phút:giây
            updateDurationDisplay(durationInSeconds);

            // Giải phóng URL object khi không cần thiết nữa
            URL.revokeObjectURL(fileURL);
        };

        tempVideo.onerror = function() {
            console.error('Error loading video file');
            document.getElementById('duration').value = '';
            document.querySelector('.duration-display').textContent = '';
            URL.revokeObjectURL(fileURL);

            // Ẩn video preview nếu có lỗi
            preview.classList.add('hidden');
            videoSource.src = '';
            preview.load();
        };
    }

    function handleThumbnailUpload(input) {
        const preview = document.getElementById('thumbnailPreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            // Nếu không có file được chọn, ẩn preview
            preview.src = '';
            preview.classList.add('hidden');
        }
    }

    function updateDurationDisplay(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = seconds % 60;
        const display = `${minutes} phút ${remainingSeconds} giây`;
        document.querySelector('.duration-display').textContent = display;
    }

    function closeVideoLessonModal() {
        modalHandler.close('createVideoLessonModal');
        document.getElementById('createVideoLessonForm').reset();

        // Reset previews
        const videoPreview = document.getElementById('videoPreview');
        const thumbnailPreview = document.getElementById('thumbnailPreview');

        videoPreview.classList.add('hidden');
        videoPreview.querySelector('source').src = '';
        videoPreview.load();

        thumbnailPreview.classList.add('hidden');
        thumbnailPreview.src = '';

        document.querySelector('.duration-display').textContent = '';
    }

    function openImageModal(src) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = src;
        modalHandler.open('imageVideoModal');
    }

    function closeImageModal() {
        modalHandler.close('imageVideoModal');
    }

    // Xử lý thumbnail
    function clearThumbnailUpload() {
        const preview = document.getElementById('thumbnailPreview');
        const input = document.getElementById('thumbnailInput');
        preview.src = '';
        preview.classList.add('hidden');
        input.value = '';
    }

    // Xử lý video
    function clearVideoUpload() {
        const preview = document.getElementById('videoPreview');
        const videoSource = preview.querySelector('source');
        const input = document.getElementById('videoUrlInput');

        videoSource.src = '';
        preview.load();
        preview.classList.add('hidden');
        input.value = '';

        document.getElementById('duration').value = '';
        document.querySelector('.duration-display').textContent = '';
    }

    // Thêm event listeners khi tài liệu đã sẵn sàng
    document.addEventListener('DOMContentLoaded', function() {
        // Đảm bảo các sự kiện được đăng ký cho các input file
        const thumbnailInput = document.getElementById('thumbnailInput');
        if (thumbnailInput) {
            thumbnailInput.addEventListener('change', function() {
                handleThumbnailUpload(this);
            });
        }

        const videoInput = document.getElementById('videoUrlInput');
        if (videoInput) {
            videoInput.addEventListener('change', function() {
                handleVideoUpload(this.files[0]);
            });
        }

        // Submit form xử lý
        const form = document.getElementById('createVideoLessonForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                const thumbnailFile = document.getElementById('thumbnailInput').files[0];
                const videoFile = document.getElementById('videoUrlInput').files[0];

                if (!thumbnailFile) {
                    e.preventDefault();
                    alert('Vui lòng chọn ảnh thumbnail');
                    return false;
                }

                if (!videoFile) {
                    e.preventDefault();
                    alert('Vui lòng chọn file video');
                    return false;
                }

                // Kiểm tra các trường khác nếu cần

                return true;
            });
        }

        // Đóng modal khi nhấn ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeVideoLessonModal();
                closeImageModal();
            }
        });

        // Đóng modal khi click bên ngoài
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('createVideoLessonModal');
            const imageModal = document.getElementById('imageVideoModal');

            if (event.target === modal) {
                closeVideoLessonModal();
            }
            if (event.target === imageModal) {
                closeImageModal();
            }
        });
    });
</script>

<!-- Thêm styles -->
<style>
    .preview-container {
        min-height: 50px;
        border: 2px dashed #e2e8f0;
        border-radius: 0.5rem;
        padding: 0.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f8fafc;
    }

    .preview-container img,
    .preview-container video {
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
