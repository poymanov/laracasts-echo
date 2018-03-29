<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        return Project::all();
    }

    public function store()
    {
        return Project::create(request(['name']));
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }
}
