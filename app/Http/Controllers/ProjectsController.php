<?php

namespace App\Http\Controllers;

use App\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::where('owner_id',auth()->id())->get();
        // return $projects;
        return view('projects.index',['projects'=>$projects]);
    }

    public function create()
    {
        return view('projects.create');
    } 

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required|min:3' // could use['required','min:3php']
        ]);
        Project::create(request(['title','description']));
        return redirect('/projects');
    }

    public function edit(Project $project) // example.com/projects/{project}/edit
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {
        $project->update(request(['title','description']));
        return redirect("/projects");
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect("/projects");
    }
}
