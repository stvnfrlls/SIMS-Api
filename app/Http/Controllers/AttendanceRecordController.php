<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendanceRecordRequest;
use App\Models\AttendanceRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AttendanceRecordController extends Controller
{
    public function index()
    {
        $presentList = AttendanceRecord::select('studentId', 'timeIn', 'timeOut', 'status')
            ->with('studentRecord')
            ->get();

        foreach ($presentList as $present) {
            $data = $present->studentRecord;
            $data->load('user');
            $data->load('gradeLevel');
        }

        $transformedRecords = $presentList->map(function ($record) {
            return $this->transformAttendanceList($record);
        });

        return response()->json($transformedRecords);
    }

    public function store(AttendanceRecordRequest $request)
    {
        $currentTime = now()->format('h:i');
        $comparisonTime = Carbon::parse('08:00:00');

        $status = ($currentTime < $comparisonTime) ? 'LATE' : 'PRESENT';

        // Find the existing record for the same day and student
        $attendanceRecord = AttendanceRecord::where([
            'academicYear' => '2023-2024',
            'studentId' => $request->student_id,
        ])
            ->where('timeIn', '!=', null)
            ->whereDate('created_at', '=', now()->toDateString())
            ->first();

        if ($attendanceRecord) {
            // Check if timeOut is not already set
            if (!$attendanceRecord->timeOut) {
                $attendanceRecord->update(['timeOut' => $currentTime]);
            }

            return response()->json($attendanceRecord);
        } else {
            $setAttendance = new AttendanceRecord([
                'academicYear' => '2023-2024',
                'studentId' => $request->student_id,
                'status' => $status,
                'timeIn' => $currentTime,
                'timeOut' => '', // You can set a default value here if needed
            ]);

            $setAttendance->save();

            return response()->json($setAttendance);
        }
    }

    public function getPresent()
    {
        // Call index internally to reuse its response
        $transformedRecords = $this->index()->getOriginalContent();

        // Filter the records to get only those with status 'PRESENT'
        $presentList = $transformedRecords->filter(function ($record) {
            return $record['status'] === 'PRESENT';
        })->values();

        return response()->json($presentList);
    }

    public function getLate()
    {
        // Call index internally to reuse its response
        $transformedRecords = $this->index()->getOriginalContent();

        // Filter the records to get only those with status 'LATE'
        $lateList = $transformedRecords->filter(function ($record) {
            return $record['status'] === 'LATE';
        })->values();

        return response()->json($lateList);
    }

    public function getAttendanceByGradeId($gradeId)
    {
        // Call index internally to reuse its response
        $transformedRecords = $this->index()->getOriginalContent();
        $filteredRecords = $transformedRecords->groupBy('gradeId');

        // Check if the array key exists before accessing it
        if (isset($filteredRecords[$gradeId])) {
            return response()->json($filteredRecords[$gradeId]);
        } else {
            // Handle the case when $gradeId is not found
            return response()->json([]);
        }
    }

    public function timeIn()
    {

    }

    public function update(Request $request, AttendanceRecord $attendanceRecord)
    {
        $record = AttendanceRecord::find($attendanceRecord->id);
        $record->update($request->all());
        return response()->json($record);
    }

    public function destroy(AttendanceRecord $attendanceRecord)
    {
        $record = AttendanceRecord::find($attendanceRecord->id);
        $record->delete();
    }

    public function transformAttendanceList($data)
    {
        $data = $data->toArray();

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
        $modifiedData = $data;
        $modifiedData['student_record'] = array_diff_key($data['student_record'], array_flip($studentRecordKeys));
        $modifiedData['studentName'] = $modifiedData['student_record']['lastName'] . ', ' . $modifiedData['student_record']['firstName'] . ' ' . strtoupper(substr($modifiedData['student_record']['middleName'], 0, 1)) . '. ' . $modifiedData['student_record']['suffix'];

        $grade_level = $modifiedData['student_record']['grade_level'];
        $modifiedData['gradeId'] = $grade_level['id'];
        $modifiedData['grade_level'] = $grade_level['gradeLabel'] . ' - ' . $grade_level['sectionName'];

        unset($modifiedData['student_record']);

        return $modifiedData;
    }
}
