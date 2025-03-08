<div class="modal fade" id="trashCourseModal" tabindex="-1" role="dialog" aria-labelledby="trashCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trashCourseModalLabel">Danh sách khóa học đã xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="QA_table mb_30">
                    <table class="table lms_table_active">
                        <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Tên khóa học</th>
                                <th scope="col">Ảnh khóa học</th>
                                <th scope="col">Giá khóa học</th>
                                <th scope="col">Giá giảm khóa học</th>
                                <th scope="col">Ngày xóa</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deletedCourses as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->category->name ?? 'N/A' }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td><img src="{{ asset($item->thumbnail) }}" alt="{{ $item->name }}" width="50"></td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->salePrice }}</td>
                                    <td>{{ $item->deleted_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="action_btns d-flex">
                                            <form action="{{ route('admin.courses.restore', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="action_btn btn btn-outline-success btn-sm" title="Khôi phục"
                                                    onclick="return confirm('Bạn có chắc chắn muốn khôi phục khóa học này?')">
                                                    <i class="fas fa-trash-restore"></i>
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
                            Hiển thị từ {{ ($deletedCourses->currentPage() - 1) * $deletedCourses->perPage() + 1 }}
                            đến {{ min($deletedCourses->currentPage() * $deletedCourses->perPage(), $deletedCourses->total()) }}
                            của {{ $deletedCourses->total() }} bản ghi
                        </div>
                        <div class="">
                            {{ $deletedCourses->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
