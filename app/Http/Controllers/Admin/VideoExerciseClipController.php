<?php

namespace App\Http\Controllers\Admin;

use App\Models\VideoExerciseClip;
use Illuminate\Http\Request;

class VideoExerciseClipController extends BaseController
{
    protected $pageTitle = 'Danh sách video exercise clip';
    public function __construct()
    {
        $this->model = VideoExerciseClip::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.video-exercise-clips';

        parent::__construct();
    }
}
