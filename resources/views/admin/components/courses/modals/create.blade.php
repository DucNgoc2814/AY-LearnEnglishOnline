<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="createCourseModal" aria-labelledby="createCourseModalLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex justify-between items-center pb-3 border-b">
                    <h3 class="text-lg font-medium text-gray-900" id="createCourseModalLabel">Thêm khóa học mới</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500"
                        onclick="modalHandler.close('createCourseModal')" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data" id="createCourseForm">
                    @csrf
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <!-- Cột trái -->
                        <div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                    Tên khóa học <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="title" name="title" value="{{ old('title') }}" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">
                                    Danh mục <span class="text-red-500">*</span>
                                </label>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="category_id" name="category_id" required>
                                    <option value="">Chọn danh mục</option>
                                    @foreach (\App\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
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
                                    id="price" name="price" value="{{ old('price', 0) }}" min="0" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="sale_price">
                                    Giá khuyến mãi
                                </label>
                                <input type="number"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="sale_price" name="sale_price" value="{{ old('sale_price') }}" min="0">
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="estimated_hours">
                                    Số giờ học dự kiến
                                </label>
                                <input type="number"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="estimated_hours" name="estimated_hours" value="{{ old('estimated_hours') }}" min="0">
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
                                    id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="short_description">
                                    Mô tả ngắn
                                </label>
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="short_description" name="short_description" rows="2">{{ old('short_description') }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnail">
                                    Ảnh đại diện <span class="text-red-500">*</span>
                                </label>
                                <div class="flex items-center space-x-2">
                                    <div class="relative">
                                        <input type="file"
                                            class="hidden"
                                            id="thumbnail" name="thumbnail"
                                            accept="image/*" required
                                            onchange="previewImage(this);">
                                        <button type="button"
                                            onclick="document.getElementById('thumbnail').click()"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Chọn ảnh
                                        </button>
                                    </div>
                                    <div id="thumbnail-preview" class="hidden">
                                        <img src="" alt="Preview" class="h-20 w-20 object-cover rounded">
                                        <button type="button"
                                            onclick="clearImage()"
                                            class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white rounded-full p-1">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div id="upload-progress" class="hidden">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
                                        </div>
                                        <span class="text-sm text-gray-500">Đang tải lên...</span>
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
                                    <div id="video-preview" class="hidden">
                                        <video width="320" height="240" controls class="rounded">
                                            <source src="" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        <button type="button"
                                            onclick="clearVideo()"
                                            class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white rounded-full p-1">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div id="video-upload-progress" class="hidden w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="release_date">
                                    Ngày phát hành
                                </label>
                                <input type="datetime-local"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="release_date" name="release_date" value="{{ old('release_date') }}">
                            </div>

                            <div class="flex space-x-4">
                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                            id="has_certificate" name="has_certificate" value="1"
                                            {{ old('has_certificate') ? 'checked' : '' }}>
                                        <span class="ml-2 text-gray-700">Có chứng chỉ</span>
                                    </label>
                                </div>

                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                            id="requires_enrollment" name="requires_enrollment" value="1"
                                            {{ old('requires_enrollment', true) ? 'checked' : '' }}>
                                        <span class="ml-2 text-gray-700">Yêu cầu đăng ký</span>
                                    </label>
                                </div>

                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                            id="is_featured" name="is_featured" value="1"
                                            {{ old('is_featured') ? 'checked' : '' }}>
                                        <span class="ml-2 text-gray-700">Nổi bật</span>
                                    </label>
                                </div>

                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600"
                                            id="is_active" name="is_active" value="1"
                                            {{ old('is_active', true) ? 'checked' : '' }}>
                                        <span class="ml-2 text-gray-700">Kích hoạt</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-2 border-t">
                        <button type="button"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2"
                            onclick="modalHandler.close('createCourseModal')">
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
function previewImage(input) {
    const preview = document.getElementById('thumbnail-preview');
    const img = preview.querySelector('img');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function clearImage() {
    const input = document.getElementById('thumbnail');
    const preview = document.getElementById('thumbnail-preview');
    input.value = '';
    preview.classList.add('hidden');
}

function previewVideo(input) {
    const preview = document.getElementById('video-preview');
    const video = preview.querySelector('video source');

    if (input.files && input.files[0]) {
        const file = input.files[0];

        // Kiểm tra kích thước file (100MB)
        if (file.size > 100 * 1024 * 1024) {
            alert('File video quá lớn. Vui lòng chọn file nhỏ hơn 100MB.');
            input.value = '';
            return;
        }

        // Kiểm tra định dạng file
        const validTypes = ['video/mp4', 'video/webm', 'video/ogg'];
        if (!validTypes.includes(file.type)) {
            alert('Định dạng file không hợp lệ. Vui lòng chọn file MP4, WebM hoặc Ogg.');
            input.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            video.src = e.target.result;
            video.parentElement.load();
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

function clearVideo() {
    const input = document.getElementById('preview_video');
    const preview = document.getElementById('video-preview');
    const video = preview.querySelector('video source');
    input.value = '';
    video.src = '';
    video.parentElement.load(); // Reload video element
    preview.classList.add('hidden');
}

document.getElementById('createCourseForm').addEventListener('submit', function(e) {
    const thumbnailInput = document.getElementById('thumbnail');
    const videoInput = document.getElementById('preview_video');
    const thumbnailProgress = document.getElementById('upload-progress');
    const videoProgress = document.getElementById('video-upload-progress');

    if (thumbnailInput.files.length > 0) {
        thumbnailProgress.classList.remove('hidden');
    }

    if (videoInput.files.length > 0) {
        videoProgress.classList.remove('hidden');
        // Progress simulation for video
        let width = 0;
        const progressBar = videoProgress.querySelector('.bg-blue-600');
        const interval = setInterval(() => {
            if (width >= 100) {
                clearInterval(interval);
            } else {
                width++;
                progressBar.style.width = width + '%';
            }
        }, 50);
    }
});
</script>
