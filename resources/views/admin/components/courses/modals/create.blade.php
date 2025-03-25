<div class="fixed inset-0 z-50 overflow-y-auto hidden" id="createCourseModal" aria-labelledby="createCourseModalLabel" aria-hidden="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
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
                    <div class="mt-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="courseName">
                                Tên khóa học <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ session('errors') && session('errors')->has('name') ? 'border-red-500' : '' }}"
                                id="courseName" name="name" value="{{ old('name') }}" placeholder="Nhập tên khóa học"
                                required>
                            @if (session('errors') && session('errors')->has('name'))
                                <p class="text-red-500 text-xs italic mt-1">{{ session('errors')->first('name') }}</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="categoryId">
                                Danh mục <span class="text-red-500">*</span>
                            </label>
                            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="categoryId" name="categoryId" required>
                                <option value="">Chọn danh mục</option>
                                @foreach (\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}" {{ old('categoryId') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                                Giá <span class="text-red-500">*</span>
                            </label>
                            <input type="number"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="price" name="price" value="{{ old('price') }}" placeholder="Nhập giá khóa học"
                                min="0" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="salePrice">
                                Giá khuyến mãi
                            </label>
                            <input type="number"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="salePrice" name="salePrice" value="{{ old('salePrice') }}"
                                placeholder="Nhập giá khuyến mãi (nếu có)" min="0">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                                Mô tả <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="description" name="description" rows="3" placeholder="Nhập mô tả khóa học" required>{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="thumbnail">
                                Ảnh thumbnail <span class="text-red-500">*</span>
                            </label>
                            <input type="file"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="thumbnail" name="thumbnail" accept="image/*" required>
                        </div>

                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-600" id="isTop" name="isTop" value="1">
                                <span class="ml-2 text-gray-700">Hiển thị trang chủ</span>
                            </label>
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
document.getElementById('createCourseForm').addEventListener('submit', function(e) {
    // e.preventDefault(); // Uncomment để test

    const formData = new FormData(this);
    console.log('=== Form Submission Debug ===');
    console.log('Form is submitting...');

    // Log từng field trong form
    for (let pair of formData.entries()) {
        console.log(pair[0] + ': ', pair[1]);
    }

    // Log file nếu có
    const fileInput = document.getElementById('thumbnail');
    if (fileInput.files.length > 0) {
        console.log('File selected:', {
            name: fileInput.files[0].name,
            size: fileInput.files[0].size,
            type: fileInput.files[0].type
        });
    }
});
</script>
