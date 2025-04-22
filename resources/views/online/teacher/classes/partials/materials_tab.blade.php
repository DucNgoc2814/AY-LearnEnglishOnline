<div class="materials-tab-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Tài liệu lớp học</h4>
        <div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#uploadClassMaterialModal">
                <i class="fas fa-upload"></i> Tải lên tài liệu lớp học
            </button>
        </div>
    </div>

    <!-- Thống kê tài liệu -->
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Tổng số tài liệu: {{ count($materials) }}</div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Buổi học có tài liệu: {{ count($materials) > 0 ? count(array_unique(array_column($materials, 'session_id'))) : 0 }}</div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">Buổi học gần nhất: {{ count($materials) > 0 ? $materials[0]['session_date'] : 'N/A' }}</div>
            </div>
        </div>
    </div>

    <!-- Filter -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-filter"></i> Bộ lọc
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label for="materialType" class="form-label">Loại tài liệu</label>
                    <select class="form-select" id="materialType">
                        <option value="">Tất cả</option>
                        <option value="document">Tài liệu (.doc, .pdf)</option>
                        <option value="presentation">Bài giảng (.ppt)</option>
                        <option value="worksheet">Bài tập (.xlsx)</option>
                        <option value="video">Video</option>
                        <option value="audio">Audio</option>
                    </select>
                </div>
                <div class="col-md-4 mb-2">
                    <label for="sessionFilter" class="form-label">Buổi học</label>
                    <select class="form-select" id="sessionFilter">
                        <option value="">Tất cả buổi học</option>
                        @foreach($class->sessions->sortByDesc('session_date') as $session)
                            <option value="{{ $session->id }}">{{ $session->session_date->format('d/m/Y') }} - {{ $session->topic ?? 'Chưa có chủ đề' }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-2">
                    <label for="searchMaterial" class="form-label">Tìm kiếm</label>
                    <input type="text" class="form-control" id="searchMaterial" placeholder="Tên tài liệu...">
                </div>
            </div>
        </div>
    </div>

    <!-- Danh sách tài liệu -->
    <div class="table-responsive">
        <table class="table table-bordered" id="materialsTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Buổi học</th>
                    <th>Tên tài liệu</th>
                    <th>Mô tả</th>
                    <th>Ngày tải lên</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @if(count($materials) > 0)
                    @foreach($materials as $index => $material)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $material['session_date'] }}</td>
                        <td>{{ $material['name'] }}</td>
                        <td>{{ $material['description'] }}</td>
                        <td>{{ $material['uploaded_at'] }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ $material['url'] }}" class="btn btn-sm btn-primary" target="_blank">
                                    <i class="fas fa-download"></i> Tải xuống
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteMaterialModal" 
                                        data-material-id="{{ $material['id'] }}" data-material-name="{{ $material['name'] }}">
                                    <i class="fas fa-trash"></i> Xóa
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">Chưa có tài liệu nào</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Modal tải lên tài liệu lớp học -->
<div class="modal fade" id="uploadClassMaterialModal" tabindex="-1" aria-labelledby="uploadClassMaterialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('online.teacher.classes.materials.upload', $class->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadClassMaterialModalLabel">Tải lên tài liệu lớp học</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="class_material_name" class="form-label">Tên tài liệu</label>
                        <input type="text" class="form-control" id="class_material_name" name="material_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="material_session" class="form-label">Buổi học</label>
                        <select class="form-select" id="material_session" name="session_id">
                            <option value="">-- Không liên kết với buổi học cụ thể --</option>
                            @foreach($class->sessions->sortByDesc('session_date') as $session)
                                <option value="{{ $session->id }}">{{ $session->session_date->format('d/m/Y') }} - {{ $session->topic ?? 'Chưa có chủ đề' }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="class_material_file" class="form-label">File tài liệu</label>
                        <input type="file" class="form-control" id="class_material_file" name="material_file" required>
                    </div>
                    <div class="mb-3">
                        <label for="class_material_description" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="class_material_description" name="material_description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Tải lên</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal xóa tài liệu -->
<div class="modal fade" id="deleteMaterialModal" tabindex="-1" aria-labelledby="deleteMaterialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('online.teacher.classes.materials.delete', ['id' => ':id']) }}" method="POST" id="deleteMaterialForm">
                @csrf
                @method('DELETE')
                
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMaterialModalLabel">Xác nhận xóa tài liệu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn xóa tài liệu "<span id="deleteMaterialNameDisplay"></span>"?</p>
                    <p class="text-danger">Lưu ý: Hành động này không thể hoàn tác!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Khởi tạo DataTable
        var materialsTable = $('#materialsTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
            },
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        
        // Lọc theo loại tài liệu
        $('#materialType').on('change', function() {
            materialsTable.column(2).search($(this).val()).draw();
        });
        
        // Lọc theo buổi học
        $('#sessionFilter').on('change', function() {
            materialsTable.column(1).search($(this).val()).draw();
        });
        
        // Tìm kiếm tài liệu
        $('#searchMaterial').on('keyup', function() {
            materialsTable.search($(this).val()).draw();
        });
        
        // Modal xóa tài liệu
        $('#deleteMaterialModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var materialId = button.data('material-id');
            var materialName = button.data('material-name');
            
            var form = $('#deleteMaterialForm');
            var action = form.attr('action');
            form.attr('action', action.replace(':id', materialId));
            
            $('#deleteMaterialNameDisplay').text(materialName);
        });
    });
</script> 