<?php

namespace App\Http\Controllers;

use App\Models\AttendanceRecord;
use Illuminate\Http\Request;

class AttendanceRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $record = AttendanceRecord::latest()->paginate(10);
        return response()->json($record);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $record = AttendanceRecord::create($request->all());
        return response()->json($record);
    }

    /**
     * Display the specified resource.
     */
    public function show(AttendanceRecord $attendanceRecord)
    {
        return response()->json($attendanceRecord);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AttendanceRecord $attendanceRecord)
    {
        $record = AttendanceRecord::find($attendanceRecord->id);
        $record->update($request->all());
        return response()->json($record);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttendanceRecord $attendanceRecord)
    {
        $record = AttendanceRecord::find($attendanceRecord->id);
        $record->delete();
    }
}
