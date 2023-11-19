<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurriculumRequest;
use App\Models\Curriculum;

class CurriculumController extends Controller
{
    public function index()
    {
        $curricula = Curriculum::all();
        return response()->json($curricula, 200);
    }

    public function store(CurriculumRequest $request)
    {
        $curricula = Curriculum::create($request->all());
        return response()->json($curricula);
    }

    public function show(Curriculum $curriculum)
    {
        return response()->json($curriculum);
    }

    public function update(CurriculumRequest $request, Curriculum $curriculum)
    {
        $curricula = Curriculum::findOrFail($curriculum->id);
        $curricula->update($request->all());
        return response()->json($curricula);
    }

    public function destroy(Curriculum $curriculum)
    {
        $curricula = Curriculum::find($curriculum->id);
        $curricula->delete();
        return response()->json(null, 200);
    }
}
