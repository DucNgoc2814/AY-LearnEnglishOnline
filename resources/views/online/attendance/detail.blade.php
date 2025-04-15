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
        }
    </style>
@endpush

@section('content')
    <div class="content-section">
        <div class="session-info">
            <div class="session-info-header">
                <h4 class="session-info-title">Buổi 16 - Unit 8: Daily Activities</h4>
            </div>
            <div class="session-info-meta">
                <div class="meta-item">
                    <i class="fas fa-calendar"></i>
                    <span>15/03/2024</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-clock"></i>
                    <span>18:00 - 20:00</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-users"></i>
                    <span>Sĩ số: 20/20 học viên</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-user-check"></i>
                    <span>Có mặt: 15 học viên</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-user-times"></i>
                    <span>Vắng mặt: 5 học viên</span>
                </div>
            </div>
        </div>

        <div class="attendance-form">
            <div class="attendance-list">
                <div class="attendance-header d-flex justify-content-between align-items-center">
                    <h5 class="attendance-title">Danh sách điểm danh</h5>
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
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i <= 20; $i++)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>
                                    <div class="student-id">PH{{ str_pad($i, 5, '0', STR_PAD_LEFT) }}</div>
                                </td>
                                <td>
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            {{ chr(64 + $i) }}
                                        </div>
                                        <div class="student-name">Học viên {{ chr(64 + $i) }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="attendance-status">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                name="attendance[{{ $i }}][status]"
                                                id="attendance{{ $i }}" {{ $i <= 15 ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <textarea class="note-input" rows="1" placeholder="Nhập ghi chú..."></textarea>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle switch changes
            document.querySelectorAll('.form-check-input').forEach(input => {
                input.addEventListener('change', function() {
                    const statusText = this.nextElementSibling.querySelector('.status-text');
                    statusText.textContent = this.checked ? 'Có mặt' : 'Vắng mặt';
                });
            });

            // Handle save button click
            const saveButton = document.getElementById('saveAttendance');

            if (saveButton) {
                saveButton.addEventListener('click', function() {
                    // Collect attendance data
                    const attendanceData = [];
                    const rows = document.querySelectorAll('.attendance-table tbody tr');

                    rows.forEach(row => {
                        const studentId = row.querySelector('.student-id').textContent;
                        const status = row.querySelector('.form-check-input').checked ? 'present' :
                            'absent';
                        const note = row.querySelector('.note-input').value;

                        attendanceData.push({
                            studentId,
                            status,
                            note
                        });
                    });

                    // Get the session ID from the URL
                    const sessionId = window.location.pathname.split('/').pop();

                    // Send data to the server
                    fetch(`{{ url('/') }}/attendance/save/${sessionId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content
                            },
                            body: JSON.stringify({
                                attendance: attendanceData
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.message) {
                                alert('Lưu điểm danh thành công!');
                                window.location.reload();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Có lỗi xảy ra khi lưu điểm danh!');
                        });
                });
            }
        });
    </script>
@endpush
