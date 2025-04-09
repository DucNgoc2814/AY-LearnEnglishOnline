@extends('client.layouts.master')

@section('title', 'Kết quả tìm kiếm')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Kết quả tìm kiếm cho "{{ $query }}"</h1>

                        @if($courses->isEmpty())
                <div class="alert alert-info">
                    Không tìm thấy khóa học nào phù hợp với từ khóa "{{ $query }}"
                </div>
            @else
                <div class="row">
                    @foreach($courses as $course)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                @if($course->thumbnail)
                                    <img src="{{ asset($course->thumbnail) }}" class="card-img-top" alt="{{ $course->title }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="bg-light" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $course->title }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($course->description, 100) }}</p>
                                    @if($course->category)
                                        <span class="badge bg-primary">{{ $course->category->name }}</span>
                                    @endif
                                </div>
                                <div class="card-footer bg-white border-top-0">
                                    <a href="{{ route('detailCourse', $course->slug) }}" class="btn btn-primary w-100">
                                        Xem chi tiết
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $courses->appends(['query' => $query])->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .card {
        transition: transform 0.2s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .badge {
        font-size: 0.8rem;
    }
</style>
@endpush
 