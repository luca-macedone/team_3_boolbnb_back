@extends('layouts.app')

@section('content')
    <div class="offcanvas offcanvas-end p-4" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Cart</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
        </div>
        <div class="offcanvas-footer p-0">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="fw-bold">Total</p>
                </div>
                <div>
                    <p>€100</p>
                </div>
            </div>
            <div>
                <button class="btn text-uppercase">go to checkout</button>
            </div>

            <div>
                <button class="btn text-uppercase">continue shopping</button>
            </div>
        </div>
    </div>
    <section class="jumbotron shadow jumbotron-fluid rounded-4 mt-3 py-5 dashboard_jumbotron">
        <div class="container">
            <div class="row mx-3">
                <h1 class="mb-4">Sponsorships</h1>
                <p class="mb-3 fs-5">
                    Give to your apartment an extra boost to reach as many clients as possible! Here below you
                    can find the right sponsorship for you! Scegli tra le nostre sponsorizzazioni standard o specifiche per
                    le tue esigenze.
                </p>
            </div>
        </div>
    </section>
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
                        <button class="cart px-5 py-3 rounded-pill text-uppercase" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                            add to cart
                            <i class="fa-solid fa-cart-plus ms-2"></i>
                        </button>

                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
    </div>
    </script>
@endsection
