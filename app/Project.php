<?php

namespace App;

use App\Events\TaskCreated;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $guarded = [];

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function addTask($task)
    {
        $task = $this->tasks()->create($task);

        TaskCreated::dispatch($task);

        return $task;
    }

}
