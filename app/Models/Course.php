<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
class Course extends BaseModel
{
    public static function mediaFields(): array
    {
        return [
            'thumbnail' => [
                'type' => 'image',
                'max_size' => 2048, // 2MB
                'mimes' => 'jpeg,png,jpg,gif',
                'label' => 'Hình ảnh khóa học'
            ],
            'preview_video' => [
                'type' => 'video',
                'max_size' => 102400,
                'mimes' => 'mp4,webm,ogg',
                'label' => 'Video khóa học'
            ]
        ];
    }
    public static function getBaseRules($id = null)
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'course_type' => 'required|in:self_paced,instructor_led,hybrid',
            'course_format' => 'required|in:online,offline,hybrid',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'estimated_hours' => 'nullable|integer|min:0',
            'has_certificate' => 'boolean',
            'requires_enrollment' => 'boolean',
            'course_outline' => 'nullable|json',
            'requirements' => 'nullable|array',
            'learning_outcomes' => 'nullable|array',
            'release_date' => 'nullable|date',
            'order' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ];
    }

    public static function getFields()
    {
        $fields = [
            'category_id' => [
                'label' => 'Danh mục',
                'type' => 'select',
                'options' => Category::pluck('name', 'id')->toArray(),
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'title' => [
                'label' => 'Tên khóa học',
                'type' => 'text',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'description' => [
                'label' => 'Mô tả chi tiết',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
            'short_description' => [
                'label' => 'Mô tả ngắn',
                'type' => 'textarea',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'course_type' => [
                'label' => 'Loại khóa học',
                'type' => 'select',
                'options' => [
                    'self_paced' => 'Tự học',
                    'instructor_led' => 'Có giảng viên hướng dẫn',
                    'hybrid' => 'Kết hợp'
                ],
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'course_format' => [
                'label' => 'Hình thức học',
                'type' => 'select',
                'options' => [
                    'online' => 'Trực tuyến',
                    'offline' => 'Trực tiếp',
                    'hybrid' => 'Kết hợp'
                ],
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'price' => [
                'label' => 'Giá gốc',
                'type' => 'number',
                'step' => '1000',
                'min' => '0',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'sale_price' => [
                'label' => 'Giá khuyến mãi',
                'type' => 'number',
                'step' => '1000',
                'min' => '0',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'estimated_hours' => [
                'label' => 'Thời lượng ước tính (giờ)',
                'type' => 'number',
                'min' => '0',
                'step' => '1',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'has_certificate' => [
                'label' => 'Cấp chứng chỉ',
                'type' => 'checkbox',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
            'requires_enrollment' => [
                'label' => 'Yêu cầu đăng ký',
                'type' => 'checkbox',
                'searchable' => true,
                'sortable' => false,
                'editable' => true
            ],
            'course_outline' => [
                'label' => 'Đề cương khóa học',
                'type' => 'json_editor',
                'searchable' => false,
                'sortable' => false,
                'editable' => true
            ],
            'requirements' => [
                'label' => 'Yêu cầu đầu vào',
                'type' => 'array_editor',
                'searchable' => false,
                'sortable' => false,
                'editable' => true
            ],
            'learning_outcomes' => [
                'label' => 'Kết quả đầu ra',
                'type' => 'array_editor',
                'searchable' => false,
                'sortable' => false,
                'editable' => true
            ],
            'release_date' => [
                'label' => 'Ngày phát hành',
                'type' => 'date',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'order' => [
                'label' => 'Thứ tự hiển thị',
                'type' => 'number',
                'min' => '0',
                'step' => '1',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'is_featured' => [
                'label' => 'Khóa học nổi bật',
                'type' => 'checkbox',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'is_active' => [
                'label' => 'Kích hoạt',
                'type' => 'checkbox',
                'searchable' => true,
                'sortable' => true,
                'editable' => true
            ],
            'total_students' => [
                'label' => 'Tổng số học viên',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'editable' => false
            ],
            'total_ratings' => [
                'label' => 'Tổng số đánh giá',
                'type' => 'number',
                'searchable' => true,
                'sortable' => true,
                'editable' => false
            ],
            'rating' => [
                'label' => 'Điểm đánh giá',
                'type' => 'number',
                'step' => '0.1',
                'searchable' => true,
                'sortable' => true,
                'editable' => false
            ]
        ];

        // Thêm các trường media vào fields
        foreach (static::mediaFields() as $field => $config) {
            $fields[$field] = [
                'label' => $config['label'],
                'type' => 'file',
                'accept' => $config['type'] === 'image' ? 'image/*' : 'video/*',
                'max_size' => $config['max_size'],
                'editable' => true
            ];
        }

        return $fields;
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
     * Get fields for listing
     */
    public static function getListFields()
    {
        return self::getFields();
    }

    /**
     * Lấy danh mục khóa học
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Lấy danh sách bài học
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * Lấy danh sách lớp học
     */
    public function classes(): HasMany
    {
        return $this->hasMany(ClassRoom::class);
    }

    /**
     * Lấy danh sách ghi danh
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Lấy danh sách đánh giá
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Lấy danh sách chứng chỉ
     */
    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    /**
     * Lấy danh sách bình luận
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Lấy danh sách tài nguyên
     */
    public function resources(): MorphMany
    {
        return $this->morphMany(Resource::class, 'resourceable');
    }

    /**
     * Lấy danh sách bài thi
     */
    public function exams(): MorphMany
    {
        return $this->morphMany(Test::class, 'testable')->where('type', 'exam');
    }
    /**
     * Lấy giá hiển thị (giá sale nếu có, ngược lại là giá gốc)
     */

    public function getCurrentPrice()
    {
        return $this->sale_price ?? $this->price;
    }

    /**
     * Kiểm tra xem khóa học có đang giảm giá không
     */
    public function hasDiscount()
    {
        return !is_null($this->sale_price) && $this->sale_price < $this->price;
    }

    /**
     * Tính phần trăm giảm giá
     */
    public function getDiscountPercentage()
    {
        if ($this->hasDiscount()) {
            return round((($this->price - $this->sale_price) / $this->price) * 100);
        }
        return 0;
    }

    /**
     * Scope cho khóa học đang hoạt động
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope cho khóa học đã được xuất bản
     */
    public function scopePublished($query)
    {
        return $query->where('is_active', true)
            ->where('release_date', '<=', now());
    }

    /**
     * Scope cho khóa học nổi bật
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope cho khóa học mới nhất
     */
    public function scopeNewest($query)
    {
        return $query->orderBy('release_date', 'desc');
    }

    /**
     * Scope cho khóa học phổ biến nhất
     */
    public function scopePopular($query)
    {
        return $query->orderBy('total_students', 'desc');
    }

    /**
     * Scope cho khóa học có đánh giá cao nhất
     */
    public function scopeTopRated($query)
    {
        return $query->where('total_ratings', '>', 0)
            ->orderBy('rating', 'desc');
    }

    public function updateRating()
    {
        $this->rating = $this->ratings()->avg('rating') ?? 0;
        $this->total_ratings = $this->ratings()->count();
        $this->save();
    }

    /**
     * Lấy URL hình ảnh đại diện khóa học
     */
    public function getThumbnailUrl(): string
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        return asset('images/default-course.png');
    }

    /**
     * Lấy độ dài khóa học dưới dạng định dạng
     */
    public function getFormattedDuration(): string
    {
        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;

        if ($hours > 0) {
            return sprintf('%d giờ %d phút', $hours, $minutes);
        }

        return sprintf('%d phút', $minutes);
    }

    /**
     * Lấy giá khóa học dưới dạng định dạng
     */
    public function getFormattedPrice(): string
    {
        if ($this->price == 0) {
            return 'Miễn phí';
        }
        return number_format($this->price, 0) . ' đ';
    }


    /**
     * Lấy tỉ lệ hoàn thành khóa học
     */
    public function getCompletionRate(): float
    {
        $total = $this->enrollments()->count();
        if ($total === 0) {
            return 0;
        }

        $completed = $this->enrollments()
            ->where('status', 'completed')
            ->count();

        return round(($completed / $total) * 100, 2);
    }

    /**
     * Lấy đánh giá trung bình khóa học
     */
    public function getAverageRating(): float
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    /**
     * Lấy tổng số bài học khóa học
     */
    public function getTotalLessons(): int
    {
        return $this->lessons()->count();
    }

    /**
     * Kiểm tra xem học viên đã đăng ký khóa học chưa
     */
    public function hasEnrolledStudent($studentId): bool
    {
        return $this->enrollments()
            ->where('student_id', $studentId)
            ->exists();
    }

    /**
     * Kiểm tra xem học viên đã hoàn thành khóa học chưa
     */
    public function isCompleted($studentId): bool
    {
        $enrollment = $this->enrollments()
            ->where('student_id', $studentId)
            ->first();

        return $enrollment && $enrollment->isCompleted();
    }

    public function totalDuration()
    {
        $totalSeconds = 0;

        $lessonsWithVideos = $this->lessons()->with('videoLessons')->get();

        foreach ($lessonsWithVideos as $lesson) {
            $totalSeconds += $lesson->videoLessons->sum('duration');
        }

        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;

        if ($hours > 0) {
            return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }

        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    public function totalLessons()
    {
        return $this->lessons()->count();
    }

    public function totalTests()
    {
        // Count lesson tests from lessons
        $lessonTestsCount = $this->lessons()
            ->withCount(['lessonTests' => function ($query) {
                $query->where('testable_type', 'App\Models\Lesson')
                    ->where('type', 'lesson_test')
                    ->whereNull('deleted_at');
            }])
            ->get()
            ->sum('lesson_tests_count');

        // Count final exams
        $finalExamsCount = Test::where('testable_type', 'App\Models\Course')
            ->where('testable_id', $this->id)
            ->where('type', 'final_exam')
            ->whereNull('deleted_at')
            ->count();

        // Return total of both types
        return $lessonTestsCount + $finalExamsCount;
    }

    public function totalVideos()
    {
        return $this->lessons()
            ->withCount('videoLessons')
            ->get()
            ->sum('video_lessons_count');
    }


    public function isEnrolledByUser($userId)
    {
        $user = User::find($userId);


        if (!$user) {
            return false;
        }

        if ($user->role === 'admin') {
            return true;
        }

        return $this->enrollments()
            ->where('user_id', $userId)
            ->exists();
    }

    public function tests()
    {
        return $this->morphMany(Test::class, 'testable')
            ->where(function ($query) {
                $query->where('type', 'final_exam')
                    ->orWhereHas('lesson', function ($q) {
                        $q->where('course_id', $this->id);
                    });
            })
            ->whereNull('deleted_at');
    }

    // Add this separate method for lesson tests
    public function lessonTests()
    {
        return $this->hasManyThrough(
            Test::class,
            Lesson::class,
            'course_id',
            'testable_id'
        )->where('testable_type', 'App\Models\Lesson')
            ->where('type', 'lesson_test')
            ->whereNull('deleted_at');
    }

    // Add this for final exams specifically
    public function finalExams()
    {
        return $this->morphMany(Test::class, 'testable')
            ->where('type', 'final_exam')
            ->whereNull('deleted_at');
    }
}
