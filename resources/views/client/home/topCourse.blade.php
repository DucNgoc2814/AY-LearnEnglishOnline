    <section class="courses Ecourse grid-view-body py-5 wow  animate__animated animate__fadeInUp opacityOnUp"
        data-wow-duration="500" data-wow-delay="300">
        <div class="container">
            <h1 class="pt-0 f-36"><span>Các khóa học hàng đầu</span></h1>
            <p class="ms-0">Đây là những khóa học phổ biến nhất trong số các khóa học cho người mới bắt đầu học tiếng
                anh.</p>
            <div class="courses-card">
                <div class="course-group-slider" data-wow-duration="1000" data-wow-delay="500">
                    @foreach ($topCourses as $course)
                        <div class="single-popup-course ">
                            <a href="{{ route('detailCourse', $course->slug) }}" id="top_course_12"
                                class="checkPropagation courses-card-body">
                                <div class="courses-card-image">
                                    <img loading="lazy"
                                        src="{{ asset('themes/client/assets/frontend/default-new/img/course_thumbnail_placeholder.jpg') }}">
                                    <div class="courses-card-image-text">
                                        <h3>Intermediate</h3>
                                    </div>
                                </div>
                                <div class="courses-text">
                                    <h5 class="mb-2">{{ $course->name }}</h5>
                                    <div class="review-icon d-flex align-items-center mb-1">
                                        <div class="review-icon-star d-flex align-items-center">
                                            @for ($i = 0; $i < $course->rating; $i++)
                                                <i class="fa-solid fa-star filled mx-0"></i>
                                            @endfor
                                            <p class="m-0 ms-1">({{ $course->totalRating }} lượt)</p>
                                        </div>
                                        <div class="review-btn d-flex align-items-center ms-auto">
                                            <p class="m-0 text-primary fw-bold">
                                                <i class="fa-solid fa-users p-0 text-15px text-primary"></i>
                                                {{ $course->totalStudent }}
                                            </p>
                                        </div>
                                    </div>

                                    <p class="ellipsis-line-2">{{ $course->shortDescription }}</p>
                                    <div class="courses-price-border">
                                        <div class="courses-price">
                                            <div class="courses-price-left">
                                                <h5 class="text-danger">{{ number_format($course->salePrice, 0, ',', '.') }}</h5>
                                                <p class="mt-1"><del>{{ number_format($course->price, 0, ',', '.') }}</del></p>
                                            </div>
                                            <div class="courses-price-right d-flex align-items-center">
                                                <i class="fa-regular fa-clock text-primary"></i>
                                                <p class="m-0">{{ $course->totalDuration() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
