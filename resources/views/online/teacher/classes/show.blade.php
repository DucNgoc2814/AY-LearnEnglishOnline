@extends('online.layouts.master')

@section('title', 'Chi tiết lớp học')

@push('styles')
    <style>
        .stats-card {
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            transition: transform 0.2s;
        }

        .stats-card:hover {
            transform: translateY(-3px);
        }

        .tab-content {
            padding: 1rem;
        }

        .progress {
            height: 20px;
        }

        .progress-bar {
            line-height: 20px;
            font-size: 0.875rem;
        }

        .student-attendance {
            width: 100px;
        }

        .materials-container .accordion-button {
            background-color: transparent !important;
            box-shadow: none !important;
        }

        .materials-container .accordion-button:focus {
            box-shadow: none !important;
            border-color: rgba(0, 0, 0, .125) !important;
        }

        /* Style cho Lesson */
        .materials-container .lesson-item>.accordion-header>.accordion-button {
            background-color: #fff !important;
            font-weight: 600;
            font-size: 1.1rem;
        }

        /* Style cho Before/During/After */
        .materials-container .level-1 {
            margin-left: 1.5rem;
            border-left: 2px solid #e9ecef;
        }

        .materials-container .level-1>.accordion-header>.accordion-button {
            background-color: #e3f2fd !important;
            font-weight: 600;
        }

        /* Style cho các mục con trong Before/During/After */
        .materials-container .level-2 {
            margin-left: 3rem;
            border-left: 2px solid #e9ecef;
        }

        .materials-container .level-2>.accordion-header>.accordion-button {
            background-color: #f8f9fa !important;
        }

        .materials-container .level-3 {
            margin-left: 4.5rem;
        }

        .materials-container .accordion-item {
            border: none;
        }

        .materials-container .list-group-item {
            border-left: none;
            border-right: none;
        }

        .student-progress {
            width: 150px;
        }

        .student-list th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .student-list td {
            vertical-align: middle;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Lớp IELTS 7.0</h1>

        <!-- Thông tin cơ bản về lớp học -->
        <div class="row mb-4">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-info-circle me-1"></i>
                        Thông tin lớp học
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title mb-0">Lớp IELTS 7.0</h5>
                            <span class="badge bg-success">Đang hoạt động</span>
                        </div>
                        <p><strong>Mã lớp:</strong> IELTS70-01</p>
                        <p><strong>Khóa học:</strong> IELTS Target 7.0</p>
                        <p><strong>Thời gian:</strong> 01/01/2024 - 30/06/2024</p>
                        <p><strong>Lịch học:</strong> Thứ 2, Thứ 4, Thứ 6</p>
                        <p><strong>Số học viên:</strong> 15/20</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Thống kê
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-body py-3">
                                        <h5 class="mb-0">15</h5>
                                        <div>Học viên</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card bg-success text-white">
                                    <div class="card-body py-3">
                                        <h5 class="mb-0">24</h5>
                                        <div>Buổi học</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card bg-info text-white">
                                    <div class="card-body py-3">
                                        <h5 class="mb-0">85%</h5>
                                        <div>Tỷ lệ điểm danh</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="card bg-warning text-white">
                                    <div class="card-body py-3">
                                        <h5 class="mb-0">75%</h5>
                                        <div>Hoàn thành</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Materials Section with Student Progress -->
        <div class="materials-container">
            <div class="accordion" id="lessonsAccordion">
                <!-- Lesson 1 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#lesson1"
                            aria-expanded="true">
                            <i class="fas fa-book me-2"></i> Lesson 1: Introduction to English
                        </button>
                    </h2>
                    <div id="lesson1" class="accordion-collapse collapse show" data-bs-parent="#lessonsAccordion">
                        <div class="accordion-body p-0">
                            <div class="accordion" id="lesson1Materials">
                                <!-- Before Class Materials -->
                                <div class="accordion-item mb-3 level-1">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#beforeClassMaterials" aria-expanded="true">
                                            <i class="fas fa-hourglass-start me-2"></i> Before Class Materials
                                        </button>
                                    </h2>
                                    <div id="beforeClassMaterials" class="accordion-collapse collapse show"
                                        data-bs-parent="#lesson1Materials">
                                        <div class="accordion-body p-0">
                                            <div class="accordion" id="beforeLessonsAccordion">
                                                <!-- Video Exercise Progress -->
                                                <div class="accordion-item level-2">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#videoProgress">
                                                            <i class="fas fa-film me-2"></i> Video Exercise Progress
                                                        </button>
                                                    </h2>
                                                    <div id="videoProgress" class="accordion-collapse collapse show">
                                                        <div class="list-group list-group-flush level-3">
                                                            <div class="list-group-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center mb-2">
                                                                    <h6 class="mb-0">Student Progress</h6>
                                                                    <a href="{{ route('online.teacher.classes.progress.video-exercise', ['id' => $class->id]) }}"
                                                                        class="btn btn-sm btn-primary">
                                                                        <i class="fas fa-list"></i> Xem danh sách
                                                                    </a>
                                                                </div>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-success" style="width: 75%">
                                                                        75% Completed
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Vocabulary Progress -->
                                                <div class="accordion-item level-2">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#vocabProgress">
                                                            <i class="fas fa-book me-2"></i> Vocabulary Progress
                                                        </button>
                                                    </h2>
                                                    <div id="vocabProgress" class="accordion-collapse collapse">
                                                        <div class="list-group list-group-flush level-3">
                                                            <div class="list-group-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center mb-2">
                                                                    <h6 class="mb-0">Student Progress</h6>
                                                                    <a href="{{ route('online.teacher.classes.progress.vocabulary', ['id' => $class->id]) }}"
                                                                        class="btn btn-sm btn-primary">
                                                                        <i class="fas fa-list"></i> Xem danh sách
                                                                    </a>
                                                                </div>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-success"
                                                                        style="width: 60%">
                                                                        60% Completed
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- During Class Materials -->
                                <div class="accordion-item mb-3 level-1">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#duringClassMaterials">
                                            <i class="fas fa-clock me-2"></i> During Class Materials
                                        </button>
                                    </h2>
                                    <div id="duringClassMaterials" class="accordion-collapse collapse"
                                        data-bs-parent="#lesson1Materials">
                                        <div class="accordion-body p-0">
                                            <div class="accordion" id="duringLessonsAccordion">
                                                <!-- Handout Progress -->
                                                <div class="accordion-item level-2">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#handoutProgress">
                                                            <i class="fas fa-file-alt me-2"></i> Handout Progress
                                                        </button>
                                                    </h2>
                                                    <div id="handoutProgress" class="accordion-collapse collapse">
                                                        <div class="list-group list-group-flush level-3">
                                                            <div class="list-group-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center mb-2">
                                                                    <h6 class="mb-0">Student Progress</h6>
                                                                    <a href="{{ route('online.teacher.classes.progress.handout', ['id' => $class->id]) }}"
                                                                        class="btn btn-sm btn-primary">
                                                                        <i class="fas fa-list"></i> Xem danh sách
                                                                    </a>
                                                                </div>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-success"
                                                                        style="width: 80%">
                                                                        80% Completed
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Shadowing Progress -->
                                                <div class="accordion-item level-2">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#shadowingProgress">
                                                            <i class="fas fa-microphone me-2"></i> Shadowing Progress
                                                        </button>
                                                    </h2>
                                                    <div id="shadowingProgress" class="accordion-collapse collapse">
                                                        <div class="list-group list-group-flush level-3">
                                                            <div class="list-group-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center mb-2">
                                                                    <h6 class="mb-0">Student Progress</h6>
                                                                    <a href="{{ route('online.teacher.classes.progress.shadowing', ['id' => $class->id]) }}"
                                                                        class="btn btn-sm btn-primary">
                                                                        <i class="fas fa-list"></i> Xem danh sách
                                                                    </a>
                                                                </div>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-success"
                                                                        style="width: 70%">
                                                                        70% Completed
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- After Class Materials -->
                                <div class="accordion-item mb-3 level-1">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#afterClassMaterials">
                                            <i class="fas fa-hourglass-end me-2"></i> After Class Materials
                                        </button>
                                    </h2>
                                    <div id="afterClassMaterials" class="accordion-collapse collapse"
                                        data-bs-parent="#lesson1Materials">
                                        <div class="accordion-body p-0">
                                            <div class="accordion" id="afterLessonsAccordion">
                                                <!-- Reflection Progress -->
                                                <div class="accordion-item level-2">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#reflectionProgress">
                                                            <i class="fas fa-pen-fancy me-2"></i> Reflection Progress
                                                        </button>
                                                    </h2>
                                                    <div id="reflectionProgress" class="accordion-collapse collapse">
                                                        <div class="list-group list-group-flush level-3">
                                                            <div class="list-group-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center mb-2">
                                                                    <h6 class="mb-0">Student Progress</h6>
                                                                    <a href="{{ route('online.teacher.classes.progress.reflection', ['id' => $class->id]) }}"
                                                                        class="btn btn-sm btn-primary">
                                                                        <i class="fas fa-list"></i> Xem danh sách
                                                                    </a>
                                                                </div>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-success"
                                                                        style="width: 65%">
                                                                        65% Completed
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lesson 2 -->
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#lesson2">
                            <i class="fas fa-book me-2"></i> Lesson 2: Basic Communication
                        </button>
                    </h2>
                    <div id="lesson2" class="accordion-collapse collapse" data-bs-parent="#lessonsAccordion">
                        <div class="accordion-body p-0">
                            <div class="accordion" id="lesson2Materials">
                                <!-- Before Class Materials -->
                                <div class="accordion-item mb-3 level-1">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#beforeClassMaterials2">
                                            <i class="fas fa-hourglass-start me-2"></i> Before Class Materials
                                        </button>
                                    </h2>
                                    <div id="beforeClassMaterials2" class="accordion-collapse collapse"
                                        data-bs-parent="#lesson2Materials">
                                        <div class="accordion-body p-0">
                                            <div class="accordion" id="beforeLessonsAccordion2">
                                                <!-- Video Exercise Progress -->
                                                <div class="accordion-item level-2">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#videoProgress2">
                                                            <i class="fas fa-film me-2"></i> Video Exercise Progress
                                                        </button>
                                                    </h2>
                                                    <div id="videoProgress2" class="accordion-collapse collapse">
                                                        <div class="list-group list-group-flush level-3">
                                                            <div class="list-group-item">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center mb-2">
                                                                    <h6 class="mb-0">Student Progress</h6>
                                                                    <a href="{{ route('online.teacher.classes.progress.video-exercise', ['id' => 2]) }}"
                                                                        class="btn btn-sm btn-primary">
                                                                        <i class="fas fa-list"></i> Xem danh sách
                                                                    </a>
                                                                </div>
                                                                <div class="progress">
                                                                    <div class="progress-bar bg-warning"
                                                                        style="width: 45%">
                                                                        45% Completed
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Similar structure for other activities -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Similar structure for During and After sections -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Progress List Modal -->
        <div class="modal fade" id="studentProgressModal" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Danh sách tiến độ học viên</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered student-list">
                                <thead>
                                    <tr>
                                        <th style="width: 50px">#</th>
                                        <th>Học viên</th>
                                        <th>Email</th>
                                        <th style="width: 120px">Trạng thái</th>
                                        <th style="width: 150px">Tiến độ</th>
                                        <th style="width: 180px">Hoạt động cuối</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Nguyễn Văn A</td>
                                        <td>nguyenvana@gmail.com</td>
                                        <td><span class="badge bg-success">Đã hoàn thành</span></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" style="width: 100%">100%</div>
                                            </div>
                                        </td>
                                        <td>15/03/2024 14:30</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Trần Thị B</td>
                                        <td>tranthib@gmail.com</td>
                                        <td><span class="badge bg-warning">Đang học</span></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" style="width: 60%">60%</div>
                                            </div>
                                        </td>
                                        <td>15/03/2024 15:45</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Lê Văn C</td>
                                        <td>levanc@gmail.com</td>
                                        <td><span class="badge bg-danger">Chưa học</span></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar bg-danger" style="width: 0%">0%</div>
                                            </div>
                                        </td>
                                        <td>-</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Remove the modal show functionality since we're using direct links now
            });
        </script>
    @endpush
@endsection
