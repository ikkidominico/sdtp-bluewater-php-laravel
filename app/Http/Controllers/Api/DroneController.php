<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DroneResource;
use App\Http\Resources\TaskResource;
use App\Models\Drone;
use Illuminate\Http\Request;

class DroneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DroneResource::collection(Drone::all());
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
        return DroneResource::make(Drone::create([
            'codename' => $data['codename'],
            'manufacturer' => $data['manufacturer'],
            'model' => $data['model'],
            'serial' => $data['serial'],
            'operator_id' => $data['operator_id']
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
        return DroneResource::make(Drone::findOrFail($id));
    }

    public function missions($id)
    {
        return response()->json([
            "drone_id" => $id,
            "missions" => Drone::findOrFail($id)->missions()->get()
        ]);
    }

    public function repairs($id)
    {
        return response()->json([
            "drone_id" => $id,
            "repairs" => Drone::findOrFail($id)->repairs()->get()
        ]);
    }

    public function tasks($id)
    {
        return response()->json([
            "drone_id" => $id,
            "tasks" => Drone::findOrFail($id)->tasks()->get()
        ]);
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
        $drone = Drone::findOrFail($id);
        $drone->codename = $data['codename'];
        $drone->manufacturer = $data['manufacturer'];
        $drone->model = $data['model'];
        $drone->serial = $data['serial'];
        $drone->operator_id = $data['operator_id'];
        $drone->save();
        return DroneResource::make($drone);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $drone = Drone::findOrFail($id);
        $drone->delete();
        return DroneResource::make($drone);
    }
}
