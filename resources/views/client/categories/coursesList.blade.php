<div class="grid-view-body courses courses-list-view-body">
    <div class="courses-card courses-grid-view-card row">
        @foreach ($data as $category)
            @foreach ($category->courses as $course)
                <div class="col-lg-4 col-md-6 col-sm-12">
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
                                        <h5 class="text-danger">{{ number_format($course->salePrice) }}</h5>
                                        <p class="mt-1"><del>{{ number_format($course->price) }}</del></p>
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
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        @if (isset($data[0]->courses))
            @if ($data[0]->courses->hasPages())
                <nav>
                    <ul class="pagination">
                        {{-- Previous Page --}}
                        @if ($data[0]->courses->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link border">&lsaquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link border"
                                    href="{{ $data[0]->courses->previousPageUrl() }}">&lsaquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($data[0]->courses->getUrlRange(1, $data[0]->courses->lastPage()) as $page => $url)
                            <li class="page-item {{ $data[0]->courses->currentPage() == $page ? 'active' : '' }}">
                                <a class="page-link border" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Next Page --}}
                        @if ($data[0]->courses->hasMorePages())
                            <li class="page-item">
                                <a class="page-link border" href="{{ $data[0]->courses->nextPageUrl() }}">&rsaquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link border">&rsaquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif
        @endif
    </div>
</div>
