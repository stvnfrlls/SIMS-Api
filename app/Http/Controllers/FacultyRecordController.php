<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacultyRecordRequest;
use App\Models\FacultyRecord;

class FacultyRecordController extends Controller
{
    public function getAllFaculty()
    {
        $faculties = FacultyRecord::with("user", "advisoryClasses", "facultySchedule")
            ->all();

        $faculties->each(function ($faculty) {
            $faculty->advisoryClasses->each(function ($advisoryClass) {
                $advisoryClass->load('gradeLevel');
            });
            $faculty->facultySchedule->each(function ($gradeLevel) {
                $gradeLevel->load('gradeLevel');
            });
            $faculty->facultySchedule->each(function ($subject) {
                $subject->load('curriculum');
            });
        });

        $modifiedData = $faculties->map(function ($facultyRecord) {
            return $this->transformFacultyRecord($facultyRecord);
        });

        return response()->json($modifiedData);
    }

    public function storeFaculty(FacultyRecordRequest $request)
    {
        $faculty = FacultyRecord::create($request->all());
        return response()->json($faculty);
    }

    public function getFaculty(FacultyRecord $facultyRecord)
    {
        $facultyRecord->load("user");
        $facultyRecord->load("advisoryClasses");
        $facultyRecord->load("facultySchedule");

        $facultyRecordCollection = collect([$facultyRecord]);

        $facultyRecordCollection->each(function ($faculty) {
            $faculty->advisoryClasses->each(function ($advisoryClass) {
                $advisoryClass->load('gradeLevel');
            });
            $faculty->facultySchedule->each(function ($gradeLevel) {
                $gradeLevel->load('gradeLevel');
            });
            $faculty->facultySchedule->each(function ($subject) {
                $subject->load('curriculum');
            });
        });

        $modifiedData = $facultyRecordCollection->map(function ($facultyRecordItem) {
            return $this->transformFacultyRecord($facultyRecordItem);
        });

        return response()->json($modifiedData);
    }

    public function updateFaculty(FacultyRecordRequest $request, FacultyRecord $facultyRecord)
    {
        $faculty = FacultyRecord::findOrFail($facultyRecord->id);
        $faculty->update($request->all());
        return response()->json($faculty);
    }

    public function destroyFaculty(FacultyRecord $facultyRecord)
    {
        $faculty = FacultyRecord::findOrFail($facultyRecord->id);
        $faculty->delete();
        return response()->json(null, 200);
    }

    public function transformFacultyRecord($data)
    {
        $data = $data->toArray();

        $facultyRecordKeys = ['id', 'userId', 'gender', 'age', 'birthday', 'deleted_at', 'created_at', 'updated_at'];
        $userKeys = ['id', 'userId', 'email_verified_at', 'deleted_at', 'created_at', 'updated_at'];

        $modifiedData = array_diff_key($data, array_flip([...$facultyRecordKeys, 'user', 'advisory_classes']));
        $modifiedData['user'] = array_diff_key($data['user'], array_flip($userKeys));

        $modifiedData += [
            'userId' => $modifiedData['user']['user_id'],
            'emailAddress' => $modifiedData['user']['email'],
            'fullName' => "{$modifiedData['lastName']} {$modifiedData['suffix']}. {$modifiedData['firstName']} {$modifiedData['middleName']}",
        ];
        unset(
            $modifiedData['lastName'],
            $modifiedData['firstName'],
            $modifiedData['middleName'],
            $modifiedData['suffix'],
            $modifiedData['user']['user_id'],
            $modifiedData['user']['email'],
            $modifiedData['user']
            );

        if (!empty($data['advisory_classes'][0]['grade_level'])) {
            $gradeLevelData = $data['advisory_classes'][0]['grade_level'];
            $modifiedData['advisoryClass'] = "{$gradeLevelData['gradeLabel']} - {$gradeLevelData['sectionName']}" ?? null;
        }

        $facultyScheduleKeys = ['id', 'academicYear', 'subjectId', 'gradeId', 'facultyId', 'deleted_at', 'created_at', 'updated_at'];

        $modifiedData['faculty_schedule'] = array_map(fn($schedule) => array_diff_key($schedule, array_flip($facultyScheduleKeys)), $data['faculty_schedule'] ?? []);

        foreach ($modifiedData['faculty_schedule'] as &$schedule) {
            if (isset($schedule['grade_level'])) {
                $gradeLevelData = $schedule['grade_level'];
                $schedule['gradeSection'] = "{$gradeLevelData['gradeLabel']} - {$gradeLevelData['sectionName']}" ?? null;
                unset($schedule['grade_level']);
            }
        }

        foreach ($modifiedData['faculty_schedule'] as &$subject) {
            if (isset($subject['curriculum'])) {
                $subjectNameData = $subject['curriculum'];
                $subject['subjectName'] = "{$subjectNameData['subjectName']}" ?? null;
                unset($subject['curriculum']);
            }
        }

        return $modifiedData;
    }
}
