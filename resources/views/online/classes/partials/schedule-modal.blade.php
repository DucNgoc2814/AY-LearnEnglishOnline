<!-- Schedule Modal -->
<div class="modal fade" id="scheduleModal{{ $class->id }}" tabindex="-1" 
    aria-labelledby="scheduleModalLabel{{ $class->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="scheduleModalLabel{{ $class->id }}">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Lịch học - {{ $class->name }} ({{ $class->code }})
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Class Info Section -->
                <div class="row mb-4">
                    <div class="col-md-3 col-6 mb-3">
                        <div class="info-box">
                            <div class="info-label">Ngày bắt đầu</div>
                            <div class="info-value">{{ \Carbon\Carbon::parse($class->start_date)->format('d/m/Y') }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        <div class="info-box">
                            <div class="info-label">Ngày kết thúc</div>
                            <div class="info-value">{{ \Carbon\Carbon::parse($class->end_date)->format('d/m/Y') }}</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 mb-3">
                        @php
                            $now = \Carbon\Carbon::now();
                            $startDate = \Carbon\Carbon::parse($class->start_date);
                            $status = '';
                            $badgeClass = '';
                            
                            if ($startDate->gt($now)) {
                                $status = 'Sắp diễn ra';
                                $badgeClass = 'bg-info';
                                $daysLeft = $now->diffInDays($startDate);
                            } elseif (\Carbon\Carbon::parse($class->end_date)->lt($now)) {
                                $status = 'Đã kết thúc';
                                $badgeClass = 'bg-secondary';
                                $daysLeft = 0;
                            } else {
                                $status = 'Đang học';
                                $badgeClass = 'bg-success';
                                $daysLeft = 0;
                            }
                        @endphp
                        <div class="info-box">
                            <div class="info-label">Trạng thái</div>
                            <div class="info-value">
                                <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                                @if($daysLeft > 0)
                                    <small class="text-muted ms-1">(còn {{ $daysLeft }} ngày)</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Schedule Table Section -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 60px">Buổi</th>
                                <th style="width: 100px">Ngày</th>
                                <th style="width: 120px">Thời gian</th>
                                <th style="width: 200px">Chủ đề</th>
                                <th>Nội dung</th>
                                <th style="width: 180px">Tài liệu</th>
                                <th style="width: 100px">Trạng thái</th>
                                <th style="width: 100px">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($class->sessions && $class->sessions->count() > 0)
                                @foreach($class->sessions->sortBy('session_date') as $session)
                                    @php
                                        // Make sure we're using the same $now variable defined earlier
                                        if (!isset($now)) {
                                            $now = \Carbon\Carbon::now();
                                        }
                                        
                                        $sessionDate = $session->session_date ? \Carbon\Carbon::parse($session->session_date) : null;
                                        $startTime = $session->start_time ? \Carbon\Carbon::parse($session->start_time) : null;
                                        $endTime = $session->end_time ? \Carbon\Carbon::parse($session->end_time) : null;
                                        
                                        // Create a datetime with both date and time for accurate comparison
                                        $sessionDateTime = null;
                                        if ($sessionDate && $startTime) {
                                            // Create a new Carbon instance with the session date
                                            $sessionDateTime = clone $sessionDate;
                                            // Set the time components from the start time
                                            $sessionDateTime->setHour($startTime->hour);
                                            $sessionDateTime->setMinute($startTime->minute);
                                            $sessionDateTime->setSecond($startTime->second);
                                        }
                                        
                                        $status = '';
                                        $badgeClass = '';
                                        
                                        if (!$sessionDate) {
                                            $status = 'Chưa lên lịch';
                                            $badgeClass = 'bg-secondary';
                                        } elseif ($sessionDateTime && $sessionDateTime->isPast()) {
                                            $status = 'Đã học';
                                            $badgeClass = 'bg-success';
                                        } elseif ($sessionDate->isToday()) {
                                            $status = 'Hôm nay';
                                            $badgeClass = 'bg-primary';
                                        } elseif ($sessionDate->diffInDays($now) <= 7) {
                                            $status = 'Sắp học';
                                            $badgeClass = 'bg-warning text-dark';
                                        } else {
                                            $status = 'Chưa học';
                                            $badgeClass = 'bg-secondary';
                                        }
                                    @endphp
                                    <tr>
                                        <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                        <td>{{ $sessionDate ? $sessionDate->format('d/m/Y') : '---' }}</td>
                                        <td>
                                            @if($startTime && $endTime)
                                                {{ $startTime->format('H:i') }} - {{ $endTime->format('H:i') }}
                                            @else
                                                <span class="text-muted">Chưa cập nhật</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($session->topic)
                                                <span class="text-primary">
                                                    <i class="fas fa-book-open me-1"></i>
                                                    {{ $session->topic }}
                                                </span>
                                            @else
                                                <span class="text-muted">Chưa cập nhật</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($session->content)
                                                {{ $session->content }}
                                            @else
                                                <span class="text-muted">Chưa cập nhật</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($session->session_materials)
                                                <div class="d-flex gap-2">
                                                    @foreach(json_decode($session->session_materials) as $material)
                                                        <a href="{{ asset('storage/' . $material->path) }}" 
                                                           class="btn btn-sm btn-outline-primary" 
                                                           download="{{ $material->original_name }}">
                                                            <i class="fas fa-download me-1"></i>
                                                            {{ Str::limit($material->original_name, 20) }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-muted">Chưa có tài liệu</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                                            @if($session->recording_url)
                                                <a href="{{ $session->recording_url }}" 
                                                   target="_blank" 
                                                   class="btn btn-sm btn-link p-0 ms-1" 
                                                   title="Xem bản ghi">
                                                    <i class="fas fa-play-circle"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($session->canJoin() && $session->schedule->meeting_url)
                                                <a href="{{ $session->schedule->meeting_url }}" 
                                                   class="btn btn-sm btn-primary" 
                                                   style="font-size: 0.75rem; padding: 0.25rem 0.5rem;"
                                                   target="_blank"
                                                   title="Vào học">
                                                    <i class="fas fa-sign-in-alt"></i> Vào học
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center py-3 text-muted">
                                        <i class="fas fa-calendar-xmark me-2"></i>Chưa có lịch học chi tiết
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<style>
.modal-xl {
    max-width: 1200px;
}

.modal-header {
    border-bottom: 0;
    padding: 1rem 1.5rem;
}

.info-box {
    background: #f8f9fa;
    padding: 12px;
    border-radius: 8px;
    height: 100%;
}

.info-label {
    color: #6c757d;
    font-size: 13px;
    margin-bottom: 4px;
}

.info-value {
    font-weight: 500;
    font-size: 15px;
}

.table {
    margin-bottom: 0;
}

.table > :not(caption) > * > * {
    padding: 12px 8px;
}

.table th {
    font-weight: 600;
    background-color: #f8f9fa;
}

.badge {
    font-weight: 500;
    padding: 6px 10px;
}

.btn-sm {
    padding: 0.25rem 0.75rem;
}

.btn-link {
    text-decoration: none;
}

.btn-link:hover {
    text-decoration: none;
    opacity: 0.8;
}

@media (max-width: 768px) {
    .modal-dialog {
        margin: 0.5rem;
    }
    
    .info-box {
        padding: 8px;
    }
    
    .info-label {
        font-size: 12px;
    }
    
    .info-value {
        font-size: 14px;
    }
    
    .table th, .table td {
        font-size: 13px;
        padding: 8px;
    }
    
    .badge {
        font-size: 11px;
        padding: 4px 8px;
    }
}
</style>