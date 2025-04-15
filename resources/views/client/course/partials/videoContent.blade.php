@if ($video1)
    <div class="content-header" style="width: 100% !important; max-width: 100% !important; position: relative;">
        <h3 class="video-title fs-5 fw-bold text-white" style="white-space: nowrap !important; width: 100% !important; display: inline-block !important; overflow: visible !important; text-overflow: unset !important;">
            {{ $video1->name ?? 'Không tìm thấy tên bài học' }}
        </h3>
    </div>
    
    <style>
        .video-wrapper {
            position: relative; 
            padding-bottom: 56.25%; 
            height: 0; 
            overflow: hidden; 
            max-width: 100%;
            background-color: #000;
            border-radius: 8px;
        }
        .video-player {
            position: absolute; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%;
            border: none;
        }
    </style>
    
    <div class="video-container">
        <div class="video-wrapper">
            @php
                $videoUrl = $video1->video_url;
                if (!str_starts_with($videoUrl, 'http')) {
                    if (!str_contains($videoUrl, 'video-lessons/videos') && !str_contains($videoUrl, '/')) {
                        $videoUrl = 'video-lessons/videos/' . $videoUrl;
                    }
                    $videoUrl = 'https://dxud4suchjyje.cloudfront.net/' . $videoUrl;
                }
            @endphp
            
            <video id="videoPlayer" class="video-player" controls autoplay playsinline>
                <source src="{{ $videoUrl }}" type="video/mp4">
                Trình duyệt của bạn không hỗ trợ phát video.
            </video>
        </div>
    </div>
@else
    <div class="alert alert-warning">
        <p>Không có video nào cho bài học này.</p>
    </div>
@endif
