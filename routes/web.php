<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\auth\AuthController;
use App\Http\Controllers\Client\CourseController;
use App\Http\Controllers\Client\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('client.index');
});

Route::get('/trang-chu', [HomeController::class, 'index'])->name('home');

// Đặt tất cả routes auth trong middleware web
Route::middleware('web')->group(function () {
    // Routes cho khách
    Route::middleware('guest')->group(function () {
        Route::get('/dang-ky', [AuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/dang-ky', [AuthController::class, 'register'])->name('register.submit');
        
        Route::get('/dang-nhap', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/dang-nhap', [AuthController::class, 'login'])->name('login.submit');
    });

    // Routes cho user đã đăng nhập
    Route::get('/khoa-hoc/{slug}', [CourseController::class, 'detailCourse'])->name('detailCourse');
    Route::middleware('auth')->group(function () {
        Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('logout');
        Route::group(['prefix' => 'tai-khoan', 'as' => 'profile.'], function () {
            Route::get('/', [AuthController::class, 'profile'])->name('index');
            Route::post('/update', [AuthController::class, 'updateProfile'])->name('update');
        });
    });
});