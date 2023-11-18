<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradeLevelRequest;
use App\Models\GradeLevel;

class GradeLevelController extends Controller
{
    public function index()
    {
        $gradeLevels = GradeLevel::all();
        return response()->json($gradeLevels);
    }

    public function store(GradeLevelRequest $request)
    {
        $gradeLevel = GradeLevel::create($request->all());
        return response()->json($gradeLevel);
    }

    public function show(GradeLevel $gradeLevel)
    {
        $gradeLevel = GradeLevel::find($gradeLevel->id);
        return response()->json($gradeLevel);
    }

    public function update(GradeLevelRequest $request, GradeLevel $gradeLevel)
    {
        $gradeLevel = GradeLevel::find($gradeLevel->id);
        $gradeLevel->update($request->all());
        return response()->json($gradeLevel);
    }

    public function destroy(GradeLevel $gradeLevel)
    {
        $gradeLevel = GradeLevel::find($gradeLevel->id);
        $gradeLevel->delete();
    }
}
