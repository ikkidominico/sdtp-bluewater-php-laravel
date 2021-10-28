<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OperatorResource;
use Illuminate\Http\Request;
use App\Models\Operator;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OperatorResource::collection(Operator::all());
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
        return OperatorResource::make(Operator::create([
            'cpf' => $data['cpf'],
            'name' => $data['name']
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
        return OperatorResource::make(Operator::findOrFail($id));
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
        $operator = Operator::findOrFail($id);
        $operator->cpf = $data['cpf'];
        $operator->name = $data['name'];
        $operator->save();
        return OperatorResource::make($operator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $operator = Operator::findOrFail($id);
        $operator->delete();
        return OperatorResource::make($operator);
    }
}
