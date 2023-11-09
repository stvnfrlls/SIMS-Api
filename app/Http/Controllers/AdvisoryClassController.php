<?php

namespace App\Http\Controllers;

use App\Models\AdvisoryClass;
use Illuminate\Http\Request;

class AdvisoryClassController extends Controller
{
    public function index()
    {
        $advisoryClass = AdvisoryClass::select('academicYear', 'gradeId', 'facultyId')->get();
        $advisoryClass->load('facultyRecord');
        $advisoryClass->load('gradeLevel');

        $transformedAdvisoryClass = $advisoryClass->map(function ($advisoryData) {
            return $this->transforAdvisoryClass($advisoryData);
        });

        return response()->json($transformedAdvisoryClass);
    }
    public function store(Request $request)
    {
        $advisoryClass = AdvisoryClass::create($request->all());
        return response()->json($advisoryClass);
    }

    public function show($advisoryClass)
    {
        $advisoryData = AdvisoryClass::select('academicYear', 'gradeId', 'facultyId')
            ->where('gradeId', $advisoryClass)
            ->get();

        $advisoryData->load('facultyRecord');
        $advisoryData->load('gradeLevel');

        $transformedAdvisoryClass = $advisoryData->map(function ($advisoryData) {
            return $this->transforAdvisoryClass($advisoryData);
        });

        return response()->json($transformedAdvisoryClass);
    }

    public function update(Request $request, AdvisoryClass $advisoryClass)
    {
        $advisoryClass->update($request->all());
        return response()->json($advisoryClass);
    }

    public function destroy(AdvisoryClass $advisoryClass)
    {
        $advisoryClass->delete();
    }

    public function transforAdvisoryClass($advisoryClass)
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
