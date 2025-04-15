<!-- Schedule Modal -->
<div class="modal fade" id="scheduleModal{{ $class->id }}" tabindex="-1" 
    aria-labelledby="scheduleModalLabel{{ $class->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleModalLabel{{ $class->id }}">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Lịch học - {{ $class->name }} ({{ $class->code }})
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <span class="fw-bold">Loại lớp:</span><br>
                                {{ $class->class_type == 'online' ? 'Trực tuyến' : 'Tại trung tâm' }}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <span class="fw-bold">Ngày bắt đầu:</span><br>
                                {{ \Carbon\Carbon::parse($class->start_date)->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <span class="fw-bold">Ngày kết thúc:</span><br>
                                {{ \Carbon\Carbon::parse($class->end_date)->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="col-md-3">
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
                                    $status = 'Đang diễn ra';
                                    $badgeClass = 'bg-success';
                                    $daysLeft = 0;
                                }
                            @endphp
                            <div class="mb-3">
                                <span class="fw-bold">Trạng thái:</span><br>
                                <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                                @if($daysLeft > 0)
                                    <small>(còn {{ $daysLeft }} ngày)</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 8%">Buổi</th>
                                <th style="width: 15%">Ngày</th>
                                <th style="width: 25%">Phòng/Link</th>
                                <th>Nội dung</th>
                                <th style="width: 15%">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($class->sessions && $class->sessions->count() > 0)
                                @foreach($class->sessions as $session)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $session->session_date ? date('d/m/Y', strtotime($session->session_date)) : '' }}</td>
                                        <td>
                                            @if($class->class_type == 'online' && isset($session->room) && filter_var($session->room, FILTER_VALIDATE_URL))
                                                <a href="{{ $session->room }}" target="_blank">
                                                    Link học trực tuyến
                                                </a>
                                            @else
                                                {{ $session->room ?? ($class->class_type == 'online' ? 'Link học trực tuyến' : 'Chưa cập nhật') }}
                                            @endif
                                        </td>
                                        <td>{{ $session->content ?? 'Chưa cập nhật' }}</td>
                                        <td>
                                            @php
                                                $now = \Carbon\Carbon::now();
                                                $sessionDate = $session->session_date ? \Carbon\Carbon::parse($session->session_date) : null;
                                                $status = '';
                                                $badgeClass = '';
                                                
                                                if (!$sessionDate) {
                                                    $status = 'Chưa lên lịch';
                                                    $badgeClass = 'bg-secondary';
                                                } elseif ($sessionDate->isPast()) {
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
                                            <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center py-4">Chưa có lịch học chi tiết</td>
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