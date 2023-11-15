<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "userId" => "required|exists:users,id",
            "firstName" => "required|string",
            "middleName" => "string",
            "lastName" => "required|string",
            "suffix" => "string",
            "gender" => "required|string",
            "age" => "required|numeric",
            "birthday" => "required",
            "gradeId" => "required|exists:grade_levels,id",
        ];
    }
}
