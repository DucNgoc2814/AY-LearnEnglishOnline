<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class VideoService
{
    /**
     * Get CloudFront URL for video
     */
    public static function getVideoUrl($path)
    {
        if (empty($path)) {
            return null;
        }

        $cloudFrontUrl = env('CLOUDFRONT_URL');
        if (empty($cloudFrontUrl)) {
            throw new \Exception('CLOUDFRONT_URL not configured');
        }

        // Remove any leading slashes from path and trailing slashes from cloudfront url
        $path = ltrim($path, '/');
        $cloudFrontUrl = rtrim($cloudFrontUrl, '/');

        return $cloudFrontUrl . '/' . $path;
    }

    /**
     * Check if video exists and is accessible
     */
    public static function checkVideoAccessible($url)
    {
        try {
            $headers = get_headers($url);
            return stripos($headers[0], "200 OK") ? true : false;
        } catch (\Exception $e) {
            \Log::error("Error checking video URL: " . $e->getMessage());
            return false;
        }
    }
} 