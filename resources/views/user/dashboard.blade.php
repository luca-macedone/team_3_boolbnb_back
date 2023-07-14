@extends('layouts.app')

{{-- @section('javascript')
    @vite(['resources/js/hide_login_confirmation.js'])
@endsection --}}

@section('content')
    <!-- right -->

    @auth
        <div class="">
            <div class="container">
                <div class="p-5 mb-3 mt-3 shadow dashboard_jumbotron">
                    <div class="container py-3">
                        <h1 class="display-5 fw-semibold mb-5">
                            {{ __('Welcome to our platform for renting houses and apartments!') }}
                        </h1>
                        <p class="col-md-8 fs-5">
                            {{ __('Here you can rent out your properties, update your account information, and manage all your listings in a simple and intuitive way.') }}
                        </p>
                    </div>
                </div>
                {{-- Jumbotron --}}
                <div class="container-fluid" id="dashboard_content">
                    <div class="row g-3">
                        <div class="col-12 col-lg-6">
                            <div class="dashboard_card banner_card shadow p-4 h-100">
                                <span class="fs-5 text-center d-inline-block h-100 d-flex align-items-center">
                                    {{ __('Furthermore, if you want to increase the visibility of your listings, you can purchase a sponsorship that will make them visible to a wider audience.') }}
                                </span>
                            </div>
                        </div>
                        {{-- Most viewed apartment --}}
                        @if ($most_relevant_apartment)
                            <div class="col-12 col-lg-6">
                                <a href="{{ route('user.apartments.show', $most_relevant_apartment->slug) }}">
                                    <div class="dashboard_card apartment_card shadow p-4 h-100">
                                        <img src="{{ asset('/storage/' . $most_relevant_apartment->image) }}"
                                            onerror="this.src='{{ asset('/storage/internal/missing_img_v2.svg') }}'"
                                            class="card-img" alt="{{ $most_relevant_apartment->title }}" />
                                        <div class="card-img-overlay">
                                            <h5 class="section_title text-center m-0 p-0">
                                                <i class="fa-solid fa-ranking-star"></i>
                                                <span class="ms-2">Most relevant apartment</span>
                                            </h5>

                                            <div class="apartment_info flex-column justify-content-between align-items-start">
                                                <h5 class="m-0 p-0">{{ $most_relevant_apartment->title }}</h5>
                                                <div class="d-flex justify-content-between align-items-center gap-2 w-100">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <span>
                                                            <span
                                                                class="fw-semibold fs-3">{{ $most_relevant_apartment?->rooms }}</span>
                                                            <span> rooms</span>
                                                        </span>
                                                        <span>
                                                            <span
                                                                class="fw-semibold fs-3">{{ $most_relevant_apartment?->beds }}</span>
                                                            <span> beds</span>
                                                        </span>
                                                        <span>
                                                            <span
                                                                class="fw-semibold fs-3">{{ $most_relevant_apartment?->square_meters }}</span>
                                                            <span> mq</span>
                                                        </span>
                                                    </div>
                                                    <span>
                                                        <span
                                                            class="fw-semibold fs-3">{{ $most_relevant_apartment?->total_views }}</span>
                                                        <span> views</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        @else
                            <div class="col-12 col-lg-6">
                                <div
                                    class="dashboard_card apartment_card shadow p-4 h-100 d-flex justify-content-center align-items-center">
                                    No apartments yet!
                                </div>
                            </div>
                        @endif
                        {{-- Statistics --}}
                        <div class="col-12 col-lg-4">
                            <div class="dashboard_card statistic shadow p-4 h-100">

                                <h3 class=""><strong class="fw-semibold fs-5">Statistics</strong></h3>

                                <div class="">
                                    You have: <span class="">
                                        @if ($apartments)
                                            <strong class="fw-semibold fs-5 mx-2">{{ $apartments?->count() }}</strong>
                                            @if ($apartments?->count() > 1)
                                                apartments
                                            @else
                                                apartment
                                            @endif
                                        @else
                                            0
                                        @endif
                                    </span>

                                </div>
                                <div class="">

                                    Your total views:<strong class="fw-semibold fs-5 ms-2">{{ $totalViewsSum }}</strong>

                                </div>
                                <div class="">

                                    Average views: <strong class="fw-semibold fs-5">{{ $mediumView }}</strong>
                                    </strong>
                                </div>
                                @if ($most_relevant_apartment)
                                    <div class="">
                                        Most seen:
                                        <strong
                                            class="fw-normal text_italic ms-2">{{ $most_relevant_apartment?->title }}</strong>
                                        <br />
                                        with
                                        <strong
                                            class="fw-semibold fs-5 mx-2">{{ $most_relevant_apartment?->total_views }}</strong>
                                        views
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-lg-8">
                            <div class="dashboard_card banner_card shadow p-4 h-100">
                                <h3 class="fs-5 text-center h-100 d-flex align-items-center">
                                    {{ __('You will also be able to view the statistics of your sponsored listings to further improve your sales.') }}
                                </h3>
                            </div>
                        </div>
                        {{-- messages --}}
                        <div class="col-12 col-lg-8">
                            <div class="dashboard_card banner_card shadow p-4 h-100">
                                <h3 class="fs-5 text-center h-100 d-flex align-items-center">
                                    {{ __('Stay connected with your guests and never miss a beat with real-time updates on the messages received for each of your properties. ') }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="dashboard_card new_messages shadow p-4 h-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class=""><strong class="fw-semibold fs-5">New Messages</strong></h3>
                                    <div id="total_messages">
                                        @if ($messages_sum > 0)
                                            <span class="badge badge_new shadow">
                                                <strong class="fw-semibold">{{ $messages_sum }}</strong>
                                            </span>
                                        @else
                                            <span class="badge badge_default shadow">
                                                <strong class="fw-semibold">{{ $messages_sum }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div id="messages_notifications">
                                    <div>
                                        @forelse ($apartments as $index => $apartment)
                                            @if ($messages_count[$index] == 1)
                                                <p><strong>{{ $messages_count[$index] }}</strong> new message for the <span
                                                        class="text_italic">{{ $apartment->title }}</span> apartment!</p>
                                            @elseif ($messages_count[$index] > 1)
                                                <p><strong>{{ $messages_count[$index] }}</strong> new messages for the <span
                                                        class="text_italic">{{ $apartment->title }}</span> apartment</p>
                                            @endif
                                        @empty
                                        @endforelse
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
