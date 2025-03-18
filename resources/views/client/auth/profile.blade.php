@extends('client.layouts.master')

@section('content')
    <section class="profile-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card border shadow-sm mb-5">
                        <div class="wish-list-search">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="student-profile-info text-center p-2">
                                        @if (Auth::user()->avatar)
                                            <img loading="lazy" class="profile-image rounded-circle mb-3" src="{{ asset(Auth::user()->avatar) }}"
                                                alt="Profile">
                                        @else
                                            <i class="fa-solid fa-user-circle fa-5x mb-3"></i>
                                        @endif
                                        <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                                        <span class="text-muted">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="wish-list-course p-3">
                                <a class="btn-profile-menu active d-block p-3 mb-2 rounded" href="#profile-info">
                                    <i class="fa-regular fa-user me-2"></i>
                                    Thông tin cá nhân
                                </a>

                                <a class="btn-profile-menu d-block p-3 mb-2 rounded" href="#my-courses">
                                    <i class="fa-solid fa-book-open-reader me-2"></i>
                                    Khóa học của tôi
                                </a>

                                <a class="btn-profile-menu d-block p-3 mb-2 rounded" href="#my-orders">
                                    <i class="fas fa-history me-2"></i>
                                    Đơn hàng
                                </a>

                                <a class="btn-profile-menu d-block p-3 rounded" href="#" data-bs-toggle="modal"
                                    data-bs-target="#updateProfileModal">
                                    <i class="fas fa-key me-2"></i>
                                    Cập nhật thông tin
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nội dung bên phải -->
                <div class="col-lg-9">
                    <div class="card" id="profile-info">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Thông tin cá nhân</h5>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Họ và tên</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Auth::user()->name }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Số điện thoại</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Auth::user()->phoneNumber ?? 'Chưa cập nhật' }}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Ngày tham gia</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    {{ Auth::user()->created_at->format('d/m/Y') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4" id="my-courses">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Khóa học của tôi: </h5>
                            @if (Auth::user()->courses && Auth::user()->courses->count() > 0)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Tên khóa học</th>
                                                <th>Ngày đăng ký</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (Auth::user()->courses as $course)
                                                <tr>
                                                    <td>{{ $course->name }}</td>
                                                    <td>{{ $course->pivot->created_at->format('d/m/Y') }}</td>
                                                    <td>
                                                        <span class="badge bg-success">Đang học</span>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-primary">Vào học</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-center">Bạn chưa đăng ký khóa học nào</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Cập nhật thông tin -->
    <div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProfileModalLabel">Cập nhật thông tin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ Auth::user()->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ Auth::user()->phone }}">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <textarea class="form-control" id="address" name="address" rows="3">{{ Auth::user()->address }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Ảnh đại diện</label>
                            <input type="file" class="form-control" id="avatar" name="avatar">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .profile-section {
            background-color: #f8f9fa;
        }

        .profile-image img {
            border: 3px solid #fff;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .text-secondary {
            color: #6c757d;
        }
    </style>
@endsection
