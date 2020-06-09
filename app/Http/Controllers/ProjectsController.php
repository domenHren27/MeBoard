<?php

namespace App\Http\Controllers;

use App\Project; //Paziti moramo na "namespace"
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->projects; //()->orderBy('updated_at', 'desc')->get(); //Uredimo jih glede na time stamp

    


        return view('projects.index', compact('projects'));
    }

    public function show(Project $project) //Auto inject wild card
    {

        $this->authorize('update', $project);
        // if (auth()->user()->isNot($project->owner)) {
        //     abort(403);
        // } //Preverimo ali je auth user lastnik projekta

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store()
    {        
        //auth//validate//presist
        $project = auth()->user()->projects()->create(request()->validate([
            'title' => 'required',
            'description' =>  'required',
            'notes' => 'min:3' //It is not required
        ]));

        //redirect
        return redirect($project->path());
    }

    public function update(Project $project)
    {

        $this->authorize('update', $project); //To je za policy

        // if (auth()->user()->isNot($project->owner)) {
        //     abort(403);
        // } //Preverimo ali je auth user lastnik projekta
        
        // $project->update([
        //     'notes' => request('notes')
        // ]); Enaki način kot spodaj le da je daljši

        $project->update(request(['notes']));

        return redirect($project->path());
    }

    
}
