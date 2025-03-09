<div class="modal fade" id="createCourseModal" tabindex="-1" role="dialog" aria-labelledby="createCourseModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCourseModalLabel">Thêm khóa học mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data" id="createCourseForm">
                @csrf
                <input type="hidden" name="debug" value="1">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="courseName">Tên khóa học <span
                                class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control {{ session('errors') && session('errors')->has('name') ? 'is-invalid' : '' }}"
                            id="courseName" name="name" value="{{ old('name') }}" placeholder="Nhập tên khóa học"
                            required>
                        @if (session('errors') && session('errors')->has('name'))
                            <div class="invalid-feedback">{{ session('errors')->first('name') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="categoryId">Danh mục <span class="text-danger">*</span></label>
                        <select
                            class="form-select {{ session('errors') && session('errors')->has('categoryId') ? 'is-invalid' : '' }}"
                            id="categoryId" name="categoryId" required>
                            <option value="">Chọn danh mục</option>
                            @foreach (\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('categoryId') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @if (session('errors') && session('errors')->has('categoryId'))
                            <div class="invalid-feedback">{{ session('errors')->first('categoryId') }}</div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="price">Giá <span class="text-danger">*</span></label>
                        <input type="number"
                            class="form-control {{ session('errors') && session('errors')->has('price') ? 'is-invalid' : '' }}"
                            id="price" name="price" value="{{ old('price') }}" placeholder="Nhập giá khóa học"
                            min="0" required>
                        @if (session('errors') && session('errors')->has('price'))
                            <div class="invalid-feedback">{{ session('errors')->first('price') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="salePrice">Giá khuyến mãi</label>
                        <input type="number"
                            class="form-control {{ session('errors') && session('errors')->has('salePrice') ? 'is-invalid' : '' }}"
                            id="salePrice" name="salePrice" value="{{ old('salePrice') }}"
                            placeholder="Nhập giá khuyến mãi (nếu có)" min="0">
                        @if (session('errors') && session('errors')->has('salePrice'))
                            <div class="invalid-feedback">{{ session('errors')->first('salePrice') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Mô tả <span class="text-danger">*</span></label>
                        <textarea class="form-control {{ session('errors') && session('errors')->has('description') ? 'is-invalid' : '' }}"
                            id="description" name="description" rows="3" placeholder="Nhập mô tả khóa học">{{ old('description') }}</textarea>
                        @if (session('errors') && session('errors')->has('description'))
                            <div class="invalid-feedback">{{ session('errors')->first('description') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="thumbnail">Ảnh thumbnail <span
                                class="text-danger">*</span></label>
                        <input type="file"
                            class="form-control {{ session('errors') && session('errors')->has('thumbnail') ? 'is-invalid' : '' }}"
                            id="thumbnail" name="thumbnail" accept="image/*" required>
                        @if (session('errors') && session('errors')->has('thumbnail'))
                            <div class="invalid-feedback">{{ session('errors')->first('thumbnail') }}</div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </div>
            </form>
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
