@extends('client.layouts.master')
@section('title', 'Home page | AY-LearnEnglish')
@section('content')
    <section class="sign-up my-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12 col-12 text-center">
                    <img loading="lazy" width="65%" src="{{ asset('themes/client/assets/frontend/default-new/image/login-security.gif') }}">
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 col-12 ">
                    <div class="sing-up-right">
                        <h3 class="text-center">Đăng ký</h3>
                        <p>Khám phá, học tập và phát triển cùng chúng tôi. Hãy bắt đầu một hành trình học tập trực tuyến
                            trơn tru và giàu cảm hứng.
                        </p>

                        <form action="{{ route('register.submit') }}" method="post"
                            enctype="multipart/form-data" id="signup-form">
                            @csrf
                            <div class="mb-4">
                                <h5>Họ và tên</h5>
                                <div class="position-relative">
                                    <i class="fa-solid fa-user"></i>
                                    <input class="form-control" id="name" type="text" name="name"
                                        placeholder="Nhập họ và tên" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h5>Số điện thoại</h5>
                                <div class="position-relative">
                                    <i class="fa-solid fa-user"></i>
                                    <input class="form-control" id="phoneNumber" type="text" name="phoneNumber"
                                        placeholder="Nhập số điện thoại" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h5>Email</h5>
                                <div class="position-relative">
                                    <i class="fa-solid fa-user"></i>
                                    <input class="form-control" id="email" type="email" name="email"
                                        placeholder="Nhập địa chỉ email" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h5>Mật khẩu</h5>
                                <div class="position-relative">
                                    <i class="fa-solid fa-key"></i>
                                    <i class="fa-solid fas fa-eye cursor-pointer"
                                        onclick="if($('#password').attr('type') == 'text'){$('#password').attr('type', 'password');}else{$('#password').attr('type', 'text');} $(this).toggleClass('fa-eye'); $(this).toggleClass('fa-eye-slash') "
                                        style="right: 20px; left: unset;"></i>
                                    <input class="form-control" id="password" type="password" name="password"
                                        placeholder="Nhập mật khẩu" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h5>Nhập lại mật khẩu</h5>
                                <div class="position-relative">
                                    <i class="fa-solid fa-key"></i>
                                    <i class="fa-solid fas fa-eye cursor-pointer"
                                        onclick="if($('#confirm_password').attr('type') == 'text'){$('#confirm_password').attr('type', 'password');}else{$('#confirm_password').attr('type', 'text');} $(this).toggleClass('fa-eye'); $(this).toggleClass('fa-eye-slash') "
                                        style="right: 20px; left: unset;"></i>
                                    <input class="form-control" id="confirm_password" type="password"
                                        name="confirm_password" placeholder="Nhập lại mật khẩu" required>
                                </div>
                            </div>

                            <div class="log-in">
                                <button type="submit" class="btn btn-primary">
                                    Đăng ký </button>
                            </div>
                        </form>

                        <div class="text-center">
                            <p>
                                Bạn đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
