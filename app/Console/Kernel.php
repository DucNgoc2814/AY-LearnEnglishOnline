<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        // Process pending logouts - run every minute
        $schedule->call(function () {
            // Get all pending logouts from the cache
            $keys = \Illuminate\Support\Facades\Cache::get('pending_logout_keys', []);
            $now = now();

            foreach ($keys as $key) {
                if (!\Illuminate\Support\Facades\Cache::has($key)) {
                    continue;
                }

                $logoutTime = \Illuminate\Support\Facades\Cache::get($key);
                $userId = str_replace('scheduled_logout_', '', $key);

                if ($now->gte($logoutTime)) {
                    \Illuminate\Support\Facades\Log::info("Processing scheduled logout for user {$userId}");

                    // Clear user's session data
                    \App\Models\User::where('id', $userId)->update([
                        'device_id' => null,
                        'active_token' => null
                    ]);

                    // Remove the scheduled logout
                    \Illuminate\Support\Facades\Cache::forget($key);
                    \Illuminate\Support\Facades\Cache::forget($key . '_browser_id');

                    // Remove from pending keys
                    $updatedKeys = array_diff($keys, [$key]);
                    \Illuminate\Support\Facades\Cache::put('pending_logout_keys', $updatedKeys);
                }
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
