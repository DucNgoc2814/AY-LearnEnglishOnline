<?php

namespace App\Helpers;

class VideoHelper
{
    /**
     * Xử lý URL video để hiển thị trong iframe
     *
     * @param string $url
     * @return string
     */
    public static function getEmbedUrl($url)
    {
        if (empty($url)) {
            return '';
        }

        // Xử lý URL từ tienganh-abc.com
        if (strpos($url, 'tienganh-abc.com') !== false) {
            // Trả về URL gốc nhưng thêm parameter để chỉ định hiển thị trong iframe
            return $url . "?embed=true";
        }

        return $url;
    }
}
