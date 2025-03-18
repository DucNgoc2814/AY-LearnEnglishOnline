@extends('admin.layouts.master')
@section('title', 'Quản lý mã giảm giá')
@section('content')
    <div class="main_content_iner">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Mã giảm giá</h4>
                            <div class="box_right d-flex lms_block">
                                <div class="serach_field_2">
                                    <div class="search_inner">
                                        <form action="{{ route('admin.vouchers.index') }}" method="GET">
                                            <div class="search_field">
                                                <input type="text" name="search" placeholder="Tìm kiếm..."
                                                    value="{{ request('search') }}">
                                            </div>
                                            <button type="submit"> <i class="ti-search"></i> </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="add_button ms-2">
                                    <button type="button" class="btn_1" data-bs-toggle="modal"
                                        data-bs-target="#createVoucherModal">
                                        Thêm mới
                                    </button>
                                </div>
                                <div class="add_button ms-2">
                                    <button type="button" class="btn_1" data-bs-toggle="modal"
                                        data-bs-target="#trashVoucherModal">
                                        Xem mã giảm giá đã xóa
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="QA_table mb_30">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã giảm giá</th>
                                        <th>Giá trị giảm</th>
                                        <th>Ngày áp dụng</th>
                                        <th>Đã sử dụng</th>
                                        <th>Số lượng</th>
                                        <th>Trạng thái</th>
                                        <th class="text-center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vouchers as $key => $item)
                                        <tr>
                                            <td>{{ ($pagination['current_page'] - 1) * $pagination['per_page'] + $key + 1 }}</td>
                                            <td>{{ $item->code }}</td>
                                            <td>{{ $item->sale }}</td>
                                            <td>{{ $item->startDate->format('d/m/Y') }} - {{ $item->endDate->format('d/m/Y') }}</td>
                                            <td>{{ $item->usageCount }}</td>
                                            <td>{{ $item->maxUsage ?? 'Không giới hạn' }}</td>
                                            <td>
                                                @php
                                                    // Get current date as timestamp
                                                    $now = time();
                                                    $startTimestamp = strtotime($item->startDate);
                                                    $endTimestamp = strtotime($item->endDate);
                                                    
                                                    // Check if current date is within the valid date range
                                                    $isDateValid = ($now >= $startTimestamp && $now <= $endTimestamp);
                                                    
                                                    // For testing/debugging - force all future dates to be valid
                                                    if ($startTimestamp > $now) {
                                                        $isDateValid = true;
                                                    }
                                                    
                                                    // Check if usage count is within limits
                                                    $isUsageValid = ($item->maxUsage === null || $item->usageCount < $item->maxUsage);
                                                    
                                                    $isValid = $isDateValid && $isUsageValid;
                                                @endphp
                                                
                                                @if($isValid)
                                                    <span class="badge bg-success">Có hiệu lực</span>
                                                @else
                                                    <span class="badge bg-danger">Hết hiệu lực</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="action_btns d-flex">
                                                    <button type="button"
                                                        class="action_btn mr_10 btn btn-outline-primary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#editVoucherModal"
                                                        onclick="populateEditModal({{ json_encode($item) }})"
                                                        title="Chỉnh sửa">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('admin.vouchers.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="action_btn btn btn-outline-danger btn-sm" title="Xóa"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa mã giảm giá này?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="">
                                    Hiển thị từ {{ ($pagination['current_page'] - 1) * $pagination['per_page'] + 1 }}
                                    đến {{ min($pagination['current_page'] * $pagination['per_page'], $pagination['total']) }}
                                    của {{ $pagination['total'] }} bản ghi
                                </div>
                                <div class="">
                                    {{ $pagination['links'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Create Modal -->
    @include('admin.components.vouchers.modals.create')

    <!-- Include Edit Modal -->
    @include('admin.components.vouchers.modals.edit')

    <!-- Include Trash Modal -->
    @include('admin.components.vouchers.modals.trash')

    <script>
        function populateEditModal(voucher) {
            const form = document.querySelector('#editVoucherForm');
            
            document.querySelector('#editVoucherForm #code').value = voucher.code;
            document.querySelector('#editVoucherForm #sale').value = voucher.sale;
            
            // Format dates for datetime-local input
            const startDate = new Date(voucher.startDate);
            const endDate = new Date(voucher.endDate);
            
            const formatDate = (date) => {
                return date.toISOString().slice(0, 16);
            };
            
            document.querySelector('#editVoucherForm #startDate').value = formatDate(startDate);
            document.querySelector('#editVoucherForm #endDate').value = formatDate(endDate);
            
            document.querySelector('#editVoucherForm #maxUsage').value = voucher.maxUsage;
            document.querySelector('#editVoucherForm #minOrderValue').value = voucher.minOrderValue;
            document.querySelector('#editVoucherForm #maxDiscount').value = voucher.maxDiscount;
            form.setAttribute('action', '{{ url('admin/vouchers') }}/' + voucher.id);
        }
    </script>
@endsection 