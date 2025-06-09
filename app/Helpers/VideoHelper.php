<?php

namespace App\Helpers;

class VideoHelper
{
    /**
     * Chuyển đổi URL video từ tienganh-abc.com thành URL có thể nhúng
     *
     * @param string $url URL gốc từ tienganh-abc.com
     * @return string URL có thể nhúng vào iframe
     */
    public static function getEmbedUrl($url)
    {
        if (empty($url)) {
            return '';
        }

        // Kiểm tra nếu là URL từ tienganh-abc.com
        if (strpos($url, 'tienganh-abc.com/videos/') !== false) {
            // Thêm /embed vào URL để có thể nhúng
            $url = str_replace('/videos/', '/videos/embed/', $url);
        }

        return $url;
    }
}
