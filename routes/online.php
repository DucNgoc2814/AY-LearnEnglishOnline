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
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('online.logout');

    // Dashboard Route
    Route::get('/', [NewsController::class, 'index'])
        ->name('online.dashboard');

    // Student Routes
    Route::middleware(['jwt.role:student'])->group(function () {
        // Classes
        Route::prefix('classes')->name('online.classes.')->group(function () {
            Route::get('/', [ClassController::class, 'index'])->name('index');
            Route::get('/{class}', [ClassController::class, 'show'])->name('show');
            Route::get('/{class_id}/tests', [TestController::class, 'index'])->name('tests');
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
        // Teacher Schedule - Sử dụng controller mới
        Route::get('/teacher/schedule', [TeacherScheduleController::class, 'index'])
            ->name('online.teacher.schedule');

        // Class Management - Sử dụng controller mới
        Route::prefix('teacher/classes')->name('online.teacher.classes.')->group(function () {
            Route::get('/', [TeacherClassController::class, 'index'])->name('index');
            Route::get('/{id}', [TeacherClassController::class, 'show'])->name('show');
            
            // Attendance
            Route::get('/{id}/attendance', [TeacherClassController::class, 'attendance'])->name('attendance');
            
            // Assignments
            Route::get('/{class}/assignments', [ClassController::class, 'classAssignments'])->name('assignments');
            Route::get('/{class}/assignments/create', [ClassController::class, 'createAssignment'])->name('assignments.create');
            Route::post('/{class}/assignments', [ClassController::class, 'storeAssignment'])->name('assignments.store');
            Route::get('/{class}/assignments/{assignment}', [ClassController::class, 'showAssignment'])->name('assignments.show');
            Route::get('/{class}/assignments/{assignment}/edit', [ClassController::class, 'editAssignment'])->name('assignments.edit');
            Route::put('/{class}/assignments/{assignment}', [ClassController::class, 'updateAssignment'])->name('assignments.update');
            Route::delete('/{class}/assignments/{assignment}', [ClassController::class, 'deleteAssignment'])->name('assignments.delete');
            
            // Grades
            Route::get('/{class}/grades', [ClassController::class, 'classGrades'])->name('grades');
            Route::post('/{class}/grades/update', [ClassController::class, 'updateGrades'])->name('grades.update');
            Route::get('/{class}/grades/export', [ClassController::class, 'exportGrades'])->name('grades.export');
            
            // Students
            Route::get('/{class}/students', [ClassController::class, 'classStudents'])->name('students');
            Route::get('/{class}/students/{student}', [ClassController::class, 'studentDetail'])->name('students.show');
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
            Route::get('/{class}', [AttendanceController::class, 'show'])->name('show');
            Route::get('/sessions/{class}', [AttendanceController::class, 'sessions'])->name('sessions');
            Route::get('/detail/{id}', [AttendanceController::class, 'detail'])->name('detail');
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
});
