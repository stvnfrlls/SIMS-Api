<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRecordRequest;
use App\Models\StudentRecord;

class StudentRecordController extends Controller
{
    public function getAllStudent()
    {
        $studentRecord = StudentRecord::with("user", "gradeLevel", "academicRecord")
            ->all();

        // $studentRecord->load("attendanceRecord");

        $studentRecord->each(function ($studentData) {
            $studentData->academicRecord->each(function ($academicRecord) {
                $academicRecord->load("curricula");
            });
        });

        $modifiedData = $studentRecord->map(function ($studentRecord) {
            return $this->transformStudentRecord($studentRecord);
        });

        return response()->json($modifiedData);
    }

    public function storeStudent(StudentRecordRequest $request)
    {
        $studentRecord = StudentRecord::create($request->all());
        return response()->json($studentRecord);
    }

    public function getStudent($studentRecord)
    {
        $studentRecord = StudentRecord::with("user", "gradeLevel", "academicRecord")
            ->where('id', $studentRecord)
            ->get();

        $studentRecord->each(function ($studentData) {
            $studentData->academicRecord->each(function ($academicRecord) {
                $academicRecord->load("curricula");
            });
        });

        $modifiedData = $studentRecord->map(function ($studentRecord) {
            return $this->transformStudentRecord($studentRecord);
        });

        return response()->json($modifiedData);
    }

    public function updateStudent(StudentRecordRequest $request, StudentRecord $studentRecord)
    {
        $student = StudentRecord::findOrFail($studentRecord->id);
        $student->update($request->all());
        return response()->json($student);
    }

    public function destroyStudent(StudentRecord $studentRecord)
    {
        $student = StudentRecord::findOrFail($studentRecord->id);
        $student->delete();
        return response()->json(null, 200);
    }

    public function transformStudentRecord($data)
    {
        $data = $data->toArray();

        $studentRecordKeys = [
            'id',
            'userId',
            'gradeId',
            'deleted_at',
            'created_at',
            'updated_at',
        ];

        $modifiedData = array_diff_key($data, array_flip($studentRecordKeys));

        $userKeys = [
            'id',
            'email_verified_at',
            'deleted_at',
            'created_at',
            'updated_at',
        ];

        $modifiedData['user'] = array_diff_key($data['user'], array_flip($userKeys));

        $modifiedData['userId'] = $modifiedData['user']['user_id'];
        $modifiedData['emailAddress'] = $modifiedData['user']['email'];
        $modifiedData['fullName'] = $modifiedData['lastName'] . ', ' . $modifiedData['suffix'] . '' . $modifiedData['firstName'] . ' ' . $modifiedData['middleName'] . ' ' . $modifiedData['suffix'];

        unset(
            $modifiedData['lastName'],
            $modifiedData['firstName'],
            $modifiedData['middleName'],
            $modifiedData['suffix'],
            $modifiedData['user']
            );

        $gradeLevelsKeys = [
            'id',
            'deleted_at',
        ];

        $modifiedData['grade_levels'] = array_diff_key($data['grade_levels'], array_flip($gradeLevelsKeys));

        $modifiedData['gradeSection'] = $modifiedData['grade_levels']['gradeLabel'] . ' - ' . $modifiedData['grade_levels']['sectionName'];
        unset($modifiedData['grade_levels']);

        $academicRecordKeys = [
            'id',
            'studentId',
            'subjectId',
            'created_at',
            'updated_at',
            'deleted_at',
        ];

        $modifiedData['academic_record'] = array_map(function ($record) use ($academicRecordKeys) {
            // Unset the desired keys for each record
            foreach ($academicRecordKeys as $key) {
                unset($record[$key]);
            }

            // Unset the desired key in the 'curricula' sub-array
            $record['subjectName'] = $record['curricula']['subjectName'];
            unset($record['curricula']);

            return $record;
        }, $data['academic_record']);

        $modifiedData['grades'] = $modifiedData['academic_record'];
        unset($modifiedData['academic_record']);

        return $modifiedData;
    }
}
