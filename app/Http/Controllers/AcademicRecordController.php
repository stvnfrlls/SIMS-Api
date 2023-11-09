<?php

namespace App\Http\Controllers;

use App\Models\AcademicRecord;
use Illuminate\Http\Request;

class AcademicRecordController extends Controller
{
    public function getAll()
    {
        $academicRecords = AcademicRecord::orderBy("gradeQuarter")->get();

        foreach ($academicRecords as $academicRecord) {
            $academicRecord->load('studentRecord');
            $academicRecord->load('curricula');
        }

        $academicRecords = $academicRecords->map(function ($academicRecord) {
            return $this->transfromRecord($academicRecord);
        });

        return response()->json($academicRecords);
    }
    public function storeRecord(Request $request)
    {
        $academicRecord = AcademicRecord::create($request->all());
        return response()->json($academicRecord);
    }

    public function getRecord($academicRecord)
    {
        $academicRecords = AcademicRecord::where("studentId", $academicRecord)
            ->orderBy("gradeQuarter")
            ->get();

        foreach ($academicRecords as $academicRecord) {
            $academicRecord->load('curricula');
        }

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

    public function updateRecord(Request $request, AcademicRecord $academicRecord)
    {
        $academicRecord->update($request->all());
        return response()->json($academicRecord);
    }

    public function destroyRecord(AcademicRecord $academicRecord)
    {
        $academicRecord->delete();
    }

    public function transfromRecord($records)
    {
        $gradesArray = $records->toArray();

        $gradesArray = array_diff_key($gradesArray, array_flip(['id', 'academicYear', 'subjectId', 'deleted_at', 'created_at', 'updated_at']));

        $curriculaData = $gradesArray['curricula'];
        unset($gradesArray['curricula']);

        $gradesArray['subjectName'] = $curriculaData['subjectName'];

        return $gradesArray;
    }
}
