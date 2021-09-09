<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        echo $id;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($pid)
    {
        $project = Project::findOrFail($pid);
        $users = User::all();
        return view('panel.task.create',compact('users','project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$pid)
    {

        $request->validate([
           'taskName'=>'required',
           'taskDetail'=>'required',
           'assignTo'=>'required|array',
            'taskType'=>'required',
        ]);
        $taskModel = new Task();
        $taskModel->title=$request->input("taskName");
        $taskModel->description= $request->input("taskDetail");
        $taskModel->project_id=$pid;
        $taskModel->created_by=$request->user()->id;
        $assignTo=[];
        if($request->input("assignTo"))
        {
            foreach ($request->input("assignTo") as $as)
            {
                array_push($assignTo,$as);
            }
        }
        $taskModel->assign_to=json_encode($assignTo);
        $taskModel->type=$request->input("taskType");
        $taskModel->status=1;
        $taskModel->save();
        return redirect()->route("projectInfo",[$pid]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($pid,$id)
    {
        $project = Project::findOrFail($pid);
        $task = Task::findOrFail($id);

        return view("panel.task.show",compact('project','task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$taskId)
    {

        $project = Project::findOrFail($id);
        $task = Task::findOrFail($taskId);
        $users = User::all();

        return view("panel.task.edit",compact('project','task','users'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$pid, $id)
    {
        $request->validate([
            'taskName'=>'required',
            'taskDetail'=>'required',
            'assignTo'=>'required|array',
            'taskType'=>'required',
             'taskStatus'=>'required'
        ]);
        $taskModel = Task::findOrFail($id);
        $taskModel->title=$request->input("taskName");
        $taskModel->description= $request->input("taskDetail");
        $assignTo=[];
        if($request->input("assignTo"))
        {
            foreach ($request->input("assignTo") as $as)
            {
                array_push($assignTo,$as);
            }
        }
        $taskModel->assign_to=json_encode($assignTo);
        $taskModel->type=$request->input("taskType");
        $taskModel->status=$request->input("taskStatus");
        $taskModel->save();
        return redirect()->route("projectInfo",[$pid]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pid,$id)
    {
        $task = Task::findOrFail($id);
        $comments= $task->comments;
        if($comments!=null)
        {
            foreach ($comments as $comment)
            {
                $comment->delete();
            }
        }
        $task->delete();
        return redirect()->route("projectInfo",[$pid]);
    }
}
