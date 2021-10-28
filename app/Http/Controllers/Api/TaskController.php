<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TaskResource::collection(Task::all());
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
        return TaskResource::make(Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'date' => Carbon::createFromFormat('m/d/Y', $data['date']),
            'is_completed' => $data['is_completed'],
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
        return TaskResource::make(Task::findOrFail($id));
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
        $task = Task::findOrFail($id);
        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->date = Carbon::createFromFormat('m/d/Y', $data['date']);
        $task->is_completed = $data['is_completed'];
        $task->drone_id = $data['drone_id'];
        $task->save();
        return TaskResource::make($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return TaskResource::make($task);
    }
}
