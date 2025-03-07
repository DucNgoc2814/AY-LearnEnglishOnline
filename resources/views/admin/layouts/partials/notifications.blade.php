@if(session()->has('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.success("{{ session('success') }}", '', {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right"
            });
        });
    </script>
@endif

@if(session()->has('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            toastr.error("{{ session('error') }}", '', {
                closeButton: true,
                progressBar: true,
                positionClass: "toast-top-right"
            });
        });
    </script>
@endif 