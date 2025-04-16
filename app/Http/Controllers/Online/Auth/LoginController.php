<?php

namespace App\Http\Controllers\Online\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Employee;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // If user is already logged in and has a valid token, redirect to dashboard
        if (session('jwt_token')) {
            try {
                $token = session('jwt_token');
                JWTAuth::setToken($token);
                $user = JWTAuth::authenticate();

                if ($user) {
                    return redirect()->route('online.dashboard');
                }
            } catch (\Exception $e) {
                // Token is invalid, clear session
                session()->forget(['jwt_token']);
                Log::error('Invalid token in session', ['error' => $e->getMessage()]);
            }
        }

        // Clear any existing session data to prevent issues
        session()->forget(['jwt_token']);

        return view('online.auth.login');
    }

    public function login(Request $request)
    {
        Log::info('Login attempt', [
            'username' => $request->username,
            'user_type' => $request->user_type
        ]);

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
            'user_type' => ['required', 'in:student,employee']
        ]);

        try {
            if ($credentials['user_type'] === 'student') {
                $user = Student::where('student_code', $credentials['username'])->first();

                Log::info('Student search result', [
                    'student_code' => $credentials['username'],
                    'found' => $user ? true : false
                ]);
            } else {
                $user = Employee::where('employee_code', $credentials['username'])->first();

                Log::info('Employee search result', [
                    'employee_code' => $credentials['username'],
                    'found' => $user ? true : false
                ]);
            }

            if (!$user) {
                Log::warning('Login failed - User not found', [
                    'username' => $credentials['username'],
                    'user_type' => $credentials['user_type']
                ]);

                return back()->withErrors([
                    'username' => 'Thông tin đăng nhập không chính xác.',
                ])->withInput($request->only('username', 'user_type'));
            }

            $passwordMatch = Hash::check($credentials['password'], $user->password);
            Log::info('Password check', [
                'matches' => $passwordMatch
            ]);

            if (!$passwordMatch) {
                Log::warning('Login failed - Invalid password', [
                    'username' => $credentials['username'],
                    'user_type' => $credentials['user_type']
                ]);

                return back()->withErrors([
                    'username' => 'Thông tin đăng nhập không chính xác.',
                ])->withInput($request->only('username', 'user_type'));
            }

            // Create custom claims for the token
            $customClaims = [
                'user_type' => $credentials['user_type']
            ];

            if ($credentials['user_type'] === 'employee') {
                $customClaims['role'] = $user->role;
            }

            // Generate token with custom claims
            $token = JWTAuth::claims($customClaims)->fromUser($user);

            Log::info('JWT token created', [
                'user_id' => $user->id,
                'user_type' => $credentials['user_type'],
                'has_token' => !empty($token)
            ]);

            // Store token in session
            session(['jwt_token' => $token]);

            // Clear any existing error messages
            session()->forget('errors');

            return redirect()->route('online.dashboard')
                ->with('notification', [
                    'message' => 'Đăng nhập thành công!',
                    'type' => 'success'
                ]);

        } catch (\Exception $e) {
            Log::error('Login error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withErrors([
                'username' => 'Có lỗi xảy ra khi đăng nhập. Vui lòng thử lại.',
            ])->withInput($request->only('username', 'user_type'));
        }
    }

    public function logout(Request $request)
    {
        try {
            // Vô hiệu hóa token nếu có
            if (session('jwt_token')) {
                JWTAuth::setToken(session('jwt_token'))->invalidate();
            }
        } catch (\Exception $e) {
            Log::error('Logout error', ['error' => $e->getMessage()]);
        }

        // Xóa session
        session()->flush();

        // Tạo token CSRF mới
        $request->session()->regenerateToken();

        return redirect()->route('online.login')
            ->with('notification', [
                'message' => 'Đăng xuất thành công!',
                'type' => 'success'
            ]);
    }
}
