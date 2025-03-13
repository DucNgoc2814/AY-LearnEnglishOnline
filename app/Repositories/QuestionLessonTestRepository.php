<?php

namespace App\Repositories;

use App\Models\QuestionLessonTest;
use App\Repositories\Interfaces\QuestionLessonTestRepositoryInterface;
use Illuminate\Support\Facades\DB;

class QuestionLessonTestRepository extends BaseRepository implements QuestionLessonTestRepositoryInterface
{
    protected $table = 'question_lesson_tests';
    protected $model;
    protected $answerLessonTestRepository;

    public function __construct(AnswerLessonTestRepository $answerLessonTestRepository)
    {
        $this->model = new QuestionLessonTest();
        $this->answerLessonTestRepository = $answerLessonTestRepository;
        parent::__construct($this->model);
    }

    public function getQuery()
    {
        return $this->model
            ->with('lessonTest')
            ->whereNull('deleted_at')
            ->latest('id');
    }

    public function create(array $data)
    {
        try {
            DB::beginTransaction();

            // Xử lý media nếu có
            $questionData = collect($data)->except(['answers', 'answers_correct', 'answerType'])->toArray();

            // Tạo câu hỏi
            $question = parent::create($questionData);
            if (!$question) {
                throw new \Exception('Không thể tạo câu hỏi');
            }

            // Lưu thông tin loại câu trả lời
            $answerType = $data['answerType'] ?? 'single_choice';

            // Xử lý câu trả lời
            if (isset($data['answers']) && is_array($data['answers'])) {
                foreach ($data['answers'] as $index => $answerData) {
                    $processedAnswerData = [
                        'questionLessonTestId' => $question->id,
                        'answer' => $answerData['answer'],
                        'orderNumber' => $answerData['orderNumber'],
                        'isCorrect' => isset($answerData['isCorrect']) ? (bool)$answerData['isCorrect'] : false,
                        'answerType' => $answerType,
                        'caseSensitive' => isset($answerData['caseSensitive']) ? (bool)$answerData['caseSensitive'] : false,
                        'alternativeAnswers' => $answerData['alternativeAnswers'] ?? null
                    ];

                    $this->answerLessonTestRepository->create($processedAnswerData);
                }
            }

            DB::commit();
            return $question->load('answers');
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($id, array $data)
    {
        $question = $this->findById($id);
        if (!$question) {
            throw new \Exception('Question not found');
        }

        try {
            DB::beginTransaction();

            // Xử lý media mới nếu có
            $questionData = collect($data)->except(['answers', 'answers_correct', 'answerType', 'mediaUrl'])->toArray();
            if (isset($data['mediaUrl']) && $data['mediaUrl']->isValid()) {
                $file = $data['mediaUrl'];
                $fileExtension = strtolower($file->getClientOriginalExtension());
                $videoExtensions = ['mp4', 'mov', 'avi', 'wmv'];
                $audioExtensions = ['mp3', 'wav', 'ogg'];

                if (in_array($fileExtension, $videoExtensions)) {
                    $mediaPath = $this->updateVideo(
                        $file,
                        'question-tests/videos',
                        $question->mediaUrl
                    );
                } elseif (in_array($fileExtension, $audioExtensions)) {
                    $mediaPath = $this->updateAudio(
                        $file,
                        'question-tests/audios',
                        $question->mediaUrl
                    );
                } else {
                    $mediaPath = $this->updateImage(
                        $file,
                        'question-tests/images',
                        $question->mediaUrl
                    );
                }

                if (!$mediaPath) {
                    throw new \Exception('Không thể upload file media');
                }
                $questionData['mediaUrl'] = $mediaPath;
            }

            // Cập nhật câu hỏi
            $question = parent::update($id, $questionData);

            // Lưu thông tin loại câu trả lời
            $answerType = $data['answerType'] ?? 'single_choice';

            // Xóa câu trả lời cũ và tạo mới nếu có
            if (isset($data['answers']) && is_array($data['answers'])) {
                // Xóa câu trả lời cũ
                $this->answerLessonTestRepository->deleteWhere(['questionLessonTestId' => $id]);

                // Tạo câu trả lời mới
                foreach ($data['answers'] as $index => $answerData) {
                    $processedAnswerData = [
                        'questionLessonTestId' => $question->id,
                        'answer' => $answerData['answer'],
                        'orderNumber' => $answerData['orderNumber'],
                        'isCorrect' => isset($answerData['isCorrect']) ? (bool)$answerData['isCorrect'] : false,
                        'answerType' => $answerType,
                        'caseSensitive' => isset($answerData['caseSensitive']) ? (bool)$answerData['caseSensitive'] : false,
                        'alternativeAnswers' => $answerData['alternativeAnswers'] ?? null
                    ];

                    $this->answerLessonTestRepository->create($processedAnswerData);
                }
            }

            DB::commit();
            return $question->load('answers');

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function searchByName($search)
    {
        return $this->getQuery()
            ->where('question', 'like', "%{$search}%")
            ->paginate(config('crud.pagination.per_page'));
    }
}
