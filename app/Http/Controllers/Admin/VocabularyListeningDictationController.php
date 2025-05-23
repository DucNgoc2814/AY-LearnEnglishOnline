<?php

namespace App\Http\Controllers\Admin;

use App\Models\VocabularyListeningDictation;

class VocabularyListeningDictationController extends BaseController
{
    protected $pageTitle = 'Quản lý bài tập Dictation';

    public function __construct()
    {
        $this->model = VocabularyListeningDictation::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.vocabulary-listening-dictations';

        parent::__construct();
    }
}
