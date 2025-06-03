@extends('online.layouts.auth')

@section('title', 'Đăng nhập')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="auth-card p-4">
                <div class="auth-header">
                    <h1 class="auth-title">Đăng nhập</h1>
                    <p class="auth-subtitle">Vui lòng đăng nhập để tiếp tục</p>
                </div>

                @if(session('notification'))
                    <div class="alert alert-{{ session('notification')['type'] }} mb-4">
                        {{ session('notification')['message'] }}
                    </div>
                @endif

                <form method="POST" action="{{ route('online.login') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label" for="user_type">Bạn là?</label>
                        <select class="form-select @error('user_type') is-invalid @enderror" id="user_type" name="user_type" required>
                            <option value="">Chọn loại tài khoản</option>
                            <option value="student" {{ old('user_type') == 'student' ? 'selected' : '' }}>Học viên</option>
                            <option value="employee" {{ old('user_type') == 'employee' ? 'selected' : '' }}>Giáo viên/Nhân viên</option>
                        </select>
                        @error('user_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="username">Mã số</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                            id="username" name="username" value="{{ old('username') }}"
                            placeholder="Nhập mã học viên hoặc mã nhân viên" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="password">Mật khẩu</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" placeholder="Nhập mật khẩu" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection