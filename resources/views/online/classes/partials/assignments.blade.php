@php
    $assignments = $class->assignments()
        ->withCount(['submissions as completed_count' => function($query) {
            $query->whereNotNull('submitted_at');
        }])
        ->orderBy('due_date', 'desc')
        ->paginate(10);
@endphp

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Danh sách bài tập</h5>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createAssignmentModal">
                    <i class="fas fa-plus"></i>
                    Thêm bài tập
                </button>
            </div>
            <div class="card-body">
                @if($assignments->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Bài tập</th>
                                    <th>Hạn nộp</th>
                                    <th class="text-center">Đã nộp</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assignments as $assignment)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $assignment->title }}</div>
                                        <div class="text-muted small">{{ Str::limit($assignment->description, 100) }}</div>
                                    </td>
                                    <td>
                                        <div class="{{ $assignment->due_date->isPast() ? 'text-danger' : '' }}">
                                            {{ $assignment->due_date->format('d/m/Y H:i') }}
                                        </div>
                                        <div class="text-muted small">
                                            {{ $assignment->due_date->diffForHumans() }}
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="badge bg-primary">
                                                {{ $assignment->completed_count }}/{{ $class->students->count() }}
                                            </span>
                                        </div>
                                        <div class="progress mt-1" style="height: 4px; width: 60px;">
                                            <div class="progress-bar" role="progressbar" 
                                                 style="width: {{ ($assignment->completed_count / $class->students->count()) * 100 }}%">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('online.teacher.classes.assignments.show', ['class' => $class->id, 'assignment' => $assignment->id]) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                                Chi tiết
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-primary dropdown-toggle dropdown-toggle-split"
                                                    data-bs-toggle="dropdown">
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href="#" 
                                                       onclick="editAssignment({{ $assignment->id }})">
                                                        <i class="fas fa-edit"></i>
                                                        Chỉnh sửa
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="#"
                                                       onclick="deleteAssignment({{ $assignment->id }})">
                                                        <i class="fas fa-trash"></i>
                                                        Xóa
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $assignments->links() }}
                    </div>
                @else
                    <div class="text-center text-muted py-3">
                        <i class="fas fa-tasks fa-3x mb-3"></i>
                        <p>Chưa có bài tập nào</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Thống kê nộp bài</h5>
            </div>
            <div class="card-body">
                @foreach($class->students as $student)
                @php
                    $total = $assignments->count();
                    $submitted = $student->submissions()
                        ->whereIn('assignment_id', $assignments->pluck('id'))
                        ->whereNotNull('submitted_at')
                        ->count();
                    $rate = $total > 0 ? round(($submitted / $total) * 100, 1) : 0;
                @endphp
                <div class="submission-stat-item mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <div class="d-flex align-items-center">
                            <img src="{{ $student->avatar_url }}" 
                                 alt="{{ $student->name }}" 
                                 class="rounded-circle me-2"
                                 width="32" height="32">
                            <span>{{ $student->name }}</span>
                        </div>
                        <span class="badge bg-{{ $rate >= 80 ? 'success' : ($rate >= 60 ? 'warning' : 'danger') }}">
                            {{ $rate }}%
                        </span>
                    </div>
                    <div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-{{ $rate >= 80 ? 'success' : ($rate >= 60 ? 'warning' : 'danger') }}" 
                             role="progressbar" 
                             style="width: {{ $rate }}%" 
                             aria-valuenow="{{ $rate }}" 
                             aria-valuemin="0" 
                             aria-valuemax="100">
                        </div>
                    </div>
                    <div class="text-muted small mt-1">
                        Đã nộp {{ $submitted }}/{{ $total }} bài
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Create Assignment Modal -->
<div class="modal fade" id="createAssignmentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm bài tập mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="createAssignmentForm">
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả</label>
                        <textarea class="form-control" name="description" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hạn nộp</label>
                        <input type="datetime-local" class="form-control" name="due_date" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">File đính kèm</label>
                        <input type="file" class="form-control" name="attachments[]" multiple>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="submitAssignment()">Thêm bài tập</button>
            </div>
        </div>
    </div>
</div>

<style>
.submission-stat-item {
    padding: 10px;
    border-radius: var(--border-radius);
    transition: background-color 0.2s;
}

.submission-stat-item:hover {
    background-color: var(--bs-gray-100);
}

.progress {
    background-color: var(--bs-gray-200);
}
</style>

<script>
function submitAssignment() {
    const form = document.getElementById('createAssignmentForm');
    const formData = new FormData(form);
    
    fetch(`/online/teacher/classes/{{ $class->id }}/assignments`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            Toast.fire({
                icon: 'error',
                title: data.message || 'Có lỗi xảy ra'
            });
        }
    })
    .catch(error => {
        Toast.fire({
            icon: 'error',
            title: 'Có lỗi xảy ra'
        });
    });
}

function editAssignment(id) {
    // TODO: Implement edit assignment
}

function deleteAssignment(id) {
    Swal.fire({
        title: 'Xác nhận xóa?',
        text: 'Bạn có chắc chắn muốn xóa bài tập này?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/online/teacher/classes/{{ $class->id }}/assignments/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: data.message || 'Có lỗi xảy ra'
                    });
                }
            })
            .catch(error => {
                Toast.fire({
                    icon: 'error',
                    title: 'Có lỗi xảy ra'
                });
            });
        }
    });
}
</script> 