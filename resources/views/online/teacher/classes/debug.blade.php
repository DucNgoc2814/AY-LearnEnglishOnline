@extends('online.layouts.master')

@section('title', 'Debug - Kiểm tra Route')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Debug Route và Controller</h4>
        </div>
        <div class="card-body">
            <h5 class="card-title">Thông tin hiện tại</h5>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>URL hiện tại:</th>
                        <td>{{ request()->url() }}</td>
                    </tr>
                    <tr>
                        <th>Route name:</th>
                        <td>{{ Route::currentRouteName() }}</td>
                    </tr>
                    <tr>
                        <th>Controller action:</th>
                        <td>{{ Route::currentRouteAction() }}</td>
                    </tr>
                    <tr>
                        <th>User ID từ session:</th>
                        <td>{{ session('user_id') ?? 'Không có' }}</td>
                    </tr>
                </tbody>
            </table>

            <h5 class="card-title mt-4">Danh sách lớp học</h5>
            <div class="alert alert-info">
                <strong>Debug:</strong> Các đường dẫn đã được cập nhật. Vui lòng kiểm tra các tuỳ chọn bên dưới để xác định vấn đề.
            </div>
            <div class="row">
                @foreach(\App\Models\Classes::take(5)->get() as $class)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $class->name }}</h5>
                            <p class="card-text">ID: {{ $class->id }}</p>
                            <div class="btn-group d-flex flex-wrap">
                                <a href="{{ route('online.teacher.classes.show', $class->id) }}" class="btn btn-primary m-1">
                                    <i class="fas fa-eye"></i> Chi tiết (Route)
                                </a>
                                <a href="{{ url('/online/teacher/classes/'.$class->id) }}" class="btn btn-outline-primary m-1">
                                    <i class="fas fa-link"></i> Chi tiết (URL)
                                </a>
                                <a href="{{ url('/test-class-details/'.$class->id) }}" class="btn btn-success m-1">
                                    <i class="fas fa-bug"></i> Test
                                </a>
                                <a href="{{ url('/super-test/'.$class->id) }}" class="btn btn-danger m-1">
                                    <i class="fas fa-bug"></i> Super Test
                                </a>
                                <a href="{{ url('/direct-class/'.$class->id) }}" class="btn btn-warning m-1">
                                    <i class="fas fa-location-arrow"></i> Direct
                                </a>
                                <a href="{{ url('/online/teacher/classes/'.$class->id) }}?debug=1" class="btn btn-info m-1">
                                    <i class="fas fa-code"></i> Với Param Debug
                                </a>
                            </div>
                            <div class="mt-2">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <tr>
                                            <th>URL Test</th>
                                            <td><small>{{ url('/test-class-details/'.$class->id) }}</small></td>
                                        </tr>
                                        <tr>
                                            <th>Super Test</th>
                                            <td><small>{{ url('/super-test/'.$class->id) }}</small></td>
                                        </tr>
                                        <tr>
                                            <th>Direct</th>
                                            <td><small>{{ url('/direct-class/'.$class->id) }}</small></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection 