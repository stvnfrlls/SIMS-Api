<?php

namespace App\Http\Requests\FacultySchedule;

use Illuminate\Foundation\Http\FormRequest;

class FacultyScheduleRequest extends FormRequest
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
            "facultyId" => "required|exists:faculty_records,id",
            "subjectId" => "required|exists:curricula,id",
            "gradeId" => "required|exists:grade_levels,id",
            "startTime" => "required",
            "endTime" => "required",
        ];
    }
}
