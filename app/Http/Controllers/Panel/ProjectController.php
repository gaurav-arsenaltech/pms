<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ProjectMember;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request,$pid){

        $model = ProjectMember::where("project_id",$pid)->get();
        $task = Task::where("project_id",$pid)->get();
        return view('panel.project.index',compact('model','task'));
    }
}
