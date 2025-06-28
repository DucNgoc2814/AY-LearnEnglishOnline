@extends('online.layouts.master')

@section('title', 'Vocabulary Progress')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Vocabulary Progress</h1>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-book me-1"></i>
                Lesson 1: Introduction to English - Vocabulary & Listening
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-primary btn-sm">
                    <i class="fas fa-download me-1"></i>Xuất Excel
                </button>
                <button class="btn btn-success btn-sm">
                    <i class="fas fa-sync-alt me-1"></i>Làm mới
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Progress Summary -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-dark">
                                    <div class="small text-muted mb-1">Tổng số học viên</div>
                                    <div class="fw-bold h5 mb-0">20</div>
                                </div>
                                <div class="text-dark">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-dark">
                                    <div class="small text-muted mb-1">Đã nộp trung bình</div>
                                    <div class="fw-bold h5 mb-0">14/20</div>
                                </div>
                                <div class="text-dark">
                                    <i class="fas fa-check-circle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-dark">
                                    <div class="small text-muted mb-1">Tỷ lệ đúng TB</div>
                                    <div class="fw-bold h5 mb-0">80.00%</div>
                                </div>
                                <div class="text-dark">
                                    <i class="fas fa-chart-line fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-dark">
                                    <div class="small text-muted mb-1">Thời gian TB</div>
                                    <div class="fw-bold h5 mb-0">20 phút</div>
                                </div>
                                <div class="text-dark">
                                    <i class="fas fa-clock fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exercise Types Summary -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Kết quả theo loại bài tập
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Loại bài tập</th>
                                            <th class="text-center">Số HV hoàn thành</th>
                                            <th class="text-center">Tỷ lệ đúng TB</th>
                                            <th class="text-center">Thời gian TB</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Ending Sound Exercise</td>
                                            <td class="text-center">15/20</td>
                                            <td class="text-center">85%</td>
                                            <td class="text-center">15 phút</td>
                                        </tr>
                                        <tr>
                                            <td>Grammar Exercise</td>
                                            <td class="text-center">14/20</td>
                                            <td class="text-center">80%</td>
                                            <td class="text-center">20 phút</td>
                                        </tr>
                                        <tr>
                                            <td>Listening & Reading Test</td>
                                            <td class="text-center">13/20</td>
                                            <td class="text-center">75%</td>
                                            <td class="text-center">25 phút</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">Loại bài tập</option>
                        <option value="ending_sound">Ending Sound Exercise</option>
                        <option value="grammar">Grammar Exercise</option>
                        <option value="listening">Listening & Reading Test</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">Trạng thái</option>
                        <option value="completed">Đã hoàn thành</option>
                        <option value="in_progress">Đang làm</option>
                        <option value="not_started">Chưa bắt đầu</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Tìm kiếm học viên...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Students Progress Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 50px">#</th>
                            <th>Học viên</th>
                            <th style="width: 150px">Ending Sound</th>
                            <th style="width: 150px">Grammar</th>
                            <th style="width: 150px">Listening</th>
                            <th style="width: 150px">Tổng điểm</th>
                            <th style="width: 180px">Cập nhật cuối</th>
                            <th style="width: 100px">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data -->
                        <tr>
                            <td class="text-center">1</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" width="40" height="40">
                                    <div>
                                        <div class="fw-bold">Nguyễn Văn A</div>
                                        <small class="text-muted">ID: 12345</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-success" style="width: 90%">90%</div>
                                    </div>
                                    <span class="badge bg-success">9/10</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-success" style="width: 85%">85%</div>
                                    </div>
                                    <span class="badge bg-success">17/20</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-success" style="width: 80%">80%</div>
                                    </div>
                                    <span class="badge bg-success">24/30</span>
                                </div>
                            </td>
                            <td>
                                <h5 class="mb-0 text-center text-success">85%</h5>
                            </td>
                            <td>15/03/2024 14:30</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-primary" title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-info" title="Gửi nhắc nhở">
                                        <i class="fas fa-bell"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" width="40" height="40">
                                    <div>
                                        <div class="fw-bold">Trần Thị B</div>
                                        <small class="text-muted">ID: 12346</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-warning" style="width: 60%">60%</div>
                                    </div>
                                    <span class="badge bg-warning">6/10</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-warning" style="width: 50%">50%</div>
                                    </div>
                                    <span class="badge bg-warning">10/20</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2">
                                        <div class="progress-bar bg-warning" style="width: 40%">40%</div>
                                    </div>
                                    <span class="badge bg-warning">12/30</span>
                                </div>
                            </td>
                            <td>
                                <h5 class="mb-0 text-center text-warning">50%</h5>
                            </td>
                            <td>15/03/2024 10:15</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-primary" title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-info" title="Gửi nhắc nhở">
                                        <i class="fas fa-bell"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://via.placeholder.com/40" class="rounded-circle me-2" width="40" height="40">
                                    <div>
                                        <div class="fw-bold">Lê Văn C</div>
                                        <small class="text-muted">ID: 12347</small>
                                    </div>
                                </div>
                            </td>
                            <td colspan="4" class="text-center">
                                <span class="badge bg-secondary">Chưa làm bài</span>
                            </td>
                            <td>-</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-primary" title="Xem chi tiết">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-info" title="Gửi nhắc nhở">
                                        <i class="fas fa-bell"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted">
                    Hiển thị 1-3 của 20 học viên
                </div>
                <nav>
                    <ul class="pagination mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Trước</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Tiếp</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Modal Chi tiết tiến độ -->
