<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\TaskComment;
use Illuminate\Http\Request;

class TaskCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request,$pid,$tid)
    {

        $request->validate([
            'comment'=>'required'
        ]);
        $model = new TaskComment();
        $filename="";
        if($request->file("myfile")!=null)
        {
            $ext=$request->file("myfile")->getExtension();
            if($ext=="jpg" || $ext=="png" || $ext=="jpeg" ||$ext=="gif")
            {
                $model->link_type="image";
            }else{
                $model->link_type="file";
            }
            $filename=$request->file("myfile")->store('public');
        }


        $model->comment_data=$request->input("comment");
        $model->user_id=$request->user()->id;
        $model->task_id=$tid;
        $model->file=$filename;
        $model->save();
        return redirect()->route("task.show",[$pid,$tid]);

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$pid, $tid,$id)
    {
        $request->validate([
            'comment'=>'required',
            'comment_id'=>'required'
        ]);
        if($request->input("comment_id")!=0 || $request->input("comment_id")!=null)
        {
            $model = TaskComment::findOrFail($request->input("comment_id"));
            $filename="";
            if($request->file("myfile")!=null)
            {
                $ext=$request->file("myfile")->getExtension();
                if($ext=="jpg" || $ext=="png" || $ext=="jpeg" ||$ext=="gif")
                {
                    $model->link_type="image";
                }else{
                    $model->link_type="file";
                }
                $filename=$request->file("myfile")->store('public');
            }


            $model->comment_data=$request->input("comment");
            $model->user_id=$request->user()->id;
            $model->task_id=$tid;
            $model->file=$filename;
            $model->save();
        }

        return redirect()->route("task.show",[$pid,$tid]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($pid,$tid,$id)
    {
        $comment = TaskComment::findOrFail($id);
        $comment->delete();
        return redirect()->route("task.show",[$pid,$tid]);
    }
}
