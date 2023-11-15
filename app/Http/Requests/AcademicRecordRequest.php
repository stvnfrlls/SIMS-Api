<?php

namespace App\Http\Requests\AcademicRecord;

use Illuminate\Foundation\Http\FormRequest;

class AcademicRecordRequest extends FormRequest
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
            "studentId" => "required|exists:student_records,id",
            "gradeQuarter" => "required|integer",
            "subjectId" => "required|exists:curricula,id",
            "gradeValue" => "required|string",
        ];
    }
}
