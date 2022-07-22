<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Titolo pagina -->
    <title>Boolbnb</title>

    <!-- Scripts JS -->
    <script src="{{ asset('js/front.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@300;400;700;900&display=swap" rel="stylesheet">

    <!-- Link CSS -->
    <link href="{{ asset('css/front.css') }}" rel="stylesheet">

</head>

<body>

    <header id="site_header_front">
        <nav class="navbar navbar-expand-md shadow">
            <div class="container">
                <div class="row w_100 align-items-center">
                    <div class="col">
                        <a href="{{ url('/') }}">
                            <img src="resources/img/logo.png" alt="">
                        </a>
                    </div>
                    <!-- /.col sx -->
                    <div class="col d-flex justify-content-center">
                        <div class="search">
                            <label for="text">Ricerca</label>
                            <input type="text" class="ms-2 border rounded-pill shadow">
                        </div>
                    </div>
                    <!-- /.col central-->
                    <div class="col d-flex justify-content-end">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!-- /btn to drowdown -->
                        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Accedi</a>
                                </li>
                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Registrati</a>
                                </li>
                                @endif
                                @else
                                <li class="nav-item dropdown d-flex align-items-center">
                                    <h4 class="navbar-brand mb-0">Bentornato {{ Auth::user()->name ?? '' }}</h4>
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                        </svg>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="{{ route('admin.home') }}">Admin</a></li>
                                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Esci</a>
                                        </li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </ul>
                                </li>
                                @endguest
                            </ul>
                        </div>
                        <!-- /authentication Links -->
                    </div>
                    <!-- /.col dx -->
                </div>
            </div>
        </nav>
        <!-- /Nav UP -->

        <div class="navbar">
            <div class="container">
                <div class="row w_100 align-items-center">
                    <div class="col d-flex justify-content-center">
                        <ul class="d-flex">
                            <li class="p-2">
                                <a href="#">Home</a>
                            </li>
                            <li class="p-2">
                                <a href="#">Ricerca</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.col sx -->
                    <div class="col d-flex justify-content-end">
                        <div class="btn btn-light shadow">
                            filter
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                            </svg>
                        </div>
                    </div>
                    <!-- /.col dx -->
                </div>
            </div>
        </div>
        <!-- /Nav DOWN -->
    </header>
    <!-- /#site_header_front -->

    <main id="site_main_front">

        @yield('content')

    </main>
    <!-- /#site_main_front -->

</body>

</html>