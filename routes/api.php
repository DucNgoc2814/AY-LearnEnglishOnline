<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\VoucherController;
use App\Http\Controllers\VideoProgressController;
use App\Http\Controllers\LessonProgressController;
use App\Http\Controllers\ClassSessionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/apply-coupon', [VoucherController::class, 'applyCoupon']);

// Payment API endpoints
Route::post('/payment/check-expiry', [\App\Http\Controllers\Client\PaymentController::class, 'checkPaymentExpiry'])->name('api.payment.check-expiry');

Route::get('/table-columns/{tableId}', function ($tableId) {
    $columns = config("table-columns.{$tableId}", []);
    return response()->json($columns);
});

// Video Progress Routes
Route::middleware('auth:sanctum')->group(function () {
    // Video Progress
    Route::post('/video-progress', [VideoProgressController::class, 'saveProgress']);
    Route::get('/video-progress/{videoId}', [VideoProgressController::class, 'getProgress']);

    // Lesson Progress
    Route::post('/lesson-progress', [LessonProgressController::class, 'saveProgress']);
    Route::get('/lesson-progress/{lessonId}/{enrollmentId}', [LessonProgressController::class, 'getProgress']);
    Route::get('/course-progress/{enrollmentId}', [LessonProgressController::class, 'getCourseProgress']);
});

