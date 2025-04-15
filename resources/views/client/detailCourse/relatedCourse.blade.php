<!-------- Related course section start ----->
<section class="courses grid-view-body course-details-card">
    <div class="container">
        <h1>Khóa học liên quan</h1>
        <div class="courses-card">
            <div class="row">
                @if ($relatedCourses->count() > 0)
                    @foreach ($relatedCourses as $relatedCourse)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12 single-popup-course">
                            <a href="{{ route('detailCourse', $relatedCourse->slug) }}" class="checkPropagation courses-card-body">
                                <div class="courses-card-image">
                                    <img loading="lazy"
                                        src="{{ asset('themes/client/assets/frontend/default-new/img/course_thumbnail_placeholder.jpg') }}">
                                    <div class="courses-card-image-text">
                                        <h3>Intermediate</h3>
                                    </div>
                                </div>  
                                <div class="courses-text">
                                    <h5 class="mb-2">{{ $relatedCourse->title }}</h5>
                                    <div class="review-icon d-flex align-items-center mb-1">
                                        <div class="review-icon-star d-flex align-items-center">
                                            @for ($i = 0; $i < $relatedCourse->rating; $i++)
                                                <i class="fa-solid fa-star filled mx-0"></i>
                                            @endfor
                                            <p class="m-0 ms-1">({{ $relatedCourse->total_ratings }} lượt)</p>
                                        </div>
                                        <div class="review-btn d-flex align-items-center ms-auto">
                                            <p class="m-0 text-primary fw-bold">
                                                <i class="fa-solid fa-users p-0 text-15px text-primary"></i>
                                                {{ $relatedCourse->total_students }}
                                            </p>
                                        </div>
                                    </div>
                                    <p class="ellipsis-line-2">{{ $relatedCourse->short_description }}</p>
                                    <div class="courses-price-border">
                                        <div class="courses-price">
                                            <div class="courses-price-left">
                                                <h5 class="text-danger">{{ number_format($relatedCourse->sale_price, 0, ',', '.') }}</h5>
                                                <p class="mt-1"><del>{{ number_format($relatedCourse->price, 0, ',', '.') }}</del></p>
                                            </div>
                                            <div class="courses-price-right d-flex align-items-center">
                                                <i class="fa-regular fa-clock text-primary"></i>
                                                <p class="m-0">{{ $relatedCourse->totalDuration() }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <p>Không tìm thấy khóa học liên quan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
