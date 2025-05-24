<?php

namespace App\Http\Controllers\Admin;

use App\Models\VocabularyListeningQuizlet;

class VocabularyListeningQuizletController extends BaseController
{
    protected $pageTitle = 'Quản lý Quizlet';

    public function __construct()
    {
        $this->model = VocabularyListeningQuizlet::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.vocabulary-listening-quizlets';

        parent::__construct();
    }
}
