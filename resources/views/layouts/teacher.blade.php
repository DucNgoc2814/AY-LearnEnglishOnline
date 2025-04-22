<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Trang giảng viên') - AY Learning English Online</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/online/teacher.css') }}">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #4f46e5;
            --success-color: #10b981;
            --info-color: #06b6d4;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --light-color: #f3f4f6;
            --dark-color: #1f2937;
            --body-bg: #f9fafb;
            --card-bg: #ffffff;
            --border-color: #e5e7eb;
            --text-color: #1f2937;
            --text-muted: #6b7280;
        }
        
        body {
            background-color: var(--body-bg);
            color: var(--text-color);
            font-family: 'Roboto', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .sidebar {
            background-color: var(--dark-color);
            color: var(--light-color);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 250px;
            z-index: 100;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .sidebar-header {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-brand {
            color: white;
            font-weight: 700;
            font-size: 1.25rem;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        
        .sidebar-brand img {
            width: 32px;
            margin-right: 0.75rem;
        }
        
        .sidebar-menu {
            padding: 1rem 0;
            list-style: none;
            margin: 0;
        }
        
        .sidebar-menu li {
            margin-bottom: 0.25rem;
        }
        
        .sidebar-menu a {
            display: block;
            padding: 0.75rem 1.5rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        
        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 3px solid var(--primary-color);
        }
        
        .sidebar-menu a i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
        }
        
        .content-wrapper {
            margin-left: 250px;
            flex: 1;
            padding: 1rem;
            transition: all 0.3s ease;
        }
        
        .topbar {
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 0.75rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
        }
        
        .topbar-title {
            font-weight: 600;
            font-size: 1.25rem;
        }
        
        .user-dropdown {
            position: relative;
            display: inline-block;
        }
        
        .user-dropdown-toggle {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }
        
        .user-dropdown-toggle:hover {
            background-color: var(--light-color);
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-right: 0.5rem;
        }
        
        .user-name {
            margin-right: 0.5rem;
            font-weight: 500;
        }
        
        .user-dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 0.375rem;
            width: 200px;
            display: none;
            z-index: 10;
        }
        
        .user-dropdown-menu.show {
            display: block;
        }
        
        .user-dropdown-menu a {
            display: block;
            padding: 0.75rem 1rem;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .user-dropdown-menu a:hover {
            background-color: var(--light-color);
        }
        
        .user-dropdown-menu a i {
            margin-right: 0.5rem;
            width: 16px;
            text-align: center;
        }
        
        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        
        .card-header i {
            margin-right: 0.5rem;
            color: var(--primary-color);
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 1.5rem;
        }
        
        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }
        
        .breadcrumb-item.active {
            color: var(--text-muted);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: var(--text-color);
            vertical-align: middle;
        }
        
        .table th {
            font-weight: 600;
            background-color: var(--light-color);
        }
        
        .progress {
            height: 0.5rem;
            margin-bottom: 0.25rem;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .content-wrapper {
                margin-left: 0;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .content-wrapper.sidebar-open {
                margin-left: 250px;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('online.teacher.dashboard') }}" class="sidebar-brand">
                <img src="{{ asset('img/logo.png') }}" alt="Logo">
                <span>AY Learning</span>
            </a>
        </div>
        
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('online.teacher.dashboard') }}" class="{{ request()->routeIs('online.teacher.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('online.teacher.classes.index') }}" class="{{ request()->routeIs('online.teacher.classes.*') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Lớp học</span>
                </a>
            </li>
            <li>
                <a href="{{ route('online.attendance.index') }}" class="{{ request()->routeIs('online.attendance.*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-check"></i>
                    <span>Điểm danh</span>
                </a>
            </li>
            <li>
                <a href="{{ route('online.teacher.schedule') }}" class="{{ request()->routeIs('online.teacher.schedule.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Lịch giảng dạy</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Topbar -->
        <div class="topbar">
            <div class="topbar-title">
                <button class="btn btn-sm btn-light d-md-none me-2" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <span>@yield('title', 'Dashboard')</span>
            </div>
            
            <div class="user-dropdown">
                <div class="user-dropdown-toggle" id="userDropdown">
                    <img src="{{ asset('img/avatar.png') }}" alt="Avatar" class="user-avatar">
                    <span class="user-name">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                
                <div class="user-dropdown-menu" id="userDropdownMenu">
                    <a href="#"><i class="fas fa-user"></i> Hồ sơ</a>
                    <a href="#"><i class="fas fa-cog"></i> Cài đặt</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Đăng xuất
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Sidebar Toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
            document.querySelector('.content-wrapper').classList.toggle('sidebar-open');
        });
        
        // User Dropdown
        document.getElementById('userDropdown').addEventListener('click', function() {
            document.getElementById('userDropdownMenu').classList.toggle('show');
        });
        
        // Close the dropdown when clicking outside
        window.addEventListener('click', function(event) {
            if (!event.target.matches('.user-dropdown-toggle') && !event.target.closest('.user-dropdown-toggle')) {
                var dropdowns = document.getElementsByClassName('user-dropdown-menu');
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html> 