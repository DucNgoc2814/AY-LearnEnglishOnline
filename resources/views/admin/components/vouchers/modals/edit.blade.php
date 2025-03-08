<div class="modal fade" id="editVoucherModal" tabindex="-1" role="dialog" aria-labelledby="editVoucherModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVoucherModalLabel">Chỉnh sửa mã giảm giá</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editVoucherForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="code">Mã giảm giá <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control {{ session('errors') && session('errors')->has('code') ? 'is-invalid' : '' }}"
                            id="code" name="code" placeholder="Nhập mã giảm giá" required>
                        @if (session('errors') && session('errors')->has('code'))
                            <div class="invalid-feedback">{{ session('errors')->first('code') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="sale">Giá trị giảm <span class="text-danger">*</span></label>
                        <input type="number" step="0.01"
                            class="form-control {{ session('errors') && session('errors')->has('sale') ? 'is-invalid' : '' }}"
                            id="sale" name="sale" placeholder="Nhập giá trị giảm" required>
                        @if (session('errors') && session('errors')->has('sale'))
                            <div class="invalid-feedback">{{ session('errors')->first('sale') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="startDate">Ngày bắt đầu <span class="text-danger">*</span></label>
                        <input type="datetime-local"
                            class="form-control {{ session('errors') && session('errors')->has('startDate') ? 'is-invalid' : '' }}"
                            id="startDate" name="startDate" required>
                        @if (session('errors') && session('errors')->has('startDate'))
                            <div class="invalid-feedback">{{ session('errors')->first('startDate') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="endDate">Ngày kết thúc <span class="text-danger">*</span></label>
                        <input type="datetime-local"
                            class="form-control {{ session('errors') && session('errors')->has('endDate') ? 'is-invalid' : '' }}"
                            id="endDate" name="endDate" required>
                        @if (session('errors') && session('errors')->has('endDate'))
                            <div class="invalid-feedback">{{ session('errors')->first('endDate') }}</div>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" for="maxUsage">Số lần sử dụng tối đa <span class="text-danger">*</span></label>
                        <input type="number"
                            class="form-control {{ session('errors') && session('errors')->has('maxUsage') ? 'is-invalid' : '' }}"
                            id="maxUsage" name="maxUsage" placeholder="Nhập số lần sử dụng tối đa" required>
                        @if (session('errors') && session('errors')->has('maxUsage'))
                            <div class="invalid-feedback">{{ session('errors')->first('maxUsage') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="minOrderValue">Giá trị đơn hàng tối thiểu <span class="text-danger">*</span></label>
                        <input type="number" step="0.01"
                            class="form-control {{ session('errors') && session('errors')->has('minOrderValue') ? 'is-invalid' : '' }}"
                            id="minOrderValue" name="minOrderValue" placeholder="Nhập giá trị đơn hàng tối thiểu" required>
                        @if (session('errors') && session('errors')->has('minOrderValue'))
                            <div class="invalid-feedback">{{ session('errors')->first('minOrderValue') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="maxDiscount">Giá trị giảm tối đa <span class="text-danger">*</span></label>
                        <input type="number" step="0.01"
                            class="form-control {{ session('errors') && session('errors')->has('maxDiscount') ? 'is-invalid' : '' }}"
                            id="maxDiscount" name="maxDiscount" placeholder="Nhập giá trị giảm tối đa" required>
                        @if (session('errors') && session('errors')->has('maxDiscount'))
                            <div class="invalid-feedback">{{ session('errors')->first('maxDiscount') }}</div>
                        @endif
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