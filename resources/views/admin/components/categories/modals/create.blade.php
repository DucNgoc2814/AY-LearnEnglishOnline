<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Thêm danh mục mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="categoryName">Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control {{ session('errors') && session('errors')->has('name') ? 'is-invalid' : '' }}"
                            id="categoryName" name="name" value="{{ old('name') }}" placeholder="Nhập tên danh mục"
                            required>
                        @if (session('errors') && session('errors')->has('name'))
                            <div class="invalid-feedback">{{ session('errors')->first('name') }}</div>
                            
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Mô tả</label>
                        <textarea class="form-control {{ session('errors') && session('errors')->has('description') ? 'is-invalid' : '' }}"
                            id="description" name="description" rows="3" placeholder="Nhập mô tả danh mục">{{ old('description') }}</textarea>
                        @if (session('errors') && session('errors')->has('description'))
                            <div class="invalid-feedback">{{ session('errors')->first('description') }}</div>
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
