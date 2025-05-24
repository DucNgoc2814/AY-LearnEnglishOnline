<?php

namespace App\Http\Controllers\Admin;

use App\Models\VideoHandoutUnit;

class VideoHandoutUnitController extends BaseController
{
    protected $pageTitle = 'Quản lý Unit Video Handout';

    public function __construct()
    {
        $this->model = VideoHandoutUnit::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.video-handout-units';

        parent::__construct();
    }
}
