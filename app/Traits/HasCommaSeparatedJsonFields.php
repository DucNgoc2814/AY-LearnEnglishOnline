<?php

namespace App\Traits;

trait HasCommaSeparatedJsonFields
{
    /**
     * Định nghĩa các trường JSON sẽ được xử lý dạng comma-separated
     * Override method này trong model
     */
    protected function getCommaSeparatedJsonFields(): array
    {
        return [];
    }

    /**
     * Boot the trait
     */
    protected static function bootHasCommaSeparatedJsonFields()
    {
        static::saving(function ($model) {
            foreach ($model->getCommaSeparatedJsonFields() as $field => $config) {
                if (isset($model->attributes[$field]) && is_string($model->attributes[$field])) {
                    // Tách chuỗi thành mảng bằng dấu phẩy
                    $items = array_map('trim', explode(',', $model->attributes[$field]));

                    // Loại bỏ các phần tử rỗng
                    $items = array_filter($items);

                    // Xử lý theo cấu trúc được định nghĩa trong config
                    if (isset($config['structure'])) {
                        $processedItems = [];
                        foreach ($items as $index => $item) {
                            if (!empty($item)) {
                                $itemData = [];
                                foreach ($config['structure'] as $key => $default) {
                                    $itemData[$key] = is_callable($default) ? $default($item, $index) : $default;
                                }
                                $processedItems[] = $itemData;
                            }
                        }
                        $model->attributes[$field] = json_encode($processedItems);
                    } else {
                        $model->attributes[$field] = json_encode($items);
                    }
                }
            }
        });
    }

    /**
     * Accessor để hiển thị dạng chuỗi trong form
     */
    protected function getJsonFieldAsString($field)
    {
        $value = $this->attributes[$field] ?? '[]';
        $items = json_decode($value, true) ?? [];

        if (request()->is('*/api/*')) {
            return $items;
        }

        // Nếu là mảng có cấu trúc, lấy giá trị từ trường word
        $config = $this->getCommaSeparatedJsonFields()[$field] ?? [];
        if (isset($config['structure']) && isset($config['structure']['word'])) {
            return implode(', ', array_column($items, 'word'));
        }

        // Nếu là mảng đơn giản
        if (is_array($items)) {
            return implode(', ', array_filter($items, 'is_scalar'));
        }

        return '';
    }
}
