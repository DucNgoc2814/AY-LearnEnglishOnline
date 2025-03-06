<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal_800px_width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="f_s_23 f_w_700 mb-0">Thêm danh mục mới</h4>
                <button type="button" class="close_icon" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="common_input mb_15">
                                        <label class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control {{ session('errors') && session('errors')->has('name') ? 'is-invalid' : '' }}" 
                                               name="name" 
                                               value="{{ old('name') }}"
                                               placeholder="Nhập tên danh mục"
                                               required>
                                        @if(session('errors') && session('errors')->has('name'))
                                            <div class="invalid-feedback">{{ session('errors')->first('name') }}</div>
                                        @endif
                                    </div>

                                    <div class="common_input mb_15">
                                        <label class="form-label">Mô tả</label>
                                        <textarea class="form-control {{ session('errors') && session('errors')->has('description') ? 'is-invalid' : '' }}" 
                                                  name="description" 
                                                  rows="3"
                                                  placeholder="Nhập mô tả danh mục">{{ old('description') }}</textarea>
                                        @if(session('errors') && session('errors')->has('description'))
                                            <div class="invalid-feedback">{{ session('errors')->first('description') }}</div>
                                        @endif
                                    </div>

                                    <div class="common_input mb_15">
                                        <label class="form-label d-block">Trạng thái</label>
                                        <label class="primary_checkbox d-flex">
                                            <input type="checkbox" 
                                                   name="is_active" 
                                                   value="1" 
                                                   {{ old('is_active', true) ? 'checked' : '' }}>
                                            <span class="checkmark mr_10"></span>
                                            <span class="label_name">Kích hoạt</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn_1">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div> 