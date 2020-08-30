@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Predstavitveno okno</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Vpisan si !

                    <a class="no-underline" href="{{ url('/projects')}}">
                        <button class="px-5 py-2 bg-blue block mt-2 ml-2" style=
                        "background-color: #ed8780; 
                        text-decoration: none;
                        box-shadow: 0 2px 7px 0 #ed8500; 
                        border-radius: 5rem;
                        color: white;">
                            Predstavi Projekte
                        </button>
                    
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
