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

        // Parse user agent to get device info
        $parser = new Parser($userAgent);

        // Create a unique device ID
        $deviceInfo = [
            'browser' => $parser->browser->toString(),
            'os' => $parser->os->toString(),
            'device' => $parser->device->toString(),
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
