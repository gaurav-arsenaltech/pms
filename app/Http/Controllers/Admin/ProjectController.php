<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Project::all();
        return view("admin.project.index",compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users= User::all();
        return view("admin.project.create",compact("users"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project=$request->input("project");
        $members=$request->input("member");
        $this->validate($request,[
            'project.title'=> 'required',
            'project.description'=>'required',
            'project.start_date'=>'required|date',
            'project.leader'=>'required'
        ]);

        $modelProject = new Project();
        $modelProject->project_name=$project['title'];
        $modelProject->description=$project['description'];
        $modelProject->start_date=$project['start_date'];
        $modelProject->project_leader=$project['leader'];
        $modelProject->save();
        $modelProject->refresh();

        if($members!=null){
            foreach ($members as $member)
            {
                if($member['user']!=null && $member['as']!=null)
                {
                    $modelProjectMember = new ProjectMember();
                    $modelProjectMember->user_id=$member['user'];
                    $modelProjectMember->designation=$member['as'];
                    $modelProjectMember->project_id=$modelProject->id;
                    $modelProjectMember->save();
                }
                }

        }
        return redirect()->route("project.index");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Project::findOrFail($id);
        $users= User::all();
        return view('admin.project.edit',compact('model','users'));
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
        $project=$request->input("project");
        $members=$request->input("member");
        $this->validate($request,[
            'project.title'=> 'required',
            'project.description'=>'required',
            'project.start_date'=>'required|date',
            'project.leader'=>'required'
        ]);

        $modelProject = Project::findOrFail($id);
        $modelProject->project_name=$project['title'];
        $modelProject->description=$project['description'];
        $modelProject->start_date=$project['start_date'];
        $modelProject->project_leader=$project['leader'];
        $modelProject->save();
        $modelProject->refresh();

        if($members!=null){
            foreach ($members as $member)
            {
                if($member['user']!=null && $member['as']!=null)
                {
                    if($member['id']==0)
                    {
                        $modelProjectMember = new ProjectMember();
                    }else{
                        $memberId=$member['id'];
                        $modelProjectMember = ProjectMember::findOrFail($memberId);
                        if($modelProjectMember==null)
                        {
                            $modelProjectMember = new ProjectMember();
                        }
                    }

                    $modelProjectMember->user_id=$member['user'];
                    $modelProjectMember->designation=$member['as'];
                    $modelProjectMember->project_id=$modelProject->id;
                    $modelProjectMember->save();
                }
            }

        }
        return redirect()->route("project.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Project::findOrFail($id);
        $members = $model->projectMembers;
        if($members !=null)
        {
            foreach ($members as $member)
            {
                $member->delete();
            }
        }
        $model->delete();
        return redirect()->route("project.index");
    }
}
