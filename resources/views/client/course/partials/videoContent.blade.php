<div class="video-container">
    @if ($video1)
        <div class="video-wrapper">
            <video id="videoPlayer" controls class="w-100 h-100" controlsList="nodownload">
                <source src="{{ url($video1->videoUrl) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    @else
        <div class="no-video">
            <i class="fas fa-video"></i>
            <p>Không có video cho bài học này</p>
        </div>
    @endif
</div>
