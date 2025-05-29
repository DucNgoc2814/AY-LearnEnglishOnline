<?php

namespace App\Http\Controllers\Online\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Services\DeviceService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class GoogleLoginController extends Controller
{
    protected $deviceService;

    public function __construct(DeviceService $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $socialUser = Socialite::driver('google')->user();

            // Begin transaction
            DB::beginTransaction();

            try {
                // Check if student exists
                $student = Student::where('auth_google_id', $socialUser->id)
                    ->orWhere('email', $socialUser->email)
                    ->first();

                if (!$student) {
                    // Create new student
                    $student = Student::create([
                        'full_name' => $socialUser->name,
                        'email' => $socialUser->email,
                        'auth_google_id' => $socialUser->id,
                        'auth_type' => 'google',
                        'password' => Hash::make(uniqid()), // Random password
                        'student_code' => Student::generateStudentCode(),
                        'status' => 'active'
                    ]);
                } else {
                    // Update existing student's Google ID if needed
                    if (!$student->auth_google_id) {
                        $student->update([
                            'auth_google_id' => $socialUser->id,
                            'auth_type' => 'google'
                        ]);
                    }
                }

                // Get device identifier
                $deviceId = $this->deviceService->getDeviceIdentifier($request);

                // Check if student is already logged in on another device
                if ($student->device_id && $student->device_id !== $deviceId) {
                    DB::rollBack();
                    return redirect()->route('online.login')
                        ->with('notification', [
                            'message' => 'Tài khoản này đang được đăng nhập trên thiết bị khác.',
                            'type' => 'error'
                        ]);
                }

                // Generate JWT token with custom claims
                $token = JWTAuth::claims(['user_type' => 'student'])->fromUser($student);

                // Update student's device info
                $student->registerDevice($deviceId, $token);

                // Store token and user info in session
                session([
                    'jwt_token' => $token,
                    'user_display_name' => $student->full_name,
                    'user_id' => $student->id,
                    'user_type' => 'student'
                ]);

                DB::commit();

                return redirect()->route('online.dashboard')
                    ->with('notification', [
                        'message' => 'Đăng nhập thành công!',
                        'type' => 'success'
                    ]);

            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (Exception $e) {
            return redirect()->route('online.login')
                ->with('notification', [
                    'message' => 'Đăng nhập bằng Google thất bại. Vui lòng thử lại.',
                    'type' => 'error'
                ]);
        }
    }
}
