<div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog" aria-labelledby="editCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCourseModalLabel">Chỉnh sửa khóa học</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCourseForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="courseName">Tên khóa học <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control {{ session('errors') && session('errors')->has('name') ? 'is-invalid' : '' }}"
                            id="courseName"
                            name="name"
                            placeholder="Nhập tên khóa học"
                            required>
                        @if (session('errors') && session('errors')->has('name'))
                            <div class="invalid-feedback">{{ session('errors')->first('name') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="categoryId">Danh mục <span class="text-danger">*</span></label>
                        <select class="form-select {{ session('errors') && session('errors')->has('categoryId') ? 'is-invalid' : '' }}"
                            id="categoryId"
                            name="categoryId"
                            required>
                            <option value="">Chọn danh mục</option>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                            id="price"
                            name="price"
                            placeholder="Nhập giá khóa học"
                            min="0"
                            required>
                        @if (session('errors') && session('errors')->has('price'))
                            <div class="invalid-feedback">{{ session('errors')->first('price') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="salePrice">Giá khuyến mãi</label>
                        <input type="number"
                            class="form-control {{ session('errors') && session('errors')->has('salePrice') ? 'is-invalid' : '' }}"
                            id="salePrice"
                            name="salePrice"
                            placeholder="Nhập giá khuyến mãi (nếu có)"
                            min="0">
                        @if (session('errors') && session('errors')->has('salePrice'))
                            <div class="invalid-feedback">{{ session('errors')->first('salePrice') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Mô tả <span class="text-danger">*</span></label>
                        <textarea class="form-control {{ session('errors') && session('errors')->has('description') ? 'is-invalid' : '' }}"
                            id="description"
                            name="description"
                            rows="3"
                            placeholder="Nhập mô tả khóa học"
                            required></textarea>
                        @if (session('errors') && session('errors')->has('description'))
                            <div class="invalid-feedback">{{ session('errors')->first('description') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="thumbnail">Ảnh thumbnail</label>
                        <input type="file"
                            class="form-control {{ session('errors') && session('errors')->has('thumbnail') ? 'is-invalid' : '' }}"
                            id="thumbnail"
                            name="thumbnail"
                            accept="image/*">
                        @if (session('errors') && session('errors')->has('thumbnail'))
                            <div class="invalid-feedback">{{ session('errors')->first('thumbnail') }}</div>
                        @endif
                        <div id="currentThumbnail" class="mt-2"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
