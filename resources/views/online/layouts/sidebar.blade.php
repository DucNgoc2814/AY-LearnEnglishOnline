<!-- Left Sidebar -->
<div class="left-sidebar">
    <a href="{{ route('online.dashboard') }}" class="menu-item" data-route="online.dashboard">
        <i class="fas fa-bell"></i>
        <span>Thông báo và tin tức</span>
    </a>
    @if (session('user_type') === 'student')
        <a href="{{ route('online.classes.index') }}" class="menu-item" data-route="online.classes">
            <i class="fas fa-graduation-cap"></i>
            <span>Lớp học của tôi</span>
        </a>
    @else
        <a href="{{ route('online.teacher.classes.index') }}" class="menu-item" data-route="online.classes">
            <i class="fas fa-graduation-cap"></i>
            <span>Quản lý lớp học</span>
        </a>
    @endif

    @if (session('user_type') === 'student')
        <a href="{{ route('online.schedule') }}" class="menu-item" data-route="online.schedule">
            <i class="fas fa-calendar-alt"></i>
            <span>Lịch học</span>
        </a>
    @else
        <a href="{{ route('online.attendance.index') }}" class="menu-item" data-route="online.attendance">
            <i class="fas fa-check-square"></i>
            <span>Điểm danh</span>
        </a>
        <a href="{{ route('online.teacher.schedule') }}" class="menu-item" data-route="online.schedule">
            <i class="fas fa-calendar-alt"></i>
            <span>Lịch giảng dạy</span>
        </a>
    @endif

    <a href="{{ route('online.awards.index') }}" class="menu-item" data-route="online.awards">
        <i class="fas fa-award"></i>
        <span>Khen thưởng/Kỷ luật</span>
    </a>

    <a href="{{ route('online.guides.index') }}" class="menu-item" data-route="online.guides">
        <i class="fas fa-book"></i>
        <span>Hướng dẫn</span>
    </a>
    <a href="{{ route('online.support.index') }}" class="menu-item" data-route="online.support">
        <i class="fas fa-question-circle"></i>
        <span>Hỗ trợ</span>
    </a>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy URL hiện tại
        const currentUrl = window.location.href;

        // Xóa active khỏi tất cả menu items
        document.querySelectorAll('.menu-item').forEach(item => {
            item.classList.remove('active');
        });

        // Set active dựa trên URL
        if (currentUrl.includes('/attendance')) {
            document.querySelector('.menu-item[data-route="online.attendance"]').classList.add('active');
        } else if (currentUrl.includes('/schedule')) {
            document.querySelector('.menu-item[data-route="online.schedule"]').classList.add('active');
        } else if (currentUrl.includes('/classes')) {
            document.querySelector('.menu-item[data-route="online.classes"]').classList.add('active');
        } else if (currentUrl.includes('/awards')) {
            document.querySelector('.menu-item[data-route="online.awards"]').classList.add('active');
        } else if (currentUrl.includes('/guides')) {
            document.querySelector('.menu-item[data-route="online.guides"]').classList.add('active');
        } else if (currentUrl.includes('/support')) {
            document.querySelector('.menu-item[data-route="online.support"]').classList.add('active');
        } else if (currentUrl.includes('/ebooks')) {
            document.querySelector('.menu-item[data-route="online.ebooks"]').classList.add('active');
        } else {
            document.querySelector('.menu-item[data-route="online.dashboard"]').classList.add('active');
        }
    });
</script>
