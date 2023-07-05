@extends('layouts.app')

@section('content')
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasRightLabel">Cart</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
  </div>
  <div class="offcanvas-footer">
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
    <div class="container py-3">
        <h1 class="mb-3">Sponsorships</h1>
        <div class="my-3">
            <h4>Give to your apartment an extra boost to reach as many clients as possible! Here below you can find the right sponsorship for you!</h4>
        </div>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-3 g-3 py-3">
            @forelse ($sponsorships as $sponsorship)
                <div class="col">
                    <div class="card p-3 h-100" id="{{'sponsor_' . $sponsorship->name}}">
                        <div class="card-body text-center mb-0">
                            <div class="fw-bold text-center" id="name">{{ $sponsorship->name }}</div>
                            <div class="my-3" id="duration">Duration: {{$sponsorship->duration}} hours</div>
                            <div class="my-3" id="price">Price: €{{$sponsorship->price}}</div>
                        </div>
                        <div class="text-center">
                        <button class="cart" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="fa-solid fa-plus"></i> ADD TO CART</button>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
    </script>
@endsection
