<?php

namespace App\Http\Controllers\Admin;

use App\Models\VideoShadowingSegment;

class VideoShadowingSegmentController extends BaseController
{
    protected $pageTitle = 'Quản lý đoạn Video Shadowing';

    public function __construct()
    {
        $this->model = VideoShadowingSegment::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.video-shadowing-segments';

        parent::__construct();
    }
}
