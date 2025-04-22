<div class="grades-tab-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Điểm số lớp học</h4>
        <div>
            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addGradeItemModal">
                <i class="fas fa-plus"></i> Thêm điểm đánh giá
            </button>
            <button type="button" class="btn btn-success" id="exportGradesBtn">
                <i class="fas fa-file-export"></i> Xuất Excel
            </button>
        </div>
    </div>

    <!-- Thống kê điểm -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Số sinh viên</h5>
                    <h2 class="mb-0">{{ is_countable($students) ? count($students) : 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Điểm trung bình</h5>
                    <h2 class="mb-0">{{ isset($averages['class']) ? number_format($averages['class'], 1) : 'N/A' }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Điểm cao nhất</h5>
                    <h2 class="mb-0">{{ isset($averages['highest']) ? number_format($averages['highest'], 1) : 'N/A' }}</h2>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title">Điểm thấp nhất</h5>
                    <h2 class="mb-0">{{ isset($averages['lowest']) ? number_format($averages['lowest'], 1) : 'N/A' }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Biểu đồ phân bố điểm -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-chart-bar"></i> Phân bố điểm
        </div>
        <div class="card-body">
            <canvas id="gradeDistributionChart" width="100%" height="30"></canvas>
        </div>
    </div>

    <!-- Bảng điểm -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table"></i> Bảng điểm sinh viên
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="gradesTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-middle">STT</th>
                            <th rowspan="2" class="align-middle">Mã SV</th>
                            <th rowspan="2" class="align-middle">Họ tên</th>
                            @if(isset($gradeItems) && count($gradeItems) > 0)
                                @foreach($gradeItems as $item)
                                <th class="text-center">
                                    {{ $item['name'] }}
                                    <small class="d-block text-muted">({{ $item['weight'] }}%)</small>
                                </th>
                                @endforeach
                            @endif
                            <th rowspan="2" class="align-middle text-center">Điểm TB</th>
                            <th rowspan="2" class="align-middle text-center">Đánh giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($students) && count($students) > 0)
                            @foreach($students as $index => $student)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $student['student_id'] }}</td>
                                <td>{{ $student['name'] }}</td>
                                @if(isset($gradeItems) && count($gradeItems) > 0)
                                    @foreach($gradeItems as $itemId => $item)
                                    <td class="text-center">
                                        <div class="grade-cell" data-student-id="{{ $student['id'] }}" data-item-id="{{ $itemId }}">
                                            @if(isset($student['grades'][$itemId]))
                                                <span class="grade-value">{{ $student['grades'][$itemId] }}</span>
                                                <a href="#" class="edit-grade-link ms-2"><i class="fas fa-edit"></i></a>
                                            @else
                                                <a href="#" class="add-grade-link">Nhập điểm</a>
                                            @endif
                                        </div>
                                    </td>
                                    @endforeach
                                @endif
                                <td class="text-center fw-bold">
                                    {{ isset($student['average']) ? number_format($student['average'], 1) : 'N/A' }}
                                </td>
                                <td class="text-center">
                                    @if(isset($student['average']))
                                        @if($student['average'] >= 8.5)
                                            <span class="badge bg-success">Xuất sắc</span>
                                        @elseif($student['average'] >= 7.0)
                                            <span class="badge bg-primary">Tốt</span>
                                        @elseif($student['average'] >= 5.5)
                                            <span class="badge bg-info">Khá</span>
                                        @elseif($student['average'] >= 4.0)
                                            <span class="badge bg-warning">Trung bình</span>
                                        @else
                                            <span class="badge bg-danger">Không đạt</span>
                                        @endif
                                    @else
                                        <span class="badge bg-secondary">Chưa có điểm</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="{{ count($gradeItems ?? []) + 5 }}" class="text-center">Không có sinh viên nào</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Thêm đầu điểm -->
<div class="modal fade" id="addGradeItemModal" tabindex="-1" aria-labelledby="addGradeItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addGradeItemModalLabel">Thêm đầu điểm đánh giá</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="grade_item_name" class="form-label">Tên đầu điểm</label>
                        <input type="text" class="form-control" id="grade_item_name" name="name" required placeholder="VD: Giữa kỳ, Cuối kỳ, Bài tập 1...">
                    </div>
                    <div class="mb-3">
                        <label for="grade_item_description" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="grade_item_description" name="description" rows="3" placeholder="Mô tả chi tiết về đầu điểm này"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="grade_item_weight" class="form-label">Trọng số (%)</label>
                        <input type="number" class="form-control" id="grade_item_weight" name="weight" required min="0" max="100" value="10">
                        <div class="form-text">Trọng số các đầu điểm phải có tổng là 100%</div>
                    </div>
                    <div class="mb-3">
                        <label for="grade_max_score" class="form-label">Điểm tối đa</label>
                        <input type="number" class="form-control" id="grade_max_score" name="max_score" required min="1" value="10" step="0.1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal nhập/sửa điểm -->
<div class="modal fade" id="editGradeModal" tabindex="-1" aria-labelledby="editGradeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('online.teacher.classes.grades.update', $class->id) }}" method="POST">
                @csrf
                <input type="hidden" name="student_id" id="edit_grade_student_id">
                <input type="hidden" name="grade_item_id" id="edit_grade_item_id">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="editGradeModalLabel">Nhập điểm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_grade_student_name" class="form-label">Sinh viên</label>
                        <input type="text" class="form-control" id="edit_grade_student_name" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit_grade_item_name" class="form-label">Đầu điểm</label>
                        <input type="text" class="form-control" id="edit_grade_item_name" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="edit_grade_value" class="form-label">Điểm số</label>
                        <input type="number" class="form-control" id="edit_grade_value" name="grade_value" required min="0" max="10" step="0.1">
                    </div>
                    <div class="mb-3">
                        <label for="edit_grade_note" class="form-label">Ghi chú</label>
                        <textarea class="form-control" id="edit_grade_note" name="note" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Khởi tạo DataTable
        var gradesTable = $('#gradesTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json'
            },
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        
        // Xử lý khi click vào link nhập/sửa điểm
        $('.add-grade-link, .edit-grade-link').on('click', function(e) {
            e.preventDefault();
            var cell = $(this).closest('.grade-cell');
            var studentId = cell.data('student-id');
            var itemId = cell.data('item-id');
            var studentName = $(this).closest('tr').find('td:eq(2)').text();
            var itemName = $('#gradesTable thead th:eq(' + ($(this).closest('td').index()) + ')').text().trim();
            var gradeValue = cell.find('.grade-value').text() || '';
            
            $('#edit_grade_student_id').val(studentId);
            $('#edit_grade_item_id').val(itemId);
            $('#edit_grade_student_name').val(studentName);
            $('#edit_grade_item_name').val(itemName);
            $('#edit_grade_value').val(gradeValue);
            
            $('#editGradeModal').modal('show');
        });
        
        // Khởi tạo biểu đồ phân bố điểm
        var ctx = document.getElementById('gradeDistributionChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['0-4', '4-5.5', '5.5-7', '7-8.5', '8.5-10'],
                    datasets: [{
                        label: 'Số sinh viên',
                        data: [
                            {{ isset($distribution) ? $distribution['0-4'] : 0 }},
                            {{ isset($distribution) ? $distribution['4-5.5'] : 0 }},
                            {{ isset($distribution) ? $distribution['5.5-7'] : 0 }},
                            {{ isset($distribution) ? $distribution['7-8.5'] : 0 }},
                            {{ isset($distribution) ? $distribution['8.5-10'] : 0 }}
                        ],
                        backgroundColor: [
                            'rgba(220, 53, 69, 0.5)',
                            'rgba(255, 193, 7, 0.5)',
                            'rgba(23, 162, 184, 0.5)',
                            'rgba(0, 123, 255, 0.5)',
                            'rgba(40, 167, 69, 0.5)'
                        ],
                        borderColor: [
                            'rgb(220, 53, 69)',
                            'rgb(255, 193, 7)',
                            'rgb(23, 162, 184)',
                            'rgb(0, 123, 255)',
                            'rgb(40, 167, 69)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }
        
        // Xuất Excel
        $('#exportGradesBtn').on('click', function() {
            window.location.href = "{{ route('online.teacher.classes.grades.export', $class->id) }}";
        });
    });
</script> 