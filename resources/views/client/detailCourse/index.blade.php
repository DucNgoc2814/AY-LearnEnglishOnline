@extends('client.layouts.master')
@section('title', 'Chi tiết khóa học')
@section('content')
    @include('client.detailCourse.bannerCourse')

    <!--------- course Decription Page Start ------>
    <section class="course-decription">
        <div class="container">
            <div class="row">
                @include('client.detailCourse.tabList')
                <div class="col-lg-4 col-md-12 col-sm-12 order-1 order-lg-2">
                    <div class="course-right-section">
                        <div class="course-card">
                            <div class="card-img">
                                <div class="courses-card-image">
                                    <img loading="lazy" class="w-100"
                                        src="{{ asset('themes/client/uploads/thumbnails/course_thumbnails/optimized/course_thumbnail_default-new_131701063901.jpg') }}">
                                </div>
                            </div>
                            <div class="ammount d-flex">
                                <h1 class="fw-500 text-danger">{{ $course->salePrice }}</h1>
                                <h3 class="fw-500"><del>{{ $course->price }}</del></h3>
                            </div>
                            <div class="enrol">
                                <div class="icon">
                                    <i class="fas fa-book text-primary"></i>
                                    <h4 class="ms-2">Bài học</h4>
                                </div>
                                <h5>{{ $course->totalLessons() }}</h5>
                            </div>

                            <div class="enrol">
                                <div class="icon">
                                    <i class="fas fa-check-circle text-success"></i>
                                    <h4 class="ms-2">Bài kiểm tra</h4>
                                </div>

                                <h5>{{ $course->totalTests() }}</h5>
                            </div>

                            <div class="enrol">
                                <div class="icon">
                                    <i class="fas fa-clock"></i>
                                    <h4 class="ms-2">Thời lượng</h4>
                                </div>
                                <h5>{{ $course->totalDuration() }}</h5>
                            </div>

                            <div class="enrol">
                                <div class="icon">
                                    <i class="fas fa-graduation-cap text-warning"></i>
                                    <h4 class="ms-2">Bằng cấp</h4>
                                </div>

                                <h5>Có</h5>
                            </div>


                            <!-- button -->
                            <div class="button">

                                <a href="#" onclick="actionTo('../../handle_buy_now/13.html')"><i
                                        class="fas fa-credit-card"></i> Mua ngay</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--------- course Decription Page end ------>
    @include('client.detailCourse.relatedCourse')
@endsection
