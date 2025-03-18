<div class="modal fade" id="trashVoucherModal" tabindex="-1" role="dialog" aria-labelledby="trashVoucherModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trashVoucherModalLabel">Danh sách mã giảm giá đã xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Mã giảm giá</th>
                            <th scope="col">Giá trị giảm</th>
                            <th scope="col">Ngày bắt đầu</th>
                            <th scope="col">Ngày kết thúc</th>
                            <th scope="col">Ngày xóa</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($trashList) && count($trashList) > 0)
                            @foreach ($trashList as $voucher)
                                <tr>
                                    <td>{{ $voucher->code }}</td>
                                    <td>{{ $voucher->sale }}</td>
                                    <td>{{ $voucher->startDate->format('d/m/Y') }}</td>
                                    <td>{{ $voucher->endDate->format('d/m/Y') }}</td>
                                    <td>{{ $voucher->deleted_at->format('H:i:s - d/m/Y') }}</td>
                                    <td>
                                        <div class="action_btns d-flex">
                                            <form action="{{ route('admin.vouchers.restore', $voucher->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="action_btn btn btn-outline-success btn-sm" title="Khôi phục"
                                                    onclick="return confirm('Bạn có chắc chắn muốn khôi phục mã giảm giá này?')">
                                                    <i class="fas fa-trash-restore"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Không có mã giảm giá nào đã bị xóa</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="">
                        Hiển thị từ {{ ($trashPagination['current_page'] - 1) * $trashPagination['per_page'] + 1 }}
                        đến {{ min($trashPagination['current_page'] * $trashPagination['per_page'], $trashPagination['total']) }}
                        của {{ $trashPagination['total'] }} bản ghi
                    </div>
                    <div class="">
                        {{ $trashPagination['links'] }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div> 