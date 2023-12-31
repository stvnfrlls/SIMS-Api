<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcademicRecordRequest;
use App\Models\AcademicRecord;

class AcademicRecordController extends Controller
{
    public function getAll()
    {
        $academicRecords = AcademicRecord::with("studentRecord", "curricula")
            ->orderBy("gradeQuarter")
            ->orderBy("studentId")
            ->orderBy("gradeQuarter")
            ->get();

        $academicRecords = $academicRecords->map(function ($academicRecord) {
            return $this->transformRecord($academicRecord);
        });

        $groupedRecords = $academicRecords->groupBy('gradeQuarter');

        return response()->json($groupedRecords);
    }

    public function storeRecord(AcademicRecordRequest $request)
    {
        $academicRecord = AcademicRecord::create($request->all());
        return response()->json($academicRecord);
    }

    public function getRecord($academicRecord)
    {
        $academicRecords = AcademicRecord::with('curricula')
            ->where("studentId", $academicRecord)
            ->orderBy("gradeQuarter")
            ->get();

        // Group academic records by gradeQuarter
        $groupedRecords = $academicRecords->groupBy('gradeQuarter');

        $groupedRecordsArray = [];

        foreach ($groupedRecords as $quarter => $records) {
            $groupedRecordsArray[] = [
                'quarter' => $quarter,
                'records' => $records->map(function ($record) {
                    return [
                        'subject' => $record->curricula->subjectName,
                        'grade' => $record->gradeValue,
                    ];
                })->all(),
            ];
        }

        return response()->json([
            'studentId' => $academicRecord->studentId,
            'academicRecords' => $groupedRecordsArray,
        ]);
    }

    public function updateRecord(AcademicRecordRequest $request, AcademicRecord $academicRecord)
    {
        $academicRecord = AcademicRecord::findOrFail($academicRecord->id);
        $academicRecord->update($request->all());
        return response()->json($academicRecord);
    }

    public function destroyRecord(AcademicRecord $academicRecord)
    {
        $academicRecord = AcademicRecord::findOrFail($academicRecord->id);
        $academicRecord->delete();
        return response()->json(null, 200);
    }

    public function transformRecord($data)
    {
        $data = $data->toArray();

        // Define keys to remove
        $academicRecordKeys = [
            'id',
            'academicYear',
            'subjectId',
            'deleted_at',
            'created_at',
            'updated_at'
        ];

        $modifiedData = array_diff_key($data, array_flip($academicRecordKeys));

        $studentRecordKeys = [
            'id',
            'userId',
            'gradeId',
            'gender',
            'age',
            'birthday',
            'deleted_at',
            'created_at',
            'updated_at'
        ];

        $modifiedData['student_record'] = array_diff_key($data['student_record'], array_flip($studentRecordKeys));

        $curriculaRecordKeys = [
            'id',
            'subjectCode',
            'minYearLevel',
            'maxYearLevel',
            'deleted_at',
        ];

        $modifiedData['curricula'] = array_diff_key($data['curricula'], array_flip($curriculaRecordKeys));

        $modifiedData['studentName'] = $modifiedData['student_record']['lastName'] . ', ' . $modifiedData['student_record']['firstName'] . ' ' . strtoupper(substr($modifiedData['student_record']['middleName'], 0, 1)) . '. ' . $modifiedData['student_record']['suffix'];
        unset($modifiedData['student_record']);

        $modifiedData['subjectName'] = $modifiedData['curricula']['subjectName'];
        unset($modifiedData['curricula']);

        return $modifiedData;
    }
}
