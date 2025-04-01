@if ($video1)
    <div class="content-header" style="width: 100% !important; max-width: 100% !important; position: relative;">
        <h3 class="video-title fs-5 fw-bold text-white" style="white-space: nowrap !important; width: 100% !important; display: inline-block !important; overflow: visible !important; text-overflow: unset !important;">
            {{ $video1->name ?? 'Không tìm thấy tên bài học' }}
        </h3>
    </div>
    <div class="video-container">
        <div class="video-wrapper">
            <video id="videoPlayer" controls class="w-100 h-100" controlsList="nodownload">
                <source src="{{ $video1->video_url }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
@else
    <div class="alert alert-warning">
        <p>Không có video nào cho bài học này.</p>
    </div>
@endif
</div>
