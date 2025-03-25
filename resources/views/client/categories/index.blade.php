@extends('client.layouts.master')
@section('title', 'Trang chủ | AY-LearnEnglish')
@section('content')
    <section class="grid-view courses-grid-view py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-4 col-12">
                    <form action="{{ route('category.index') }}" method="get" id="course_filter_form">
                        <div class="course-all-category">
                            <div class="course-category">
                                <h3>Danh mục</h3>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="all" name="category"
                                        id="category_all" onchange="filterCourse(this)"
                                        {{ !request()->route('slug') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="category_all">
                                        <a href="{{ route('category.index') }}" class="category-link">
                                            <div class="category-heading">
                                                <span class="text-13px">Tất cả danh mục</span>
                                            </div>
                                        </a>
                                    </label>
                                </div>
                                <div class="webdesign webdesign-category less">
                                    @foreach ($categories as $category)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="{{ $category->slug }}"
                                                name="category" id="category-{{ $category->id }}"
                                                onchange="filterCourse(this)"
                                                {{ request()->route('slug') === $category->slug ? 'checked' : '' }}>
                                            <label class="form-check-label" for="category-{{ $category->id }}">
                                                <a href="{{ route('category.index', $category->slug) }}"
                                                    class="category-link">
                                                    <div class="category-heading">
                                                        <span class="text-13px">{{ $category->name }}</span>
                                                        <span>({{ $category->courses->count() }})</span>
                                                    </div>
                                                </a>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <input id="sorting_hidden_input" type="hidden" name="sort_by" value="all">

                    </form>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8">
                    <div class="grid-view-body courses courses-list-view-body">
                        <div class="courses-card courses-grid-view-card row">
                            <div id="courses-container">
                                @include('client.categories.coursesList', ['data' => $data])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        function filterCourse(element) {
            const categorySlug = element.value;
            const baseUrl = "{{ route('category.index') }}";
            const url = categorySlug === 'all' ? baseUrl : `${baseUrl}/${categorySlug}`;
            window.history.pushState({}, '', url);
            const coursesContainer = document.getElementById('courses-container');
            coursesContainer.style.opacity = '0.5';
            fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        coursesContainer.innerHTML = data.html;
                        coursesContainer.style.opacity = '1';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    coursesContainer.style.opacity = '1';
                });

            return false;
        }
        document.getElementById('course_filter_form').addEventListener('submit', (e) => {
            e.preventDefault();
        });
        document.addEventListener('DOMContentLoaded', () => {
            const coursesContainer = document.getElementById('courses-container');
            coursesContainer.style.transition = 'opacity 0.3s ease';
        });
    </script>
@endpush
