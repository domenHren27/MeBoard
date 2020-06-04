@extends('layouts.app')
@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-grey-dark text-sm font-normal">
                <a href="/projects" class="text-grey-dark text-sm font-normal no-underline"> My Projects </a> / {{ $project->title}}
                
            </p>
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
    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3">
                <div class=mb-8>
                    <h2 class="text-grey-dark text-lg font-normal mb-3">Tasks</h2>
                    {{--Tasks --}}
                    <div class="bg-white mb-3 p-5 rounded-lg shadow shadow">Lorem ipsum</div>
                    <div class="bg-white mb-3 p-5 rounded-lg shadow shadow">Lorem ipsum</div>
                    <div class="bg-white mb-3 p-5 rounded-lg shadow shadow">Lorem ipsum</div>
                    <div class="bg-white mb-3 p-5 rounded-lg shadow shadow">Lorem ipsum</div>
                    <div class="bg-white p-5 rounded-lg shadow shadow">Lorem ipsum</div>
                </div>
                <div>
                    <h2 class="text-grey-dark text-lg font-normal mb-3">General Notes</h2>
                    {{-- General notes --}}
                    <textarea class="bg-white p-5 rounded-lg shadow shadow w-full" style="min-height: 200px">Lorem ipsum</textarea>
                </div>                                 
                
            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')
            </div>
        </div>
    </main>
    
@endsection