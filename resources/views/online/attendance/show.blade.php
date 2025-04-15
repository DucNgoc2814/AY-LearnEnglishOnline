@extends('online.layouts.master')

@section('title', 'Chi tiết điểm danh')

@section('content')
<div class="content-section">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Chi tiết điểm danh</h2>
        <a href="{{ route('online.attendance.index') }}" class="btn btn-sm btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i>Quay lại
        </a>
    </div>
    
    <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i>
        Đây là trang hiển thị chi tiết điểm danh cho lớp học với ID: {{ $classId }}
    </div>
    
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="m-0">Thông tin điểm danh</h5>
        </div>
        <div class="card-body">
            <p class="text-muted">Chức năng đang phát triển...</p>
        </div>
    </div>
</div>
@endsection 