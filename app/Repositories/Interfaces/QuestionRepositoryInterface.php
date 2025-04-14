<?php

namespace App\Repositories\Interfaces;

interface QuestionRepositoryInterface extends BaseRepositoryInterface
{
    public function searchByName($keyword);
    public function getAllWithTrashed();
    public function findOrFail($id);
    public function findWithFullUrls($id);
    public function handleImage($image, string $folder);
    public function handleVideo($video, string $folder);
    public function handleAudio($audio, string $folder);
    public function deleteFile($path);
    public function getAnswersByQuestionId($questionId);
}
