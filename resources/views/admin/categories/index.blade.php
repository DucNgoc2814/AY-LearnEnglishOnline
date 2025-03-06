@extends('admin.layouts.master')
@section('title', 'Quản lý danh mục')
@section('content')
    <div class="main_content_iner ">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="dashboard_header mb_50">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="dashboard_header_title">
                                    <h3>Danh sách danh mục</h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="dashboard_breadcam text-end">
                                    <p><a href="javascript:;">Dashboard</a> <i class="fas fa-caret-right"></i> Danh mục</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Danh mục</h4>
                            <div class="box_right d-flex lms_block">
                                <div class="serach_field_2">
                                    <div class="search_inner">
                                        <form active="#">
                                            <div class="search_field">
                                                <input type="text" placeholder="Tìm kiếm...">
                                            </div>
                                            <button type="submit"> <i class="ti-search"></i> </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="add_button ms-2">
                                    <button type="button" class="btn_1" data-bs-toggle="modal"
                                        data-bs-target="#createCategoryModal">
                                        Thêm mới
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="QA_table mb_30">
                            <div class="dataTables_wrapper no-footer">
                                <table class="table lms_table_active">
                                    <thead>
                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Tên danh mục</th>
                                            <th scope="col">Số khóa học</th>
                                            <th scope="col">Ngày tạo</th>
                                            <th scope="col">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->courses_count }}</td>
                                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    <div class="action_btns d-flex">
                                                        <a href="{{ route('admin.categories.edit', $item->id) }}"
                                                            class="action_btn mr_10">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.categories.destroy', $item->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="action_btn" title="Xóa"
                                                                onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')"
                                                                style="border: none; background: none; padding: 0;">
                                                                <i class="fas fa-trash text-danger"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="dataTables_paginate paging_simple_numbers mt-3"
                                    id="DataTables_Table_0_paginate">
                                    {{ $items->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Create Modal -->
    @include('admin.categories.modals.create')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // DataTable config
            $('.table').DataTable({
                bLengthChange: false,
                "bDestroy": true,
                language: {
                    search: "<i class='ti-search'></i>",
                    searchPlaceholder: 'Tìm kiếm',
                    paginate: {
                        next: "<i class='ti-arrow-right'></i>",
                        previous: "<i class='ti-arrow-left'></i>"
                    }
                },
                columnDefs: [{
                    visible: false
                }],
                responsive: true,
                searching: false,
            });

            // Xử lý hiển thị lỗi validation trong modal nếu có
            @if(session('errors') && session('errors')->any())
                $('#createCategoryModal').modal('show');
            @endif
        });
    </script>
@endpush

