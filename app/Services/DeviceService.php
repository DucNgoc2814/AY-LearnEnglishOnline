<?php

namespace App\Services;

use Illuminate\Http\Request;
use WhichBrowser\Parser;

class DeviceService
{
    /**
     * Get a unique identifier for the current device
     *
     * @param Request $request
     * @return string
     */
    public function getDeviceIdentifier(Request $request): string
    {
        $userAgent = $request->header('User-Agent');
        $ip = $request->ip();
        $acceptLanguage = $request->header('Accept-Language') ?? '';
        $acceptEncoding = $request->header('Accept-Encoding') ?? '';

        // Get browser fingerprint details
        $parser = new Parser($userAgent);

        // Create a unique device ID with more browser-specific information
        $deviceInfo = [
            'browser' => $parser->browser->toString(),
            'browser_version' => $parser->browser->version->toString(),
            'os' => $parser->os->toString(),
            'os_version' => $parser->os->version->toString(),
            'device' => $parser->device->toString(),
            'accept_language' => $acceptLanguage,
            'accept_encoding' => $acceptEncoding,
            'ip' => $ip,
        ];

        // Create a unique hash from device info
        return hash('sha256', json_encode($deviceInfo));
    }

    /**
     * Get device name for display
     *
     * @param Request $request
     * @return string
     */
    public function getDeviceName(Request $request): string
    {
        $userAgent = $request->header('User-Agent');
        $parser = new Parser($userAgent);

        $browser = $parser->browser->toString() ?: 'Unknown Browser';
        $os = $parser->os->toString() ?: 'Unknown OS';
        $device = $parser->device->toString();

        if ($device) {
            return "$device ($browser on $os)";
        } else {
            return "$browser on $os";
        }
    }
}
