<?php

namespace App\Http\Controllers;

use App\Models\StudentRecord;

class ClasslistController extends Controller
{
    public function index()
    {
        $classlist = StudentRecord::select('userId', 'firstName', 'middleName', 'lastName', 'suffix', 'gradeId')
            ->orderBy('gradeId', 'asc')
            ->with('gradeLevel')
            ->get();

        $groupedClasslist = $classlist->groupBy('gradeId');

        return response()->json($groupedClasslist);
    }

    public function show(string $id)
    {
        $classlist = StudentRecord::select('userId', 'firstName', 'middleName', 'lastName', 'suffix', 'gradeId')
            ->where('gradeId', $id)
            ->with('gradeLevel')
            ->get();

        $classlist = $classlist->map(function ($record) {
            $recordArray = $record->toArray();

            unset($recordArray['gradeId']);
            unset($recordArray['grade_levels']['id']);
            unset($recordArray['grade_levels']['deleted_at']);

            return $recordArray;
        });

        return response()->json($classlist);
    }
}
