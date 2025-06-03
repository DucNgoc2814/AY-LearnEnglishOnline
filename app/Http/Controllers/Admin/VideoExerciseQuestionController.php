<?php

namespace App\Http\Controllers\Admin;

use App\Models\VideoExerciseQuestion;

class VideoExerciseQuestionController extends BaseController
{
    protected $pageTitle = 'Danh sách video exercise question';
    public function __construct()
    {
        $this->model = VideoExerciseQuestion::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.video-exercise-questions';

        parent::__construct();
    }
}
