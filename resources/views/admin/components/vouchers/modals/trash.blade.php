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
                        @if(isset($deletedVouchers) && count($deletedVouchers) > 0)
                            @foreach ($deletedVouchers as $voucher)
                                <tr>
                                    <td>{{ $voucher->code }}</td>
                                    <td>{{ $voucher->sale }}</td>
                                    <td>{{ $voucher->startDate->format('d/m/Y') }}</td>
                                    <td>{{ $voucher->endDate->format('d/m/Y') }}</td>
                                    <td>{{ $voucher->deleted_at->format('H:i:s - d/m/Y') }}</td>
                                    <td>
                                        <form action="{{ route('admin.vouchers.restore', ['voucher' => $voucher->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Khôi phục</button>
                                        </form>
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
                
                @if(isset($deletedVouchers) && $deletedVouchers->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $deletedVouchers->links() }}
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div> 