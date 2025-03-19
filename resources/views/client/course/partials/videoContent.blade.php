@if ($video1)
    <div class="content-header">
        <h4 class="video-title fs-4 fw-bold text-white">{{ $video1->name ?? 'Không tìm thấy tên bài học' }}</h4>
    </div>
    <div class="video-container">
        <div class="video-wrapper">
            <video id="videoPlayer" controls class="w-100 h-100" controlsList="nodownload">
                <source src="{{ url($video1->videoUrl) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
@else
    <div class="video-container">

        <div class="no-video">
            <i class="fas fa-video"></i>
            <p>Không có video cho bài học này</p>
        </div>
    </div>
@endif
</div>
