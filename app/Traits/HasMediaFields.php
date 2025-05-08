<?php

namespace App\Traits;

trait HasMediaFields
{
    /**
     * Define media fields for the model
     * Format: [
     *   'field_name' => [
     *     'type' => 'image|video|audio',
     *     'max_size' => 2048, // size in KB
     *     'mimes' => 'jpeg,png,jpg', // allowed mime types
     *     'label' => 'Hình ảnh' // label for the field
     *   ]
     * ]
     */
    public static function mediaFields(): array
    {
        return [];
    }

    /**
     * Get validation rules for media fields
     */
    public static function getMediaRules(): array
    {
        $rules = [];
        foreach (static::mediaFields() as $field => $config) {
            $rules[$field] = [
                'nullable',
                'file',
                'mimes:' . ($config['mimes'] ?? ''),
                'max:' . ($config['max_size'] ?? 2048)
            ];
        }
        return $rules;
    }

    /**
     * Get media field configuration
     */
    public static function getMediaFieldConfig(string $field): ?array
    {
        return static::mediaFields()[$field] ?? null;
    }

    /**
     * Check if model has media fields
     */
    public static function hasMediaFields(): bool
    {
        return !empty(static::mediaFields());
    }

    /**
     * Check if field is a media field
     */
    public static function isMediaField(string $field): bool
    {
        return isset(static::mediaFields()[$field]);
    }

    /**
     * Get media type for field
     */
    public static function getMediaType(string $field): ?string
    {
        return static::mediaFields()[$field]['type'] ?? null;
    }
}