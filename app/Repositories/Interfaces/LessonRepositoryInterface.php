<?php

namespace App\Repositories\Interfaces;

interface LessonRepositoryInterface extends BaseRepositoryInterface
{
    public function searchByName($search);

    /**
     * Lấy danh sách bài học theo khóa học
     *
     * @param int $courseId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByCourseId($courseId);

    /**
     * Lấy danh sách video của bài học
     *
     * @param int $lessonId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getVideosByLessonId($lessonId);
}
