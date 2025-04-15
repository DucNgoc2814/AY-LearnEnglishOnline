<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #dbeafe;
            --text-color: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --bg-color: #f9fafb;

            /* Background Gradients - Bạn có thể thay đổi các màu này */
            --gradient-start: #4158D0;
            --gradient-middle: #C850C0;
            --gradient-end: #FFCC70;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(43deg, var(--gradient-start) 0%, var(--gradient-middle) 46%, var(--gradient-end) 100%);
        }

        /* Thêm animation cho background */
        @keyframes gradient-animation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        /* Một số class gradient có sẵn để bạn có thể thay đổi dễ dàng */
        .gradient-blue {
            --gradient-start: #0093E9;
            --gradient-middle: #4B73FF;
            --gradient-end: #80D0C7;
        }

        .gradient-purple {
            --gradient-start: #8B5CF6;
            --gradient-middle: #D946EF;
            --gradient-end: #F472B6;
        }

        .gradient-green {
            --gradient-start: #00B4DB;
            --gradient-middle: #20BF55;
            --gradient-end: #A8EB12;
        }

        .gradient-sunset {
            --gradient-start: #FA8BFF;
            --gradient-middle: #2BD2FF;
            --gradient-end: #2BFF88;
        }

        .gradient-ocean {
            --gradient-start: #4B79A1;
            --gradient-middle: #283E51;
            --gradient-end: #0A2342;
        }

        .auth-wrapper {
            width: 100%;
        }

        .auth-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .auth-subtitle {
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        .form-label {
            font-weight: 500;
            color: var(--text-color);
        }

        .form-control, .form-select {
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border: none;
            padding: 0.75rem 1rem;
            font-weight: 500;
            border-radius: 0.5rem;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-dark));
            transform: translateY(-1px);
        }
    </style>

    @stack('styles')
</head>
<body class="gradient-purple">
    <div class="auth-wrapper">
        @yield('content')
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html> 