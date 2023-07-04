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
        <div class="offcanvas_navbar p-2 shadow d-flex justify-content-start align-items-center gap-3">
            <a class="d-xl-none btn offcanvas_button" data-bs-toggle="offcanvas" href="#offcanvas" role="button"
                aria-controls="offcanvasExample">
                <i class="fa-solid fa-bars fa-2x"></i>
            </a>
            <div class="logo_wrapper"></div>
        </div>

        <div class="offcanvas offcanvas-start d-xl-none" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
            <div class="offcanvas-header d-flex justify-content-end">
                {{-- <h5 class="offcanvas-title" id="offcanvasLabel">Boolbnb</h5> --}}
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="d-flex flex-column align-items-start justify-content-start gap-3 ps-0">
                    @auth

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
                    @endauth
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
                        <li>
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
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
                            {{-- <li>
                                <div class="logo_wrapper">
                                    
                                </div>
                            </li> --}}
                            @auth
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
                            @endauth
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
                                <li>
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @endguest
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
