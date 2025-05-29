<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class ClassSchedule extends BaseModel
{
    public static function getBaseRules($id = null)
    {
        return [
            'class_id' => [
                'required',
                'exists:classes,id',
            ],
            'day_of_week' => [
                'required',
                'integer',
                'min:1',
                'max:7'
            ],
            'start_time' => [
                'required',
                'date_format:H:i:s'
            ],
            'end_time' => [
                'required',
                'date_format:H:i:s',
                'after:start_time'
            ],
            'start_date' => [
                'required',
                'date',
                'before_or_equal:end_date'
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date'
            ],
            'room_number' => [
                'nullable',
                'string',
                'max:50',
                'required_if:is_online,false'
            ],
            'meeting_url' => [
                'nullable',
                'string',
                'url',
                'max:255',
                'required_if:is_online,true'
            ],
            'notes' => [
                'nullable',
                'string',
                'max:1000'
            ],
            'is_repeating' => [
                'required',
                'boolean'
            ],
            'is_active' => [
                'required',
                'boolean'
            ],
            'is_online' => [
                'required',
                'boolean'
            ]
        ];
    }

    public static function getFields()
    {
        return [
            'class_id' => [
                'label' => 'Lớp học',
                'type' => 'select',
                'options' => Classes::pluck('name', 'id')->toArray(),
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'day_of_week' => [
                'label' => 'Thứ trong tuần',
                'type' => 'select',
                'options' => [
                    1 => 'Thứ Hai',
                    2 => 'Thứ Ba',
                    3 => 'Thứ Tư',
                    4 => 'Thứ Năm',
                    5 => 'Thứ Sáu',
                    6 => 'Thứ Bảy',
                    7 => 'Chủ Nhật'
                ],
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'start_time' => [
                'label' => 'Giờ bắt đầu',
                'type' => 'time',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'end_time' => [
                'label' => 'Giờ kết thúc',
                'type' => 'time',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'start_date' => [
                'label' => 'Ngày bắt đầu',
                'type' => 'date',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'end_date' => [
                'label' => 'Ngày kết thúc',
                'type' => 'date',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'is_online' => [
                'label' => 'Học trực tuyến',
                'type' => 'checkbox',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'room_number' => [
                'label' => 'Phòng học',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true,
                'depends' => [
                    'is_online' => false
                ]
            ],
            'meeting_url' => [
                'label' => 'Link học trực tuyến',
                'type' => 'url',
                'searchable' => true,
                'sortable' => true,
                'editable' => true,
                'depends' => [
                    'is_online' => true
                ]
            ],
            'is_repeating' => [
                'label' => 'Lặp lại hàng tuần',
                'type' => 'checkbox',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'is_active' => [
                'label' => 'Đang hoạt động',
                'type' => 'checkbox',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'notes' => [
                'label' => 'Ghi chú',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ]
        ];
    }

    /**
     * Get fields for form (create/edit)
     */
    public static function getFormFields()
    {
        $fields = [];
        foreach (self::getFields() as $key => $field) {
            if (!isset($field['editable']) || $field['editable']) {
                $fields[$key] = $field;
            }
        }
        return $fields;
    }

    /**
     * Lấy lớp học của lịch học
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    /**
     * Lấy các buổi học theo lịch học này
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(ClassSession::class, 'schedule_id');
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }
    /**
     * Lấy ngày trong tuần dạng text
     */
    public function getDayOfWeekTextAttribute(): string
    {
        $days = [
            1 => 'Thứ Hai',
            2 => 'Thứ Ba',
            3 => 'Thứ Tư',
            4 => 'Thứ Năm',
            5 => 'Thứ Sáu',
            6 => 'Thứ Bảy',
            0 => 'Chủ Nhật',
        ];

        return $days[$this->day_of_week] ?? 'Không xác định';
    }

    /**
     * Lấy thời lượng của buổi học (phút)
     */
    public function getDuration(): int
    {
        return $this->start_time->diffInMinutes($this->end_time);
    }

    /**
     * Lấy thời lượng của buổi học dạng text
     */
    public function getFormattedDurationAttribute(): string
    {
        $duration = $this->getDuration();
        $hours = floor($duration / 60);
        $minutes = $duration % 60;

        if ($hours > 0) {
            return sprintf('%d giờ %d phút', $hours, $minutes);
        }

        return sprintf('%d phút', $minutes);
    }

    /**
     * Lấy ngày kế tiếp theo lịch học
     */
    public function getNextOccurrenceAttribute(): ?Carbon
    {
        $now = Carbon::now();
        $targetDay = $this->day_of_week;

        // Nếu lịch học đã kết thúc
        if ($this->end_date && $now->greaterThan($this->end_date)) {
            return null;
        }

        // Tìm ngày kế tiếp có cùng thứ
        $nextDate = $now->copy();
        while ($nextDate->dayOfWeek != $targetDay) {
            $nextDate->addDay();
        }

        // Nếu đã qua thời gian học trong ngày, thêm 1 tuần
        $classTime = Carbon::parse($this->start_time);
        $todayClassTime = $nextDate->copy()->setHour($classTime->hour)->setMinute($classTime->minute)->setSecond(0);

        if ($now->greaterThan($todayClassTime) && $now->dayOfWeek == $targetDay) {
            $nextDate->addWeek();
        }

        // Kiểm tra xem ngày kế tiếp có nằm trong khoảng thời gian lịch học không
        if ($this->end_date && $nextDate->greaterThan($this->end_date)) {
            return null;
        }

        if ($this->start_date && $nextDate->lessThan($this->start_date)) {
            return Carbon::parse($this->start_date);
        }

        return $nextDate;
    }

    /**
     * Tạo các buổi học từ lịch học
     */
    public function createSessions(Carbon $startDate, Carbon $endDate): array
    {
        $sessions = [];
        $current = $startDate->copy();
        $targetDay = $this->day_of_week;

        // Đảm bảo ngày bắt đầu và kết thúc nằm trong khoảng thời gian lịch học
        if ($this->start_date && $startDate->lessThan($this->start_date)) {
            $current = Carbon::parse($this->start_date);
        }

        if ($this->end_date && $endDate->greaterThan($this->end_date)) {
            $endDate = Carbon::parse($this->end_date);
        }

        // Tìm ngày đầu tiên có cùng thứ
        while ($current->dayOfWeek != $targetDay && $current->lessThan($endDate)) {
            $current->addDay();
        }

        // Tạo các buổi học
        while ($current->lessThanOrEqualTo($endDate)) {
            $session = ClassSession::create([
                'class_id' => $this->class_id,
                'schedule_id' => $this->id,
                'session_date' => $current->toDateString(),
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'room_number' => $this->room_number,
                'session_type' => 'regular',
                'topic' => 'Buổi học theo lịch',
                'status' => 'scheduled'
            ]);

            $sessions[] = $session;

            // Thêm 1 tuần cho buổi học kế tiếp
            $current->addWeek();
        }

        return $sessions;
    }

    /**
     * Scope lấy lịch học đang hoạt động
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope lấy lịch học theo ngày trong tuần
     */
    public function scopeByDay($query, $day)
    {
        return $query->where('day_of_week', $day);
    }

    /**
     * Scope lấy lịch học hiện tại (chưa kết thúc)
     */
    public function scopeCurrent($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('end_date')
                ->orWhere('end_date', '>=', now());
        });
    }

    public function isActive(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->end_date && $this->end_date->isPast()) {
            return false;
        }

        return true;
    }

    public function overlaps(ClassSchedule $other): bool
    {
        if ($this->day_of_week !== $other->day_of_week) {
            return false;
        }

        return $this->start_time < $other->end_time && $this->end_time > $other->start_time;
    }

    public function generateSessions($startDate, $endDate)
    {
        $dates = [];
        $current = $startDate->copy();

        while ($current <= $endDate) {
            if ($current->format('l') === ucfirst($this->day_of_week)) {
                $dates[] = $current->copy();
            }
            $current->addDay();
        }

        foreach ($dates as $date) {
            $this->sessions()->create([
                'class_id' => $this->class_id,
                'session_date' => $date,
                'start_time' => $this->start_time->format('H:i:s'),
                'end_time' => $this->end_time->format('H:i:s'),
                'room_number' => $this->room_number,
                'status' => 'scheduled'
            ]);
        }
    }
}