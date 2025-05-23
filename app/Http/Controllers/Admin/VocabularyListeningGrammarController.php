<?php

namespace App\Http\Controllers\Admin;

use App\Models\VocabularyListeningGrammar;

class VocabularyListeningGrammarController extends BaseController
{
    protected $pageTitle = 'Quản lý bài tập ngữ pháp';

    public function __construct()
    {
        $this->model = VocabularyListeningGrammar::class;
        $this->viewPath = 'admin.crud';
        $this->route = 'admin.vocabulary-listening-grammars';

        parent::__construct();
    }
}
