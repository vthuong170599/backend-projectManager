<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task)
    {
       return $task->with(['Member','Project'])->get()->toArray();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = Task::create($request->all());
        return response()->json([
            'message'=>'success',
            'task'=>$task
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Task::find($id);
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
        $task = Task::find($id)->update($request->all());
        return response()->json([
            'message'=>'success',
            'task'=>$task
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
<<<<<<< HEAD
        return Task::find($id)->delete();
=======
        $task = Task::find($id)->delete();
        return response()->json(['task'=>$task],200);
    }

    public function search(Request $request,Task $task){
        $task = $task->search($request->subject);
        return response()->json(['task'=>$task],200);
>>>>>>> 880846942df0a6d7862495e0005d038c00de8e2d
    }
}
