@extends('layouts.app')

{{-- @section('javascript')
    @vite(['resources/js/hide_login_confirmation.js'])
@endsection --}}

@section('content')
    <!-- right -->

    @auth
        <div class="">
            <div class="container">
                <!-- THIS WILL DISAPPEAR -->
                {{-- <div id="log_box" class="log_box">
                    <div class="user_name">{{ Auth::user()->name }}</div>
                    <div class="">


                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    {{ __('You are logged in!') }}
                </div> --}}

                <!-- END/THIS WILL DISAPPEAR -->


                {{-- <img src="/storage/internal/logo_horizontal.svg"  alt=""> --}}
                <div class="p-5 mb-4 rounded-3 mt-3 shadow dashboard_jumbotron">
                    <div class="container py-3">
                        <h1 class="display-5 fw-semibold mb-5">
                            Benvenut* nella nostra piattaforma di affitto case e appartamenti!
                        </h1>
                        <p class="col-md-8 fs-5">
                            Qui potrai
                            mettere in affitto le tue
                            proprietà, modificare i dati del tuo account e gestire tutti i tuoi annunzi in modo semplice e
                            intuitivo.
                        </p>
                        {{-- <button class="btn btn-primary btn-lg" type="button">Example button</button> --}}
                    </div>
                </div>

                <div class="container-fluid" id="dashboard_content">
                    <div class="row g-3">
                        <div class="col-12 col-lg-6">
                            <div class="dashboard_card banner_card shadow p-4 h-100">
                                <span class="fs-5">
                                    Inoltre, se vuoi aumentare
                                    la visibilità dei tuoi annunci, puoi acquistare una sponsorship che li renderà visibili a un
                                    pubblico più
                                    vasto.
                                </span>
                            </div>
                        </div>
                        @if ($apartment)
                            <div class="col-12 col-lg-6">
                                <a href="{{ route('user.apartments.show', $apartment->slug) }}">
                                    <div class="dashboard_card apartment_card shadow p-4 h-100">
                                        <img src="{{ asset("/storage/$apartment->image") }}" class="card-img" alt="">
                                        <div class="card-img-overlay">
                                            <h5 class="section_title text-center m-0 p-0">
                                                <i class="fa-solid fa-ranking-star"></i>
                                                <span class="ms-2">Most relevant apartment</span>
                                            </h5>

                                            <div class="apartment_info flex-column justify-content-between align-items-start">
                                                <h5 class="m-0 p-0">{{ $apartment->title }}</h5>
                                                <div class="d-flex justify-content-between align-items-center gap-2 w-100">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <span>
                                                            <span class="fw-semibold fs-3">{{ $apartment?->rooms }}</span>
                                                            <span> rooms</span>
                                                        </span>
                                                        <span>
                                                            <span class="fw-semibold fs-3">{{ $apartment?->beds }}</span>
                                                            <span> beds</span>
                                                        </span>
                                                        <span>
                                                            <span
                                                                class="fw-semibold fs-3">{{ $apartment?->square_meters }}</span>
                                                            <span> mq</span>
                                                        </span>
                                                    </div>
                                                    <span>
                                                        <span class="fw-semibold fs-3">1000</span>
                                                        <span> views</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        @else
                        @endif
                        <div class="col-12 col-lg-4">
                            <div class="dashboard_card shadow p-4 h-100">
                                statistiche appartmento più visto
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="dashboard_card banner_card shadow p-4 h-100">
                                <h3 class="fs-5">
                                    Potrai anche visualizzare le statistiche dei tuoi annunci sponsorizzati per migliorare
                                    ulteriormente
                                    le tue vendite.
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <h5>

                    Grazie per
                    aver scelto la nostra piattaforma e buona fortuna con i tuoi affitti!

                </h5> --}}


            </div>
        </div>

    @endauth

    @guest
        <!-- the img must be in a link that bring you to the front office -->
        <img src="/storage/internal/logo_horizontal.svg" alt="">
        <h1 class="text-center">Log in to start rent your first apartment!</h1>


    @endguest
@endsection
