@extends('online.layouts.master')

@section('title', 'Khen thưởng và Kỷ luật')

@section('content')
    <div class="content-section">
        <div class="row mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0 text-primary">
                        <i class="fas fa-award me-2"></i>Khen thưởng và Kỷ luật
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="recordsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="awards-tab" data-bs-toggle="tab" data-bs-target="#awards"
                                type="button" role="tab" aria-controls="awards" aria-selected="true">Khen
                                thưởng</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="disciplines-tab" data-bs-toggle="tab" data-bs-target="#disciplines"
                                type="button" role="tab" aria-controls="disciplines" aria-selected="false">Kỷ
                                luật</button>
                        </li>
                    </ul>

                    <div class="tab-content mt-4" id="recordsTabContent">
                        <!-- Awards Tab -->
                        <div class="tab-pane fade show active" id="awards" role="tabpanel" aria-labelledby="awards-tab">
                            @if (count($awards) > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Ngày</th>
                                                <th>Danh hiệu/Hình thức</th>
                                                <th>Nội dung</th>
                                                <th>Quyết định số</th>
                                                <th>Cấp khen thưởng</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($awards as $award)
                                                <tr>
                                                    <td>{{ $award->date ?? '' }}</td>
                                                    <td>{{ $award->title ?? '' }}</td>
                                                    <td>{{ $award->content ?? '' }}</td>
                                                    <td>{{ $award->decision_number ?? '' }}</td>
                                                    <td>{{ $award->level ?? '' }}</td>
                                                    <td>
                                                        <a href="{{ route('online.awards.show', $award->id ?? 1) }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>Bạn chưa có thông tin khen thưởng nào.
                                </div>
                            @endif
                        </div>

                        <!-- Disciplines Tab -->
                        <div class="tab-pane fade" id="disciplines" role="tabpanel" aria-labelledby="disciplines-tab">
                            @if (count($disciplines) > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Ngày</th>
                                                <th>Hình thức kỷ luật</th>
                                                <th>Nội dung vi phạm</th>
                                                <th>Quyết định số</th>
                                                <th>Cấp ra quyết định</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($disciplines as $discipline)
                                                <tr>
                                                    <td>{{ $discipline->date ?? '' }}</td>
                                                    <td>{{ $discipline->type ?? '' }}</td>
                                                    <td>{{ $discipline->violation ?? '' }}</td>
                                                    <td>{{ $discipline->decision_number ?? '' }}</td>
                                                    <td>{{ $discipline->authority ?? '' }}</td>
                                                    <td>
                                                        <a href="{{ route('online.awards.show', $discipline->id ?? 1) }}"
                                                            class="btn btn-sm btn-primary">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle me-2"></i>Bạn không có thông tin kỷ luật nào.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
