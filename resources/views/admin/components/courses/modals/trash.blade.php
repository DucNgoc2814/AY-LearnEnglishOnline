<div class="modal fade" id="trashCourseModal" tabindex="-1" role="dialog" aria-labelledby="trashCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trashCourseModalLabel">Danh sách khóa học đã xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên khóa học</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Ngày xóa</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($deletedCourses) && count($deletedCourses) > 0)
                            @foreach ($deletedCourses as $key => $course)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->category->name ?? 'N/A' }}</td>
                                    <td>{{ $course->price }}</td>
                                    <td>{{ $course->deleted_at->format('H:i:s - d/m/Y') }}</td>
                                    <td>
                                        <form action="{{ route('admin.courses.restore', ['course' => $course->id]) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Khôi phục</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">Không có khóa học nào đã xóa.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                @if(isset($deletedCourses) && count($deletedCourses) > 0)
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
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div> 