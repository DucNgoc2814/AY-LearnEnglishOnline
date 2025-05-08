<?php

namespace App\Models;

use App\Traits\HasSlug;
use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;

abstract class BaseModel extends Model
{
    use SoftDeletes, HasSlug, HasMedia;

    protected $guarded = ['id'];

    /**
     * Các trường sẽ tự động tạo slug
     */
    protected static function getSlugSourceField(): string
    {
        return 'name';
    }

    public static function rules($id = null)
    {
        return [];
    }

    public static function getFields()
    {
        return [];
    }

    /**
     * Get fields that can be searched
     */
    public static function getSearchableFields()
    {
        $fields = static::getFields();
        $searchableFields = [];

        foreach ($fields as $field => $options) {
            if (isset($options['searchable']) && $options['searchable']) {
                $searchableFields[] = $field;
            }
        }

        // If no searchable fields are explicitly defined, default to basic text fields
        if (empty($searchableFields)) {
            foreach ($fields as $field => $options) {
                if (in_array($options['type'] ?? 'text', ['text', 'textarea'])) {
                    $searchableFields[] = $field;
                }
            }
        }

        return $searchableFields;
    }

    /**
     * Get fields that can be filtered
     */
    public static function getFilterableFields()
    {
        $fields = static::getFields();
        $filterableFields = [];

        foreach ($fields as $field => $options) {
            if (isset($options['filterable']) && $options['filterable']) {
                $filterableFields[$field] = $options;
            }
        }

        return $filterableFields;
    }

    /**
     * Get fields that can be sorted
     */
    public static function getSortableFields()
    {
        $fields = static::getFields();
        $sortableFields = [];

        foreach ($fields as $field => $options) {
            if (!isset($options['sortable']) || $options['sortable']) {
                $sortableFields[$field] = $options['label'] ?? ucfirst($field);
            }
        }

        return $sortableFields;
    }

    public function getFieldLabel($field)
    {
        $fields = static::getFields();
        return $fields[$field]['label'] ?? ucfirst($field);
    }

    public function getFieldType($field)
    {
        $fields = static::getFields();
        return $fields[$field]['type'] ?? 'text';
    }

    public function getFieldOptions($field)
    {
        $fields = static::getFields();
        return $fields[$field]['options'] ?? [];
    }

    /**
     * Handle file upload for a field
     */
    public function handleMediaUpload($field, UploadedFile $file)
    {
        $fields = static::getFields();
        $fieldConfig = $fields[$field] ?? null;

        if (!$fieldConfig) {
            throw new \InvalidArgumentException("Field {$field} not found in model configuration");
        }

        $type = $fieldConfig['media_type'] ?? 'image';
        if (!in_array($type, ['image', 'video', 'audio'])) {
            throw new \InvalidArgumentException("Invalid media type: {$type}");
        }

        return $this->handleFileUpload($field, $file, $type);
    }

    /**
     * Get full URL for a media field
     */
    public function getMediaUrl($field): ?string
    {
        if (!$this->$field) {
            return null;
        }

        return $this->getFileUrl($this->$field);
    }
}
