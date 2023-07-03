<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>


<body>
    <div id="app">
        {{-- <nav class="navbar navbar-expand-xl navbar-light shadow">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <div class="logo_laravel">

                    </div>
                    
                </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav d-flex d-xl-none align-items-center gap-3">
                
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if (Auth::user()->name)
                                {{ Auth::user()->name }}
                            @else
                                {{ Auth::user()->email }}
                            @endif
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                            
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
    </nav> --}}
        <div class="offcanvas_navbar p-2 d-xl-none shadow">
            <a class="btn btn-outline-light offcanvas_button" data-bs-toggle="offcanvas" href="#offcanvas"
                role="button" aria-controls="offcanvasExample">
                <i class="fa-solid fa-bars fa-2x"></i>
            </a>
        </div>

        <div class="offcanvas offcanvas-start d-xl-none" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasLabel">Offcanvas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="d-flex flex-column align-items-start justify-content-start gap-3 ps-0">
                    <li>
                        <i class="fa-solid fa-home"></i>
                        <a class="" href="{{ url('/') }}">
                            {{ __('Home') }}
                        </a>
                    </li>
                    <li>
                        <i class="fa-solid fa-user"></i>
                        <a class="" href="{{ url('profile') }}">
                            {{ __('Profile') }}
                        </a>
                    </li>
                    <li>
                        <i class="fa-regular fa-building"></i>
                        <a class="" href="{{ url('/user/apartments') }}">
                            {{ __('Apartments') }}
                        </a>
                    </li>
                    <li>
                        <i class="fa-solid fa-envelope-open-text"></i>
                        <a class="" href="{{ url('/user/apartments') }}">
                            {{ __('Messages') }}
                        </a>
                    </li>
                    <li>
                        <i class="fa-solid fa-tv"></i>
                        <a class="" href="{{ url('/user/services') }}">
                            {{ __('Services') }}
                        </a>
                    </li>
                    <li>
                        <i class="fa-solid fa-star"></i>
                        <a class="" href="{{ url('/user/services') }}">
                            {{ __('Sponsorships') }}
                        </a>
                    </li>
                    <li>
                        <i class="fa-solid fa-chart-pie"></i>
                        <a class="" href="{{ url('/user/services') }}">
                            {{ __('Analytics') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="dashboard_bg"></div>

        <div class="container-fluid container_z_index">
            <div class="row justify-content-center p-1 p-xl-5">
                <!-- left -->
                <div class="col-12 col-lg-3 d-none d-xl-block">
                    <aside class="sidebar_menu px-5 py-4 shadow">
                        <ul class="d-flex flex-column align-items-start justify-content-start gap-3 ps-0">
                            <li>
                                <i class="fa-solid fa-home"></i>
                                <a class="" href="{{ url('/') }}">
                                    {{ __('Home') }}
                                </a>
                            </li>
                            <li>
                                <i class="fa-solid fa-user"></i>
                                <a class="" href="{{ url('profile') }}">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                            <li>
                                <i class="fa-regular fa-building"></i>
                                <a class="" href="{{ url('/user/apartments') }}">
                                    {{ __('Apartments') }}
                                </a>
                            </li>
                            <li>
                                <i class="fa-solid fa-envelope-open-text"></i>
                                <a class="" href="{{ url('/user/apartments') }}">
                                    {{ __('Messages') }}
                                </a>
                            </li>
                            <li>
                                <i class="fa-solid fa-tv"></i>
                                <a class="" href="{{ url('/user/services') }}">
                                    {{ __('Services') }}
                                </a>
                            </li>
                            <li>
                                <i class="fa-solid fa-star"></i>
                                <a class="" href="{{ url('/user/services') }}">
                                    {{ __('Sponsorships') }}
                                </a>
                            </li>
                            <li>
                                <i class="fa-solid fa-chart-pie"></i>
                                <a class="" href="{{ url('/user/services') }}">
                                    {{ __('Analytics') }}
                                </a>
                            </li>
                        </ul>
                    </aside>
                </div>

                <main class="col-12 col-lg-9">
                    @yield('content')
                </main>
            </div>
            @yield('javascript')
</body>

</html>
