@if(session()->has('message'))
    <style>
        /* Custom styles for Toast notifications */
        .toast-container {
            position: fixed !important;
            top: 1rem !important;
            right: 1rem !important;
            z-index: 9999 !important;
        }

        .custom-toast {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
            font-size: 0.95rem !important;
            position: relative !important;
        }
        
        .custom-toast .swal2-title {
            font-size: 0.95rem !important;
            font-weight: 500 !important;
            padding: 0.25rem 0 !important;
        }

        .custom-toast.swal2-toast {
            padding: 0.75rem !important;
            width: auto !important;
            max-width: 400px !important;
            min-width: 300px !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px) !important;
            margin: 0 !important;
        }

        /* Success toast */
        .custom-toast.success-toast {
            border-left: 4px solid #059669 !important;
        }
        .custom-toast.success-toast .swal2-icon.swal2-success {
            border-color: #059669 !important;
            color: #059669 !important;
        }

        /* Error toast */
        .custom-toast.error-toast {
            border-left: 4px solid #dc2626 !important;
        }
        .custom-toast.error-toast .swal2-icon.swal2-error {
            border-color: #dc2626 !important;
            color: #dc2626 !important;
        }

        /* Warning toast */
        .custom-toast.warning-toast {
            border-left: 4px solid #eab308 !important;
        }
        .custom-toast.warning-toast .swal2-icon.swal2-warning {
            border-color: #eab308 !important;
            color: #eab308 !important;
        }

        /* Info toast */
        .custom-toast.info-toast {
            border-left: 4px solid #0ea5e9 !important;
        }
        .custom-toast.info-toast .swal2-icon.swal2-info {
            border-color: #0ea5e9 !important;
            color: #0ea5e9 !important;
        }

        /* Animation */
        .swal2-show {
            animation: toast-in-right 0.3s ease !important;
        }

        .swal2-hide {
            animation: toast-out-right 0.3s ease !important;
        }

        @keyframes toast-in-right {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes toast-out-right {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    popup: 'custom-toast',
                    container: 'toast-container'
                },
                didOpen: (toast) => {
                    // Add type-specific class for styling
                    toast.classList.add('{{ session("type") }}-toast');
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            Toast.fire({
                icon: '{{ session("type") }}',
                title: '{{ session("message") }}'
            });
        });
    </script>
@endif

@if($errors->any())
    <style>
        .error-list {
            margin: 0 !important;
            padding: 0 !important;
            list-style-type: none !important;
        }

        .error-list li {
            margin-bottom: 0.5rem !important;
            color: #dc2626 !important;
            font-size: 0.9rem !important;
        }

        .error-list li:last-child {
            margin-bottom: 0 !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                html: `<ul class="error-list">{!! implode('', $errors->all('<li>:message</li>')) !!}</ul>`,
                showConfirmButton: true,
                timer: 5000,
                timerProgressBar: true,
                toast: true,
                position: 'top-end',
                customClass: {
                    popup: 'custom-toast error-toast',
                    title: 'toast-title',
                    htmlContainer: 'toast-html',
                    container: 'toast-container'
                }
            });
        });
    </script>
@endif 