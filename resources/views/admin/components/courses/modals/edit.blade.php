<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="editCourseModal" aria-labelledby="editCourseModalLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="editCourseModalLabel">Chỉnh sửa khóa học</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500"
                        onclick="modalHandler.close('editCourseModal')" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editCourseForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <!-- Cột trái -->
                        <div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                    Tên khóa học <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="title" name="title" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">
                                    Danh mục <span class="text-red-500">*</span>
                                </label>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="category_id" name="category_id" required>
                                    <option value="">Chọn danh mục</option>
                                    @foreach(\App\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="course_type">
                                    Loại khóa học <span class="text-red-500">*</span>
                                </label>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
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
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="course_format" name="course_format" required>
                                    <option value="online">Trực tuyến</option>
                                    <option value="offline">Trực tiếp</option>
                                    <option value="hybrid">Kết hợp</option>
                                </select>
                            </div>

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

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="estimated_hours">
                                    Số giờ học dự kiến
                                </label>
                                <input type="number"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="estimated_hours" name="estimated_hours" min="0">
                            </div>
                        </div>

                        <!-- Cột phải -->
                        <div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                    Mô tả chi tiết
                                </label>
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="description" name="description" rows="3"></textarea>
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
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnail">
                                    Ảnh đại diện
                                </label>
                                <div class="flex items-center space-x-2">
                                    <div class="relative">
                                        <input type="file"
                                            class="hidden"
                                            id="thumbnail" name="thumbnail"
                                            accept="image/*"
                                            onchange="previewImage(this);">
                                        <button type="button"
                                            onclick="document.getElementById('thumbnail').click()"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Chọn ảnh
                                        </button>
                                    </div>
                                    <div id="thumbnail-preview" class="relative">
                                        <!-- Ảnh hiện tại sẽ được hiển thị ở đây -->
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="preview_video">
                                    Video giới thiệu
                                </label>
                                <div class="flex items-center space-x-2">
                                    <div class="relative">
                                        <input type="file"
                                            class="hidden"
                                            id="preview_video"
                                            name="preview_video"
                                            accept="video/*"
                                            onchange="previewVideo(this);">
                                        <button type="button"
                                            onclick="document.getElementById('preview_video').click()"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Chọn video
                                        </button>
                                    </div>
                                    <div id="video-preview" class="relative">
                                        <!-- Video hiện tại sẽ được hiển thị ở đây -->
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="release_date">
                                    Ngày phát hành
                                </label>
                                <input type="datetime-local"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="release_date" name="release_date">
                            </div>

                            <div class="flex space-x-4">
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

                    <div class="flex justify-end pt-2 border-t">
                        <button type="button"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            onclick="modalHandler.close('editCourseModal')">
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

<script>
function populateEditModal(item) {
    modalHandler.open('editCourseModal');
    const form = document.getElementById('editCourseForm');

    // Cập nhật action URL của form
    form.action = `/admin/courses/${item.id}`;

    // Điền các giá trị vào form
    form.querySelector('#title').value = item.title;
    form.querySelector('#category_id').value = item.category_id;
    form.querySelector('#description').value = item.description;
    form.querySelector('#short_description').value = item.short_description;
    form.querySelector('#course_type').value = item.course_type;
    form.querySelector('#course_format').value = item.course_format;
    form.querySelector('#price').value = item.price;
    form.querySelector('#sale_price').value = item.sale_price || '';
    form.querySelector('#estimated_hours').value = item.estimated_hours || '';
    form.querySelector('#has_certificate').checked = item.has_certificate;
    form.querySelector('#requires_enrollment').checked = item.requires_enrollment;
    form.querySelector('#is_featured').checked = item.is_featured;
    form.querySelector('#is_active').checked = item.is_active;

    // Xử lý ngày phát hành
    if (item.release_date) {
        const releaseDate = new Date(item.release_date);
        const formattedDate = releaseDate.toISOString().slice(0, 16); // Format: YYYY-MM-DDTHH:mm
        form.querySelector('#release_date').value = formattedDate;
    }

    // Hiển thị ảnh hiện tại
    const thumbnailPreview = document.getElementById('thumbnail-preview');
    if (item.thumbnail) {
        thumbnailPreview.innerHTML = `
            <div class="mt-2 relative">
                <p class="text-sm text-gray-600 mb-1">Ảnh hiện tại:</p>
                <div class="relative group">
                    <img src="/storage/${item.thumbnail}"
                         alt="Current thumbnail"
                         class="h-20 w-20 object-cover rounded border border-gray-300">
                    <button type="button"
                            onclick="clearThumbnail()"
                            class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white rounded-full p-1 hidden group-hover:block">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        `;
    } else {
        thumbnailPreview.innerHTML = '<p class="text-sm text-gray-500">Chưa có ảnh</p>';
    }

    // Hiển thị video hiện tại
    const videoPreview = document.getElementById('video-preview');
    if (item.preview_video) {
        videoPreview.innerHTML = `
            <div class="mt-2 relative">
                <p class="text-sm text-gray-600 mb-1">Video hiện tại:</p>
                <div class="relative group">
                    <video width="320" height="240" controls class="rounded border border-gray-300">
                        <source src="/storage/${item.preview_video}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <button type="button"
                            onclick="clearVideo()"
                            class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white rounded-full p-1 hidden group-hover:block">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        `;
    } else {
        videoPreview.innerHTML = '<p class="text-sm text-gray-500">Chưa có video</p>';
    }
}

// Thêm hàm xóa ảnh
function clearThumbnail() {
    const preview = document.getElementById('thumbnail-preview');
    const input = document.getElementById('thumbnail');
    preview.innerHTML = '<p class="text-sm text-gray-500">Chưa có ảnh</p>';
    input.value = '';

    // Thêm input hidden để đánh dấu xóa ảnh
    const form = document.getElementById('editCourseForm');
    if (!form.querySelector('input[name="remove_thumbnail"]')) {
        const removeInput = document.createElement('input');
        removeInput.type = 'hidden';
        removeInput.name = 'remove_thumbnail';
        removeInput.value = '1';
        form.appendChild(removeInput);
    }
}

// Thêm hàm xóa video
function clearVideo() {
    const preview = document.getElementById('video-preview');
    const input = document.getElementById('preview_video');
    preview.innerHTML = '<p class="text-sm text-gray-500">Chưa có video</p>';
    input.value = '';

    // Thêm input hidden để đánh dấu xóa video
    const form = document.getElementById('editCourseForm');
    if (!form.querySelector('input[name="remove_preview_video"]')) {
        const removeInput = document.createElement('input');
        removeInput.type = 'hidden';
        removeInput.name = 'remove_preview_video';
        removeInput.value = '1';
        form.appendChild(removeInput);
    }
}

function previewImage(input) {
    const preview = document.getElementById('thumbnail-preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <div class="mt-2">
                    <p class="text-sm text-gray-600 mb-1">Ảnh đã chọn:</p>
                    <img src="${e.target.result}"
                         alt="Preview thumbnail"
                         class="h-20 w-20 object-cover rounded border border-gray-300">
                </div>
            `;
        }
        reader.readAsDataURL(input.files[0]);

        // Xóa input hidden remove_thumbnail nếu có
        const form = document.getElementById('editCourseForm');
        const removeInput = form.querySelector('input[name="remove_thumbnail"]');
        if (removeInput) {
            removeInput.remove();
        }
    }
}

function previewVideo(input) {
    const preview = document.getElementById('video-preview');
    if (input.files && input.files[0]) {
        const file = input.files[0];
        // Kiểm tra kích thước file (100MB)
        if (file.size > 100 * 1024 * 1024) {
            alert('File video quá lớn. Vui lòng chọn file nhỏ hơn 100MB.');
            input.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <div class="mt-2">
                    <p class="text-sm text-gray-600 mb-1">Video đã chọn:</p>
                    <video width="320" height="240" controls class="rounded">
                        <source src="${e.target.result}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            `;
        }
        reader.readAsDataURL(file);

        // Xóa input hidden remove_preview_video nếu có
        const form = document.getElementById('editCourseForm');
        const removeInput = form.querySelector('input[name="remove_preview_video"]');
        if (removeInput) {
            removeInput.remove();
        }
    }
}
</script>


