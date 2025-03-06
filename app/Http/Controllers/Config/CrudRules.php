<?php

namespace App\Http\Controllers\Config;

class CrudRules
{
    /**
     * Rules cơ bản cho các trường thông dụng
     */
    const BASIC_RULES = [
        'required' => 'required',
        'string' => 'string',
        'numeric' => 'numeric',
        'date' => 'date',
        'email' => 'email',
        'boolean' => 'boolean',
        'array' => 'array',
        'file' => 'file',
        'image' => 'image',
        'exists' => 'exists',
        'unique' => 'unique'
    ];

    /**
     * Rules cho text
     */
    const TEXT_RULES = [
        'name' => ['required', 'string', 'max:255'],
        'title' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string', 'max:1000'],
        'content' => ['nullable', 'string'],
        'slug' => ['nullable', 'string', 'max:255'],
        'sortDescription' => ['nullable', 'string', 'max:255'],
        'type' => ['nullable', 'string', 'max:255'],
        'url' => ['nullable', 'string', 'max:255'],
        'notes' => ['nullable', 'string', 'max:1000'],
    ];

    /**
     * Rules cho số
     */
    const NUMBER_RULES = [
        'price' => ['required', 'numeric', 'min:0'],
        'quantity' => ['required', 'integer', 'min:0'],
        'order' => ['nullable', 'integer', 'min:0'],
        'status' => ['required', 'boolean'],
        'duration' => ['nullable', 'integer', 'min:0'],
    ];

    /**
     * Rules cho ngày tháng
     */
    const DATE_RULES = [
        'date' => ['required', 'date'],
        'start_date' => ['required', 'date'],
        'end_date' => ['required', 'date', 'after:start_date'],
        'published_at' => ['nullable', 'date'],
        'start_time' => ['required', 'date'],
        'end_time' => ['required', 'date', 'after:start_time'],
    ];

    /**
     * Rules cho file và hình ảnh
     */
    const FILE_RULES = [
        'image' => [
            'nullable',
            'image',
            'mimes:jpeg,png,jpg,gif',
            'max:' . (CrudConfig::MAX_FILE_SIZE['images'] / 1024) // Convert to KB
        ],
        'document' => [
            'nullable',
            'file',
            'mimes:pdf,doc,docx,xls,xlsx',
            'max:' . (CrudConfig::MAX_FILE_SIZE['documents'] / 1024)
        ],
    ];

    /**
     * Rules cho mối quan hệ
     */
    const RELATION_RULES = [
        'questionFinalExamId' => ['required', 'exists:question_final_exams,id'],
        'answerFinalExamId' => ['required', 'exists:answer_final_exams,id'],
        'lessonId' => ['required', 'exists:lessons,id'],
        'courseId' => ['required', 'exists:courses,id'],
        'lessonTestId' => ['required', 'exists:lesson_tests,id'],
        'answerLessonTestId' => ['required', 'exists:answer_lesson_tests,id'],
        'questionLessonTestId' => ['required', 'exists:question_lesson_tests,id'],
        'category_id' => ['required', 'exists:categories,id'],
        'user_id' => ['required', 'exists:users,id'],
    ];

    /**
     * Messages lỗi tùy chỉnh
     */
    const MESSAGES = [
        'required' => ':attribute không được để trống',
        'string' => ':attribute phải là chuỗi ký tự',
        'numeric' => ':attribute phải là số',
        'date' => ':attribute không đúng định dạng ngày tháng',
        'email' => ':attribute không đúng định dạng email',
        'max' => [
            'string' => ':attribute không được vượt quá :max ký tự',
            'file' => ':attribute không được vượt quá :max KB',
        ],
        'min' => [
            'numeric' => ':attribute không được nhỏ hơn :min',
        ],
        'exists' => ':attribute không tồn tại trong hệ thống',
        'unique' => ':attribute đã tồn tại trong hệ thống',
        'image' => ':attribute phải là hình ảnh',
        'mimes' => ':attribute phải có định dạng: :values',
        'after' => ':attribute phải sau ngày :date',
    ];

    /**
     * Attributes tùy chỉnh
     */
    const ATTRIBUTES = [
        'name' => 'Tên',
        'title' => 'Tiêu đề',
        'description' => 'Mô tả',
        'content' => 'Nội dung',
        'price' => 'Giá',
        'quantity' => 'Số lượng',
        'status' => 'Trạng thái',
        'image' => 'Hình ảnh',
        'document' => 'Tài liệu',
        'parent_id' => 'Danh mục cha',
        'category_id' => 'Danh mục',
        'user_id' => 'Người dùng',
        'start_date' => 'Ngày bắt đầu',
        'end_date' => 'Ngày kết thúc',
        'published_at' => 'Ngày xuất bản',
    ];
} 