<?php

namespace App\Http\Requests\Admin\Class;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Enums\EmployeeRole;

/**
 * @package App\Http\Requests\Admin\Class
 * @author Your Name
 * @description Request validation cho cập nhật lớp học
 */
class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        // Chuyển đổi schedule từ string sang json nếu là string
        if ($this->has('schedule') && is_string($this->schedule)) {
            try {
                $schedule = json_decode($this->schedule, true);
                $this->merge(['schedule' => $schedule]);
            } catch (\Exception $e) {
                // Nếu không phải JSON hợp lệ, để nguyên giá trị để validation xử lý
            }
        }
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('classes')->ignore($this->route('id')),
            ],
            'teacher_id' => [
                'required',
                'exists:employees,id',
                function ($attribute, $value, $fail) {
                    $employee = \App\Models\Employee::find($value);
                    if (!$employee || $employee->employee_role !== EmployeeRole::TEACHER || !$employee->is_active) {
                        $fail('Giáo viên không tồn tại hoặc không hoạt động');
                    }
                }
            ],
            'start_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $startDate = Carbon::parse($value);
                    if ($startDate->isPast() && $startDate->diffInHours(now()) > 24) {
                        $fail('Không thể thay đổi ngày bắt đầu của lớp học đã diễn ra quá 24 giờ.');
                    }
                },
            ],
            'end_date' => [
                'required',
                'date',
                'after:start_date',
            ],
            'enrollment_deadline' => [
                'required',
                'date',
                'before_or_equal:start_date',
            ],
            'max_students' => [
                'required',
                'integer',
                'min:1',
                'gte:min_students',
                function ($attribute, $value, $fail) {
                    $class = $this->route('class');
                    if ($class && $value < $class->current_students) {
                        $fail('Số học viên tối đa không thể nhỏ hơn số học viên hiện tại.');
                    }
                },
            ],
            'min_students' => [
                'required',
                'integer',
                'min:1',
            ],
            'status' => [
                'required',
                'string',
                'in:pending,active,completed,cancelled',
            ],
            'description' => ['nullable', 'string'],
            'schedule' => ['required', 'json'],
            'is_active' => ['boolean'],
        ];
    }

    /**
     * Get custom messages for validator errors
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên lớp học',
            'code.required' => 'Vui lòng nhập mã lớp',
            'code.unique' => 'Mã lớp đã tồn tại',
            'teacher_id.required' => 'Vui lòng chọn giáo viên',
            'teacher_id.exists' => 'Giáo viên không tồn tại hoặc không hoạt động',
            'start_date.required' => 'Vui lòng chọn ngày bắt đầu',
            'end_date.required' => 'Vui lòng chọn ngày kết thúc',
            'end_date.after' => 'Ngày kết thúc phải sau ngày bắt đầu',
            'enrollment_deadline.required' => 'Vui lòng chọn hạn đăng ký',
            'enrollment_deadline.before_or_equal' => 'Hạn đăng ký phải trước hoặc bằng ngày bắt đầu',
            'max_students.required' => 'Vui lòng nhập số học viên tối đa',
            'max_students.min' => 'Số học viên tối đa phải lớn hơn 0',
            'max_students.gte' => 'Số học viên tối đa phải lớn hơn hoặc bằng số học viên tối thiểu',
            'min_students.required' => 'Vui lòng nhập số học viên tối thiểu',
            'min_students.min' => 'Số học viên tối thiểu phải lớn hơn 0',
            'status.required' => 'Vui lòng chọn trạng thái',
            'status.in' => 'Trạng thái không hợp lệ',
            'schedule.required' => 'Vui lòng nhập lịch học',
            'schedule.json' => 'Lịch học phải là định dạng JSON hợp lệ',
        ];
    }

    /**
     * Get custom attributes for validator errors
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'Tên lớp học',
            'code' => 'Mã lớp',
            'teacher_id' => 'Giáo viên',
            'start_date' => 'Ngày bắt đầu',
            'end_date' => 'Ngày kết thúc',
            'enrollment_deadline' => 'Hạn đăng ký',
            'max_students' => 'Số học viên tối đa',
            'min_students' => 'Số học viên tối thiểu',
            'status' => 'Trạng thái',
            'description' => 'Mô tả',
            'schedule' => 'Lịch học',
            'is_active' => 'Kích hoạt',
        ];
    }
}
