<?php

namespace App\Http\Controllers;

use App\Project; //Paziti moramo na "namespace"
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Project::all();

    


        return view('projects.index', compact('projects'));
    }

    public function show(Project $project) //Auto inject wild card
    {
        //$project = Project::findOrFail(request('project')); //'project je wild card {project} "glej routes/web"

        return view('projects.show', compact('project'));
    }

    public function store()
    {        
        //auth//validate//presist
        auth()->user()->projects()->create(request()->validate([
            'title' => 'required',
            'description' =>  'required',
        ]));

        //redirect
        return redirect('/projects');
    }
}
