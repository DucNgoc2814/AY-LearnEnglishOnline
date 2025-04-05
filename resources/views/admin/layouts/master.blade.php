<!DOCTYPE html>
<html lang="vi">


<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('uploads/logos/LG 1.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/ad.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.layouts.partials.styles')
    @stack('styles')

    <!-- TinyMCE -->
    <script src="{{ asset('assets/libs/tinymce/tinymce.min.js') }}"></script>

    <!-- Loading Animation Style -->
    <style>
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.3s;
        }
        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .loading-text {
            margin-top: 1rem;
            color: #2d3748;
            font-size: 1.125rem;
        }
    </style>
</head>

<body>
    <!-- Loading Screen -->
    <div id="loading-screen">
        <div class="flex flex-col items-center">
            <div class="loading-spinner"></div>
            <div class="loading-text">Đang tải...</div>
        </div>
    </div>

    <div class="flex flex-col min-h-screen">
        @include('admin.layouts.partials.header')
        @yield('content')
        @include('admin.layouts.partials.footer')
    </div>

    @include('admin.layouts.partials.scripts')
    @stack('scripts')

    <!-- TinyMCE Config -->
    <script src="{{ asset('assets/js/tinymce-config.js') }}"></script>

    <!-- Loading Screen Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loadingScreen = document.getElementById('loading-screen');

            // Hide loading screen when page is loaded
            loadingScreen.style.opacity = '0';
            setTimeout(() => {
                loadingScreen.style.display = 'none';
            }, 300);

            // Show loading screen before unload
            window.addEventListener('beforeunload', function() {
                loadingScreen.style.opacity = '1';
                loadingScreen.style.display = 'flex';
            });

            // Handle form submissions
            document.addEventListener('submit', function(e) {
                if (e.target.tagName === 'FORM') {
                    loadingScreen.style.opacity = '1';
                    loadingScreen.style.display = 'flex';
                }
            });

            // Handle AJAX requests
            let originalXHR = window.XMLHttpRequest;
            function newXHR() {
                let xhr = new originalXHR();
                xhr.addEventListener('loadstart', function() {
                    loadingScreen.style.opacity = '1';
                    loadingScreen.style.display = 'flex';
                });
                xhr.addEventListener('loadend', function() {
                    loadingScreen.style.opacity = '0';
                    setTimeout(() => {
                        loadingScreen.style.display = 'none';
                    }, 300);
                });
                return xhr;
            }
            window.XMLHttpRequest = newXHR;

            // Add CSRF token to all fetch requests
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            let originalFetch = window.fetch;
            window.fetch = function(url, options = {}) {
                options.headers = {
                    ...options.headers,
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                };
                return originalFetch(url, options);
            };
        });
    </script>
</body>

</html>
