<?php

namespace App\Http\Controllers\Admin;

use App\Models\VocabularyListeningEndingSound;

class VocabularyListeningEndingSoundController extends BaseController
{
    protected $pageTitle = 'Quản lý âm cuối';

    public function __construct()
    {
        $this->model = VocabularyListeningEndingSound::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.vocabulary-listening-ending-sounds';

        parent::__construct();
    }
}
