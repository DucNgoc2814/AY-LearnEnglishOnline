<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        $message = implode('<br>', $errors);

        // Log thông tin để debug
        Log::info('BaseRequest validation failed', [
            'is_ajax' => $this->ajax(),
            'expects_json' => $this->expectsJson(),
            'errors' => $errors,
            'message' => $message,
            'content_type' => $this->header('Content-Type'),
            'accept' => $this->header('Accept'),
            'x_requested_with' => $this->header('X-Requested-With')
        ]);

        if ($this->expectsJson() || $this->ajax()) {
            Log::info('Returning JSON response for validation error');
            throw new HttpResponseException(
                response()->json([
                    'status' => 'error',
                    'success' => false,
                    'message' => $message,
                    'errors' => $errors
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
            );
        }

        // Nếu là request thông thường (non-AJAX), sử dụng flash session
        Log::info('Redirecting back with validation error');
        throw new HttpResponseException(
            redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', $message)
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [];
    }
}
