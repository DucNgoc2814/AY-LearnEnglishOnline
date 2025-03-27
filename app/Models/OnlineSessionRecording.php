<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OnlineSessionRecording extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'online_room_id',
        'recording_id',
        'file_type',
        'file_size',
        'play_url',
        'download_url',
        'duration',
        'recording_start',
        'recording_end',
        'status',
        'password',
        'view_count',
        'is_active',
        'original_video_record_id'
    ];

    protected $casts = [
        'file_size' => 'integer',
        'duration' => 'integer',
        'recording_start' => 'datetime',
        'recording_end' => 'datetime',
        'view_count' => 'integer',
        'is_active' => 'boolean'
    ];

    /**
     * Lấy phòng học online của bản ghi
     */
    public function onlineRoom(): BelongsTo
    {
        return $this->belongsTo(OnlineRoom::class);
    }

    /**
     * Lấy danh sách lượt xem bản ghi
     */
    public function views(): HasMany
    {
        return $this->hasMany(RecordingView::class, 'recording_id');
    }

    /**
     * Format thời lượng bản ghi theo định dạng giờ:phút:giây
     */
    public function getFormattedDuration(): string
    {
        $hours = floor($this->duration / 3600);
        $minutes = floor(($this->duration % 3600) / 60);
        $seconds = $this->duration % 60;

        if ($hours > 0) {
            return sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
        }

        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    /**
     * Format kích thước file theo định dạng dễ đọc (KB, MB, GB)
     */
    public function getFormattedFileSize(): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $size = $this->file_size;
        $unit = 0;

        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }

        return round($size, 2) . ' ' . $units[$unit];
    }

    /**
     * Kiểm tra xem bản ghi đã được xử lý chưa
     */
    public function isProcessed(): bool
    {
        return $this->status === 'processed';
    }

    /**
     * Kiểm tra xem bản ghi đã xử lý thất bại chưa
     */
    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    /**
     * Scope lấy các bản ghi đã được xử lý
     */
    public function scopeProcessed($query)
    {
        return $query->where('status', 'processed');
    }

    /**
     * Scope lấy các bản ghi đang được xử lý
     */
    public function scopeProcessing($query)
    {
        return $query->where('status', 'processing');
    }

    /**
     * Scope lấy các bản ghi đã xử lý thất bại
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Lấy URL bản ghi có bảo vệ (nếu cần)
     */
    public function getProtectedUrlAttribute(): string
    {
        if ($this->password) {
            // Tạo URL có tham số token hoặc xác thực
            return route('recordings.view', ['id' => $this->id]);
        }
        
        return $this->recording_url;
    }

    /**
     * Tăng lượt xem bản ghi
     */
    public function incrementViewCount(User $user = null): self
    {
        $this->increment('view_count');
        
        if ($user) {
            RecordingView::create([
                'recording_id' => $this->id,
                'user_id' => $user->id,
                'viewed_at' => now(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent()
            ]);
        }
        
        return $this;
    }

    /**
     * Tăng lượt tải bản ghi
     */
    public function incrementDownloadCount(): self
    {
        $this->increment('download_count');
        return $this;
    }

    /**
     * Kiểm tra xem bản ghi có khả dụng không
     */
    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    /**
     * Scope lấy các bản ghi phổ biến nhất
     */
    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'desc');
    }

    /**
     * Scope lấy các bản ghi theo nhà cung cấp
     */
    public function scopeByProvider($query, string $provider)
    {
        return $query->where('provider', $provider);
    }
} 