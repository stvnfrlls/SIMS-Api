<?php

namespace App\Http\Requests\AdvisoryClass;

use Illuminate\Foundation\Http\FormRequest;

class AdvisoryClassRequest extends FormRequest
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
            "academicYear" => "required|string|max:10",
            "gradeId" => "required|exists:grade_levels,id",
            "facultyId" => "required|exists:faculty_records,id|unique:advisory_classes,facultyId",
        ];
    }
}
