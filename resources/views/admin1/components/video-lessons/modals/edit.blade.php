<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="editVideoLessonModal"
    aria-labelledby="editVideoLessonModalLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="editVideoLessonModalLabel">Chỉnh sửa bài giảng
                        video</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500"
                        onclick="closeEditVideoLessonModal()" aria-label="Close">
                        <span class="sr-only">Đóng</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form id="editVideoLessonForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="lesson_id" id="edit_lessonId">
                    <input type="hidden" id="edit_videoId">

                    <div class="mt-4">
                        <!-- Thông tin cơ bản -->
                        <div class="mb-6">
                            <h4 class="font-medium text-gray-900 mb-4">Thông tin cơ bản</h4>

                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-700 text-sm font-bold mb-2"
                                        for="edit_videoLessonName">
                                        Tên video <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_videoLessonName" name="name" required>
                                </div>

                                <div class="flex flex-col justify-center">
                                    <label class="flex items-center mb-2">
                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                            id="edit_is_preview" name="is_preview" value="1">
                                        <span class="ml-2 text-gray-700">Cho phép xem thử</span>
                                    </label>

                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                            id="edit_is_downloadable" name="is_downloadable" value="1">
                                        <span class="ml-2 text-gray-700">Cho phép tải xuống</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin media -->
                        <div class="mt-6">
                            <h4 class="font-medium text-gray-900 mb-4">Nội dung Video</h4>

                            <div class="grid grid-cols-2 gap-6">
                                <!-- Video upload -->
                                <div class="mb-6">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_videoUrlInput">
                                        File Video <span class="text-red-500">*</span>
                                    </label>
                                    <!-- Container hiển thị video -->
                                    <div id="current_video_container" class="preview-container mb-2">
                                        <video id="edit_videoPreview"
                                            class="max-w-full rounded-lg shadow-md cursor-pointer"
                                            style="max-height: 200px; width: 100%;" controls>
                                            <source src="" type="video/mp4">
                                            Trình duyệt của bạn không hỗ trợ thẻ video.
                                        </video>
                                    </div>
                                    <div class="flex space-x-2">
                                        <input type="file" class="hidden" id="edit_videoUrlInput" name="video_url"
                                            accept="video/*,.mp4,.mov,.wmv,.avi,.flv"
                                            onchange="handleEditVideoUpload(this.files[0])">
                                        <label for="edit_videoUrlInput"
                                            class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded cursor-pointer">
                                            Thay đổi video
                                        </label>
                                        <button type="button" onclick="clearEditVideoUpload()"
                                            class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded">
                                            Xóa video
                                        </button>
                                    </div>

                                    <!-- Duration -->
                                    <div class="mt-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_duration">
                                            Thời lượng <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-gray-100"
                                            id="edit_duration" name="duration" placeholder="Thời lượng video (giây)"
                                            min="1" required readonly>
                                        <p class="mt-1 text-sm text-gray-500 edit-duration-display"></p>
                                    </div>
                                </div>

                                <!-- Thumbnail upload -->
                                <div class="mb-6">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_thumbnailInput">
                                        Ảnh thumbnail <span class="text-red-500">*</span>
                                    </label>
                                    <!-- Container hiển thị thumbnail -->
                                    <div id="current_thumbnail_container" class="preview-container mb-2">
                                        <img id="edit_thumbnailPreview" src=""
                                            class="max-w-full h-auto rounded-lg shadow-md cursor-pointer"
                                            style="max-height: 150px; object-fit: contain;"
                                            onclick="openImageModal(this.src)">
                                    </div>
                                    <div class="flex space-x-2">
                                        <input type="file" class="hidden" id="edit_thumbnailInput"
                                            name="thumbnail_url" accept="image/*"
                                            onchange="handleEditThumbnailUpload(this)">
                                        <label for="edit_thumbnailInput"
                                            class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded cursor-pointer">
                                            Thay đổi ảnh
                                        </label>
                                        <button type="button" onclick="clearEditThumbnailUpload()"
                                            class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded">
                                            Xóa ảnh
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" id="edit_video_type" name="video_type">
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t mt-6">
                        <button type="button"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            onclick="closeEditVideoLessonModal()">
                            Hủy
                        </button>
                        <button type="submit" id="editSubmitBtn"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Cập nhật
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
        const videoTypeInput = document.getElementById('edit_video_type');

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

    // Thêm hàm editVideoLesson để xử lý khi nút edit được nhấn
    function editVideoLesson(id) {
        console.log('Editing video lesson:', id); // Debug log

        // Fetch dữ liệu video lesson và mở modal
        fetch(`/admin/video-lessons/${id}/edit`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(response => {
                console.log('API Response:', response); // Debug log chi tiết
                if (response.status) {
                    // Kiểm tra dữ liệu trả về từ API
                    const videoData = response.data;
                    console.log('Video URL:', videoData.video_url);
                    console.log('Thumbnail URL:', videoData.thumbnail_url);

                    // Kiểm tra và chuẩn hóa URL nếu cần
                    if (videoData.video_url && !videoData.video_url.startsWith('http')) {
                        // Nếu URL không bắt đầu bằng http, thêm domain
                        if (videoData.video_url.startsWith('/')) {
                            videoData.video_url = window.location.origin + videoData.video_url;
                        } else {
                            videoData.video_url = window.location.origin + '/' + videoData.video_url;
                        }
                        console.log('Fixed video URL:', videoData.video_url);
                    }

                    if (videoData.thumbnail_url && !videoData.thumbnail_url.startsWith('http')) {
                        // Nếu URL không bắt đầu bằng http, thêm domain
                        if (videoData.thumbnail_url.startsWith('/')) {
                            videoData.thumbnail_url = window.location.origin + videoData.thumbnail_url;
                        } else {
                            videoData.thumbnail_url = window.location.origin + '/' + videoData.thumbnail_url;
                        }
                        console.log('Fixed thumbnail URL:', videoData.thumbnail_url);
                    }

                    populateVideoLessonEditModal(videoData);
                } else {
                    throw new Error(response.message || 'Không thể tải thông tin video');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Đã xảy ra lỗi khi tải dữ liệu: ' + error.message);
            });
    }

    // Hàm để mở modal và điền dữ liệu
    function populateVideoLessonEditModal(videoLesson) {
        console.log('Populating modal with:', videoLesson); // Debug log
        modalHandler.open('editVideoLessonModal');

        const form = document.getElementById('editVideoLessonForm');

        // Cập nhật action của form
        form.action = `/admin/video-lessons/${videoLesson.id}`;

        // Điền dữ liệu vào form
        document.getElementById('edit_videoId').value = videoLesson.id;
        document.getElementById('edit_lessonId').value = videoLesson.lesson_id;
        document.getElementById('edit_videoLessonName').value = videoLesson.name;
        document.getElementById('edit_is_preview').checked = Boolean(videoLesson.is_preview);
        document.getElementById('edit_is_downloadable').checked = Boolean(videoLesson.is_downloadable);
        document.getElementById('edit_duration').value = videoLesson.duration;

        // Hiển thị thời lượng
        updateEditDurationDisplay(videoLesson.duration);

        // Hiển thị video preview nếu có
        const videoPreview = document.getElementById('edit_videoPreview');
        const videoSource = videoPreview.querySelector('source');
        const videoContainer = document.getElementById('current_video_container');

        if (videoLesson.video_url) {
            console.log('Setting video URL:', videoLesson.video_url); // Debug log

            // Reset container
            videoContainer.innerHTML = '';
            videoContainer.appendChild(videoPreview);

            try {
                // Set video source và hiển thị
                videoSource.src = videoLesson.video_url;
                videoPreview.load();

                // Hiển thị container
                videoContainer.style.display = 'flex';
                videoContainer.style.justifyContent = 'center';
                videoContainer.style.alignItems = 'center';

                // Hiển thị video
                videoPreview.style.display = 'block';

                // Log thành công
                console.log('Video element set up completed, waiting for load event');

                // Đăng ký sự kiện load
                videoPreview.onloadeddata = function() {
                    console.log('Video loaded successfully');
                };

                // Đăng ký sự kiện lỗi
                videoPreview.onerror = function(e) {
                    console.error('Error loading video:', e);
                    // Hiển thị thông báo lỗi
                    videoContainer.innerHTML = `
                        <div class="text-center py-4">
                            <p class="text-red-500">Không thể tải video. Lỗi: ${e.target.error ? e.target.error.message : 'Unknown error'}</p>
                            <p class="text-gray-700 mt-2">URL: ${videoLesson.video_url}</p>
                            <a href="${videoLesson.video_url}" target="_blank" class="text-blue-500 underline mt-1 inline-block">Mở video trong tab mới</a>
                        </div>
                    `;
                };
            } catch (error) {
                console.error('Error setting up video:', error);
                // Hiển thị thông báo lỗi
                videoContainer.innerHTML = `
                    <div class="text-center py-4">
                        <p class="text-red-500">Lỗi khi cài đặt video: ${error.message}</p>
                        <p class="text-gray-700 mt-2">URL: ${videoLesson.video_url}</p>
                        <a href="${videoLesson.video_url}" target="_blank" class="text-blue-500 underline mt-1 inline-block">Mở video trong tab mới</a>
                    </div>
                `;
            }
        } else {
            // Hiển thị container rỗng với thông báo chưa có video
            videoContainer.innerHTML = `
                <div class="text-center py-4">
                    <p class="text-gray-500">Chưa có video</p>
                </div>
            `;
        }

        // Hiển thị thumbnail nếu có
        const thumbnailPreview = document.getElementById('edit_thumbnailPreview');
        const thumbnailContainer = document.getElementById('current_thumbnail_container');

        if (videoLesson.thumbnail_url) {
            console.log('Setting thumbnail URL:', videoLesson.thumbnail_url); // Debug log

            // Reset container
            thumbnailContainer.innerHTML = '';
            thumbnailContainer.appendChild(thumbnailPreview);

            try {
                // Set image source và hiển thị
                thumbnailPreview.src = videoLesson.thumbnail_url;

                // Hiển thị container
                thumbnailContainer.style.display = 'flex';
                thumbnailContainer.style.justifyContent = 'center';
                thumbnailContainer.style.alignItems = 'center';

                // Hiển thị thumbnail
                thumbnailPreview.style.display = 'block';

                // Log thành công
                console.log('Thumbnail element set up completed, waiting for load event');

                // Đăng ký sự kiện load
                thumbnailPreview.onload = function() {
                    console.log('Thumbnail loaded successfully');
                };

                // Đăng ký sự kiện lỗi
                thumbnailPreview.onerror = function(e) {
                    console.error('Error loading thumbnail:', e);
                    // Hiển thị thông báo lỗi
                    thumbnailContainer.innerHTML = `
                        <div class="text-center py-4">
                            <p class="text-red-500">Không thể tải ảnh</p>
                            <p class="text-gray-700 mt-2">URL: ${videoLesson.thumbnail_url}</p>
                            <a href="${videoLesson.thumbnail_url}" target="_blank" class="text-blue-500 underline mt-1 inline-block">Mở ảnh trong tab mới</a>
                        </div>
                    `;
                };
            } catch (error) {
                console.error('Error setting up thumbnail:', error);
                thumbnailContainer.innerHTML = `
                    <div class="text-center py-4">
                        <p class="text-red-500">Lỗi khi cài đặt ảnh: ${error.message}</p>
                        <p class="text-gray-700 mt-2">URL: ${videoLesson.thumbnail_url}</p>
                        <a href="${videoLesson.thumbnail_url}" target="_blank" class="text-blue-500 underline mt-1 inline-block">Mở ảnh trong tab mới</a>
                    </div>
                `;
            }
        } else {
            // Hiển thị container rỗng với thông báo chưa có ảnh
            thumbnailContainer.innerHTML = `
                <div class="text-center py-4">
                    <p class="text-gray-500">Chưa có ảnh thumbnail</p>
                </div>
            `;
        }

        // Xóa các input hidden remove_thumbnail và remove_video_url nếu có
        const removeThumbInput = form.querySelector('input[name="remove_thumbnail_url"]');
        if (removeThumbInput) removeThumbInput.remove();

        const removeVideoInput = form.querySelector('input[name="remove_video_url"]');
        if (removeVideoInput) removeVideoInput.remove();
    }

    function handleEditVideoUpload(file) {
        if (!file) {
            return;
        }

        // Nhận diện loại video
        detectVideoType(file);

        // Tạo URL cho file và hiển thị video
        const fileURL = URL.createObjectURL(file);
        const preview = document.getElementById('edit_videoPreview');
        const videoSource = preview.querySelector('source');
        const videoContainer = document.getElementById('current_video_container');

        // Reset container nếu có lỗi trước đó
        videoContainer.innerHTML = '';
        videoContainer.appendChild(preview);

        // Hiển thị video preview
        videoSource.src = fileURL;
        preview.load();
        preview.style.display = 'block';
        videoContainer.style.display = 'flex';
        videoContainer.style.justifyContent = 'center';
        videoContainer.style.alignItems = 'center';

        // Tạo một phần tử video mới để lấy thời lượng
        const tempVideo = document.createElement('video');
        tempVideo.src = fileURL;

        tempVideo.onloadedmetadata = function() {
            // Làm tròn thời lượng thành số nguyên giây
            const durationInSeconds = Math.max(1, Math.round(tempVideo.duration));
            document.getElementById('edit_duration').value = durationInSeconds;

            // Hiển thị thời lượng dạng phút:giây
            updateEditDurationDisplay(durationInSeconds);

            // Giải phóng URL object khi không cần thiết nữa
            URL.revokeObjectURL(fileURL);
        };

        tempVideo.onerror = function() {
            console.error('Error loading video file');
            URL.revokeObjectURL(fileURL);

            // Hiển thị thông báo lỗi
            videoContainer.innerHTML = `
                <div class="text-center py-4">
                    <p class="text-red-500">Không thể tải video</p>
                </div>
            `;
        };
    }

    function handleEditThumbnailUpload(input) {
        const preview = document.getElementById('edit_thumbnailPreview');
        const thumbnailContainer = document.getElementById('current_thumbnail_container');

        if (input.files && input.files[0]) {
            // Reset container nếu có lỗi trước đó
            thumbnailContainer.innerHTML = '';
            thumbnailContainer.appendChild(preview);

            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                thumbnailContainer.style.display = 'flex';
                thumbnailContainer.style.justifyContent = 'center';
                thumbnailContainer.style.alignItems = 'center';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function updateEditDurationDisplay(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = seconds % 60;
        const display = `${minutes} phút ${remainingSeconds} giây`;
        document.querySelector('.edit-duration-display').textContent = display;
    }

    function closeEditVideoLessonModal() {
        modalHandler.close('editVideoLessonModal');
        document.getElementById('editVideoLessonForm').reset();

        // Xóa các input hidden nếu có
        const form = document.getElementById('editVideoLessonForm');
        const removeThumbnailInput = form.querySelector('input[name="remove_thumbnail_url"]');
        if (removeThumbnailInput) removeThumbnailInput.remove();

        const removeVideoInput = form.querySelector('input[name="remove_video_url"]');
        if (removeVideoInput) removeVideoInput.remove();
    }

    // Xử lý thumbnail
    function clearEditThumbnailUpload() {
        const preview = document.getElementById('edit_thumbnailPreview');
        const input = document.getElementById('edit_thumbnailInput');
        const thumbnailContainer = document.getElementById('current_thumbnail_container');

        // Hiển thị container rỗng với thông báo đã xóa ảnh
        thumbnailContainer.innerHTML = `
            <div class="text-center py-4">
                <p class="text-gray-500">Đã xóa ảnh thumbnail</p>
            </div>
        `;

        input.value = '';

        // Thêm input hidden để đánh dấu xóa thumbnail
        let removeInput = document.querySelector('input[name="remove_thumbnail_url"]');
        if (!removeInput) {
            removeInput = document.createElement('input');
            removeInput.type = 'hidden';
            removeInput.name = 'remove_thumbnail_url';
            removeInput.value = '1';
            input.parentNode.appendChild(removeInput);
        }
        removeInput.value = '1';
    }

    // Xử lý video
    function clearEditVideoUpload() {
        const input = document.getElementById('edit_videoUrlInput');
        const videoContainer = document.getElementById('current_video_container');

        // Hiển thị container rỗng với thông báo đã xóa video
        videoContainer.innerHTML = `
            <div class="text-center py-4">
                <p class="text-gray-500">Đã xóa video</p>
            </div>
        `;

        input.value = '';

        document.getElementById('edit_duration').value = '';
        document.querySelector('.edit-duration-display').textContent = '';

        // Thêm input hidden để đánh dấu xóa video
        let removeInput = document.querySelector('input[name="remove_video_url"]');
        if (!removeInput) {
            removeInput = document.createElement('input');
            removeInput.type = 'hidden';
            removeInput.name = 'remove_video_url';
            removeInput.value = '1';
            input.parentNode.appendChild(removeInput);
        }
        removeInput.value = '1';
    }

    // Thêm event listeners khi tài liệu đã sẵn sàng
    document.addEventListener('DOMContentLoaded', function() {
        // Đăng ký sự kiện cho form edit
        const editForm = document.getElementById('editVideoLessonForm');
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const videoId = document.getElementById('edit_videoId').value;
                const formData = new FormData(this);

                // Gửi form bằng AJAX
                fetch(`/admin/video-lessons/${videoId}`, {
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
                            closeEditVideoLessonModal();
                            // Reload trang để cập nhật dữ liệu
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
        }

        // Đóng modal khi nhấn ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeEditVideoLessonModal();
                closeImageModal();
            }
        });

        // Đóng modal khi click bên ngoài
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('editVideoLessonModal');
            if (event.target === modal) {
                closeEditVideoLessonModal();
            }
        });
    });

    function openImageModal(src) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = src;
        modalHandler.open('imageVideoModal');
    }

    function closeImageModal() {
        modalHandler.close('imageVideoModal');
    }
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
