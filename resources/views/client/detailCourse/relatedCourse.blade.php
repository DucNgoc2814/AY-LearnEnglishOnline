<!-------- Related course section start ----->
<section class="courses grid-view-body course-details-card">
    <div class="container">
        <h1>Khóa học liên quan</h1>
        <div class="courses-card">
            <div class="row">
                @if ($relatedCourses->count() > 0)
                    @foreach ($relatedCourses as $relatedCourse)
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12" style="z-index: ;">
                            <a href="{{ route('detailCourse', $relatedCourse->slug) }}" class="courses-card-body">
                                <div class="courses-card-image">
                                    <img
                                        src="{{ url('themes/client/uploads/thumbnails/course_thumbnails/optimized/course_thumbnail_default-new_141701064819.jpg') }}">
                                    <div class="courses-icon " id="coursesWishlistIcon14">
                                    </div>
                                    <div class="courses-card-image-text">
                                        <h3>{{ $relatedCourse->name }}</h3>
                                    </div>
                                </div>
                                <div class="courses-text">
                                    <h5 class="mb-2">{{ $relatedCourse->name }}</h5>
                                    <div class="review-icon">
                                        <div class="review-icon-star">
                                            <p>{{ $relatedCourse->rating }}</p>
                                            <i class="fa-solid fa-star filled"></i>
                                            <p>({{ $relatedCourse->totalRating }} Đánh giá)</p>
                                        </div>
                                        <div class="review-btn">
                                            <span class="compare-img checkPropagation"
                                                onclick="redirectTo('../../compare63e2.html?course-1=scorm-drawing-course&amp;course-id-1=14');">
                                                <img loading="lazy"
                                                    src="../../../assets/frontend/default-new/image/compare.png">
                                                Compare </span>
                                        </div>
                                    </div>
                                    <p class="m-0 text-primary fw-bold"> <i
                                            class="fa-solid fa-users p-0 text-15px text-primary"></i>
                                        {{ $relatedCourse->totalStudent }}
                                    </p>
                                    <p class="ellipsis-line-2 mx-0">{{ $relatedCourse->sortDescription }}</p>
                                    <div class="courses-price-border">
                                        <div class="courses-price">
                                            <div class="courses-price-left">
                                                <h5 class="text-danger">{{ $relatedCourse->salePrice }}</h5>
                                                <p class="mt-1"><del>{{ $relatedCourse->price }}</del></p>
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
