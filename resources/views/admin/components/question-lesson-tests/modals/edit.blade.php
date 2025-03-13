<div class="modal fade" id="editLessonModal" tabindex="-1" role="dialog" aria-labelledby="editLessonModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLessonModalLabel">Chỉnh sửa bài học</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editLessonForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="lessonName">Tên bài học <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control {{ session('errors') && session('errors')->has('name') ? 'is-invalid' : '' }}"
                            id="lessonName"
                            name="name"
                            placeholder="Nhập tên bài học"
                            required>
                        @if (session('errors') && session('errors')->has('name'))
                            <div class="invalid-feedback">{{ session('errors')->first('name') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="orderNumber">Thứ tự <span class="text-danger">*</span></label>
                        <input type="number"
                            class="form-control {{ session('errors') && session('errors')->has('orderNumber') ? 'is-invalid' : '' }}"
                            id="orderNumber"
                            name="orderNumber"
                            placeholder="Nhập số thứ tự bài học"
                            min="1"
                            required>
                        @if (session('errors') && session('errors')->has('orderNumber'))
                            <div class="invalid-feedback">{{ session('errors')->first('orderNumber') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="description">Mô tả <span class="text-danger">*</span></label>
                        <textarea class="form-control {{ session('errors') && session('errors')->has('description') ? 'is-invalid' : '' }}"
                            id="description"
                            name="description"
                            rows="3"
                            placeholder="Nhập mô tả bài học"
                            required></textarea>
                        @if (session('errors') && session('errors')->has('description'))
                            <div class="invalid-feedback">{{ session('errors')->first('description') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="isPreview" name="isPreview" value="1">
                            <label class="form-check-label" for="isPreview">
                                Cho phép xem thử
                            </label>
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
