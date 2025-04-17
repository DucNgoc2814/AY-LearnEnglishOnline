<?php

namespace App\Http\Controllers\Online\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Employee;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

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
                    return redirect()->route('online.dashboard');
                }
            } catch (\Exception $e) {
                session()->forget(['jwt_token']);
            }
        }
        session()->forget(['jwt_token']);
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
            if ($credentials['user_type'] === 'student') {
                $user = Student::where('student_code', $credentials['username'])->first();
            } else {
                $user = Employee::where('employee_code', $credentials['username'])->first();
            }
            if (!$user) {
                return back()->withErrors([
                    'username' => 'Thông tin đăng nhập không chính xác.',
                ])->withInput($request->only('username', 'user_type'));
            }
            $passwordMatch = Hash::check($credentials['password'], $user->password);
            if (!$passwordMatch) {
                return back()->withErrors([
                    'username' => 'Thông tin đăng nhập không chính xác.',
                ])->withInput($request->only('username', 'user_type'));
            }
            $customClaims = [
                'user_type' => $credentials['user_type']
            ];
            if ($credentials['user_type'] === 'employee') {
                $customClaims['role'] = $user->role;
            }
            $token = JWTAuth::claims($customClaims)->fromUser($user);
            $displayName = '';
            if ($credentials['user_type'] === 'student') {
                $displayName = $user->full_name ?? $user->student_code ?? '';
            } else {
                $displayName = $user->name ?? $user->employee_code ?? '';
            }
            session([
                'jwt_token' => $token,
                'user_display_name' => $displayName,
                'user_id' => $user->id,
                'user_type' => $credentials['user_type']
            ]);
            session()->forget('errors');

            return redirect()->route('online.dashboard')
                ->with('notification', [
                    'message' => 'Đăng nhập thành công!',
                    'type' => 'success'
                ]);
        } catch (\Exception $e) {
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
            }
        } catch (\Exception $e) {
        }
        session()->flush();
        $request->session()->regenerateToken();
        return redirect()->route('online.login')
            ->with('notification', [
                'message' => 'Đăng xuất thành công!',
                'type' => 'success'
            ]);
    }
}