<div class="modal fade" id="progressDetailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết tiến độ học viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="student-info mb-4">
                    <div class="d-flex align-items-center">
                        <img src="" class="rounded-circle me-3" width="60" height="60" id="studentAvatar">
                        <div>
                            <h5 class="mb-1" id="studentName"></h5>
                            <p class="mb-0 text-muted" id="studentEmail"></p>
                        </div>
                    </div>
                </div>

                <!-- Quizlet Progress -->
                <div class="card mb-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Quizlet Progress</h6>
                    </div>
                    <div class="card-body">
                        <div class="quizlet-checkboxes mb-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="flashcardsCheck" disabled>
                                        <label class="form-check-label" for="flashcardsCheck">
                                            <i class="fas fa-clone me-1"></i> Học với Flashcards
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="learnCheck" disabled>
                                        <label class="form-check-label" for="learnCheck">
                                            <i class="fas fa-graduation-cap me-1"></i> Học (Learn)
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="writeCheck" disabled>
                                        <label class="form-check-label" for="writeCheck">
                                            <i class="fas fa-pencil-alt me-1"></i> Viết (Write)
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="testCheck" disabled>
                                        <label class="form-check-label" for="testCheck">
                                            <i class="fas fa-tasks me-1"></i> Kiểm tra (Test)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="last-activity text-muted">
                            <small>Hoạt động gần nhất: <span id="quizletLastActivity">-</span></small>
                        </div>
                    </div>
                </div>

                <!-- Other Exercises Progress -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">Chi tiết các bài tập</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Loại bài tập</th>
                                        <th style="width: 150px">Số câu đã làm</th>
                                        <th style="width: 200px">Thời gian làm gần nhất</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Dictation</td>
                                        <td id="dictationProgress">0/0</td>
                                        <td id="dictationLastAttempt">-</td>
                                    </tr>
                                    <tr>
                                        <td>Key Phrases</td>
                                        <td id="keyPhrasesProgress">0/0</td>
                                        <td id="keyPhrasesLastAttempt">-</td>
                                    </tr>
                                    <tr>
                                        <td>Sentence Building</td>
                                        <td id="sentenceBuildingProgress">0/0</td>
                                        <td id="sentenceBuildingLastAttempt">-</td>
                                    </tr>
                                    <tr>
                                        <td>Grammar</td>
                                        <td id="grammarProgress">0/0</td>
                                        <td id="grammarLastAttempt">-</td>
                                    </tr>
                                    <tr>
                                        <td>Transcription</td>
                                        <td id="transcriptionProgress">0/0</td>
                                        <td id="transcriptionLastAttempt">-</td>
                                    </tr>
                                    <tr>
                                        <td>Ending Sound</td>
                                        <td id="endingSoundProgress">0/0</td>
                                        <td id="endingSoundLastAttempt">-</td>
                                    </tr>
                                    <tr>
                                        <td>Listening and Reading</td>
                                        <td id="listeningProgress">0/0</td>
                                        <td id="listeningLastAttempt">-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.progress {
    height: 20px;
}
.progress-bar {
    line-height: 20px;
    font-size: 0.875rem;
}
.table > :not(caption) > * > * {
    vertical-align: middle;
}

/* Styles cho modal chi tiết */
.student-info {
    border-bottom: 1px solid #dee2e6;
    padding-bottom: 1rem;
}

.quizlet-checkboxes .form-check {
    padding: 0.5rem;
    border-radius: 0.25rem;
    transition: background-color 0.2s;
}

.quizlet-checkboxes .form-check:hover {
    background-color: #f8f9fa;
}

.quizlet-checkboxes .form-check-input:checked {
    background-color: #198754;
    border-color: #198754;
}

.quizlet-checkboxes .form-check-input:disabled:checked {
    opacity: 1;
}

