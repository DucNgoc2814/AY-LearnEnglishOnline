@extends('admin.layouts.master')
@section('title', 'Quản lý buổi học Zoom')
@section('content')
    <div class="main_content_iner">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section">
                        <div class="white_box_tittle list_header">
                            <h4>Buổi học Zoom</h4>
                            <div class="box_right d-flex lms_block">
                                <div class="serach_field_2">
                                    <div class="search_inner">
                                        <form action="{{ route('admin.zoom-sessions.index') }}" method="GET">
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
                                        data-bs-target="#createZoomSessionModal">
                                        Thêm mới
                                    </button>
                                </div>
                                <div class="add_button ms-2">
                                    <button type="button" class="btn_1" data-bs-toggle="modal"
                                        data-bs-target="#trashZoomSessionModal">
                                        Xem buổi học đã xóa
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="QA_table mb_30">
                            <table class="table lms_table_active">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">STT</th>
                                        <th class="text-center align-middle">Tên khóa học</th>
                                        <th class="text-center align-middle">Tên buổi học</th>
                                        <th class="text-center align-middle">Thời gian bắt đầu</th>
                                        <th class="text-center align-middle">Thời lượng (phút)</th>
                                        <th class="text-center align-middle">Meeting ID</th>
                                        <th class="text-center align-middle">Trạng thái</th>
                                        <th class="text-center align-middle">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($zoomSessions as $key => $item)
                                        <tr>
                                            <td class="text-center align-middle">{{ ($pagination['current_page'] - 1) * $pagination['per_page'] + $key + 1 }}</td>
                                            <td class="text-center align-middle">{{ $item->course->name ?? 'N/A' }}</td>
                                            <td class="text-center align-middle">{{ $item->name }}</td>
                                            <td class="text-center align-middle">{{ \Carbon\Carbon::parse($item->start_time)->format('d/m/Y H:i') }}</td>
                                            <td class="text-center align-middle">{{ $item->duration }}</td>
                                            <td class="text-center align-middle">{{ $item->meeting_id }}</td>
                                            <td class="text-center align-middle">
                                                @if($item->status == 'scheduled')
                                                    <span class="badge bg-primary">Đã lên lịch</span>
                                                @elseif($item->status == 'in_progress')
                                                    <span class="badge bg-success">Đang diễn ra</span>
                                                @elseif($item->status == 'completed')
                                                    <span class="badge bg-secondary">Đã kết thúc</span>
                                                @else
                                                    <span class="badge bg-warning">Chưa xác định</span>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="action_btns d-flex">
                                                    <a href="{{ route('admin.zoom-sessions.show', ['zoomSession' => $item->id]) }}"
                                                        class="action_btn mr_10 btn btn-outline-info btn-sm"
                                                        title="Xem chi tiết">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button type="button"
                                                        class="action_btn mr_10 btn btn-outline-primary btn-sm"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editZoomSessionModal"
                                                        onclick="populateEditModal({{ json_encode($item) }})"
                                                        title="Chỉnh sửa">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('admin.zoom-sessions.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="action_btn btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa buổi học này?')"
                                                            title="Xóa">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @if (count($zoomSessions) == 0)
                                        <tr>
                                            <td colspan="8" class="text-center">Không có dữ liệu</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    Hiển thị từ {{ ($pagination['current_page'] - 1) * $pagination['per_page'] + 1 }}
                                    đến {{ min($pagination['current_page'] * $pagination['per_page'], $pagination['total']) }}
                                    của {{ $pagination['total'] }} bản ghi
                                </div>
                                <div>
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
    @include('admin.components.zoom-sessions.modals.create')

    <!-- Include Edit Modal -->
    @include('admin.components.zoom-sessions.modals.edit')

    <!-- Include Trash Modal -->
    @include('admin.components.zoom-sessions.modals.trash')
@endsection

@push('scripts')
    <script>
        function populateEditModal(item) {
            document.querySelector('#editZoomSessionModal #sessionName').value = item.name;
            document.querySelector('#editZoomSessionModal #courseId').value = item.courseId;
            document.querySelector('#editZoomSessionModal #startTime').value = item.start_time;
            document.querySelector('#editZoomSessionModal #duration').value = item.duration;
            document.querySelector('#editZoomSessionModal #meetingId').value = item.meeting_id;
            document.querySelector('#editZoomSessionModal #status').value = item.status;
            document.querySelector('#editZoomSessionModal #description').value = item.description || '';

            const form = document.querySelector('#editZoomSessionModal form');
            form.action = "{{ route('admin.zoom-sessions.update', '') }}/" + item.id;
        }
    </script>
@endpush
