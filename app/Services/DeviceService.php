<?php

namespace App\Services;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class DeviceService
{
    /**
     * Get a unique device identifier
     */
    public function getDeviceIdentifier(Request $request): string
    {
        // Get browser fingerprint from header or generate new one
        $browserId = $request->header('X-Browser-ID');
        if (!$browserId) {
            $browserId = $this->generateBrowserFingerprint($request);
        }

        return $browserId;
    }

    /**
     * Generate a browser fingerprint
     */
    private function generateBrowserFingerprint(Request $request): string
    {
        $agent = new Agent();

        // Collect browser information
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $platform = $agent->platform();
        $device = $agent->device();

        // Get IP address
        $ip = $request->ip();

        // Get user agent
        $userAgent = $request->userAgent();

        // Combine all information
        $fingerprint = implode('|', [
            $browser,
            $version,
            $platform,
            $device,
            $ip,
            $userAgent
        ]);

        // Generate hash
        return hash('sha256', $fingerprint);
    }

    /**
     * Validate if the device is allowed to access
     */
    public function validateDevice($user, Request $request): bool
    {
        if (!$user) {
            return false;
        }

        $currentDeviceId = $this->getDeviceIdentifier($request);

        // If no device is registered yet
        if (!$user->device_id) {
            return true;
        }

        // Check if current device matches registered device
        return $user->device_id === $currentDeviceId;
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
