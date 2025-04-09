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
use App\Repositories\Interfaces\LessonTestRepositoryInterface;
use App\Repositories\LessonTestRepository;
use App\Repositories\Interfaces\QuestionLessonTestRepositoryInterface;
use App\Repositories\QuestionLessonTestRepository;
use App\Repositories\Interfaces\AnswerLessonTestRepositoryInterface;
use App\Repositories\AnswerLessonTestRepository;
use App\Repositories\Interfaces\ZoomSessionRepositoryInterface;
use App\Repositories\ZoomSessionRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(VoucherRepositoryInterface::class, VoucherRepository::class);
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
        $this->app->bind(LessonRepositoryInterface::class, LessonRepository::class);
        $this->app->bind(VideoLessonRepositoryInterface::class, VideoLessonRepository::class);
        $this->app->bind(LessonTestRepositoryInterface::class, LessonTestRepository::class);
        $this->app->bind(QuestionLessonTestRepositoryInterface::class, QuestionLessonTestRepository::class);
        $this->app->bind(AnswerLessonTestRepositoryInterface::class, AnswerLessonTestRepository::class);
        $this->app->bind(ZoomSessionRepositoryInterface::class, ZoomSessionRepository::class);
    }
}
