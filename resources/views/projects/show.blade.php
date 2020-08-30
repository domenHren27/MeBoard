@extends('layouts.app')
@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-grey-dark text-sm font-normal">
                <a href="/projects" class="text-grey-dark text-sm font-normal no-underline"> Moji Projekti </a> / {{ $project->title}}
                
            </p>
            <div class="flex items-center">
                @foreach ($project->members as $member)
                    <img 
                        src="/images/avatar.png" 
                        class="rounded-full w-8 mr-2" 
                        alt="{{ $member->name }}'s avatar">
                @endforeach

                <img 
                    src="/images/avatar.png"
                    class="rounded-full w-8 mr-2" 
                    alt="{{ $project->owner->name }}'s avatar">

                <a href="{{ $project->path().'/edit' }}" 
                    class="py-2 px-5 ml-4"
                    style=
                        "background-color: #ed8780; 
                        text-decoration: none;
                        box-shadow: 0 2px 7px 0 #ed8500; 
                        border-radius: 5rem;
                        color: white;
                        font-size: 0.8rem;">
                        Uredi Projekt
                    </a>
            </div>
            
        </div>
        
    </header>
    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class=mb-8>
                    <h2 class="text-grey-dark text-lg font-normal mb-3">Naloge</h2>
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
                            <input placeholder="Dodaj novo nalogo" class="w-full" name="body">
                            {{-- pomembno je, da damo inputu name --}}
                        </form>                            
                    </div>
                </div>
                <div>
                    <h2 class="text-grey-dark text-lg font-normal mb-3">Zapiski

                    </h2>
                    {{-- General notes --}}

                    <form action="{{$project->path()}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <textarea
                            name="notes" 
                            class="bg-white p-5 rounded-lg shadow shadow w-full mb-4" 
                            style="min-height: 200px" placeholder="Imaš kaj posebnega za dodati...">{{$project->notes}}
                        </textarea>

                        <button class="py-2 px-5" type="submit" style=
                        "background-color: #ed8780; 
                        text-decoration: none;
                        box-shadow: 0 2px 7px 0 #ed8500; 
                        border-radius: 5rem;
                        color: white;
                        font-size: 0.8rem;">Shrani</button>
                    </form>
                    
                    @include('errors') 

                </div>                                 
                
            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')

                @include('projects.activity.card')

                {{-- @if (auth()->user()->is($project->owner))
                    @include('projects.invite')
                @endif --}}
                
                {{-- Zgoraj je naveden ena od možnih avtetikacij spodaj je druga za uporabo policiya @can --}}
                @can('manage', $project)
                    @include('projects.invite')
                @endcan
                
                
                
            </div>
        </div>
    </main>
    
@endsection