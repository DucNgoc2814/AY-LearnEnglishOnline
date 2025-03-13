<?php

namespace App\Services;

use App\Models\VideoLesson;
use App\Services\Interfaces\QuestionLessonTestServiceInterface;
use App\Services\Interfaces\AnswerLessonTestServiceInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\QuestionLessonTestRepositoryInterface;

class QuestionLessonTestService extends BaseService implements QuestionLessonTestServiceInterface
{
    protected $repository;
    protected $answerLessonTestService;

    public function __construct(
        QuestionLessonTestRepositoryInterface $repository,
        AnswerLessonTestServiceInterface $answerLessonTestService
    ) {
        $this->repository = $repository;
        $this->answerLessonTestService = $answerLessonTestService;
        parent::__construct($repository);
    }

    public function create(array $data)
    {
        try {
            DB::beginTransaction();

            // Xử lý file upload
            if (isset($data['mediaUrl'])) {
                $file = $data['mediaUrl'];

                // Kiểm tra nếu là instance của UploadedFile
                if ($file instanceof \Illuminate\Http\UploadedFile) {
                    $fileExtension = strtolower($file->getClientOriginalExtension());
                    $videoExtensions = ['mp4', 'mov', 'avi', 'wmv'];
                    $audioExtensions = ['mp3', 'wav', 'ogg'];

                    if (in_array($fileExtension, $videoExtensions)) {
                        $mediaPath = $this->repository->handleVideo($file, 'question-tests/videos');
                    } elseif (in_array($fileExtension, $audioExtensions)) {
                        $mediaPath = $this->repository->handleAudio($file, 'question-tests/audios');
                    } else {
                        $mediaPath = $this->repository->handleImage($file, 'question-tests/images');
                    }

                    if (!$mediaPath) {
                        throw new \Exception('Không thể upload file media');
                    }
                    $data['mediaUrl'] = $mediaPath;
                }
            }

            // Tạo câu hỏi
            $questionData = collect($data)->except('answers')->toArray();
            $question = $this->repository->create($questionData);

            // Xử lý và tạo câu trả lời
            if (isset($data['answers']) && is_array($data['answers'])) {
                foreach ($data['answers'] as $answerData) {
                    $processedAnswerData = [
                        'questionLessonTestId' => $question->id,
                        'answer' => $answerData['answer'],
                        'orderNumber' => $answerData['orderNumber'],
                        'isCorrect' => isset($answerData['isCorrect']) ? (bool)$answerData['isCorrect'] : false,
                        'caseSensitive' => isset($answerData['caseSensitive']) ? (bool)$answerData['caseSensitive'] : false,
                        'alternativeAnswers' => $answerData['alternativeAnswers'] ?? null,
                        'answerType' => $data['answerType']
                    ];

                    $result = $this->answerLessonTestService->create($processedAnswerData);
                    if (!$result['status']) {
                        throw new \Exception('Không thể tạo câu trả lời: ' . $result['message']);
                    }
                }
            }

            DB::commit();
            return $this->successResponse(
                $question->load('answers'),
                'Thêm mới câu hỏi và câu trả lời thành công'
            );

        } catch (\Exception $e) {
            DB::rollBack();

            // Xóa file media nếu có lỗi
            if (isset($mediaPath)) {
                $fileExtension = pathinfo($mediaPath, PATHINFO_EXTENSION);
                $videoExtensions = ['mp4', 'mov', 'avi', 'wmv'];

                if (in_array($fileExtension, $videoExtensions)) {
                    $this->repository->deleteVideo($mediaPath);
                } else {
                    $this->repository->deleteImage($mediaPath);
                }
            }

            return $this->errorResponse('Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function searchByName($keyword)
    {
        try {
            $questionLessonTests = $this->repository->searchByName($keyword);
            return $this->successResponse($questionLessonTests, 'Tìm kiếm thành công');
        } catch (\Exception $e) {
            return $this->errorResponse('Có lỗi xảy ra khi tìm kiếm');
        }
    }
}
