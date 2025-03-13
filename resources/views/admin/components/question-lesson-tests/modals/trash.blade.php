<div class="modal fade" id="trashLessonModal" tabindex="-1" role="dialog" aria-labelledby="trashLessonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trashLessonModalLabel">Danh sách bài học đã xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tên khóa học</th>
                            <th scope="col">Tên bài học</th>
                            <th scope="col">Thứ tự</th>
                            <th scope="col">Cho phép xem thử</th>
                            <th scope="col">Ngày xóa</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($trashList) && count($trashList) > 0)
                            @foreach ($trashList as $lesson)
                                <tr>
                                    <td>{{ $lesson->course->name ?? 'N/A' }}</td>
                                    <td>{{ $lesson->name }}</td>
                                    <td>{{ $lesson->orderNumber }}</td>
                                    <td>{{ $lesson->isPreview ? 'Có' : 'Không' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($lesson->deleted_at)->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="action_btns d-flex">
                                            <form action="{{ route('admin.lessons.restore', $lesson->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="action_btn btn btn-outline-success btn-sm" title="Khôi phục"
                                                    onclick="return confirm('Bạn có chắc chắn muốn khôi phục bài học này?')">
                                                    <i class="fas fa-trash-restore"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Không có bài học nào đã xóa.</td>
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
