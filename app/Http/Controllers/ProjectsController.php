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

    public function store()
    {
        Project::create(request(['title', 'description']));

        return redirect('/projects');
    }
}
