<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-grey-lighter">
    <div id="app">
        <nav class="bg-white section">
            <div class="container mx-auto">
                <div class="flex justify-between items-center py-1">
                    <div class="flex items-center">
                        <h1>
                        <a class="navbar-brand" href="{{ url('/projects') }}">
                            <img src="/images/target.png" alt="Meboard" 
                            width="50px" height="50px" class="relative" style="top: 2px">
                        </a>
                        </h1>
                        <h1 class="mr-5 title" style="margin-right: 2rem">Moja tabla</h1>
                    </div>
                    

                    <div>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto list-reset">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Vpis') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Registracija') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a
                                        id="navbarDropdown"
                                        class="nav-link dropdown-toggle"
                                        href="#" role="button"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        v-pre
                                    >
                                        <img width="50"
                                             class="rounded-full"
                                             src="/images/avatar.png">
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a  class="py-1 px-2"
                                           href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                           style=
                                           "background-color: #ed8780; 
                                           text-decoration: none;
                                           box-shadow: 0 2px 7px 0 #ed8500; 
                                           border-radius: 1rem;
                                           color: white;
                                           font-size: 0.8rem;"
                                        >
                                            {{ __('Izpis') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                                
                            @endguest
                        </ul>
                        
                    </div>
                    
                </div>
            </div>
        </nav>

        <div class="section">
            <main class="container mx-auto py-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
