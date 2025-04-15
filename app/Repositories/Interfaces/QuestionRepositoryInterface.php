<?php

namespace App\Repositories\Interfaces;

interface QuestionRepositoryInterface extends BaseRepositoryInterface
{
    public function searchByName($keyword);
    public function findWithFullUrls($id);
    public function getAnswersByQuestionId($questionId);
}
