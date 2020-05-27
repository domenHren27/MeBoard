<?php

namespace App\Http\Controllers;

use App\Project; //Paziti moramo na "namespace"
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects;

    


        return view('projects.index', compact('projects'));
    }

    public function show(Project $project) //Auto inject wild card
    {

        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        } //Preverimo ali je auth user lastnik projekta

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
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
