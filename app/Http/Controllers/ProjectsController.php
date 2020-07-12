<?php

namespace App\Http\Controllers;

use App\Project; //Paziti moramo na "namespace"
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = auth()->user()->allProjects(); //()->orderBy('updated_at', 'desc')->get(); //Uredimo jih glede na time stamp

    


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
        $project = auth()->user()->projects()->create($this->validateRequest());

        //redirect
        return redirect($project->path());
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project); // Mora imeti, da ne vidi informacij
        return view('projects.edit', compact('project'));   
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

        $attribustes = $this->validateRequest();

        $project->update($attribustes);

        return redirect($project->path());
    }

    public function destroy(Project $project)
    {
        $this->authorize('update', $project);
        $project->delete();

        return redirect('/projects');
    }

    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'sometimes|required', //Ne vedno, samo ko imamo vključena oba
            'description' => 'sometimes|required', //Ne vedno, samo ko imamo vključena oba
            'notes' => 'nullable' //Lahko jih sploh ni
        ]);
    }
    
}
