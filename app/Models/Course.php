<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'price',
        'duration',
        'level',
        'requirements',
        'learning_outcomes',
        'release_date',
        'order',
        'is_featured',
        'is_active'
    ];

    protected $casts = [
        'learning_outcomes' => 'array',
        'requirements' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'release_date' => 'datetime'
    ];

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
     * Lấy danh sách bài kiểm tra
     */
    public function tests(): MorphMany
    {
        return $this->morphMany(Test::class, 'testable')->where('type', 'test');
    }

    /**
     * Lấy danh sách bài kiểm tra bài học
     */
    public function lessonTests(): MorphMany
    {
        return $this->morphMany(Test::class, 'testable')->where('type', 'lesson_test');
    }

    /**
     * Lấy danh sách bài thi cuối khóa
     */
    public function finalExams(): MorphMany
    {
        return $this->morphMany(Test::class, 'testable')->where('type', 'final_exam');
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
        return $this->lessons()
            ->join('lesson_videos', 'lessons.id', '=', 'lesson_videos.lesson_id')
            ->sum('lesson_videos.duration');
    }

    public function totalLessons()
    {
        return $this->lessons()->count();
    }

    public function totalTests()
    {
        return $this->lessonTests()->count() 
            + $this->finalExams()->count();

    }

    public function isEnrolledByUser($userId){
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
}
