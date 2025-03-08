<div class="modal fade" id="trashCategoryModal" tabindex="-1" role="dialog" aria-labelledby="trashCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trashCategoryModalLabel">Danh sách danh mục đã xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tên danh mục</th>
                            <th scope="col">Số khóa học</th>
                            <th scope="col">Ngày xóa</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($trashList) && count($trashList) > 0)
                            @foreach ($trashList as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->courses_count }}</td>
                                    <td>{{ \Carbon\Carbon::parse($category->deleted_at)->format('d/m/Y') }}</td>
                                    <td>
                                        <form action="{{ route('admin.categories.restore', $category->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Khôi phục</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">Không có danh mục nào đã xóa.</td>
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