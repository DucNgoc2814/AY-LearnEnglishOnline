<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resource extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'type',
        'url',
        'file_type',
        'file_size',
        'download_count',
        'is_public',
        'order',
        'is_active',
        'resourceable_type',
        'resourceable_id',
        'file_path',
        'file_extension',
        'file_url',
        'external_url',
        'preview_path',
        'category',
        'resource_level',
        'access_type',
        'is_downloadable',
        'is_featured',
        'duration',
        'original_lesson_video_id'
    ];

    protected $casts = [
        'file_size' => 'integer',
        'download_count' => 'integer',
        'is_public' => 'boolean',
        'order' => 'integer',
        'is_active' => 'boolean',
        'is_downloadable' => 'boolean',
        'is_featured' => 'boolean',
        'duration' => 'integer'
    ];

    /**
     * Lấy model sở hữu resource này
     */
    public function resourceable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Lấy video bài học gốc
     */
    public function originalLessonVideo()
    {
        return $this->belongsTo(LessonVideo::class, 'original_lesson_video_id');
    }

    /**
     * Người tạo tài liệu
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Người cập nhật tài liệu
     */
    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Kiểm tra xem tài liệu có phải là công khai không
     */
    public function isPublic(): bool
    {
        return $this->is_public;
    }

    /**
     * Kiểm tra xem tài liệu có nổi bật không
     */
    public function isFeatured(): bool
    {
        return $this->is_featured;
    }

    /**
     * Kiểm tra xem tài liệu có thể tải xuống không
     */
    public function isDownloadable(): bool
    {
        return $this->is_downloadable;
    }

    /**
     * Ghi nhận lượt tải xuống
     */
    public function incrementDownloadCount(): self
    {
        $this->download_count = ($this->download_count ?: 0) + 1;
        $this->save();
        
        return $this;
    }

    /**
     * Kiểm tra xem tài liệu có phải là kiểu file không
     */
    public function isFile(): bool
    {
        return !empty($this->file_path);
    }

    /**
     * Kiểm tra xem tài liệu có phải là kiểu URL không
     */
    public function isUrl(): bool
    {
        return !empty($this->url) && empty($this->file_path);
    }

    /**
     * Kiểm tra xem tài liệu có phải là văn bản không
     */
    public function isDocument(): bool
    {
        $documentTypes = ['doc', 'docx', 'pdf', 'txt', 'rtf', 'odt'];
        return $this->isFile() && in_array(strtolower($this->file_type), $documentTypes);
    }

    /**
     * Kiểm tra xem tài liệu có phải là hình ảnh không
     */
    public function isImage(): bool
    {
        $imageTypes = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'];
        return $this->isFile() && in_array(strtolower($this->file_type), $imageTypes);
    }

    /**
     * Kiểm tra xem tài liệu có phải là video không
     */
    public function isVideo(): bool
    {
        $videoTypes = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv'];
        return $this->isFile() && in_array(strtolower($this->file_type), $videoTypes);
    }

    /**
     * Kiểm tra xem tài liệu có phải là âm thanh không
     */
    public function isAudio(): bool
    {
        $audioTypes = ['mp3', 'wav', 'ogg', 'aac', 'flac', 'wma'];
        return $this->isFile() && in_array(strtolower($this->file_type), $audioTypes);
    }

    /**
     * Lấy kích thước file theo định dạng đọc được (KB, MB, GB)
     */
    public function getFormattedSizeAttribute(): string
    {
        if (!$this->file_size) {
            return '0 KB';
        }
        
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $size = $this->file_size;
        $i = 0;
        
        while ($size >= 1024 && $i < count($units) - 1) {
            $size /= 1024;
            $i++;
        }
        
        return round($size, 2) . ' ' . $units[$i];
    }

    /**
     * Lấy URL tải xuống tài liệu
     */
    public function getDownloadUrlAttribute(): ?string
    {
        if (!$this->isDownloadable()) {
            return null;
        }
        
        if ($this->isFile()) {
            return route('resources.download', $this->id);
        }
        
        return $this->url;
    }

    /**
     * Scope lấy các tài liệu công khai
     */
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    /**
     * Scope lấy các tài liệu nổi bật
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope lấy các tài liệu có thể tải xuống
     */
    public function scopeDownloadable($query)
    {
        return $query->where('is_downloadable', true);
    }

    /**
     * Scope lấy các tài liệu theo loại
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope lấy các tài liệu đang hoạt động
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope lấy các tài liệu theo thứ tự
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function getFileSize($formatted = true)
    {
        if (!$formatted) {
            return $this->file_size;
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $size = $this->file_size;
        $unit = 0;

        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }

        return round($size, 2) . ' ' . $units[$unit];
    }

    public function getDuration($formatted = true)
    {
        if (!$formatted || !$this->duration) {
            return $this->duration;
        }

        $hours = floor($this->duration / 3600);
        $minutes = floor(($this->duration % 3600) / 60);
        $seconds = $this->duration % 60;

        if ($hours > 0) {
            return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }
        
        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    public function isAccessibleBy(User $user): bool
    {
        switch ($this->access_type) {
            case 'free':
                return true;
            case 'enrolled':
                return $user->enrollments()
                    ->whereHas('course', function ($query) {
                        $query->whereHas('resources', function ($q) {
                            $q->where('id', $this->id);
                        });
                    })
                    ->exists();
            case 'premium':
                return $user->hasActivePremiumSubscription();
            default:
                return false;
        }
    }

    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('file_type', $type);
    }

    public function getFormattedFileSize(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getFileExtension(): string
    {
        return pathinfo($this->file_name, PATHINFO_EXTENSION);
    }

    public function isPDF(): bool
    {
        return $this->file_type === 'application/pdf';
    }

    public function getIconClass(): string
    {
        if ($this->isImage()) {
            return 'fa-image';
        } elseif ($this->isPDF()) {
            return 'fa-file-pdf';
        } elseif ($this->isVideo()) {
            return 'fa-video';
        } elseif ($this->isAudio()) {
            return 'fa-music';
        } elseif ($this->isDocument()) {
            return 'fa-file-word';
        }

        return 'fa-file';
    }

    public function sessions()
    {
        return $this->hasMany(ClassSession::class);
    }
} 