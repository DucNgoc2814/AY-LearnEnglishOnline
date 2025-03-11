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
                ->with('success', 'Registration successful! Please login.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Registration failed. Please try again.');
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
                ->withErrors(['email' => 'Invalid credentials']);
        }

        return redirect()->intended(route('home'))
            ->with('success', 'Welcome back!');
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
            ->with('success', 'Đăng xuất thành công.');
    }

    public function profile(): View
    {
        return view('client.auth.profile');
    }
}
