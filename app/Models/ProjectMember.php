<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{
    use HasFactory;
    protected $table="project_member";

    public function user()
    {
        return $this->hasOne(User::class,"id",'user_id');
    }
}
