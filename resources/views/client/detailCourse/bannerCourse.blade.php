    <section>
        <div class="bread-crumb courses-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="courses-details-1st-text">
                            <h1>{{ $course->title }}</h1>
                            <p class="mb-3">{{ $course->short_description }}</p>
                            <div class="review">
                                <div class="row ">
                                    <div class="col-12 course-heading-info mb-3">
                                        <div class="info-tag">
                                            <i class="fa-regular fa-clock text-15px mt-7px"></i>
                                            <p class="text-15px mt-1">{{ $course->totalDuration() }}</p>
                                        </div>
                                        <div class="info-tag">
                                            <i class="fa-regular fa-user text-15px mt-7px"></i>
                                            <p class="text-15px mt-1">{{ $course->total_students }}</p>
                                        </div>

                                        <div class="info-tag">
                                            <div class="icon">
                                                <ul>
                                                    @for ($i = 0; $i < $course->rating; $i++)
                                                        <li class="me-0"><i
                                                                class="fa-solid fa-star text-15px  mt-7px"></i>
                                                        </li>
                                                    @endfor
                                                    <p class="text-15px mt-1">({{ $course->totalRating }} Đánh giá)</p>
                                                </ul>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-12 course-heading-info mb-3">
                                        <div class="info-tag">
                                            <i class="fas fa-book text-15px mt-8px"></i>
                                            <p class="text-15px mt-1">{{ $course->category->name }}</p>
                                        </div>

                                        <div class="info-tag">
                                            <p><i class="far fa-calendar-alt text-15px mt-7px"></i></p>
                                            <p class="text-15px mt-1">
                                                {{ $course->created_at->format('d-m-Y') }} </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!---------- Banner Area End ---------->
