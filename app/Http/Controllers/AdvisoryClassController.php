<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvisoryClassRequest;
use App\Models\AdvisoryClass;

class AdvisoryClassController extends Controller
{
    public function getAllAdvisoryClass()
    {
        $advisoryClass = AdvisoryClass::select('academicYear', 'gradeId', 'facultyId')
            ->with("facultyRecord", "gradeLevel")
            ->get();

        $transformedAdvisoryClass = $advisoryClass->map(function ($advisoryData) {
            return $this->transformAdvisoryClass($advisoryData);
        });

        $groupedRecords = $transformedAdvisoryClass->groupBy('academicYear');

        return response()->json($groupedRecords);
    }

    public function storeAdvisoryClass(AdvisoryClassRequest $request)
    {
        $advisoryClass = AdvisoryClass::create($request->all());
        return response()->json($advisoryClass);
    }

    public function getAdvisoryClass($advisoryClass)
    {
        $advisoryData = AdvisoryClass::select('academicYear', 'gradeId', 'facultyId')
            ->with("facultyRecord", "gradeLevel")
            ->where('gradeId', $advisoryClass)
            ->get();

        $transformedAdvisoryClass = $advisoryData->map(function ($advisoryData) {
            return $this->transformAdvisoryClass($advisoryData);
        });

        return response()->json($transformedAdvisoryClass);
    }

    public function updateAdvisoryClass(AdvisoryClassRequest $request, AdvisoryClass $advisoryClass)
    {
        $advisoryClass->update($request->all());
        return response()->json($advisoryClass);
    }

    public function destroyAdvisoryClass(AdvisoryClass $advisoryClass)
    {
        $advisoryClass->delete();
    }

    public function transformAdvisoryClass($advisoryClass)
    {
        $advisoryArray = $advisoryClass->toArray();

        $keysToUnset = [
            'faculty_record' => ['id', 'userId', 'gender', 'age', 'birthday', 'deleted_at', 'created_at', 'updated_at'],
            'grade_level' => ['id', 'gradeLevel', 'deleted_at'],
        ];

        foreach ($keysToUnset as $relation => $keys) {
            if (isset($advisoryArray[$relation])) {
                foreach ($keys as $key) {
                    unset($advisoryArray[$relation][$key]);
                }
            }
        }

        $faculty_record = $advisoryArray['faculty_record'];
        unset($advisoryArray['faculty_record']);
        unset($advisoryArray['facultyId']);

        $facultyName = $faculty_record['suffix']
            ? $faculty_record['lastName'] . ', ' . $faculty_record['firstName'] . ' ' . $faculty_record['middleName']
            : $faculty_record['lastName'] . ' ' . $faculty_record['suffix'] . '. ' . $faculty_record['firstName'] . ' ' . $faculty_record['middleName'];

        $advisoryArray['facultyName'] = $facultyName;

        $grade_level = $advisoryArray['grade_level'];
        unset($advisoryArray['grade_level']);
        unset($advisoryArray['gradeId']);
        $advisoryArray['grade_level'] = $grade_level['gradeLabel'] . ' - ' . $grade_level['sectionName'];

        return $advisoryArray;
    }
}
