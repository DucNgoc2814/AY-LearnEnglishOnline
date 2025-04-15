<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5.0, minimum-scale=0.86">
    <meta name="description" content="Online Learning - AmazingYou Learning English">
    <meta name="keywords" content="online classes, english learning, virtual classroom">
    <meta name="robots" content="Meta robot">
    <meta name="author" content="AmazingYou">
    <!-- Security Headers -->
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="Referrer-Policy" content="same-origin">
    <meta http-equiv="Content-Security-Policy"
        content="default-src * 'self' data: blob: 'unsafe-inline' 'unsafe-eval'; script-src * 'self' data: 'unsafe-inline' 'unsafe-eval'; style-src * 'self' data: 'unsafe-inline'; img-src * 'self' data: blob: https:; font-src * 'self' data:; connect-src * 'self' data:; frame-src * 'self' data:; object-src 'none';">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (session('notification'))
        <meta name="notification" content="{{ json_encode(session('notification')) }}">
    @endif
    <title>@yield('title') - AmazingYou Learning English</title>

    <!-- Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @yield('styles')
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('themes/client/assets/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/client/assets/frontend/default-new/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/client/assets/frontend/default-new/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/online/css/style.css') }}">
    <style>
        :root {
            --sidebar-width: 250px;
            --header-height: 60px;
            --primary-color: #2563eb;
            --primary-dark: #1e40af;
            --primary-light: #dbeafe;
            --text-color: #374151;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --card-bg: #ffffff;
            --bg-color: #f3f4f6;
            --hover-bg: #f9fafb;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --border-radius: 0.75rem;
            --border-radius-sm: 0.5rem;
            --transition: all 0.2s ease;
            --success-color: #059669;
            --danger-color: #dc2626;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: var(--bg-color);
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            color: var(--text-color);
            overflow-x: hidden;
            line-height: 1.6;
        }

        .left-sidebar {
            width: var(--sidebar-width);
            position: fixed;
            left: 0;
            top: var(--header-height);
            bottom: 0;
            background: var(--card-bg);
            box-shadow: var(--shadow-sm);
            overflow-y: auto;
            z-index: 100;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-right: 1px solid var(--border-color);
        }

        .main-content {
            margin-left: var(--sidebar-width);
            padding: calc(var(--header-height) + 1.5rem) 1.5rem 1.5rem;
            min-height: calc(100vh - var(--header-height));
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .top-navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--header-height);
            background: var(--card-bg);
            box-shadow: var(--shadow-sm);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            background-color: rgba(255, 255, 255, 0.8);
            border-bottom: 1px solid var(--border-color);
        }

        .nav-logo {
            height: 35px;
            width: auto;
            max-width: 200px;
            object-fit: contain;
        }

        .mobile-menu-toggle {
            display: none;
            background: transparent;
            border: none;
            font-size: 1.25rem;
            color: var(--text-color);
            cursor: pointer;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .mobile-menu-toggle:hover {
            background: var(--hover-bg);
            color: var(--primary-color);
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.25rem;
            color: var(--text-color);
            text-decoration: none;
            transition: var(--transition);
            border-left: 3px solid transparent;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .menu-item:hover {
            background: var(--hover-bg);
            color: var(--primary-color);
            border-left: 3px solid var(--primary-color);
        }

        .menu-item.active {
            background: var(--primary-light);
            color: var(--primary-color);
            border-left: 3px solid var(--primary-color);
        }

        .menu-item i {
            width: 20px;
            margin-right: 0.75rem;
            font-size: 1rem;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .content-section {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            height: 100%;
            border: 1px solid var(--border-color);
        }

        .content-section:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .section-title {
            color: var(--primary-color);
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--primary-light);
        }

        .dropdown-menu {
            border: none;
            box-shadow: var(--shadow-md);
            border-radius: var(--border-radius);
            margin-top: 0.5rem;
            border: 1px solid var(--border-color);
            padding: 0.5rem;
        }

        .dropdown-item {
            padding: 0.625rem 1rem;
            color: var(--text-color);
            transition: var(--transition);
            border-radius: var(--border-radius-sm);
            font-size: 0.875rem;
        }

        .dropdown-item:hover {
            background: var(--hover-bg);
            color: var(--primary-color);
        }

        .nav-tabs {
            border-bottom: 1px solid var(--border-color);
            flex-wrap: nowrap;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            gap: 1rem;
        }

        .nav-tabs .nav-link {
            color: var(--text-muted);
            border: none;
            border-bottom: 2px solid transparent;
            padding: 0.75rem 1rem;
            margin-bottom: -1px;
            background: transparent;
            transition: var(--transition);
            white-space: nowrap;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .nav-tabs .nav-link:hover {
            color: var(--primary-color);
            border-color: transparent;
        }

        .nav-tabs .nav-link.active {
            color: var(--primary-color);
            background: transparent;
            border-bottom: 2px solid var(--primary-color);
        }

        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: var(--border-radius);
        }

        .left-sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .left-sidebar::-webkit-scrollbar-track {
            background: var(--bg-color);
        }

        .left-sidebar::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 3px;
        }

        .left-sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--text-muted);
        }

        .overlay {
            display: none;
            position: fixed;
            top: var(--header-height);
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 99;
            opacity: 0;
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }
            
        .overlay.active {
            display: block;
            opacity: 1;
        }

        @media (max-width: 991px) {
            :root {
                --sidebar-width: 220px;
            }
        }

        @media (max-width: 768px) {
            :root {
                --sidebar-width: 250px;
            }
            
            .mobile-menu-toggle {
                display: flex;
            }
            
            .left-sidebar {
                transform: translateX(-100%);
            }
            
            .left-sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: calc(var(--header-height) + 1rem) 1rem 1rem;
            }
        }

        @media (max-width: 576px) {
            .content-section {
                padding: 1rem;
            }
            
            h2, .h2 {
                font-size: 1.25rem;
            }
            
            h3, .h3 {
                font-size: 1.125rem;
            }
            
            .grid-container {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .top-navbar {
                padding: 0 1rem;
            }
        }

        /* Custom styles */
        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        /* Standardize "Back" buttons */
        .back-btn {
            font-size: 0.875rem !important;
            padding: 0.25rem 0.5rem !important;
            border-radius: var(--border-radius-sm) !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.5rem !important;
            font-weight: 500 !important;
        }
        
        /* Add any other global custom styles here */
    </style>

    <script>
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}',
            appUrl: '{{ url('/') }}'
        };
    </script>
</head>

<body>
    @include('online.layouts.header')
    @include('online.layouts.sidebar')
    <div class="overlay" id="sidebarOverlay"></div>
    <div class="main-content">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle functionality
            const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
            const sidebar = document.querySelector('.left-sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');
                    document.body.classList.toggle('sidebar-open');
                });
            }
            
            if (overlay) {
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    document.body.classList.remove('sidebar-open');
                });
            }
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768 && document.body.classList.contains('sidebar-open')) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    document.body.classList.remove('sidebar-open');
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
