<?php

namespace App\Http\Controllers\Admin;

use App\Models\VideoHandoutFile;

class VideoHandoutFileController extends BaseController
{
    protected $pageTitle = 'Quản lý file Video Handout';

    public function __construct()
    {
        $this->model = VideoHandoutFile::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.video-handout-files';

        parent::__construct();
    }
}
