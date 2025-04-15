<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Online\ClassController;
use App\Http\Controllers\Online\SessionController;
use App\Http\Controllers\Online\AttendanceController;
use App\Http\Controllers\Online\Auth\LoginController;
use App\Http\Controllers\Online\ScheduleController;
use App\Http\Controllers\Online\AwardController;
use App\Http\Controllers\Online\GuideController;
use App\Http\Controllers\Online\SupportController;
use App\Http\Controllers\Online\EbookController;

/*
|--------------------------------------------------------------------------
| Online Routes
|--------------------------------------------------------------------------
|
| Here is where you can register online routes for your application.
|
*/

// Guest Routes (No Authentication Required)
Route::middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('online.login')
        ->middleware('guest');
    Route::post('/login', [LoginController::class, 'login'])
        ->middleware('guest');
});

// Protected Routes - Require JWT Authentication
Route::middleware(['web', 'jwt.role'])->group(function () {
    // Logout Route
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('online.logout');

    // Dashboard Route
    Route::get('/', [ClassController::class, 'index'])
        ->name('online.dashboard');

    // Student Routes
    Route::middleware(['jwt.role:student'])->group(function () {
        // Classes
        Route::prefix('classes')->name('online.classes.')->group(function () {
            Route::get('/', [ClassController::class, 'index'])->name('index');
            Route::get('/{class}', [ClassController::class, 'show'])->name('show');
        });

        // Sessions
        Route::prefix('sessions')->name('online.sessions.')->group(function () {
            Route::get('/', [SessionController::class, 'index'])->name('index');
            Route::get('/{session}', [SessionController::class, 'show'])->name('show');
            Route::get('/{session}/join', [SessionController::class, 'join'])->name('join');
        });

        // Student Schedule
        Route::get('/schedule', [ScheduleController::class, 'index'])
            ->name('online.schedule');
    });

    // Teacher Routes
    Route::middleware(['jwt.role:teacher'])->group(function () {
        // Attendance Management
        Route::prefix('attendance')->name('online.attendance.')->group(function () {
            Route::get('/', [AttendanceController::class, 'index'])->name('index');
            Route::get('/{class}', [AttendanceController::class, 'show'])->name('show');
            Route::get('/sessions/{class}', [AttendanceController::class, 'sessions'])->name('sessions');
            Route::get('/detail/{id}', [AttendanceController::class, 'detail'])->name('detail');
            Route::post('/save/{id}', [AttendanceController::class, 'saveAttendance'])->name('save');
            Route::get('/students', [AttendanceController::class, 'students'])->name('students');
        });

        // Teacher Schedule
        Route::get('/teacher/schedule', [ScheduleController::class, 'teacherSchedule'])
            ->name('online.teacher.schedule');
    });

    // Shared Routes - Accessible by both Students and Teachers
    Route::middleware(['jwt.role:student,teacher'])->group(function () {
        // Awards
        Route::prefix('awards')->name('online.awards.')->group(function () {
            Route::get('/', [AwardController::class, 'index'])->name('index');
            Route::get('/{award}', [AwardController::class, 'show'])->name('show');
        });

        // Guides
        Route::prefix('guides')->name('online.guides.')->group(function () {
            Route::get('/', [GuideController::class, 'index'])->name('index');
            Route::get('/{topic}', [GuideController::class, 'show'])->name('show');
        });

        // Support
        Route::prefix('support')->name('online.support.')->group(function () {
            Route::get('/', [SupportController::class, 'index'])->name('index');
            Route::post('/ticket', [SupportController::class, 'store'])->name('store');
        });

        // Ebooks
        Route::prefix('ebooks')->name('online.ebooks.')->group(function () {
            Route::get('/', [EbookController::class, 'index'])->name('index');
            Route::get('/{ebook}', [EbookController::class, 'show'])->name('show');
        });
    });

    // Admin Routes
    Route::middleware(['jwt.role:admin'])->group(function () {
        // Admin specific routes can be added here
    });
});
