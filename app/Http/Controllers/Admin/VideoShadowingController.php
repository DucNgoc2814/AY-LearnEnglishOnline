<?php

namespace App\Http\Controllers\Admin;

use App\Models\VideoShadowing;

class VideoShadowingController extends BaseController
{
    protected $pageTitle = 'Quản lý Video Shadowing';

    public function __construct()
    {
        $this->model = VideoShadowing::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.video-shadowings';

        parent::__construct();
    }
}
