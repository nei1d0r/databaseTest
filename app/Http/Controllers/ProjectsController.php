<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::where('owner_id', auth()->id())->get();
        // return $projects;
        return view('projects.index',['projects'=>$projects]);
    }
    public function create()
    {
        return view('projects.create');
    } 
    public function store()
    {
        $project = new Project();
        $project->title = request('title');
        $project->description = request('description');
        $project->save();

        return redirect('/projects');
    }
}
