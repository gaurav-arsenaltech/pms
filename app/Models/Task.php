<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table="task";
    protected $fillable=['title','description','project_id','created_by','assign_to','type','status'];

    public function project()
    {
        return $this->hasOne(Project::class,"id","project_id");
    }
    public function user()
    {
        return $this->hasOne(User::class,"id","created_by");
    }
    public function arrayUser()
    {
        $users=$this->assign_to;
        $response=[];
        if($users!=null)
        {
            $users= json_decode($users);
            $response= User::whereIn('id',$users)->get();
        }
        return $response;
    }
    public function comments()
    {
        return $this->hasMany(TaskComment::class,"task_id","id");
    }
}
