<?php

namespace App\Http\Controllers\Admin;

use App\Models\VideoExerciseLesson;
use Illuminate\Http\Request;

class VideoExerciseLessonController extends BaseController
{
    protected $pageTitle = 'Danh sách video exercise lesson';
    public function __construct()
    {
        $this->model = VideoExerciseLesson::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.video-exercise-lessons';

        parent::__construct();
    }
}
