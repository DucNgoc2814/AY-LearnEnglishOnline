<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Thêm khóa học mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tên khóa học <span class="text-danger">*</span></label>
                            <input type="text"
                                class="form-control {{ session('errors') && session('errors')->has('name') ? 'is-invalid' : '' }}"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Nhập tên khóa học"
                                required>
                            @if (session('errors') && session('errors')->has('name'))
                                <div class="invalid-feedback">{{ session('errors')->first('name') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Danh mục <span class="text-danger">*</span></label>
                            <select class="form-select {{ session('errors') && session('errors')->has('categoryId') ? 'is-invalid' : '' }}"
                                name="categoryId"
                                required>
                                <option value="">Chọn danh mục</option>
                                @foreach(\App\Models\Category::all() as $category)
                                    <option value="{{ $category->id }}" {{ old('categoryId') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if (session('errors') && session('errors')->has('categoryId'))
                                <div class="invalid-feedback">{{ session('errors')->first('categoryId') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Giá <span class="text-danger">*</span></label>
                            <input type="number"
                                class="form-control {{ session('errors') && session('errors')->has('price') ? 'is-invalid' : '' }}"
                                name="price"
                                value="{{ old('price') }}"
                                placeholder="Nhập giá khóa học"
                                min="0"
                                required>
                            @if (session('errors') && session('errors')->has('price'))
                                <div class="invalid-feedback">{{ session('errors')->first('price') }}</div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Giá khuyến mãi</label>
                            <input type="number"
                                class="form-control {{ session('errors') && session('errors')->has('salePrice') ? 'is-invalid' : '' }}"
                                name="salePrice"
                                value="{{ old('salePrice') }}"
                                placeholder="Nhập giá khuyến mãi (nếu có)"
                                min="0">
                            @if (session('errors') && session('errors')->has('salePrice'))
                                <div class="invalid-feedback">{{ session('errors')->first('salePrice') }}</div>
                            @endif
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Mô tả ngắn</label>
                            <textarea
                                class="form-control {{ session('errors') && session('errors')->has('sortDescription') ? 'is-invalid' : '' }}"
                                name="sortDescription"
                                rows="2"
                                placeholder="Nhập mô tả ngắn về khóa học">{{ old('sortDescription') }}</textarea>
                            @if (session('errors') && session('errors')->has('sortDescription'))
                                <div class="invalid-feedback">{{ session('errors')->first('sortDescription') }}</div>
                            @endif
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Mô tả chi tiết <span class="text-danger">*</span></label>
                            <textarea
                                class="form-control {{ session('errors') && session('errors')->has('description') ? 'is-invalid' : '' }}"
                                name="description"
                                rows="4"
                                placeholder="Nhập mô tả chi tiết về khóa học"
                                required>{{ old('description') }}</textarea>
                            @if (session('errors') && session('errors')->has('description'))
                                <div class="invalid-feedback">{{ session('errors')->first('description') }}</div>
                            @endif
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">Ảnh thumbnail</label>
                            <input type="file"
                                class="form-control {{ session('errors') && session('errors')->has('thumbnail') ? 'is-invalid' : '' }}"
                                name="thumbnail"
                                accept="image/*">
                            @if (session('errors') && session('errors')->has('thumbnail'))
                                <div class="invalid-feedback">{{ session('errors')->first('thumbnail') }}</div>
                            @endif
                            <small class="form-text text-muted">Chọn ảnh đại diện cho khóa học (định dạng: jpg, png, jpeg)</small>
                        </div>
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

@push('scripts')
<script>
$(document).ready(function() {
    // Test xem modal có được gọi không
    console.log('Modal script loaded');

    // Thêm event listener cho nút mở modal
    $('.btn_1').on('click', function() {
        console.log('Button clicked');
        var myModal = new bootstrap.Modal(document.getElementById('createCategoryModal'));
        myModal.show();
    });
});
</script>
@endpush
