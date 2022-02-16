<?php

namespace App\Http\Controllers;


use App\Models\Tasks;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
// use App\Http\Requests\TasksRequest;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $tasksProgress = Tasks::whereIn('status', ['in_progress'])
          ->get();
        $tasksPending = Tasks::whereIn('status', ['pending'])
          ->get();

        $tasksTesting = Tasks::whereIn('status', ['testing'])
          ->get();

        $tasksFeedback = Tasks::whereIn('status', ['feedback'])
          ->get();
        $tasksComplete = Tasks::whereIn('status', ['complete'])
          ->get();



        return view('admin.task_status.index', compact('tasksProgress', 'tasksPending','tasksTesting','tasksFeedback','tasksComplete'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.task_status.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
