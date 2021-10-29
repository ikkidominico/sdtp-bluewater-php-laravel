<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DroneMissionResource;
use App\Models\DroneMission;
use Illuminate\Http\Request;

class DroneMissionController extends Controller
{
    /**
     * Attach drones to missions resources and store in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attach(Request $request)
    {
        $data = $request->json()->all();
        return DroneMissionResource::make(DroneMission::create([
            'drone_id' => $data['drone_id'],
            'mission_id' => $data['mission_id']
        ]));
    }
}
