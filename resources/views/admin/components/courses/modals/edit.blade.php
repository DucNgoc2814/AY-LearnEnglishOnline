<div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog" aria-labelledby="editCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCourseModalLabel">Chỉnh sửa khóa học</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCourseForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tên khóa học <span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="courseName"
                                name="name"
                                placeholder="Nhập tên khóa học"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                            <select class="form-select @error('categoryId') is-invalid @enderror"
                                id="categoryId"
                                name="categoryId"
                                required>
                                <option value="">Chọn danh mục</option>
                                @foreach(\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('categoryId')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Giá khóa học <span class="text-danger">*</span></label>
                            <input type="number"
                                step="0.01"
                                class="form-control @error('price') is-invalid @enderror"
                                id="price"
                                name="price"
                                placeholder="Nhập giá khóa học"
                                required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Giá khuyến mãi</label>
                            <input type="number"
                                step="0.01"
                                class="form-control @error('salePrice') is-invalid @enderror"
                                id="salePrice"
                                name="salePrice"
                                placeholder="Nhập giá khuyến mãi (nếu có)">
                            @error('salePrice')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Mô tả ngắn</label>
                            <textarea class="form-control @error('sortDescription') is-invalid @enderror"
                                id="sortDescription"
                                name="sortDescription"
                                rows="2"
                                placeholder="Nhập mô tả ngắn về khóa học"></textarea>
                            @error('sortDescription')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Mô tả chi tiết <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                id="description"
                                name="description"
                                rows="3"
                                placeholder="Nhập mô tả chi tiết về khóa học"
                                required></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Ảnh thumbnail</label>
                            <input type="file"
                                class="form-control @error('thumbnail') is-invalid @enderror"
                                id="thumbnail"
                                name="thumbnail"
                                accept="image/*">
                            @error('thumbnail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Chọn ảnh đại diện cho khóa học (định dạng: jpg, png, jpeg)</small>
                            <div id="currentThumbnail" class="mt-2"></div>
                        </div>
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

@push('scripts')
<script>
function populateEditModal(item) {
    // Cập nhật action của form
    $('#editCourseForm').attr('action', '/admin/courses/' + item.id);

    // Điền dữ liệu vào các trường
    $('#courseName').val(item.name);
    $('#categoryId').val(item.categoryId || item.category_id); // Thêm fallback
    $('#price').val(parseFloat(item.price).toFixed(2)); // Format số thập phân
    $('#salePrice').val(item.salePrice ? parseFloat(item.salePrice).toFixed(2) : '');
    $('#sortDescription').val(item.sortDescription || item.sort_description);
    $('#description').val(item.description);

    // Hiển thị ảnh thumbnail hiện tại
    if (item.thumbnail) {
        $('#currentThumbnail').html(`
            <div class="mt-2">
                <img src="${'{{ asset("") }}' + item.thumbnail}"
                     alt="Current thumbnail"
                     class="img-thumbnail"
                     width="100">
                <small class="d-block mt-1">Ảnh hiện tại</small>
            </div>
        `);
    } else {
        $('#currentThumbnail').empty();
    }
}
</script>
@endpush
