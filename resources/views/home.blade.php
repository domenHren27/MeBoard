@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    <a class="no-underline" href="{{ url('/projects')}}">
                        <button class="px-5 py-2 bg-blue block mt-2 ml-2" style=
                        "background-color: #47cdff; 
                        text-decoration: none;
                        box-shadow: 0 2px 7px 0 #b0eaff; 
                        border-radius: 5rem;
                        color: white;">
                            Display Projects
                        </button>
                    
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
