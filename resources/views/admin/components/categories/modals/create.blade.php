<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Thêm danh mục mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="name" class="col-form-label">Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control {{ session('errors') && session('errors')->has('name') ? 'is-invalid' : '' }}" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               placeholder="Nhập tên danh mục"
                               required>
                        @if(session('errors') && session('errors')->has('name'))
                            <div class="invalid-feedback">{{ session('errors')->first('name') }}</div>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="col-form-label">Mô tả</label>
                        <textarea class="form-control {{ session('errors') && session('errors')->has('description') ? 'is-invalid' : '' }}" 
                                  id="description" 
                                  name="description" 
                                  rows="3"
                                  placeholder="Nhập mô tả danh mục">{{ old('description') }}</textarea>
                        @if(session('errors') && session('errors')->has('description'))
                            <div class="invalid-feedback">{{ session('errors')->first('description') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="col-form-label d-block">Trạng thái</label>
                        <label class="primary_checkbox d-flex mr-12">
                            <input type="checkbox" 
                                   name="is_active" 
                                   value="1" 
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <span class="checkmark mr-2"></span>
                            <span>Kích hoạt</span>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" 
                            onclick="$('#createCategoryModal').modal('hide'); $('.modal-backdrop').remove(); $('body').removeClass('modal-open');">
                        Hủy
                    </button>
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