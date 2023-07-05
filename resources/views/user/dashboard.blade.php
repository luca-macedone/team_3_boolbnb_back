@extends('layouts.app')

@section('javascript')
    @vite(['resources/js/hide_login_confirmation.js'])
@endsection

@section('content')


        
        <!-- right -->

    @auth
    <div class="">
            <div class="container">
    <!-- THIS WILL DISAPPEAR -->
                <div id="log_box" class="log_box">
                    <div class="user_name">{{ Auth::user()->name }}</div>
                    <div class="">

                       
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">   
                        {{ session('status') }}
                        </div>
                        @endif
                    </div>
                        {{ __('You are logged in!') }}
                </div>

    <!-- END/THIS WILL DISAPPEAR -->


                <img src="/storage/internal/logo_horizontal.svg"  alt="">
                <h5>
                    Benvenuti nella nostra piattaforma di affitto case e appartamenti! Qui potrai mettere in affitto le tue proprietà, modificare i dati del tuo account e gestire tutti i tuoi annunzi in modo semplice e intuitivo. Puoi creare, visualizzare, modificare ed eliminare i tuoi affitti con facilità. Inoltre, se vuoi aumentare la visibilità dei tuoi annunci, puoi acquistare una sponsorship che li renderà visibili a un pubblico più vasto. Potrai anche visualizzare le statistiche dei tuoi annunci sponsorizzati per migliorare ulteriormente le tue vendite. Scegli tra le nostre sponsorizzazioni standard o specifiche per le tue esigenze. Grazie per aver scelto la nostra piattaforma e buona fortuna con i tuoi affitti!

                </h5>

                  
             </div>
    </div>
   
    @endauth

    @guest
    <!-- the img must be in a link that bring you to the front office -->
        <img src="/storage/internal/logo_horizontal.svg"  alt="">
        <h1 class="text-center">Log in to start rent your first apartment!</h1>

        
    @endguest


@endsection