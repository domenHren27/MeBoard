@extends('layouts.app')
@section('content')   
    <h1>Create a Project</h1>  
    
    <form method="POST"  action="/projects">
        @csrf

        <div>
            <label for="title">
                Title
            </label>

            <div>
                <input type="text" name="title">
            </div>
        </div>

        <div>
            <label for="description">
                Description
            </label>

            <div>
                <textarea  name="description"></textarea>
            </div>
        </div>

        <div>
            <div>
                <a type="submit" class="py-2 px-5"
                style=
                    "background-color: #47cdff; 
                    text-decoration: none;
                    box-shadow: 0 2px 7px 0 #b0eaff; 
                    border-radius: 5rem;
                    color: white;
                    font-size: 0.8rem;">Create Project</a>
                <a href="/projects">Cancle</a>
            </div>
        </div>

    </form>
@endsection