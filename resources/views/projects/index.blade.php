@extends('layouts.app')
@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <h2 class="text-grey-dark text-sm font-normal">My Projects</h2>
            <a href="/projects/create" 
            class="py-2 px-5"
            style=
                "background-color: #47cdff; 
                text-decoration: none;
                box-shadow: 0 2px 7px 0 #b0eaff; 
                border-radius: 5rem;
                color: white;
                font-size: 0.8rem;">
                New Project
            </a>
        </div>
        
    </header>

    <main class="flex flex-wrap -mx-3">
        @forelse ($projects as $project)
            <div class="w-1/3 px-3 pb-6">
                @include('projects.card')
            </div>             
        @empty
            <div>No projects yet.</div>
        @endforelse
        
    </main>
  
@endsection