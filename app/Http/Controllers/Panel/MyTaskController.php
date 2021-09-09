<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class MyTaskController extends Controller
{
    public function index(Request $request)
    {
       $userId=  $request->user()->id;

       $model = Task::whereJsonContains('assign_to',"$userId")->get();

       return view("panel.myTask.index",compact('model'));
    }
}
