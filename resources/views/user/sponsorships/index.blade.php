@extends('layouts.app')

@section('content')
    <section class="jumbotron shadow jumbotron-fluid rounded-4 mt-3 py-5 dashboard_jumbotron">
        <div class="container">
            <div class="row mx-3">
                <h1 class="mb-4">Sponsorships</h1>
                <p class="mb-3 fs-5">
                    {{ __('Give your apartment an extra boost to reach as many clients as possible! Below, you can find the right sponsorship for you! Choose from our standard sponsorships or tailor-made options to meet your needs.') }}
                </p>
            </div>
        </div>
    </section>

    <div class="p-5 mt-3 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold m-0 p-0">{{ $apartment->title }}</h1>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center py-3 g-3">
        @forelse ($sponsorships as $sponsorship)
            <div class="col">
                <div class="card sponsorship_card shadow d-flex flex-column justify-content-center gap-3 align-items-center h-100"
                    id="{{ 'sponsor_' . $sponsorship->name }}">
                    <div
                        class="card-body p-4 h-100 w-100 d-flex flex-column align-items-center justify-content-center gap-5">
                        <div class="fw-semibold text-center p-2 rounded-pill sponsorship_name">
                            {{ $sponsorship->name }}
                        </div>
                        <div class="d-flex flex-column gap-3 align-items-center">
                            <div class="" id="duration">
                                <span class="me-2">Duration:</span>
                                <span class="fs-3 fw-semibold">
                                    {{ $sponsorship->duration }}
                                </span>
                                <small class="">hours</small>
                            </div>
                            <div class="" id="price">
                                <span>Price:</span>
                                <span class="ms-2 fw-regular fs-4">€{{ $sponsorship->price }}</span>
                            </div>
                        </div>
                        <a href="{{ route('user.payment', ['apartment_id' => $apartment->id, 'sponsorship_id' => $sponsorship->id]) }}"
                            class="cart px-5 py-3 rounded-pill text-uppercase text-decoration-none" type="button">
                            <i class="fa-solid fa-dollar"></i>
                            Buy
                        </a>

                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
@endsection
