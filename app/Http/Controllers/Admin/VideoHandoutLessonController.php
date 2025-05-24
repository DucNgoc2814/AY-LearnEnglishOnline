<?php

namespace App\Http\Controllers\Admin;

use App\Models\VideoHandoutLesson;

class VideoHandoutLessonController extends BaseController
{
    protected $pageTitle = 'Quản lý bài học Video Handout';

    public function __construct()
    {
        $this->model = VideoHandoutLesson::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.video-handout-lessons';

        parent::__construct();
    }
}
