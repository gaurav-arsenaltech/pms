<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    use HasFactory;
    protected $table="task_comment";
    protected $fillable=['comment_data','user_id','task_id','file','link_type'];

    protected $attributes=[
        'link_type'=>"null"
    ];
    public function user()
    {
        return $this->hasOne(User::class,"id","user_id");
    }
}
