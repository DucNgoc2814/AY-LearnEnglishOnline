@extends('client.layouts.master')
@section('title', 'Home page | AY-LearnEnglish')
@section('content')
    <section class="sign-up my-5 py-5">
        <div class="container ">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12 col-12 text-center">
                    <img loading="lazy" width="65%"
                        src="{{ asset('themes/client/assets/frontend/default-new/image/login-security.gif') }}">
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 col-12 ">
                    <div class="sing-up-right">
                        <h3 class="text-center">Đăng nhập</h3>
                        <p>Khám phá, học tập và phát triển cùng chúng tôi. Hãy bắt đầu một hành trình học tập trực tuyến
                            trơn tru và giàu cảm hứng.
                        </p>

                        <div class="alert alert-info mb-3">
                            <strong>Thông báo bảo mật:</strong>
                            Mỗi tài khoản chỉ có thể đăng nhập trên một trình duyệt tại một thời điểm.
                            Vui lòng đăng xuất khỏi phiên hiện tại trước khi đăng nhập ở thiết bị mới.
                        </div>

                        <form action="{{ route('login.submit') }}" method="post" id="login-form">
                            @csrf
                            <div class="mb-4">
                                <h5>Email</h5>
                                <div class="position-relative">
                                    <i class="fa-solid fa-user"></i>
                                    {{-- <i class="fa-solid fa-shield-halved"></i> --}}
                                    <input class="form-control" id="email" type="email" name="email"
                                        placeholder="Nhập email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="">
                                <h5>Mật khẩu</h5>
                                <div class="position-relative">
                                    <i class="fa-solid fa-key"></i>
                                    <i class="fa-solid fas fa-eye cursor-pointer"
                                        onclick="if($('#password').attr('type') == 'text'){$('#password').attr('type', 'password');}else{$('#password').attr('type', 'text');} $(this).toggleClass('fa-eye'); $(this).toggleClass('fa-eye-slash') "
                                        style="right: 20px; left: unset;"></i>
                                    <input class="form-control" id="password" type="password" name="password"
                                        placeholder="Nhập mật khẩu">
                                </div>
                                <small class="w-100">
                                    <a class="text-end w-100 text-muted" href="login/forgot_password_request.html">Quên mật
                                        khẩu?</a>
                                </small>
                            </div>
                            <div class="log-in">
                                <button type="submit" class="btn btn-primary">
                                    Đăng nhập </button>
                            </div>
                        </form>

                        <div class="text-center">
                            <p>
                                Bạn chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
