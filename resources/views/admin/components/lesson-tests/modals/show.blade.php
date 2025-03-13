<div class="modal fade" id="showLessonTestModal" tabindex="-1" role="dialog" aria-labelledby="showLessonTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showLessonTestModalLabel">Chi tiết bài kiểm tra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Thông tin bài kiểm tra -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Bài học:</label>
                            <div id="showLesson"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên bài kiểm tra:</label>
                            <div id="showName"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mô tả:</label>
                            <div id="showDescription"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Thời gian làm bài:</label>
                                <div id="showDuration"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Số lần làm tối đa:</label>
                                <div id="showMaxAttempt"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Điểm tối thiểu:</label>
                                <div id="showMinScore"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Điểm tối đa:</label>
                                <div id="showMaxScore"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Trạng thái:</label>
                            <div id="showIsRequired"></div>
                        </div>
                    </div>
                </div>

                <!-- Danh sách câu hỏi -->
                <div class="question-list mt-4">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">STT</th>
                                    <th class="text-center" width="10%">Loại</th>
                                    <th class="text-center" width="30%">Câu hỏi</th>
                                    <th class="text-center" width="15%">Media</th>
                                    <th class="text-center" width="30%">Câu trả lời</th>
                                    <th class="text-center" width="10%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="questionList">
                                <!-- Dữ liệu câu hỏi sẽ được thêm vào đây bằng JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<style>
    #showLessonTestModal .modal-xl {
        max-width: 95%;
    }

    .table th {
        white-space: nowrap;
    }

    .table td:nth-child(3),
    .table td:nth-child(5) {
        white-space: normal;
    }

    .media-preview img {
        max-height: 50px;
        cursor: pointer;
    }

    .media-preview audio,
    .media-preview video {
        max-width: 150px;
    }
</style>

