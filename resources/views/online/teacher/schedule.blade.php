@extends('online.layouts.master')

@section('title', 'Lịch giảng dạy')

@push('styles')
<style>
    .schedule-container {
        margin-bottom: 2rem;
    }

    .schedule-filter {
        background: var(--card-bg);
        border-radius: var(--border-radius);
        padding: 1rem;
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-color);
    }

    .week-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .current-week {
        font-size: 1.1rem;
        font-weight: 600;
    }

    .schedule-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .schedule-table th,
    .schedule-table td {
        border: 1px solid var(--border-color);
        padding: 0.5rem;
        vertical-align: top;
    }

    .day-header {
        background-color: var(--primary-color);
        color: white;
        text-align: center;
        padding: 0.75rem;
        font-weight: 600;
    }

    .day-date {
        font-size: 0.85rem;
        opacity: 0.8;
        margin-top: 0.25rem;
    }

    .time-slot {
        background-color: var(--bg-light);
        font-weight: 600;
        text-align: center;
        width: 100px;
    }

    .slot-time {
        font-size: 0.85rem;
    }

    .slot-name {
        font-size: 0.75rem;
        color: var(--text-muted);
    }

    .session-item {
        background-color: var(--primary-color);
        color: white;
        border-radius: var(--border-radius);
        padding: 0.5rem;
        margin-bottom: 0.5rem;
        font-size: 0.85rem;
    }

    .session-item.completed {
        background-color: var(--success-color);
    }

    .session-item.canceled {
        background-color: var(--danger-color);
        text-decoration: line-through;
    }

    .session-class {
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .session-time,
    .session-location {
        font-size: 0.75rem;
        margin-bottom: 0.25rem;
    }

    .empty-schedule {
        text-align: center;
        padding: 3rem 1rem;
        background: var(--card-bg);
        border-radius: var(--border-radius);
        color: var(--text-muted);
    }

    .empty-schedule i {
        font-size: 3rem;
        margin-bottom: 1rem;
    }
</style>
@endpush

@section('content')
<div class="container">
    <h1 class="page-title">Lịch giảng dạy</h1>

    @if(isset($error))
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @else
        <div class="schedule-container">
            <div class="schedule-filter">
                <form method="GET" action="{{ route('online.teacher.schedule') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Từ ngày</label>
                                <input type="date" name="start_date" class="form-control" value="{{ $startDate->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Đến ngày</label>
                                <input type="date" name="end_date" class="form-control" value="{{ $endDate->format('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Lớp học</label>
                                <select name="class_id" class="form-control">
                                    <option value="">-- Tất cả lớp học --</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}" {{ $selectedClassId == $class->id ? 'selected' : '' }}>
                                            {{ $class->name }} ({{ $class->code }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-primary btn-block">Lọc</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="week-navigation">
                <a href="{{ route('online.teacher.schedule', ['start_date' => $startDate->copy()->subWeek()->format('Y-m-d'), 'end_date' => $endDate->copy()->subWeek()->format('Y-m-d'), 'class_id' => $selectedClassId]) }}" class="btn btn-outline-primary">
                    <i class="fas fa-chevron-left"></i> Tuần trước
                </a>
                <div class="current-week">
                    {{ $startDate->format('d/m/Y') }} - {{ $endDate->format('d/m/Y') }}
                </div>
                <a href="{{ route('online.teacher.schedule', ['start_date' => $startDate->copy()->addWeek()->format('Y-m-d'), 'end_date' => $endDate->copy()->addWeek()->format('Y-m-d'), 'class_id' => $selectedClassId]) }}" class="btn btn-outline-primary">
                    Tuần sau <i class="fas fa-chevron-right"></i>
                </a>
            </div>

            @if(count($calendar) > 0)
                <div class="table-responsive">
                    <table class="schedule-table">
                        <thead>
                            <tr>
                                <th></th>
                                @foreach($calendar as $dateData)
                                    <th class="day-header">
                                        <div>{{ $dateData['day_name'] }}</div>
                                        <div class="day-date">{{ \Carbon\Carbon::parse($dateData['date'])->format('d/m/Y') }}</div>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($calendar[array_key_first($calendar)]['time_slots'] as $index => $timeSlot)
                                <tr>
                                    <td class="time-slot">
                                        <div class="slot-time">{{ $timeSlot[0] }} - {{ $timeSlot[1] }}</div>
                                        <div class="slot-name">Ca {{ $index + 1 }}</div>
                                    </td>
                                    
                                    @foreach($calendar as $dateData)
                                        <td>
                                            @foreach($dateData['sessions'] as $session)
                                                @php
                                                    $sessionStart = $session->start_time;
                                                    $sessionEnd = $session->end_time;
                                                    $slotStart = $timeSlot[0];
                                                    $slotEnd = $timeSlot[1];
                                                    
                                                    // Kiểm tra xem buổi học có nằm trong khung giờ này không
                                                    if (($sessionStart <= $slotEnd) && ($sessionEnd >= $slotStart)) {
                                                        $status = $session->status ?? 'scheduled';
                                                @endphp
                                                    <div class="session-item {{ $status }}">
                                                        <div class="session-class">{{ $session->class->name ?? 'Lớp không xác định' }}</div>
                                                        <div class="session-time">{{ $sessionStart }} - {{ $sessionEnd }}</div>
                                                        <div class="session-location">{{ $session->location ?? 'Online' }}</div>
                                                        <a href="{{ route('online.sessions.show', $session->id) }}" class="text-white">
                                                            <i class="fas fa-eye"></i> Chi tiết
                                                        </a>
                                                    </div>
                                                @php
                                                    }
                                                @endphp
                                            @endforeach
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-schedule">
                    <i class="fas fa-calendar-times"></i>
                    <h3>Không có lịch dạy</h3>
                    <p>Bạn chưa có lịch dạy trong khoảng thời gian đã chọn.</p>
                </div>
            @endif
        </div>
    @endif
</div>
@endsection 