<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\auth\AuthController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\CourseController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\PaymentController;

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
Route::get('/', [HomeController::class, 'index'])->name('home');

// Đặt tất cả routes auth trong middleware web
Route::middleware('web')->group(function () {
    // Routes cho khách
    Route::middleware('guest')->group(function () {
        Route::get('/dang-ky', [AuthController::class, 'showRegisterForm'])->name('register');
        Route::post('/dang-ky', [AuthController::class, 'register'])->name('register.submit');

        Route::get('/dang-nhap', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/dang-nhap', [AuthController::class, 'login'])->name('login.submit');
    });

    Route::get('/khoa-hoc/{slug}', [CourseController::class, 'detailCourse'])->name('detailCourse');
    Route::get('/danh-muc/{slug?}', [CategoryController::class, 'index'])->name('category.index');

    // Routes cho user đã đăng nhập
    Route::middleware('auth')->group(function () {
        Route::post('/dang-xuat', [AuthController::class, 'logout'])->name('logout');
        Route::get('/thanh-toan', [PaymentController::class, 'showQrPayment'])->name('checkout');
        Route::get('/thanh-toan/{slug}', [PaymentController::class, 'showQrPayment'])->name('payment.qr');
        Route::get('/thanh-toan/expired', [PaymentController::class, 'expired'])->name('payment.expired');
        Route::get('/thanh-toan/check-expiry', [PaymentController::class, 'checkPaymentExpiry'])->name('payment.check-expiry');
        
        // Route học khóa học - đơn giản hóa
        Route::middleware(['check.course.access'])->group(function () {
            Route::get('/learning/{courseSlug}', [CourseController::class, 'learning'])->name('course.learning');
        });
        
        Route::group(['prefix' => 'tai-khoan', 'as' => 'profile.'], function () {
            Route::get('/', [AuthController::class, 'profile'])->name('index');
            Route::post('/update', [AuthController::class, 'updateProfile'])->name('update');
        });
    });
});
