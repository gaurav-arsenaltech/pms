<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table="project";
    protected $fillable =['project_name','description','start_date','project_leader'];

    public function user()
    {
        return $this->hasOne(User::class,'id','project_leader');
    }
    public function projectMembers()
    {
        return $this->hasMany(ProjectMember::class,'project_id',"id");
    }
}
