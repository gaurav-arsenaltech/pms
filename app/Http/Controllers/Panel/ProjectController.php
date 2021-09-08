<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ProjectMember;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request,$id){
        $model = ProjectMember::where("project_id",$id)->get();
        return view('panel.project.index',compact('model'));
    }
}
