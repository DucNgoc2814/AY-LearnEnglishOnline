<div class="modal fade" id="editVideoLessonModal" tabindex="-1" role="dialog" aria-labelledby="editVideoLessonModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVideoLessonModalLabel">Chỉnh sửa bài giảng video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editVideoLessonForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="lessonId" id="lessonId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="videoLessonName">Tên video <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="videoLessonName" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="videoUrl">File Video</label>
                        <input type="file" class="form-control" id="videoUrl" name="videoUrl"
                            accept="video/*,.mp4,.mov,.wmv,.avi,.flv"
                            onchange="handleVideoUpload(this.files[0])">
                        <small class="form-text text-muted">Để trống nếu không muốn thay đổi video</small>
                    </div>

                    <input type="hidden" id="videoType" name="videoType">

                    <div class="mb-3">
                        <label class="form-label" for="duration">Thời lượng <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="duration" name="duration"
                            placeholder="Thời lượng video (giây)" min="1" required readonly>
                        <small class="form-text text-muted duration-display"></small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="thumbnail">Ảnh thumbnail</label>
                        <input type="file" class="form-control" id="thumbnail" name="thumbnail"
                            accept="image/*">
                        <small class="form-text text-muted">Để trống nếu không muốn thay đổi thumbnail</small>
                        <div id="currentThumbnail" class="mt-2"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function detectVideoType(file) {
    const videoTypeInput = document.getElementById('videoType');

    if (!file) {
        videoTypeInput.value = '';
        return;
    }

    const extension = file.name.split('.').pop().toLowerCase();
    if (['mp4', 'mov', 'wmv', 'avi', 'flv'].includes(extension)) {
        videoTypeInput.value = 'mp4';
    } else {
        videoTypeInput.value = ''; // Không xác định được loại video
    }
}

function setLessonIdForVideo(lessonId) {
    document.getElementById('lessonId').value = lessonId;
}

function handleVideoUpload(file) {
    detectVideoType(file);
    if (file) {
        const video = document.createElement('video');
        const fileURL = URL.createObjectURL(file);

        video.src = fileURL;

        video.onloadedmetadata = function() {
            // Làm tròn thời lượng thành số nguyên giây
            const durationInSeconds = Math.max(1, Math.round(video.duration));
            document.getElementById('duration').value = durationInSeconds;

            // Hiển thị thời lượng dạng phút:giây
            updateDurationDisplay(durationInSeconds);

            URL.revokeObjectURL(fileURL);
        };

        video.onerror = function() {
            console.error('Error loading video file');
            document.getElementById('duration').value = '';
            document.querySelector('.duration-display').textContent = '';
            URL.revokeObjectURL(fileURL);
        };
    } else {
        document.getElementById('duration').value = '';
        document.querySelector('.duration-display').textContent = '';
    }
}

function updateDurationDisplay(seconds) {
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = seconds % 60;
    const display = `${minutes} phút ${remainingSeconds} giây`;
    document.querySelector('.duration-display').textContent = display;
}
</script>
