@extends('online.layouts.master')

@section('title', 'Chi tiết điểm danh')

@push('styles')
    <style>
        .session-info {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
        }

        .session-info-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .session-info-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-color);
            margin: 0;
        }

        .session-info-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .meta-item i {
            color: var(--primary-color);
        }

        .attendance-list {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .attendance-header {
            padding: 0.5rem 1rem;
            background: var(--bg-color);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .attendance-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-color);
            margin: 0;
        }

        .attendance-actions {
            display: flex;
            gap: 0.75rem;
        }

        .attendance-table {
            width: 100%;
            border-collapse: collapse;
        }

        .attendance-table th {
            background: var(--bg-color);
            padding: 0.75rem;
            font-weight: 600;
            text-align: left;
            color: var(--text-color);
            border-bottom: 1px solid var(--border-color);
        }

        .attendance-table td {
            padding: 0px 0.75rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .attendance-table tr:last-child td {
            border-bottom: none;
        }

        .attendance-table tr:hover {
            background: var(--bg-color);
        }

        .student-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .student-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1rem;
        }

        .student-id {
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 600;
        }

        .attendance-status {
            display: flex;
            align-items: center;
        }

        .form-check.form-switch {
            padding-left: 4em;
            margin-bottom: 0;
        }

        .form-check-input {
            width: 3.5em !important;
            height: 1.5em !important;
            cursor: pointer;
        }

        .status-radio {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .status-radio input[type="radio"] {
            appearance: none;
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #ddd;
            border-radius: 50%;
            margin: 0;
            position: relative;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .status-radio input[type="radio"]:checked {
            border-width: 5px;
        }

        .status-radio input[value="present"] {
            border-color: #22c55e;
        }

        .status-radio input[value="absent"] {
            border-color: #ef4444;
        }

        .status-radio input[value="present"]:checked {
            background-color: white;
            border-color: #22c55e;
        }

        .status-radio input[value="absent"]:checked {
            background-color: white;
            border-color: #ef4444;
        }

        .status-radio span {
            font-size: 0.875rem;
            font-weight: 500;
        }

        .note-input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius-sm);
            font-size: 0.875rem;
            resize: none;
        }

        .save-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.55rem 1.5rem;
            border-radius: var(--border-radius-sm);
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }

        .save-btn:hover {
            background: var(--primary-dark);
        }

        .save-btn:disabled {
            background: var(--border-color);
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .session-info-meta {
                gap: 1rem;
            }

            .attendance-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .attendance-actions {
                width: 100%;
            }

            .save-btn {
                width: 100%;
            }

            .attendance-table {
                display: block;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
        }

        .attendance-form {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            margin-bottom: 2rem;
        }

        .attendance-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            margin-bottom: 1rem;
            background: white;
        }

        .student-info {
            flex: 1;
            margin-right: 2rem;
        }

        .student-name {
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-color);
        }

        .student-id {
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        .attendance-status {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        /* Custom Radio Button Styles */
        .status-group {
            display: flex;
            gap: 2rem;
        }

        .status-option {
            position: relative;
        }

        .status-input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .status-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .status-radio {
            width: 20px;
            height: 20px;
            border: 2px solid #ddd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .status-radio::after {
            content: '';
            width: 10px;
            height: 10px;
            border-radius: 50%;
            transition: all 0.3s ease;
            transform: scale(0);
        }

        .status-text {
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* Present Status */
        .status-input[value="present"]+.status-label .status-text {
            color: #22c55e;
        }

        .status-input[value="present"]:checked+.status-label .status-radio {
            border-color: #22c55e;
        }

        .status-input[value="present"]:checked+.status-label .status-radio::after {
            background-color: #22c55e;
            transform: scale(1);
        }

        /* Absent Status */
        .status-input[value="absent"]+.status-label .status-text {
            color: #ef4444;
        }

        .status-input[value="absent"]:checked+.status-label .status-radio {
            border-color: #ef4444;
        }

        .status-input[value="absent"]:checked+.status-label .status-radio::after {
            background-color: #ef4444;
            transform: scale(1);
        }

        .note-input {
            margin-top: 1rem;
            width: 100%;
        }

        .save-btn {
            width: 20%;
            padding: 0.75rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .save-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
        }

        .form-check.form-switch {
            padding-left: 3.5em;
        }


        .form-check-input:checked {
            background-color: #0c339e;
            border-color: #0c339e;
        }

        .status-text {
            font-size: 0.875rem;
            font-weight: 500;
            margin-left: 0.5rem;
        }

        .form-check-input:checked~.form-check-label .status-text {
            color: #0c339e;
        }

        .form-check-input:not(:checked)~.form-check-label .status-text {
            color: #ef4444;
            color: #ef4444;
        }
    </style>
@endpush

@section('content')
    <div class="row mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-primary">
                    <i class="fas fa-clipboard-check me-2"></i>Chi tiết điểm danh
                </h5>
                <a href="{{ route('online.attendance.sessions', ['class' => $class->id]) }}"
                    class="btn btn-sm btn-outline-primary back-btn">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại
                </a>
            </div>
            <div class="card-body">
                <!-- Session Info -->
                <div class="session-info">
                    <div class="session-info-header">
                        <h4 class="session-info-title">{{ $session->topic ? $session->topic : 'Buổi học ' . ($session->id) }}</h4>
                    </div>
                    <div class="session-info-meta">
                        <div class="meta-item">
                            <i class="fas fa-calendar"></i>
                            <span>{{ $session->session_date ? \Carbon\Carbon::parse($session->session_date)->format('d/m/Y') : 'Chưa có lịch' }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-clock"></i>
                            <span>{{ ($session->start_time ? \Carbon\Carbon::parse($session->start_time)->format('H:i') : '--:--') }} - {{ ($session->end_time ? \Carbon\Carbon::parse($session->end_time)->format('H:i') : '--:--') }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-users"></i>
                            <span>Sĩ số: {{ $totalStudents }} học viên</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-user-check"></i>
                            <span>Có mặt: {{ $presentCount }} học viên</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-user-times"></i>
                            <span>Vắng mặt: {{ $absentCount }} học viên</span>
                        </div>
                    </div>
                </div>

                <!-- Attendance List -->
                <div class="attendance-form">
                    <div class="attendance-list">
                        <div class="attendance-header d-flex justify-content-between align-items-center">
                            <h5 class="attendance-title">Danh sách điểm danh - {{ $class->name }} ({{ $class->code }})</h5>
                            <button type="button" class="save-btn" id="saveAttendance">
                                <i class="fas fa-save me-2"></i>Lưu điểm danh
                            </button>
                        </div>

                        <table class="attendance-table">
                            <thead>
                                <tr>
                                    <th style="width: 40px">STT</th>
                                    <th>Mã học viên</th>
                                    <th>Học viên</th>
                                    <th style="width: 200px">Trạng thái</th>
                                    <th>Ghi chú</th>
                                    <th>Tiến độ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($registrations as $index => $registration)
                                    @php
                                        $student = $registration->student;
                                    @endphp
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="student-id">{{ $student->student_code }}</div>
                                        </td>
                                        <td>
                                            <div class="student-info">
                                                <div class="student-avatar">
                                                    {{ strtoupper(substr($student->full_name ?? '', 0, 1)) }}
                                                </div>
                                                <div class="student-name">{{ $student->full_name }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="attendance-status">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        name="attendance[{{ $student->id }}][status]" 
                                                        data-student-id="{{ $student->id }}"
                                                        id="attendance{{ $student->id }}" 
                                                        {{ isset($student->current_attendance) && $student->current_attendance && $student->current_attendance->status == 'present' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="attendance{{ $student->id }}">
                                                        <span class="status-text">{{ isset($student->current_attendance) && $student->current_attendance && $student->current_attendance->status == 'present' ? 'Có mặt' : 'Vắng mặt' }}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <textarea class="note-input" rows="1" data-student-id="{{ $student->id }}" 
                                               placeholder="Nhập ghi chú...">{{ isset($student->current_attendance) && $student->current_attendance ? $student->current_attendance->notes : '' }}</textarea>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                                    <div class="progress-bar bg-primary" role="progressbar"
                                                        style="width: {{ $student->attendance_stats['attendance_rate'] ?? 0 }}%;"
                                                        aria-valuenow="{{ $student->attendance_stats['present_count'] ?? 0 }}" 
                                                        aria-valuemin="0"
                                                        aria-valuemax="{{ $student->attendance_stats['total_sessions'] ?? 0 }}">
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column align-items-end">
                                                    <span class="small">{{ $student->attendance_stats['present_count'] ?? 0 }}/{{ $student->attendance_stats['total_sessions'] ?? 0 }}</span>
                                                    @if(isset($student->attendance_stats['absent_count']) && $student->attendance_stats['absent_count'] > 0)
                                                    <span class="small text-danger fw-medium">(Nghỉ: {{ $student->attendance_stats['absent_count'] }} buổi)</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-info-circle me-2"></i>Chưa có học viên nào trong lớp
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle save button click
            const saveButton = document.getElementById('saveAttendance');
            const form = document.querySelector('.attendance-form');
            
            if (saveButton && form) {
                saveButton.addEventListener('click', function() {
                    // Disable the button to prevent double-click
                    saveButton.disabled = true;
                    saveButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Đang lưu...';
                    
                    // Collect attendance data
                    let attendanceData = [];
                    
                    // Get all student rows
                    const rows = document.querySelectorAll('.attendance-table tbody tr');
                    
                    // Loop through each row to get attendance data
                    rows.forEach(function(row) {
                        const checkbox = row.querySelector('.form-check-input');
                        
                        if (checkbox && checkbox.getAttribute('data-student-id')) {
                            const studentId = checkbox.getAttribute('data-student-id');
                            const status = checkbox.checked ? 'present' : 'absent';
                            const noteElem = row.querySelector('.note-input');
                            const notes = noteElem ? noteElem.value : '';
                            
                            // Add to attendance data array
                            attendanceData.push({
                                student_id: studentId,
                                status: status,
                                notes: notes
                            });
                        }
                    });
                    
                    // Prepare the data to send
                    const postData = {
                        attendance: attendanceData
                    };
                    
                    // Make the AJAX request using fetch
                    fetch('{{ route("online.attendance.save", ["id" => $session->id]) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(postData)
                    })
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(data) {
                        console.log('Success:', data);
                        // Re-enable button
                        saveButton.disabled = false;
                        saveButton.innerHTML = '<i class="fas fa-save me-2"></i>Lưu điểm danh';
                        window.location.reload();
                    })
                    .catch(function(error) {
                        console.error('Error:', error);
                        // Re-enable button
                        saveButton.disabled = false;
                        saveButton.innerHTML = '<i class="fas fa-save me-2"></i>Lưu điểm danh';
                        
                        // Show error message
                        alert('Có lỗi xảy ra khi lưu điểm danh. Vui lòng thử lại!');
                    });
                });
            }
            
            // Handle switch changes - update row styling
            document.querySelectorAll('.form-check-input').forEach(function(input) {
                // Apply initial styling
                updateRowStyling(input);
                
                // Add event listener for changes
                input.addEventListener('change', function() {
                    updateRowStyling(this);
                });
            });
            
            // Function to update row styling based on attendance status
            function updateRowStyling(checkbox) {
                const row = checkbox.closest('tr');
                if (row) {
                    row.classList.remove('table-success', 'table-danger');
                    if (checkbox.checked) {
                        row.classList.add('table-success');
                    } else {
                        row.classList.add('table-danger');
                    }
                }
            }
        });
    </script>
@endpush

