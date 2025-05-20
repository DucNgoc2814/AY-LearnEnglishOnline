<div class="progress-container p-4">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="fas fa-tasks text-primary me-2"></i>
                        Tiến độ làm bài tập
                    </h5>
                    <div class="progress mb-3" style="height: 20px;">
                        <div class="progress-bar" role="progressbar"
                             style="width: 75%"
                             aria-valuenow="75"
                             aria-valuemin="0"
                             aria-valuemax="100">
                            75%
                        </div>
                    </div>
                    <p class="text-muted">
                        Đã hoàn thành 15/20 bài tập
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="fas fa-clipboard-check text-success me-2"></i>
                        Tiến độ làm bài test
                    </h5>
                    <div class="progress mb-3" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar"
                             style="width: 60%"
                             aria-valuenow="60"
                             aria-valuemin="0"
                             aria-valuemax="100">
                            60%
                        </div>
                    </div>
                    <p class="text-muted">
                        Đã hoàn thành 6/10 bài test
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="fas fa-history text-info me-2"></i>
                        Lịch sử hoạt động gần đây
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Thời gian</th>
                                    <th>Hoạt động</th>
                                    <th>Trạng thái</th>
                                    <th>Điểm số</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>15/03/2024 14:30</td>
                                    <td>Nộp bài tập: Unit 5 - Grammar Exercise</td>
                                    <td>
                                        <span class="badge bg-success">Đã hoàn thành</span>
                                    </td>
                                    <td>9/10</td>
                                </tr>
                                <tr>
                                    <td>14/03/2024 16:45</td>
                                    <td>Làm bài test: Vocabulary Quiz</td>
                                    <td>
                                        <span class="badge bg-success">Đã hoàn thành</span>
                                    </td>
                                    <td>85/100</td>
                                </tr>
                                <tr>
                                    <td>13/03/2024 10:20</td>
                                    <td>Nộp bài tập: Writing Assignment</td>
                                    <td>
                                        <span class="badge bg-warning">Đang chấm</span>
                                    </td>
                                    <td>N/A</td>
                                </tr>
                                <tr>
                                    <td>12/03/2024 09:15</td>
                                    <td>Làm bài test: Listening Comprehension</td>
                                    <td>
                                        <span class="badge bg-success">Đã hoàn thành</span>
                                    </td>
                                    <td>90/100</td>
                                </tr>
                                <tr>
                                    <td>11/03/2024 11:30</td>
                                    <td>Nộp bài tập: Reading Exercise</td>
                                    <td>
                                        <span class="badge bg-danger">Trễ hạn</span>
                                    </td>
                                    <td>7/10</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.progress-container .card {
    border-radius: 10px;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    transition: transform 0.2s ease;
}

.progress-container .card:hover {
    transform: translateY(-5px);
}

.progress-container .progress {
    border-radius: 10px;
    background-color: #f0f0f0;
}

.progress-container .progress-bar {
    border-radius: 10px;
    transition: width 0.6s ease;
}

.progress-container .table th {
    border-top: none;
    font-weight: 600;
}

.progress-container .table td {
    vertical-align: middle;
}

.badge {
    padding: 0.5em 0.8em;
    font-weight: 500;
}
</style>
