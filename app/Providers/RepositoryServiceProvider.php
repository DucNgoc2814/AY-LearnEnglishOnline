<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\Interfaces\VoucherRepositoryInterface;
use App\Repositories\VoucherRepository;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\LessonRepositoryInterface;
use App\Repositories\Interfaces\VideoLessonRepositoryInterface;
use App\Repositories\CourseRepository;
use App\Repositories\LessonRepository;
use App\Repositories\VideoLessonRepository;
use App\Repositories\Interfaces\ZoomSessionRepositoryInterface;
use App\Repositories\ZoomSessionRepository;
use App\Repositories\Interfaces\TestRepositoryInterface;
use App\Repositories\TestRepository;
use App\Repositories\Interfaces\QuestionRepositoryInterface;
use App\Repositories\QuestionRepository;
use App\Repositories\Interfaces\AnswerRepositoryInterface;
use App\Repositories\AnswerRepository;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\StudentRepository;
use App\Repositories\Interfaces\ClassRepositoryInterface;
use App\Repositories\ClassRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(VoucherRepositoryInterface::class, VoucherRepository::class);
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
        $this->app->bind(LessonRepositoryInterface::class, LessonRepository::class);
        $this->app->bind(VideoLessonRepositoryInterface::class, VideoLessonRepository::class);
        $this->app->bind(ZoomSessionRepositoryInterface::class, ZoomSessionRepository::class);
        $this->app->bind(TestRepositoryInterface::class, TestRepository::class);
        $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
        $this->app->bind(AnswerRepositoryInterface::class, AnswerRepository::class);
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(ClassRepositoryInterface::class, ClassRepository::class);
    }
}
