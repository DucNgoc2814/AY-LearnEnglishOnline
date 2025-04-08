<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\auth\AuthController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\CourseController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\CommentController;

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

        Route::group(['prefix' => 'tai-khoan', 'as' => 'profile.'], function () {
            Route::get('/', [AuthController::class, 'profile'])->name('index');
            Route::post('/update', [AuthController::class, 'updateProfile'])->name('update');
        });

        Route::prefix('hoc-khoa-hoc')->group(function () {
            
            // Route mặc định
            Route::get('/{courseSlug}', [CourseController::class, 'learning'])
                ->name('course.learning');

            // Route cho video
            Route::get('/{courseSlug}/bai-hoc/{lessonSlug}/video/{videoSlug}', [CourseController::class, 'learning'])
                ->name('course.learning.video');

            // Route cho test
            Route::get('/{courseSlug}/bai-hoc/{lessonSlug}/bai-kiem-tra/{testSlug}', [CourseController::class, 'learning'])
                ->name('course.learning.test');
        });

        // Comment routes
        Route::middleware(['auth'])->group(function () {
            Route::post('/comments', [App\Http\Controllers\Client\CommentController::class, 'store'])->name('client.comments.store');
            Route::post('/comments/{comment}/reply', [App\Http\Controllers\Client\CommentController::class, 'reply'])->name('client.comments.reply');
            
            // Rating routes
            Route::post('/ratings', [App\Http\Controllers\Client\CommentController::class, 'storeRating'])->name('client.ratings.store');
        });
    });
});
