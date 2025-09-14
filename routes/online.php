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
use App\Http\Controllers\Online\ClassStudentController;
use App\Http\Controllers\Online\Auth\GoogleLoginController;
use App\Http\Controllers\Online\OnlineClassLessonController;
use App\Http\Controllers\Online\VocabularyListeningDictationController;
use App\Http\Controllers\VideoExerciseController;
use App\Http\Controllers\ReflectionExerciseController;
use App\Http\Controllers\VideoHandoutController;
use App\Http\Controllers\Online\VideoShadowingController;
use App\Http\Controllers\Online\VocabularyListeningController;
use App\Http\Controllers\Online\VideoExerciseLessonController;

/*
|--------------------------------------------------------------------------
| Online Routes
|--------------------------------------------------------------------------
|
| Here is where you can register online routes for your application.
|
*/

// Base route for online platform
Route::prefix('online')->name('online.')->group(function () {
    // Guest Routes (No Authentication Required)
    Route::middleware(['web'])->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.post');

        // Social Login Routes
        Route::get('auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
        Route::get('auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('auth.google.callback');
    });

    // Protected Routes - Require Authentication
    Route::middleware(['online'])->group(function () {
        // Root route
        Route::get('/', function() {
            return redirect()->route('online.dashboard');
        });

        // Dashboard Route (default landing page after login)
        Route::get('/dashboard', [NewsController::class, 'index'])->name('dashboard');

        // Logout Route
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        // Student Routes
        Route::group([], function () {
            // Classes
            Route::prefix('classes')->name('classes.')->group(function () {
                Route::get('/', [ClassStudentController::class, 'index'])->name('index');
                Route::get('/{id}', [ClassStudentController::class, 'show'])->name('show');
                Route::get('/{id}/lessons', [OnlineClassLessonController::class, 'index'])->name('lessons');
                Route::get('/{class_id}/tests', [TestController::class, 'index'])->name('tests');
                Route::get('/quiz/{quiz}', [ClassStudentController::class, 'quiz'])->name('quiz');

                // Add new route for saving dictation progress
                Route::post('/vocabulary-listening/dictation/save-progress', [VocabularyListeningDictationController::class, 'saveProgress'])
                    ->name('vocabulary-listening.dictation.save-progress');

                // Add new route for saving grammar progress
                Route::post('/vocabulary-listening/grammar/save-progress', [VocabularyListeningController::class, 'saveGrammarProgress'])
                    ->name('vocabulary-listening.grammar.save-progress');

                // Add new route for saving key phrase progress
                Route::post('/vocabulary-listening/phrases/save-progress', [VocabularyListeningController::class, 'savePhrasesProgress'])
                    ->name('vocabulary-listening.phrases.save-progress');

                // Add new route for saving sentence building progress
                Route::post('/vocabulary-listening/sentence/save-progress', [VocabularyListeningController::class, 'saveSentenceProgress'])
                    ->name('vocabulary-listening.sentence.save-progress');

                // Add new route for transcription progress
                Route::post('/vocabulary-listening/transcription/save-progress', [VocabularyListeningController::class, 'saveTranscriptionProgress'])
                    ->name('vocabulary-listening.transcription.save-progress');
            });

            // Sessions
            Route::prefix('sessions')->name('sessions.')->group(function () {
                Route::get('/', [SessionController::class, 'index'])->name('index');
                Route::get('/{session}', [SessionController::class, 'show'])->name('show');
                Route::get('/{session}/join', [SessionController::class, 'join'])->name('join');
            });

            // Student Schedule
            Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');

            // Tests
            Route::prefix('tests')->name('tests.')->group(function () {
                Route::get('/', [TestController::class, 'index'])->name('index');
                Route::get('/{test_id}', [TestController::class, 'show'])->name('show');
                Route::post('/{test_id}/submit', [TestController::class, 'submit'])->name('submit');
                Route::get('/{test_id}/result', [TestController::class, 'result'])->name('result');
            });

            // Student Grades
            Route::prefix('grades')->name('grades.')->group(function () {
                Route::get('/', [GradeController::class, 'index'])->name('index');
                Route::get('/{class_id}', [GradeController::class, 'show'])->name('show');
                Route::get('/detail/{assessment_id}', [GradeController::class, 'detail'])->name('detail');
            });
        });

        // Teacher Routes
        Route::middleware(['jwt.role:teacher,teaching_assistant'])->group(function () {
            Route::prefix('teacher')->name('teacher.')->group(function () {
                // Teacher Schedule
                Route::get('/schedule', [TeacherScheduleController::class, 'index'])->name('schedule');

                // Class Management
                Route::prefix('classes')->name('classes.')->group(function () {
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
                        Route::get('/reflection/student/{student_id}', [TeacherClassController::class, 'reflectionDetail'])->name('reflection.detail');
                        Route::post('/reflection/student/{student_id}/save', [TeacherClassController::class, 'saveReflection'])->name('reflection.save');
                    });

                    // Materials
                    Route::post('/{id}/materials/upload', [TeacherClassController::class, 'uploadMaterial'])->name('materials.upload');
                    Route::delete('/materials/{id}', [TeacherClassController::class, 'deleteMaterial'])->name('materials.delete');
                });

                // Grades Management
                Route::prefix('grades')->name('grades.')->group(function () {
                    Route::get('/', [GradeController::class, 'teacherIndex'])->name('index');
                    Route::get('/class/{class_id}', [GradeController::class, 'classGrades'])->name('class');
                    Route::get('/student/{student_id}', [GradeController::class, 'studentGrades'])->name('student');
                    Route::get('/assessment/{assessment_id}', [GradeController::class, 'assessmentGrades'])->name('assessment');
                    Route::post('/update', [GradeController::class, 'updateGrades'])->name('update');
                    Route::get('/export/{class_id}', [GradeController::class, 'exportGrades'])->name('export');
                });
            });
        });

        // Shared Routes - Accessible by all authenticated users
        Route::group([], function () {
            // Danh sách khóa học
            Route::get('/courses', [App\Http\Controllers\Online\CourseController::class, 'index'])
                ->name('courses.index');

            // Chi tiết từng khóa học
            Route::get('/courses/show', [App\Http\Controllers\Online\CourseController::class, 'show1'])
                ->name('courses.show');
            Route::get('/courses/show2', [App\Http\Controllers\Online\CourseController::class, 'show2'])
                ->name('courses.show2');
            Route::get('/courses/show3', [App\Http\Controllers\Online\CourseController::class, 'show3'])
                ->name('courses.show3');
            Route::get('/courses/show4', [App\Http\Controllers\Online\CourseController::class, 'show4'])
                ->name('courses.show4');

            // Attendance
            Route::prefix('attendance')->name('attendance.')->group(function () {
                Route::get('/', [AttendanceController::class, 'index'])->name('index');
                Route::get('/detail/{id}', [AttendanceController::class, 'detail'])->name('detail');
                Route::post('/save/{id}', [AttendanceController::class, 'saveAttendance'])->name('save');
                Route::get('/sessions/{class}', [AttendanceController::class, 'sessions'])->name('sessions');
                Route::get('/{class}', [AttendanceController::class, 'show'])->name('show');
            });

            // Awards
            Route::prefix('awards')->name('awards.')->group(function () {
                Route::get('/', [AwardController::class, 'index'])->name('index');
                Route::get('/{award}', [AwardController::class, 'show'])->name('show');
            });

            // Guides
            Route::prefix('guides')->name('guides.')->group(function () {
                Route::get('/', [GuideController::class, 'index'])->name('index');
                Route::get('/{topic}', [GuideController::class, 'show'])->name('show');
            });

            // Support
            Route::prefix('support')->name('support.')->group(function () {
                Route::get('/', [SupportController::class, 'index'])->name('index');
                Route::post('/ticket', [SupportController::class, 'store'])->name('store');
            });

            // Ebooks
            Route::prefix('ebooks')->name('ebooks.')->group(function () {
                Route::get('/', [EbookController::class, 'index'])->name('index');
                Route::get('/{ebook}', [EbookController::class, 'show'])->name('show');
            });

            // News & Announcements
            Route::prefix('news')->name('news.')->group(function () {
                Route::get('/', [NewsController::class, 'index'])->name('index');
                Route::get('/{id}', [NewsController::class, 'show'])->name('show');
            });

            // Exercise Routes
            Route::prefix('video-exercise')->name('video-exercise.')->group(function () {
                Route::get('/', [VideoExerciseLessonController::class, 'index'])->name('index');
                Route::get('/{id}', [VideoExerciseLessonController::class, 'show'])->name('show');
                Route::post('/', [VideoExerciseLessonController::class, 'store'])->name('store');
                Route::put('/{id}', [VideoExerciseLessonController::class, 'update'])->name('update');
                Route::delete('/{id}', [VideoExerciseLessonController::class, 'destroy'])->name('destroy');
            });
            Route::get('/reflection-exercise/{id}', [ReflectionExerciseController::class, 'show'])->name('reflection-exercise.show');
            Route::get('/video-handout', [VideoHandoutController::class, 'show'])->name('video-handout.show');
            Route::get('/video-shadowing/{id}', [VideoShadowingController::class, 'show'])->name('video-shadowing.show');
            Route::get('/vocabulary-listening/{lesson_id?}', [\App\Http\Controllers\Online\VocabularyListeningController::class, 'show'])->name('vocabulary-listening.show');

            // Summary of all exercises routes
            Route::prefix('summary-of-all-exercises')->name('summary-of-all-exercises.')->group(function () {
                Route::prefix('course-two')->name('course-two.')->group(function () {
                    Route::prefix('before')->name('before.')->group(function () {
                        Route::get('/video-handout/show', [VideoHandoutController::class, 'show'])
                            ->name('video-handout.show');
                        Route::get('/video-handout/show2', [VideoHandoutController::class, 'show2'])
                            ->name('video-handout.show2');
                    });
                });
            });
        });
    });
});
