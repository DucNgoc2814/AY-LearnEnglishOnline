<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\DeviceService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class SocialLoginController extends Controller
{
    protected $deviceService;

    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(Request $request)
    {
        try {
            $socialUser = Socialite::driver('facebook')->user();

            // Begin transaction
            DB::beginTransaction();

            try {
                // Check if user exists
                $user = User::where('auth_facebook_id', $socialUser->id)
                    ->orWhere('email', $socialUser->email)
                    ->first();

                if (!$user) {
                    // Create new user
                    $user = User::create([
                        'name' => $socialUser->name,
                        'email' => $socialUser->email,
                        'auth_facebook_id' => $socialUser->id,
                        'auth_type' => 'facebook',
                        'password' => Hash::make(uniqid()), // Random password
                    ]);
                } else {
                    // Update existing user's Facebook ID if needed
                    if (!$user->auth_facebook_id) {
                        $user->update([
                            'auth_facebook_id' => $socialUser->id,
                            'auth_type' => 'facebook'
                        ]);
                    }
                }

                // Get device identifier
                $deviceId = $this->deviceService->getDeviceIdentifier($request);

                // Check if user is already logged in on another device
                if ($user->device_id && $user->device_id !== $deviceId) {
                    DB::rollBack();
                    return redirect()->route('login')
                        ->with('notification', [
                            'message' => 'Tài khoản này đang được đăng nhập trên thiết bị khác.',
                            'type' => 'error'
                        ]);
                }

                // Generate JWT token
                $token = JWTAuth::fromUser($user);

                // Update user's device info
                $user->registerDevice($deviceId, $token);

                // Store token in session
                session(['jwt_token' => $token]);

                DB::commit();

                return redirect()->route('home')
                    ->with('notification', [
                        'message' => 'Đăng nhập thành công!',
                        'type' => 'success'
                    ]);

            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (Exception $e) {
            return redirect()->route('login')
                ->with('notification', [
                    'message' => 'Đăng nhập bằng Facebook thất bại. Vui lòng thử lại.',
                    'type' => 'error'
                ]);
        }
    }
}
