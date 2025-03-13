<?php

namespace App\Http\Controllers\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

/**
 * @package App\Http\Controllers\Client\Auth
 * @author YourName
 * @description Handles user authentication operations
 */
class AuthController extends Controller
{
    /**
     * Show registration form
     * 
     * @return View
     */
    public function showRegisterForm(): View
    {
        return view('client.auth.register');
    }

    /**
     * Handle registration request
     * 
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phoneNumber' => $request->phoneNumber,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('login')
                ->with('notification', [
                    'message' => 'Đăng ký thành công! Vui lòng đăng nhập.',
                    'type' => 'success'
                ]);
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('notification', [
                    'message' => 'Đăng ký thất bại. Vui lòng thử lại.',
                    'type' => 'error'
                ]);
        }
    }

    /**
     * Show login form
     * 
     * @return View
     */
    public function showLoginForm(): View
    {
        return view('client.auth.login');
    }

    /**
     * Handle login request
     * 
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return back()->withInput()
                ->with('notification', [
                    'message' => 'Email hoặc mật khẩu không chính xác',
                    'type' => 'error'
                ]);
        }

        return redirect()->intended(route('home'))
            ->with('notification', [
                'message' => 'Đăng nhập thành công!',
                'type' => 'success'
            ]);
    }

    /**
     * Handle logout request
     * 
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();
        
        return redirect()->route('home')
            ->with('notification', [
                'message' => 'Đăng xuất thành công.',
                'type' => 'success'
            ]);
    }

    public function profile(): View
    {
        return view('client.auth.profile');
    }
}
