<?php

namespace App\Http\Controllers;

use App\Models\StudentRecord;
use Illuminate\Http\Request;

class StudentRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAllStudent()
    {
        $studentRecord = StudentRecord::all();
        return response()->json($studentRecord);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeStudent(Request $request)
    {
        $studentRecord = StudentRecord::create($request->all());
        return response()->json($studentRecord);
    }

    /**
     * Display the specified resource.
     */
    public function getStudent(StudentRecord $studentRecord)
    {
        $studentRecord = StudentRecord::find($studentRecord->id);
        return response()->json($studentRecord);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStudent(Request $request, StudentRecord $studentRecord)
    {
        $studentRecord->update($request->all());
        return response()->json($studentRecord);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyStudent(StudentRecord $studentRecord)
    {
        $studentRecord->delete();
    }
}
