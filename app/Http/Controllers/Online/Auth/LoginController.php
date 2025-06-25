<?php

namespace App\Http\Controllers\Online\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Employee;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (session('jwt_token')) {
            try {
                $token = session('jwt_token');
                JWTAuth::setToken($token);
                $user = JWTAuth::authenticate();

                if ($user) {
                    Log::info('User already authenticated, redirecting to dashboard', [
                        'user_id' => $user->id,
                        'user_type' => $user->getTable()
                    ]);
                    return redirect()->route('online.dashboard');
                }
            } catch (\Exception $e) {
                Log::warning('Invalid session token, clearing session', ['error' => $e->getMessage()]);
                session()->forget(['jwt_token', 'user_type', 'user_display_name']);
            }
        }
        return view('online.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
            'user_type' => ['required', 'in:student,employee']
        ]);

        try {
            Log::info('Login attempt', [
                'username' => $credentials['username'],
                'user_type' => $credentials['user_type']
            ]);

            if ($credentials['user_type'] === 'student') {
                $user = Student::where('student_code', $credentials['username'])->first();
            } else {
                $user = Employee::where('employee_code', $credentials['username'])->first();
            }

            if (!$user) {
                Log::warning('Login failed: User not found', [
                    'username' => $credentials['username'],
                    'user_type' => $credentials['user_type']
                ]);
                return back()->withErrors([
                    'username' => 'Thông tin đăng nhập không chính xác.',
                ])->withInput($request->only('username', 'user_type'));
            }

            $passwordMatch = Hash::check($credentials['password'], $user->password);
            if (!$passwordMatch) {
                Log::warning('Login failed: Invalid password', [
                    'username' => $credentials['username'],
                    'user_type' => $credentials['user_type']
                ]);
                return back()->withErrors([
                    'username' => 'Thông tin đăng nhập không chính xác.',
                ])->withInput($request->only('username', 'user_type'));
            }

            // Create JWT token with custom claims
            $customClaims = [
                'user_type' => $credentials['user_type'],
                'sub' => $user->id
            ];

            if ($credentials['user_type'] === 'employee' && isset($user->role)) {
                $customClaims['role'] = $user->role;
            }

            $token = JWTAuth::claims($customClaims)->fromUser($user);

            // Get display name based on user type
            $displayName = $credentials['user_type'] === 'student'
                ? ($user->full_name ?? $user->student_code ?? '')
                : ($user->name ?? $user->employee_code ?? '');

            // Store token and user info in session
            session([
                'jwt_token' => $token,
                'user_display_name' => $displayName,
                'user_type' => $credentials['user_type'],
                'user_id' => $user->id
            ]);

            Log::info('Login successful', [
                'user_id' => $user->id,
                'user_type' => $credentials['user_type']
            ]);

            // Redirect to online dashboard
            return redirect()->route('online.dashboard')
                ->with('notification', [
                    'message' => 'Đăng nhập thành công!',
                    'type' => 'success'
                ]);

        } catch (\Exception $e) {
            Log::error('Login error', [
                'error' => $e->getMessage(),
                'username' => $credentials['username'] ?? null,
                'user_type' => $credentials['user_type'] ?? null
            ]);

            return back()->withErrors([
                'username' => 'Có lỗi xảy ra khi đăng nhập. Vui lòng thử lại.',
            ])->withInput($request->only('username', 'user_type'));
        }
    }

    public function logout(Request $request)
    {
        try {
            if (session('jwt_token')) {
                JWTAuth::setToken(session('jwt_token'))->invalidate();
                Log::info('JWT token invalidated successfully');
            }
        } catch (\Exception $e) {
            Log::warning('Error invalidating JWT token', ['error' => $e->getMessage()]);
        }

        session()->flush();
        $request->session()->regenerateToken();

        Log::info('User logged out successfully');

        return redirect()->route('online.login')
            ->with('notification', [
                'message' => 'Đăng xuất thành công!',
                'type' => 'success'
            ]);
    }
}
