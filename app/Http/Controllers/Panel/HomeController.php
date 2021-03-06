<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $userId=$request->user()->id;

        $model = Project::where(function ($query) use($userId){
            $query->where("project.project_leader",$userId)->orWhere('project_member.user_id',$userId)->orWhereJsonContains('task.assign_to',"$userId");
        })->join("project_member","project.id","=","project_member.project_id")->leftJoin("task","project.id","=","task.project_id")->select("project.*")->groupBy('project.id')->get();

        return view("panel.home",compact('model','userId'));
    }
}
