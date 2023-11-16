<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacultyScheduleRequest;
use App\Models\FacultySchedule;

class FacultyScheduleController extends Controller
{
    public function getall()
    {
        $schedules = FacultySchedule::with(['facultyRecord', 'curriculum', 'gradeLevel'])
            ->select('facultyId', 'subjectId', 'gradeId', 'startTime', 'endTime')
            ->orderBy('startTime')
            ->get();

        $transformedSchedules = $schedules->map(function ($schedule) {
            return $this->transformSchedule($schedule);
        });

        return response()->json($transformedSchedules);
    }

    public function storeSchedule(FacultyScheduleRequest $request)
    {
        $faculty = FacultySchedule::create($request->all());
        return response()->json($faculty);
    }

    public function getSchedule($facultySchedule)
    {
        $schedule = FacultySchedule::select('facultyId', 'subjectId', 'gradeId', 'startTime', 'endTime')
            ->with('facultyRecord', 'curriculum', 'gradeLevel')
            ->where('facultyId', $facultySchedule)
            ->orderBy('startTime')
            ->get();

        $transformedSchedules = $schedule->map(function ($schedule) {
            return $this->transformSchedule($schedule);
        });

        return response()->json($transformedSchedules);
    }

    public function updateSchedule(FacultyScheduleRequest $request, FacultySchedule $facultySchedule)
    {
        $schedule = FacultySchedule::findOrFail($request->id);
        $schedule->update($request->all());
        return response()->json($schedule);
    }

    public function destroySchedule(FacultySchedule $facultySchedule)
    {
        $faculty = FacultySchedule::findOrFail($facultySchedule->id);
        $faculty->delete();
        return response()->json(null, 200);
    }

    public function transformSchedule($schedule)
    {
        $scheduleArray = $schedule->toArray();

        $keysToUnset = [
            'faculty_record' => ['id', 'userId', 'gender', 'age', 'birthday', 'deleted_at', 'created_at', 'updated_at'],
            'curriculum' => ['id', 'subjectCode', 'minYearLevel', 'maxYearLevel', 'deleted_at'],
            'grade_level' => ['id', 'gradeLevel', 'deleted_at'],
        ];

        foreach ($keysToUnset as $relation => $keys) {
            if (isset($scheduleArray[$relation])) {
                foreach ($keys as $key) {
                    unset($scheduleArray[$relation][$key]);
                }
            }
        }

        $faculty_record = $scheduleArray['faculty_record'];
        unset($scheduleArray['faculty_record']);
        unset($scheduleArray['facultyId']);

        $facultyName = $faculty_record['suffix']
            ? $faculty_record['lastName'] . ', ' . $faculty_record['firstName'] . ' ' . $faculty_record['middleName']
            : $faculty_record['lastName'] . ' ' . $faculty_record['suffix'] . '. ' . $faculty_record['firstName'] . ' ' . $faculty_record['middleName'];

        $scheduleArray['facultyName'] = $facultyName;

        $curriculum = $scheduleArray['curriculum'];
        unset($scheduleArray['curriculum']);
        unset($scheduleArray['subjectId']);
        $scheduleArray['subjectName'] = $curriculum['subjectName'];

        $grade_level = $scheduleArray['grade_level'];
        unset($scheduleArray['grade_level']);
        unset($scheduleArray['gradeId']);
        $scheduleArray['grade_level'] = $grade_level['gradeLabel'] . ' - ' . $grade_level['sectionName'];

        return $scheduleArray;
    }
}
