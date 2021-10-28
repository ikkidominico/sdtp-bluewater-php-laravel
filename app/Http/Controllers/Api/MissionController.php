<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MissionResource;
use App\Models\Mission;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MissionResource::collection(Mission::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        return MissionResource::make(Mission::create([
            'codename' => $data['codename'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'radius' => $data['radius'],
            'date' => Carbon::createFromFormat('m/d/Y', $data['date'])
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return MissionResource::make(Mission::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->json()->all();
        $mission = Mission::findOrFail($id);
        $mission->codename = $data['codename'];
        $mission->latitude = $data['latitude'];
        $mission->longitude = $data['longitude'];
        $mission->radius = $data['radius'];
        $mission->date = Carbon::createFromFormat('m/d/Y', $data['date']);
        $mission->save();
        return MissionResource::make($mission);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mission = Mission::findOrFail($id);
        $mission->delete();
        return MissionResource::make($mission);
    }
}
