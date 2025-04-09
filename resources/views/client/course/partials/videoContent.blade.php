@if ($video1)
    <div class="content-header" style="width: 100% !important; max-width: 100% !important; position: relative;">
        <h3 class="video-title fs-5 fw-bold text-white" style="white-space: nowrap !important; width: 100% !important; display: inline-block !important; overflow: visible !important; text-overflow: unset !important;">
            {{ $video1->name ?? 'Không tìm thấy tên bài học' }}
        </h3>
    </div>
    <div class="video-container">
        <div class="video-wrapper" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%;">
            <!-- Using iframe with streaming route -->
            <iframe 
                id="videoFrame"
                src="{{ route('stream.video', ['videoId' => $video1->id]) }}" 
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                frameborder="0" 
                allowfullscreen
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                loading="lazy">
            </iframe>
        </div>
        
        <!-- Backup direct video option - normally hidden -->
        <div id="directVideoContainer" style="display: none; margin-top: 20px;">
            <p>Nếu video không tải được, bạn có thể <a href="#" id="showDirectVideo" class="text-primary">xem trực tiếp</a>.</p>
            <div id="directVideo" style="display: none;">
                @php
                    $videoUrl = $video1->video_url;
                    if (!str_starts_with($videoUrl, 'http')) {
                        if (!str_contains($videoUrl, 'video-lessons/videos') && !str_contains($videoUrl, '/')) {
                            $videoUrl = 'video-lessons/videos/' . $videoUrl;
                        }
                        $videoUrl = 'https://dxud4suchjyje.cloudfront.net/' . $videoUrl;
                    }
                @endphp
                <a href="{{ route('direct.video', ['videoId' => $video1->id]) }}" target="_blank" class="btn btn-primary">Mở video trong tab mới</a>
            </div>
        </div>
    </div>
    
    <script>
        // Show direct video link after 5 seconds if iframe doesn't load properly
        setTimeout(function() {
            document.getElementById('directVideoContainer').style.display = 'block';
        }, 5000);
        
        // Toggle direct video link
        document.getElementById('showDirectVideo').addEventListener('click', function(e) {
            e.preventDefault();
            var directVideo = document.getElementById('directVideo');
            directVideo.style.display = directVideo.style.display === 'none' ? 'block' : 'none';
        });
    </script>
@else
    <div class="alert alert-warning">
        <p>Không có video nào cho bài học này.</p>
    </div>
@endif
</div>