.card-header {
    background-color: #f8f9fa;
}

.progress-sections .card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.last-activity {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #dee2e6;
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Handle filters
    $('select, input').on('change keyup', function() {
        // Add your filter logic here
    });

    // Handle refresh button
    $('.btn-success').on('click', function() {
        // Add your refresh logic here
    });

    // Handle export button
    $('.btn-primary').on('click', function() {
        // Add your export logic here
    });

    // Khởi tạo modal
    const progressModal = new bootstrap.Modal(document.getElementById('progressDetailModal'));

    // Xử lý khi click nút xem chi tiết
    $('.btn-primary[title="Xem chi tiết"]').on('click', function() {
        const row = $(this).closest('tr');
        const studentId = row.find('small.text-muted').text().replace('ID: ', '');

        // Cập nhật thông tin học viên trong modal
        $('#studentAvatar').attr('src', row.find('img').attr('src'));
        $('#studentName').text(row.find('.fw-bold').text());
        $('#studentEmail').text(row.find('td:eq(2)').text());

        // Gọi API để lấy dữ liệu chi tiết
        fetchStudentProgress(studentId);

        // Hiển thị modal
        progressModal.show();
    });

    // Hàm lấy dữ liệu chi tiết tiến độ học viên
    function fetchStudentProgress(studentId) {
        // Giả lập dữ liệu API - Thay thế bằng call API thực tế
        const mockData = {
            quizlet: {
                flashcards: true,
                learn: true,
                write: false,
                test: true,
                lastActivity: '2024-03-15 14:30'
            },
            exercises: {
                dictation: {
                    completed: 8,
                    total: 10,
                    lastAttempt: '2024-03-15 14:00'
                },
                keyPhrases: {
                    completed: 15,
                    total: 20,
                    lastAttempt: '2024-03-15 13:45'
                },
                sentenceBuilding: {
                    completed: 12,
                    total: 15,
                    lastAttempt: '2024-03-15 13:30'
                },
                grammar: {
                    completed: 18,
                    total: 20,
                    lastAttempt: '2024-03-15 13:15'
                },
                transcription: {
                    completed: 5,
                    total: 8,
                    lastAttempt: '2024-03-15 13:00'
                },
                endingSound: {
                    completed: 10,
                    total: 10,
                    lastAttempt: '2024-03-15 12:45'
                },
                listening: {
                    completed: 25,
                    total: 30,
                    lastAttempt: '2024-03-15 12:30'
                }
            }
        };

        // Cập nhật Quizlet checkboxes
        $('#flashcardsCheck').prop('checked', mockData.quizlet.flashcards);
        $('#learnCheck').prop('checked', mockData.quizlet.learn);
        $('#writeCheck').prop('checked', mockData.quizlet.write);
        $('#testCheck').prop('checked', mockData.quizlet.test);
        $('#quizletLastActivity').text(mockData.quizlet.lastActivity);

        // Cập nhật tiến độ các bài tập
        $('#dictationProgress').text(`${mockData.exercises.dictation.completed}/${mockData.exercises.dictation.total}`);
        $('#dictationLastAttempt').text(mockData.exercises.dictation.lastAttempt);

        $('#keyPhrasesProgress').text(`${mockData.exercises.keyPhrases.completed}/${mockData.exercises.keyPhrases.total}`);
        $('#keyPhrasesLastAttempt').text(mockData.exercises.keyPhrases.lastAttempt);

        $('#sentenceBuildingProgress').text(`${mockData.exercises.sentenceBuilding.completed}/${mockData.exercises.sentenceBuilding.total}`);
        $('#sentenceBuildingLastAttempt').text(mockData.exercises.sentenceBuilding.lastAttempt);

        $('#grammarProgress').text(`${mockData.exercises.grammar.completed}/${mockData.exercises.grammar.total}`);
        $('#grammarLastAttempt').text(mockData.exercises.grammar.lastAttempt);

        $('#transcriptionProgress').text(`${mockData.exercises.transcription.completed}/${mockData.exercises.transcription.total}`);
        $('#transcriptionLastAttempt').text(mockData.exercises.transcription.lastAttempt);

        $('#endingSoundProgress').text(`${mockData.exercises.endingSound.completed}/${mockData.exercises.endingSound.total}`);
        $('#endingSoundLastAttempt').text(mockData.exercises.endingSound.lastAttempt);

        $('#listeningProgress').text(`${mockData.exercises.listening.completed}/${mockData.exercises.listening.total}`);
        $('#listeningLastAttempt').text(mockData.exercises.listening.lastAttempt);
    }
});
</script>
@endpush
@endsection
