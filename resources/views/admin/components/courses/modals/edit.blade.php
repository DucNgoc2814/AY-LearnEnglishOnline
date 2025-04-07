<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="editCourseModal" aria-labelledby="editCourseModalLabel"
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
                    <h3 class="text-lg font-medium text-gray-900" id="editCourseModalLabel">Chỉnh sửa khóa học</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500"
                        onclick="modalHandler.close('editCourseModal')" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editCourseForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Hidden input để lưu course id -->
                    <input type="hidden" name="course_id" id="course_id">

                    <div class="grid grid-cols-2 gap-6 mt-4">
                        <!-- Thông tin cơ bản -->
                        <div>
                            <h4 class="font-medium text-gray-900 mb-4">Thông tin cơ bản</h4>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                    Tên khóa học <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="title" name="title" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="short_description">
                                    Mô tả ngắn
                                </label>
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="short_description" name="short_description" rows="2"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="editDescription">
                                    Mô tả chi tiết
                                </label>
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="editDescription" name="description" rows="4"></textarea>
                            </div>

                            <!-- Phân loại -->
                            <h4 class="font-medium text-gray-900 mb-4 mt-6">Phân loại</h4>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">
                                    Danh mục <span class="text-red-500">*</span>
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="category_id" name="category_id" required>
                                    <option value="">Chọn danh mục</option>
                                    @foreach (\App\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="course_type">
                                        Loại khóa học <span class="text-red-500">*</span>
                                    </label>
                                    <select
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="course_type" name="course_type" required>
                                        <option value="self_paced">Tự học</option>
                                        <option value="instructor_led">Có giảng viên</option>
                                        <option value="hybrid">Kết hợp</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="course_format">
                                        Hình thức học <span class="text-red-500">*</span>
                                    </label>
                                    <select
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="course_format" name="course_format" required>
                                        <option value="online">Trực tuyến</option>
                                        <option value="offline">Trực tiếp</option>
                                        <option value="hybrid">Kết hợp</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Thông tin bổ sung -->
                        <div>
                            <h4 class="font-medium text-gray-900 mb-4">Media</h4>

                            <!-- Thumbnail upload -->
                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnail">
                                    Ảnh đại diện <span class="text-red-500">*</span>
                                </label>
                                <div class="preview-container mb-2">
                                    <img id="editThumbnailPreview" src="" class="hidden max-w-xs h-auto rounded-lg shadow-md cursor-pointer"
                                        style="max-height: 200px; object-fit: contain;" onclick="openImageModal(this.src)">
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button type="button" id="chooseThumbnailBtn"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Chọn ảnh
                                    </button>
                                    <button type="button" onclick="clearThumbnail()"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Xóa ảnh
                                    </button>
                                </div>
                                <input type="file" class="hidden" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewImage(this);">
                            </div>

                            <!-- Video upload -->
                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="preview_video">
                                    Video giới thiệu
                                </label>
                                <div class="preview-container mb-2">
                                    <video id="editVideoPreview" class="hidden max-w-xs rounded-lg shadow-md cursor-pointer"
                                        style="max-height: 300px; width: 100%;" onclick="openVideoModal(this.querySelector('source').src)" controls>
                                        <source src="" type="video/mp4">
                                    </video>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button type="button" id="chooseVideoBtn"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Chọn video
                                    </button>
                                    <button type="button" onclick="clearVideo()"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Xóa video
                                    </button>
                                </div>
                                <input type="file" class="hidden" id="preview_video" name="preview_video" accept="video/*" onchange="previewVideo(this);">
                            </div>

                            <h4 class="font-medium text-gray-900 mb-4 mt-6">Thông tin khác</h4>

                            <!-- Giá và thời gian -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                                        Giá <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="price" name="price" min="0" required>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="sale_price">
                                        Giá khuyến mãi
                                    </label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="sale_price" name="sale_price" min="0">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="estimated_hours">
                                        Số giờ học dự kiến
                                    </label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="estimated_hours" name="estimated_hours" min="0">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="release_date">
                                        Ngày phát hành
                                    </label>
                                    <input type="datetime-local"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="release_date" name="release_date">
                                </div>
                            </div>

                            <!-- Checkboxes -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                            id="has_certificate" name="has_certificate" value="1">
                                        <span class="ml-2 text-gray-700">Có chứng chỉ</span>
                                    </label>
                                </div>

                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                            id="requires_enrollment" name="requires_enrollment" value="1">
                                        <span class="ml-2 text-gray-700">Yêu cầu đăng ký</span>
                                    </label>
                                </div>

                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                            id="is_featured" name="is_featured" value="1">
                                        <span class="ml-2 text-gray-700">Nổi bật</span>
                                    </label>
                                </div>

                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                            id="is_active" name="is_active" value="1">
                                        <span class="ml-2 text-gray-700">Kích hoạt</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t mt-6">
                        <button type="button"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            onclick="modalHandler.close('editCourseModal')">
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

<!-- Thêm modal xem ảnh -->
<div id="imageModal" class="fixed inset-0 z-[60] hidden overflow-y-auto" aria-labelledby="imageModalLabel"
    aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="relative bg-white rounded-lg max-w-3xl w-full mx-auto">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-xl font-semibold text-gray-900" id="imageModalLabel">Xem ảnh</h3>
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

<!-- Thêm modal xem video -->
<div id="videoModal" class="fixed inset-0 z-[60] hidden overflow-y-auto" aria-labelledby="videoModalLabel"
    aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="relative bg-white rounded-lg max-w-4xl w-full mx-auto">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-xl font-semibold text-gray-900" id="videoModalLabel">Xem video</h3>
                <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeVideoModal()">
                    <span class="sr-only">Đóng</span>
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Body -->
            <div class="p-4">
                <video id="modalVideo" class="w-full h-auto" controls>
                    <source src="" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
</div>

<script>
    // Thêm function mới để gọi API
    function editCourse(id) {
        console.log('Editing course:', id); // Debug log

        fetch(`/admin/courses/${id}/edit`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(response => {
                console.log('Response:', response); // Debug log
                if (response.status) {
                    populateCourseEditModal(response.data);
                } else {
                    throw new Error(response.message || 'Có lỗi xảy ra khi lấy thông tin khóa học');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra: ' + error.message);
            });
    }

    function populateCourseEditModal(item) {
        console.log('Populating modal with:', item); // Để debug
        modalHandler.open('editCourseModal');
        const form = document.getElementById('editCourseForm');

        // Cập nhật action URL của form
        form.action = `/admin/courses/${item.id}`;

        // Điền các giá trị vào form
        form.querySelector('#title').value = item.title || '';
        form.querySelector('#category_id').value = item.category_id || '';
        form.querySelector('#short_description').value = item.short_description || '';

        // Cập nhật nội dung cho TinyMCE với id mới
        if (tinymce.get('editDescription')) {
            tinymce.get('editDescription').setContent(item.description || '');
        } else {
            setTimeout(() => {
                if (tinymce.get('editDescription')) {
                    tinymce.get('editDescription').setContent(item.description || '');
                }
            }, 500);
        }

        form.querySelector('#course_type').value = item.course_type || '';
        form.querySelector('#course_format').value = item.course_format || '';
        form.querySelector('#price').value = item.price || '';
        form.querySelector('#sale_price').value = item.sale_price || '';
        form.querySelector('#estimated_hours').value = item.estimated_hours || '';
        form.querySelector('#has_certificate').checked = Boolean(item.has_certificate);
        form.querySelector('#requires_enrollment').checked = Boolean(item.requires_enrollment);
        form.querySelector('#is_featured').checked = Boolean(item.is_featured);
        form.querySelector('#is_active').checked = Boolean(item.is_active);

        // Xử lý ngày phát hành
        if (item.release_date) {
            const releaseDate = new Date(item.release_date);
            const formattedDate = releaseDate.toISOString().slice(0, 16);
            form.querySelector('#release_date').value = formattedDate;
        } else {
            form.querySelector('#release_date').value = '';
        }

        // Hiển thị ảnh hiện tại
        const thumbnailPreview = document.getElementById('editThumbnailPreview');
        if (item.full_thumbnail) {
            console.log('Setting thumbnail:', item.full_thumbnail); // Để debug
            thumbnailPreview.src = item.full_thumbnail;
            thumbnailPreview.classList.remove('hidden');
        } else {
            thumbnailPreview.classList.add('hidden');
        }

        // Hiển thị video hiện tại
        const videoPreview = document.getElementById('editVideoPreview');
        const videoSource = videoPreview.querySelector('source');
        if (item.full_video) {
            console.log('Setting video:', item.full_video); // Để debug
            videoSource.src = item.full_video;
            videoPreview.load(); // Quan trọng: Load lại video sau khi thay đổi source
            videoPreview.classList.remove('hidden');
        } else {
            videoPreview.classList.add('hidden');
        }

        // Xóa các input hidden remove_thumbnail và remove_preview_video nếu có
        const removeThumbInput = form.querySelector('input[name="remove_thumbnail"]');
        if (removeThumbInput) removeThumbInput.remove();

        const removeVideoInput = form.querySelector('input[name="remove_preview_video"]');
        if (removeVideoInput) removeVideoInput.remove();
    }

    // Thêm biến để lưu trữ file đã chọn
    let selectedThumbnail = null;
    let selectedVideo = null;

    // Xử lý sự kiện click cho nút "Chọn ảnh"
    document.querySelector('button[onclick="document.getElementById(\'thumbnail\').click()"]').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('thumbnail').click();
    });

    // Xử lý sự kiện click cho nút "Chọn video"
    document.querySelector('button[onclick="document.getElementById(\'preview_video\').click()"]').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('preview_video').click();
    });

    function previewImage(input) {
        console.log('Preview Image Called:', input.files);
        const preview = document.getElementById('editThumbnailPreview');
        const file = input.files[0];

        if (file) {
            selectedThumbnail = file; // Lưu file đã chọn
            console.log('Selected thumbnail:', file.name, file.size);
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    function previewVideo(input) {
        console.log('Preview Video Called:', input.files);
        const preview = document.getElementById('editVideoPreview');
        const file = input.files[0];

        if (file) {
            selectedVideo = file; // Lưu file đã chọn
            console.log('Selected video:', file.name, file.size);
            const url = URL.createObjectURL(file);
            preview.src = url;
            preview.classList.remove('hidden');
        }
    }

    function clearThumbnail() {
        const preview = document.getElementById('editThumbnailPreview');
        const input = document.getElementById('thumbnail');
        preview.src = '';
        preview.classList.add('hidden');
        input.value = '';
        selectedThumbnail = null;

        // Thêm input hidden để đánh dấu xóa thumbnail
        let removeInput = document.querySelector('input[name="remove_thumbnail"]');
        if (!removeInput) {
            removeInput = document.createElement('input');
            removeInput.type = 'hidden';
            removeInput.name = 'remove_thumbnail';
            input.parentNode.appendChild(removeInput);
        }
        removeInput.value = '1';
    }

    function clearVideo() {
        const preview = document.getElementById('editVideoPreview');
        const input = document.getElementById('preview_video');
        preview.src = '';
        preview.classList.add('hidden');
        input.value = '';
        selectedVideo = null;

        // Thêm input hidden để đánh dấu xóa video
        let removeInput = document.querySelector('input[name="remove_preview_video"]');
        if (!removeInput) {
            removeInput = document.createElement('input');
            removeInput.type = 'hidden';
            removeInput.name = 'remove_preview_video';
            input.parentNode.appendChild(removeInput);
        }
        removeInput.value = '1';
    }

    function openImageModal(src) {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = src;
        modalHandler.open('imageModal');
    }

    function closeImageModal() {
        modalHandler.close('imageModal');
    }

    function openVideoModal(src) {
        const modalVideo = document.getElementById('modalVideo');
        modalVideo.querySelector('source').src = src;
        modalVideo.load(); // Reload video with new source
        modalHandler.open('videoModal');
    }

    function closeVideoModal() {
        const modalVideo = document.getElementById('modalVideo');
        modalVideo.pause(); // Pause video when closing modal
        modalHandler.close('videoModal');
    }

    // Close modals with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeImageModal();
            closeVideoModal();
        }
    });

    // Xử lý submit form
    document.getElementById('editCourseForm').addEventListener('submit', function(e) {
        e.preventDefault();
        console.log('Form submitted');

        const formData = new FormData();

        // Thêm các trường dữ liệu cơ bản
        const formElements = this.elements;
        for (let element of formElements) {
            if (element.name && element.name !== 'thumbnail' && element.name !== 'preview_video') {
                formData.append(element.name, element.value);
            }
        }

        // Thêm method PUT
        formData.append('_method', 'PUT');

        // Thêm file nếu có
        if (selectedThumbnail) {
            console.log('Appending thumbnail:', selectedThumbnail.name);
            formData.append('thumbnail', selectedThumbnail);
        }

        if (selectedVideo) {
            console.log('Appending video:', selectedVideo.name);
            formData.append('preview_video', selectedVideo);
        }

        // Debug form data
        console.log('Form data entries:');
        for (let pair of formData.entries()) {
            if (pair[1] instanceof File) {
                console.log(pair[0] + ': File -', pair[1].name, '(' + pair[1].size + ' bytes)');
            } else {
                console.log(pair[0] + ':', pair[1]);
            }
        }

        const submitButton = this.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;
        submitButton.disabled = true;
        submitButton.innerHTML = 'Đang xử lý...';

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            credentials: 'same-origin',
            redirect: 'follow'
        })
        .then(response => {
            console.log('Response status:', response.status);
            console.log('Is redirected:', response.redirected);
            console.log('Response URL:', response.url);

            if (response.redirected) {
                window.location.href = response.url;
                return null;
            }

            // Kiểm tra xem response có phải là JSON không
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.indexOf('application/json') !== -1) {
                return response.json();
            } else {
                // Nếu không phải JSON, có thể là HTML, redirect sang URL hiện tại
                window.location.reload();
                return null;
            }
        })
        .then(data => {
            if (!data) return; // Đã redirect hoặc reload

            console.log('Server response:', data);
            if (data.success) {
                alert('Cập nhật thành công!');
                window.location.reload();
            } else {
                throw new Error(data.message || 'Có lỗi xảy ra');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra: ' + error.message);
        })
        .finally(() => {
            submitButton.disabled = false;
            submitButton.innerHTML = originalText;
        });
    });
</script>

<style>
    /* Thêm styles cho preview containers */
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

    /* Hover effect cho preview */
    .preview-container img:hover,
    .preview-container video:hover {
        transform: scale(1.02);
    }

    /* Style cho buttons */
    button {
        transition: all 0.2s ease;
    }

    button:hover {
        transform: translateY(-1px);
    }

    button:active {
        transform: translateY(1px);
    }

    /* Loading indicator */
    .loading {
        position: relative;
    }

    .loading::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Add styles for modal content */
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

    /* Add hover effect for preview items */
    .preview-container img,
    .preview-container video {
        cursor: pointer;
    }

    .preview-container img:hover,
    .preview-container video:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
</style>
