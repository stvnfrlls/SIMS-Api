<?php

namespace App\Http\Controllers;

use App\Models\StudentRecord;

class ClasslistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classlist = StudentRecord::select('userId', 'firstName', 'middleName', 'lastName', 'suffix', 'gradeId')
            ->orderBy('gradeId', 'asc')
            ->with('gradeLevel') // Eager load the gradeLevel relationship
            ->get();

        // Group the data by 'gradeId' using Laravel Collection
        $groupedClasslist = $classlist->groupBy('gradeId');

        return response()->json($groupedClasslist);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $classlist = StudentRecord::select('userId', 'firstName', 'middleName', 'lastName', 'suffix', 'gradeId')
            ->where('gradeId', $id)
            ->with('gradeLevel') // Eager load the gradeLevel relationship
            ->get();

        // You can remove specific values inside the 'grade_levels' array
        $classlist = $classlist->map(function ($record) {
            $recordArray = $record->toArray();

            // Remove 'gradeId' from the main array
            unset($recordArray['gradeId']);

            // Remove specific values inside 'grade_levels'
            unset($recordArray['grade_levels']['id']);
            unset($recordArray['grade_levels']['deleted_at']);

            return $recordArray;
        });

        return response()->json($classlist);
    }
}
