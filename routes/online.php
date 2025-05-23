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
use App\Http\Controllers\Online\GradeController;
use App\Http\Controllers\Online\NewsController;
use App\Http\Controllers\Online\TestController;
use App\Http\Controllers\Online\MaterialController;
use App\Http\Controllers\Online\Teacher\ClassController as TeacherClassController;
use App\Http\Controllers\Online\Teacher\ScheduleController as TeacherScheduleController;

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
    // Removed duplicate route

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('online.logout');

    // Dashboard Route
    Route::get('/', [NewsController::class, 'index'])
        ->name('online.dashboard');

    // Exercise Routes
    Route::prefix('exercises')->name('exercises.')->group(function () {
        Route::get('/video/{id}', [MaterialController::class, 'videoExercise'])->name('video');
        Route::get('/audio/{id}', [MaterialController::class, 'audioExercise'])->name('audio');
        Route::get('/grammar/{id}', [MaterialController::class, 'grammarExercise'])->name('grammar');
        Route::get('/video-series/{id}', [MaterialController::class, 'videoSeries'])->name('video-series');
        Route::get('/audio-collection/{id}', [MaterialController::class, 'audioCollection'])->name('audio-collection');
        Route::get('/games/{id}', [MaterialController::class, 'vocabularyGames'])->name('games');

        // Submit exercise routes
        Route::post('/video/{id}/submit', [MaterialController::class, 'submitVideoExercise'])->name('video.submit');
        Route::post('/audio/{id}/submit', [MaterialController::class, 'submitAudioExercise'])->name('audio.submit');
        Route::post('/grammar/{id}/submit', [MaterialController::class, 'submitGrammarExercise'])->name('grammar.submit');
    });

    // Student Routes
    Route::middleware(['jwt.role:student'])->group(function () {
        // Classes
        Route::prefix('classes')->name('online.classes.')->group(function () {
            Route::get('/', [ClassController::class, 'index'])->name('index');
            Route::get('/{id}', [ClassController::class, 'show'])->name('show');
            Route::get('/{class_id}/tests', [TestController::class, 'index'])->name('tests');
            Route::get('/quiz/{quiz}', [ClassController::class, 'quiz'])->name('quiz');
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

        // Tests
        Route::prefix('tests')->name('online.tests.')->group(function () {
            Route::get('/', [TestController::class, 'index'])->name('index');
            Route::get('/{test_id}', [TestController::class, 'show'])->name('show');
            Route::post('/{test_id}/submit', [TestController::class, 'submit'])->name('submit');
            Route::get('/{test_id}/result', [TestController::class, 'result'])->name('result');
        });

        // Student Grades
        Route::prefix('grades')->name('online.grades.')->group(function () {
            Route::get('/', [GradeController::class, 'index'])->name('index');
            Route::get('/{class_id}', [GradeController::class, 'show'])->name('show');
            Route::get('/detail/{assessment_id}', [GradeController::class, 'detail'])->name('detail');
        });
    });

    // Teacher Routes (for both teachers and teaching assistants)
    Route::middleware(['jwt.role:teacher,teaching_assistant'])->group(function () {
        // Teacher Schedule
        Route::get('/teacher/schedule', [TeacherScheduleController::class, 'index'])
            ->name('online.teacher.schedule');

        // Class Management
        Route::prefix('teacher/classes')->name('online.teacher.classes.')->group(function () {
            Route::get('/', [TeacherClassController::class, 'index'])->name('index');
            Route::get('/{id}', [TeacherClassController::class, 'show'])->name('show');
            Route::get('/{id}/attendance', [TeacherClassController::class, 'attendance'])->name('attendance');

            // Progress Routes
            Route::prefix('{id}/progress')->name('progress.')->group(function () {
                Route::get('/video-exercise', [TeacherClassController::class, 'videoExerciseProgress'])->name('video-exercise');
                Route::get('/vocabulary', [TeacherClassController::class, 'vocabularyProgress'])->name('vocabulary');
                Route::get('/handout', [TeacherClassController::class, 'handoutProgress'])->name('handout');
                Route::get('/shadowing', [TeacherClassController::class, 'shadowingProgress'])->name('shadowing');
                Route::get('/reflection', [TeacherClassController::class, 'reflectionProgress'])->name('reflection');
            });

            // Materials
            Route::post('/{id}/materials/upload', [TeacherClassController::class, 'uploadMaterial'])->name('materials.upload');
            Route::delete('/materials/{id}', [TeacherClassController::class, 'deleteMaterial'])->name('materials.delete');
        });

        // Teacher Grades Management
        Route::prefix('teacher/grades')->name('online.teacher.grades.')->group(function () {
            Route::get('/', [GradeController::class, 'teacherIndex'])->name('index');
            Route::get('/class/{class_id}', [GradeController::class, 'classGrades'])->name('class');
            Route::get('/student/{student_id}', [GradeController::class, 'studentGrades'])->name('student');
            Route::get('/assessment/{assessment_id}', [GradeController::class, 'assessmentGrades'])->name('assessment');
            Route::post('/update', [GradeController::class, 'updateGrades'])->name('update');
            Route::get('/export/{class_id}', [GradeController::class, 'exportGrades'])->name('export');
        });

        // Attendance Management
        Route::prefix('attendance')->name('online.attendance.')->group(function () {
            Route::post('/save/{id}', [AttendanceController::class, 'saveAttendance'])->name('save');
            Route::get('/students', [AttendanceController::class, 'students'])->name('students');
        });
    });

    // Admin Routes
    Route::middleware(['jwt.role:admin'])->group(function () {
        // Admin specific routes here
    });

    // Staff Routes
    Route::middleware(['jwt.role:staff'])->group(function () {
        // Staff specific routes here
    });

    // Shared Routes - Accessible by Students, Teachers, and Teaching Assistants
    Route::middleware(['jwt.role:student,teacher,teaching_assistant'])->group(function () {
        // Shared Attendance Routes
        Route::prefix('attendance')->name('online.attendance.')->group(function () {
            Route::get('/', [AttendanceController::class, 'index'])->name('index');
            Route::get('/detail/{id}', [AttendanceController::class, 'detail'])->name('detail');
            Route::post('/save/{id}', [AttendanceController::class, 'saveAttendance'])->name('save');
            Route::get('/sessions/{class}', [AttendanceController::class, 'sessions'])->name('sessions');
            Route::get('/{class}', [AttendanceController::class, 'show'])->name('show');
        });

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

    // Test Routes
    Route::prefix('test')->middleware(['debug.request'])->group(function () {
        Route::get('/test-class-details/{id}', [TeacherClassController::class, 'show'])
            ->name('test.class.details');
        Route::get('/direct-class/{id}', [TeacherClassController::class, 'show'])
            ->name('direct.class');
        Route::get('/super-test/{id}', [TeacherClassController::class, 'show'])
            ->name('super.test');
    });
});
