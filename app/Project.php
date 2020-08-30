<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function users()
    {
    	return $this->belongsToMany(\App\User::class);
    }

    public function tasks()
    {
    	return $this->hasMany(\App\Task::class);
    }
}
