<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index(Project $project)
    {
        return $project->tasks;
    }

    public function store(Project $project)
    {
        return $project->addTask(request(['title']));
    }
}
