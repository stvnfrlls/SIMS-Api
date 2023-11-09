<?php

namespace App\Http\Controllers;

use App\Models\FacultyRecord;
use Illuminate\Http\Request;

class FacultyRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAllFaculty()
    {
        $faculties = FacultyRecord::all();
        return response()->json($faculties);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeFaculty(Request $request)
    {
        $faculty = FacultyRecord::create($request->all());
        return response()->json($faculty);
    }

    /**
     * Display the specified resource.
     */
    public function getFaculty(FacultyRecord $facultyRecord)
    {
        return response()->json($facultyRecord);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateFaculty(Request $request, FacultyRecord $facultyRecord)
    {
        $facultyRecord->update($request->all());
        return response()->json($facultyRecord);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroyFaculty(FacultyRecord $facultyRecord)
    {
        $facultyRecord->delete();
    }
}
