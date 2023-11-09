<?php

namespace App\Http\Controllers;

use App\Models\CityMunicipality;
use Illuminate\Http\Request;

class CityMunicipalityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = CityMunicipality::all();
        return response()->json($cities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cities = CityMunicipality::create($request->all());
        return response()->json($cities);
    }

    /**
     * Display the specified resource.
     */
    public function show(CityMunicipality $cityMunicipalities)
    {
        return response()->json($cityMunicipalities);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CityMunicipality $cityMunicipalities)
    {
        $cities = CityMunicipality::find($request->id);
        $cities->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CityMunicipality $cityMunicipalities)
    {
        $cityMunicipalities->delete();
    }
}
