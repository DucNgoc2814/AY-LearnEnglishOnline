<div class="modal fade" id="trashVideoLessonModal" tabindex="-1" role="dialog" aria-labelledby="trashVideoLessonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trashVideoLessonModalLabel">Danh sách bài giảng video đã xóa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="QA_table">
                    <table class="table lms_table_active">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">Tên bài học</th>
                                <th class="text-center align-middle">Tên video</th>
                                <th class="text-center align-middle">Video</th>
                                <th class="text-center align-middle">Thời lượng</th>
                                <th class="text-center align-middle">Định dạng</th>
                                <th class="text-center align-middle">Ngày xóa</th>
                                <th class="text-center align-middle">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($trashListVideoLesson) && count($trashListVideoLesson) > 0)
                                @foreach ($trashListVideoLesson as $video)
                                    <tr>
                                        <td class="text-center align-middle">{{ $video->lesson->name ?? 'N/A' }}</td>
                                        <td class="text-center align-middle">{{ $video->name }}</td>
                                        <td class="text-center align-middle">
                                            <button type="button"
                                                class="btn btn-info btn-sm text-white"
                                                onclick="showVideo('{{ $video->videoUrl }}')"
                                                title="Xem video">
                                                <i class="fas fa-play me-1 text-white"></i>
                                                XEM VIDEO BÀI HỌC
                                            </button>
                                        </td>
                                        <td class="text-center align-middle">
                                            @if($video->duration)
                                                @php
                                                    $minutes = floor($video->duration / 60);
                                                    $seconds = $video->duration % 60;
                                                    $durationText = $minutes . ' phút ' . $seconds . ' giây';
                                                @endphp
                                                {{ $durationText }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">{{ $video->videoType }}</td>
                                        <td class="text-center align-middle">
                                            {{ \Carbon\Carbon::parse($video->deleted_at)->format('d/m/Y H:i:s') }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="action_btns d-flex justify-content-center">
                                                <form action="{{ route('admin.video-lessons.restore', $video->id) }}"
                                                      method="POST"
                                                      class="d-inline">
                                                    @csrf
                                                    <button type="submit"
                                                        class="action_btn btn btn-outline-success btn-sm"
                                                        title="Khôi phục"
                                                        onclick="return confirm('Bạn có chắc chắn muốn khôi phục video này?')">
                                                        <i class="fas fa-trash-restore"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">Không có bài giảng video nào đã xóa.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                @if(isset($trashPaginationVideoLesson))
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            Hiển thị từ {{ ($trashPaginationVideoLesson['current_page'] - 1) * $trashPaginationVideoLesson['per_page'] + 1 }}
                            đến {{ min($trashPaginationVideoLesson['current_page'] * $trashPaginationVideoLesson['per_page'], $trashPaginationVideoLesson['total']) }}
                            của {{ $trashPaginationVideoLesson['total'] }} bản ghi
                        </div>
                        <div>
                            {{ $trashPaginationVideoLesson['links'] }}
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
