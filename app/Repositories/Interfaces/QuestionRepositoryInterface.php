<?php

namespace App\Repositories\Interfaces;

interface QuestionRepositoryInterface extends BaseRepositoryInterface
{
    public function searchByName($search);
    public function findWithFullUrls($id);
}
