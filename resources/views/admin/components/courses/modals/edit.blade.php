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
                        onclick="closeEditCourseModal()" aria-label="Close">
                        <span class="sr-only">Đóng</span>
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
                    <input type="hidden" name="course_id" id="edit_courseId">
                    <input type="hidden" name="thumbnail_url" id="edit_thumbnail_url">
                    <input type="hidden" name="preview_video_url" id="edit_preview_video_url">
                    <div class="grid grid-cols-2 gap-6 mt-4">
                        <!-- Thông tin cơ bản -->
                        <div>
                            <h4 class="font-medium text-gray-900 mb-4">Thông tin cơ bản</h4>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_title">
                                    Tên khóa học <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_title" name="title" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_short_description">
                                    Mô tả ngắn
                                </label>
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_short_description" name="short_description" rows="2"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_description">
                                    Mô tả chi tiết
                                </label>
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_description" name="description" rows="4"></textarea>
                            </div>

                            <!-- Phân loại -->
                            <h4 class="font-medium text-gray-900 mb-4 mt-6">Phân loại</h4>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_category_id">
                                    Danh mục <span class="text-red-500">*</span>
                                </label>
                                <select
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="edit_category_id" name="category_id" required>
                                    <option value="">Chọn danh mục</option>
                                    @foreach (\App\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_course_type">
                                        Loại khóa học <span class="text-red-500">*</span>
                                    </label>
                                    <select
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_course_type" name="course_type" required>
                                        <option value="self_paced">Tự học</option>
                                        <option value="instructor_led">Có giảng viên</option>
                                        <option value="hybrid">Kết hợp</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_course_format">
                                        Hình thức học <span class="text-red-500">*</span>
                                    </label>
                                    <select
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_course_format" name="course_format" required>
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
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_thumbnail">
                                    Ảnh đại diện <span class="text-red-500">*</span>
                                </label>
                                <div class="preview-container mb-2">
                                    <img id="edit_thumbnailPreview" src=""
                                        class="hidden max-w-xs h-auto rounded-lg shadow-md cursor-pointer"
                                        style="max-height: 200px; object-fit: contain;"
                                        onclick="openImageModal(this.src)">
                                </div>
                                <div class="flex space-x-2">
                                    <button type="button" id="edit_chooseThumbnailBtn"
                                        class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                                        Chọn ảnh
                                    </button>
                                    <button type="button" onclick="clearEditThumbnail()"
                                        class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded">
                                        Xóa ảnh
                                    </button>
                                </div>
                                <input type="file" class="hidden" id="edit_thumbnail" name="thumbnail"
                                    accept="image/*">
                            </div>

                            <!-- Video upload -->
                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_preview_video">
                                    Video giới thiệu
                                </label>
                                <div class="preview-container mb-2">
                                    <video id="edit_videoPreview"
                                        class="hidden max-w-xs rounded-lg shadow-md cursor-pointer"
                                        style="max-height: 300px; width: 100%;"
                                        onclick="openVideoModal(this.querySelector('source').src)" controls>
                                        <source src="" type="video/mp4">
                                    </video>
                                </div>
                                <div class="flex space-x-2">
                                    <button type="button" id="edit_chooseVideoBtn"
                                        class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 rounded">
                                        Chọn video
                                    </button>
                                    <button type="button" onclick="clearEditVideo()"
                                        class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-2 px-4 rounded">
                                        Xóa video
                                    </button>
                                </div>
                                <input type="file" class="hidden" id="edit_preview_video" name="preview_video"
                                    accept="video/*">
                            </div>

                            <h4 class="font-medium text-gray-900 mb-4 mt-6">Thông tin khác</h4>

                            <!-- Giá và thời gian -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_price">
                                        Giá <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_price" name="price" min="0"
                                        required>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_sale_price">
                                        Giá khuyến mãi
                                    </label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_sale_price" name="sale_price"
                                        min="0">
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_estimated_hours">
                                        Số giờ học dự kiến
                                    </label>
                                    <input type="number"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_estimated_hours" name="estimated_hours"
                                        min="0">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_release_date">
                                        Ngày phát hành
                                    </label>
                                    <input type="datetime-local"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="edit_release_date" name="release_date">
                                </div>
                            </div>

                            <!-- Checkboxes -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                            id="edit_has_certificate" name="has_certificate" value="1">
                                        <span class="ml-2 text-gray-700">Có chứng chỉ</span>
                                    </label>
                                </div>

                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                            id="edit_requires_enrollment" name="requires_enrollment" value="1">
                                        <span class="ml-2 text-gray-700">Yêu cầu đăng ký</span>
                                    </label>
                                </div>

                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                            id="edit_is_featured" name="is_featured" value="1">
                                        <span class="ml-2 text-gray-700">Nổi bật</span>
                                    </label>
                                </div>

                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                            id="edit_is_active" name="is_active" value="1">
                                        <span class="ml-2 text-gray-700">Kích hoạt</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t mt-6">
                        <button type="button"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            onclick="closeEditCourseModal()">
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
    function editCourse(id) {
        console.log('Editing course:', id);

        fetch(`/admin/courses/${id}/edit`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(response => {
                console.log('Response:', response);
                if (response.status) {
                    populateCourseEditModal(response.data);
                } else {
                    throw new Error(response.message || 'Không thể tải thông tin khóa học');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Đã xảy ra lỗi khi tải dữ liệu: ' + error.message);
            });
    }

    function populateCourseEditModal(course) {
        console.log('Populating modal with:', course);
        modalHandler.open('editCourseModal');

        const form = document.getElementById('editCourseForm');
        form.action = `/admin/courses/${course.id}`;

        // Điền dữ liệu vào form
        document.getElementById('edit_courseId').value = course.id;
        document.getElementById('edit_title').value = course.title;
        document.getElementById('edit_short_description').value = course.short_description || '';
        document.getElementById('edit_description').value = course.description || '';

        // Khởi tạo lại TinyMCE cho trường mô tả chi tiết
        if (tinymce.get('edit_description')) {
            tinymce.get('edit_description').setContent(course.description || '');
        } else {
            setTimeout(function() {
                tinymce.init({
                    selector: '#edit_description',
                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                    height: 300,
                    language: 'vi',
                    image_title: true,
                    automatic_uploads: true,
                    file_picker_types: 'image',
                    entity_encoding: 'raw',
                    encoding: 'UTF-8'
                });
            }, 100);
        }

        document.getElementById('edit_category_id').value = course.category_id;
        document.getElementById('edit_course_type').value = course.course_type;
        document.getElementById('edit_course_format').value = course.course_format;
        document.getElementById('edit_price').value = course.price;
        document.getElementById('edit_sale_price').value = course.sale_price || '';
        document.getElementById('edit_estimated_hours').value = course.estimated_hours || '';

        // Lưu URL hiện tại vào input hidden để giữ lại khi không upload file mới
        document.getElementById('edit_thumbnail_url').value = course.thumbnail || '';
        document.getElementById('edit_preview_video_url').value = course.preview_video || '';

        // Xử lý ngày phát hành
        if (course.release_date) {
            const releaseDate = new Date(course.release_date);
            const formattedDate = releaseDate.toISOString().slice(0, 16);
            document.getElementById('edit_release_date').value = formattedDate;
        } else {
            document.getElementById('edit_release_date').value = '';
        }

        // Checkboxes
        document.getElementById('edit_has_certificate').checked = Boolean(course.has_certificate);
        document.getElementById('edit_requires_enrollment').checked = Boolean(course.requires_enrollment);
        document.getElementById('edit_is_featured').checked = Boolean(course.is_featured);
        document.getElementById('edit_is_active').checked = Boolean(course.is_active);

        // Hiển thị thumbnail
        const thumbnailPreview = document.getElementById('edit_thumbnailPreview');
        if (course.thumbnail) {
            console.log('Setting thumbnail:', course.thumbnail);
            thumbnailPreview.src = course.thumbnail;
            thumbnailPreview.classList.remove('hidden');
        } else {
            thumbnailPreview.classList.add('hidden');
        }

        // Hiển thị video
        const videoPreview = document.getElementById('edit_videoPreview');
        const videoSource = videoPreview.querySelector('source');
        if (course.preview_video) {
            console.log('Setting video:', course.preview_video);
            videoSource.src = course.preview_video;
            videoPreview.load();
            videoPreview.classList.remove('hidden');
        } else {
            videoSource.src = '';
            videoPreview.load();
            videoPreview.classList.add('hidden');
        }

        // Xóa các input hidden nếu có
        const removeThumbnailInput = form.querySelector('input[name="remove_thumbnail"]');
        if (removeThumbnailInput) removeThumbnailInput.remove();

        const removeVideoInput = form.querySelector('input[name="remove_preview_video"]');
        if (removeVideoInput) removeVideoInput.remove();
    }

    function handleEditThumbnailUpload(input) {
        const preview = document.getElementById('edit_thumbnailPreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');

                // Xóa URL hiện tại
                document.getElementById('edit_thumbnail_url').value = '';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function handleEditVideoUpload(input) {
        const preview = document.getElementById('edit_videoPreview');
        const videoSource = preview.querySelector('source');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            if (file.size > 100 * 1024 * 1024) {
                alert('File video quá lớn. Vui lòng chọn file nhỏ hơn 100MB.');
                input.value = '';
                return;
            }

            // Tạo URL cho file và hiển thị video
            const fileURL = URL.createObjectURL(file);
            videoSource.src = fileURL;
            preview.load();
            preview.classList.remove('hidden');

            // Xóa URL hiện tại
            document.getElementById('edit_preview_video_url').value = '';
        }
    }

    function clearEditThumbnail() {
        const preview = document.getElementById('edit_thumbnailPreview');
        const input = document.getElementById('edit_thumbnail');
        const urlInput = document.getElementById('edit_thumbnail_url');

        preview.src = '';
        preview.classList.add('hidden');
        input.value = '';
        urlInput.value = ''; // Xóa giá trị URL hiện tại

        // Thêm input hidden để đánh dấu xóa thumbnail
        let removeInput = document.querySelector('input[name="remove_thumbnail"]');
        if (!removeInput) {
            removeInput = document.createElement('input');
            removeInput.type = 'hidden';
            removeInput.name = 'remove_thumbnail';
            removeInput.value = '1';
            input.parentNode.appendChild(removeInput);
        }
        removeInput.value = '1';
    }

    function clearEditVideo() {
        const preview = document.getElementById('edit_videoPreview');
        const videoSource = preview.querySelector('source');
        const input = document.getElementById('edit_preview_video');
        const urlInput = document.getElementById('edit_preview_video_url');

        videoSource.src = '';
        preview.load();
        preview.classList.add('hidden');
        input.value = '';
        urlInput.value = ''; // Xóa giá trị URL hiện tại

        // Thêm input hidden để đánh dấu xóa video
        let removeInput = document.querySelector('input[name="remove_preview_video"]');
        if (!removeInput) {
            removeInput = document.createElement('input');
            removeInput.type = 'hidden';
            removeInput.name = 'remove_preview_video';
            removeInput.value = '1';
            input.parentNode.appendChild(removeInput);
        }
        removeInput.value = '1';
    }

    function closeEditCourseModal() {
        modalHandler.close('editCourseModal');

        // Xóa instance TinyMCE để tránh xung đột
        if (tinymce.get('edit_description')) {
            tinymce.get('edit_description').remove();
        }

        document.getElementById('editCourseForm').reset();

        // Xóa các input hidden nếu có
        const form = document.getElementById('editCourseForm');
        const removeThumbnailInput = form.querySelector('input[name="remove_thumbnail"]');
        if (removeThumbnailInput) removeThumbnailInput.remove();

        const removeVideoInput = form.querySelector('input[name="remove_preview_video"]');
        if (removeVideoInput) removeVideoInput.remove();
    }

    // Thêm event listeners khi tài liệu đã sẵn sàng
    document.addEventListener('DOMContentLoaded', function() {
        // Đăng ký sự kiện cho form edit
        const editForm = document.getElementById('editCourseForm');
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const courseId = document.getElementById('edit_courseId').value;
                const formData = new FormData(this);

                // Xử lý các trường input hidden
                const thumbnailInput = document.getElementById('edit_thumbnail');
                const videoInput = document.getElementById('edit_preview_video');

                // Nếu không có file upload mới, sử dụng URL hiện tại
                if (!thumbnailInput.files.length && document.getElementById('edit_thumbnail_url').value && !formData.has('remove_thumbnail')) {
                    // Không thêm gì vào formData nếu đang giữ nguyên thumbnail
                    console.log('Keeping current thumbnail:', document.getElementById('edit_thumbnail_url').value);
                }

                if (!videoInput.files.length && document.getElementById('edit_preview_video_url').value && !formData.has('remove_preview_video')) {
                    // Không thêm gì vào formData nếu đang giữ nguyên video
                    console.log('Keeping current video:', document.getElementById('edit_preview_video_url').value);
                }

                // Gửi form bằng AJAX
                fetch(`/admin/courses/${courseId}`, {
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
                            closeEditCourseModal();
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

        // Xử lý sự kiện click cho nút "Chọn ảnh"
        const thumbnailBtn = document.getElementById('edit_chooseThumbnailBtn');
        if (thumbnailBtn) {
            thumbnailBtn.addEventListener('click', function() {
                document.getElementById('edit_thumbnail').click();
            });
        }

        // Xử lý sự kiện click cho nút "Chọn video"
        const videoBtn = document.getElementById('edit_chooseVideoBtn');
        if (videoBtn) {
            videoBtn.addEventListener('click', function() {
                document.getElementById('edit_preview_video').click();
            });
        }

        // Xử lý preview ảnh
        const thumbnailInput = document.getElementById('edit_thumbnail');
        if (thumbnailInput) {
            thumbnailInput.addEventListener('change', function(e) {
                handleEditThumbnailUpload(this);

                // Xóa input hidden remove_thumbnail nếu chọn file mới
                const removeInput = document.querySelector('input[name="remove_thumbnail"]');
                if (removeInput) removeInput.remove();
            });
        }

        // Xử lý preview video
        const videoInput = document.getElementById('edit_preview_video');
        if (videoInput) {
            videoInput.addEventListener('change', function(e) {
                handleEditVideoUpload(this);

                // Xóa input hidden remove_preview_video nếu chọn file mới
                const removeInput = document.querySelector('input[name="remove_preview_video"]');
                if (removeInput) removeInput.remove();
            });
        }

        // Đóng modal khi nhấn ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeEditCourseModal();
            }
        });

        // Đóng modal khi click bên ngoài
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('editCourseModal');
            if (event.target === modal) {
                closeEditCourseModal();
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
