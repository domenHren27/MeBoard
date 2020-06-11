@extends('layouts.app')
@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-grey-dark text-sm font-normal">
                <a href="/projects" class="text-grey-dark text-sm font-normal no-underline"> My Projects </a> / {{ $project->title}}
                
            </p>
            <a href="{{ $project->path().'/edit' }}" 
            class="py-2 px-5"
            style=
                "background-color: #47cdff; 
                text-decoration: none;
                box-shadow: 0 2px 7px 0 #b0eaff; 
                border-radius: 5rem;
                color: white;
                font-size: 0.8rem;">
                Edit Project
            </a>
        </div>
        
    </header>
    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class=mb-8>
                    <h2 class="text-grey-dark text-lg font-normal mb-3">Tasks</h2>
                    {{--Tasks --}}
                    @foreach ($project->tasks as $task)
                        <div class="bg-white mb-3 p-5 rounded-lg shadow">
                            <form method="POST" action="{{$task->path()}}">
                                @method('PATCH')
                                @csrf
                                <div class="flex">
                                <input 
                                name="body"
                                value="{{ $task->body }}" class="w-full {{$task->completed ? 'text-grey-dark' : ''}}">
                                <input 
                                name="completed"
                                type="checkbox"
                                onChange="this.form.submit()" {{ $task->completed ? 'checked' : ''}}>
                                </div>
                                
                            </form>
                        </div>
                    @endforeach
                    <div class="bg-white mb-3 p-5 rounded-lg shadow shadow">
                        <form action="{{ $project->path() . '/tasks'}}" method="POST">
                            @csrf
                            <input placeholder="Add a new task" class="w-full" name="body">
                            {{-- pomembno je, da damo inputu name --}}
                        </form>                            
                    </div>
                </div>
                <div>
                    <h2 class="text-grey-dark text-lg font-normal mb-3">General Notes</h2>
                    {{-- General notes --}}

                    <form action="{{$project->path()}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <textarea
                            name="notes" 
                            class="bg-white p-5 rounded-lg shadow shadow w-full mb-4" 
                            style="min-height: 200px" placeholder="Anything special that you make note of...">{{$project->notes}}
                        </textarea>

                        <button class="py-2 px-5" type="submit" style=
                        "background-color: #47cdff; 
                        text-decoration: none;
                        box-shadow: 0 2px 7px 0 #b0eaff; 
                        border-radius: 5rem;
                        color: white;
                        font-size: 0.8rem;">Save</button>
                    </form>
                    @if ($errors->any())
                        <div class="field mt-6">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm text-red">{{ $error }}</li>
                        @endforeach
                        </div>  {{--  Show errors, pomembno, da dodamo ob vsakemu formu --}}
                    @endif                   
                </div>                                 
                
            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')
            </div>
        </div>
    </main>
    
@endsection