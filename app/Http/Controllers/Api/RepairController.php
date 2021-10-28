<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RepairResource;
use App\Models\Repair;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RepairResource::collection(Repair::all());
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
        return RepairResource::make(Repair::create([
            'description' => $data['description'],
            'date' => Carbon::createFromFormat('m/d/Y', $data['date']),
            'drone_id' => $data['drone_id']
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
        return RepairResource::make(Repair::findOrFail($id));
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
        $repair = Repair::findOrFail($id);
        $repair->description = $data['description'];
        $repair->date = Carbon::createFromFormat('m/d/Y', $data['date']);
        $repair->drone_id = $data['drone_id'];
        $repair->save();
        return RepairResource::make($repair);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $repair = Repair::findOrFail($id);
        $repair->delete();
        return RepairResource::make($repair);
    }
}
