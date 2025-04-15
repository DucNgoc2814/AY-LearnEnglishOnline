@extends('online.layouts.master')

@section('title', isset($record->is_discipline) ? 'Chi tiết Kỷ luật' : 'Chi tiết Khen thưởng')

@section('content')
{{-- <div class="content-section"> --}}
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('online.dashboard') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('online.awards.index') }}">Khen thưởng & Kỷ luật</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0 text-primary">
                            @if(isset($record->is_discipline) && $record->is_discipline)
                                <i class="fas fa-exclamation-triangle me-2 text-warning"></i>Chi tiết Kỷ luật
                            @else
                                <i class="fas fa-medal me-2 text-success"></i>Chi tiết Khen thưởng
                            @endif
                        </h5>
                        <a href="{{ route('online.awards.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Quay lại
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(isset($record) && $record)
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-4">
                                    <h5 class="fw-bold mb-3">
                                        @if(isset($record->is_discipline) && $record->is_discipline)
                                            {{ $record->type ?? 'Hình thức kỷ luật' }}
                                        @else
                                            {{ $record->title ?? 'Danh hiệu/Hình thức khen thưởng' }}
                                        @endif
                                    </h5>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-calendar-alt me-2"></i>Ngày: {{ $record->date ?? date('d/m/Y') }}
                                    </p>
                                    <p class="text-muted mb-4">
                                        <i class="fas fa-file-alt me-2"></i>Quyết định số: {{ $record->decision_number ?? 'QĐ-01/2025' }}
                                    </p>

                                    <div class="mb-4">
                                        <h6 class="fw-bold">Nội dung:</h6>
                                        <div class="p-3 bg-light rounded">
                                            @if(isset($record->is_discipline) && $record->is_discipline)
                                                {{ $record->violation ?? 'Chi tiết về hành vi vi phạm sẽ được hiển thị ở đây.' }}
                                            @else
                                                {{ $record->content ?? 'Chi tiết về thành tích và lý do khen thưởng sẽ được hiển thị ở đây.' }}
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <h6 class="fw-bold">
                                                @if(isset($record->is_discipline) && $record->is_discipline)
                                                    Cấp ra quyết định:
                                                @else
                                                    Cấp khen thưởng:
                                                @endif
                                            </h6>
                                            <p>{{ $record->authority ?? $record->level ?? 'Trường AmazingYou' }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="fw-bold">Người ký:</h6>
                                            <p>{{ $record->signed_by ?? 'Hiệu trưởng' }}</p>
                                        </div>
                                    </div>

                                    @if(isset($record->is_discipline) && $record->is_discipline)
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <h6 class="fw-bold">Ngày hiệu lực:</h6>
                                            <p>{{ $record->effective_date ?? date('d/m/Y') }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="fw-bold">Ngày hết hiệu lực:</h6>
                                            <p>{{ $record->expiry_date ?? date('d/m/Y', strtotime('+1 year')) }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm h-100">
                                    <div class="card-header bg-light">
                                        <h6 class="mb-0">Tài liệu đính kèm</h6>
                                    </div>
                                    <div class="card-body">
                                        @if(isset($record->attachments) && count($record->attachments) > 0)
                                            <ul class="list-group list-group-flush">
                                                @foreach($record->attachments as $attachment)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <span>
                                                            <i class="fas fa-file-pdf text-danger me-2"></i>
                                                            {{ $attachment->name ?? 'Quyết định' }}
                                                        </span>
                                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-download"></i>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <div class="text-center py-4">
                                                <i class="fas fa-file-alt text-muted fs-2 mb-2"></i>
                                                <p class="mb-0">Không có tài liệu đính kèm</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-circle me-2"></i>Không tìm thấy thông tin chi tiết.
                            <a href="{{ route('online.awards.index') }}" class="alert-link">Quay lại danh sách</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection 