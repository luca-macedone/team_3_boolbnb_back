@extends('layouts.app')

@section('content')
    <div class="container">
        
            


        <div class="col d-flex justify-content-between py-3">

        <h1 class="text-center pb-5"><strong>{{ $apartment->title }}</strong></h1>

            <a type="button" class="btn back_btn d-flex align-items-center gap-2 shadow h-50 mt-1"
                href="{{ route('user.apartments.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i>
                    Back
            </a>
        
        </div>
  
        <div class="row">
        
            <div class="col-12 col-xl-8 d-flex justify-content-center pb-4">

                <img src="{{ asset('/storage/uploads/' . $apartment->image) }}"  class="img-fluid card_shadow rounded-1"
                    alt="{{ $apartment->title }}">

            </div>
           
           
            <div class="col-12 col-xl-4 d-flex flex-wrap flex-column card_show gap-3">
                
                <h3 class="text-center pt-3"><strong>DETAILS:</strong></h3>
               
               <div class="col-5 gap-2">
                    <div> <strong>Rooms: </strong>{{ $apartment->rooms }}</div>
                    <div> <strong>Beds: </strong>{{ $apartment->beds }}</div>
                    <div> <strong>Square meters: </strong>{{ $apartment->square_meters }}</div>
                    <div> <strong>Bathrooms: </strong>{{ $apartment->bathrooms }}</div>
                    <div> <strong>Full address: </strong>{{ $apartment->full_address }}</div>


               </div>

               <hr class="hr_margin justify-content-center">

               <div class="col-12 bottom">
                   <h6><strong>Service:</strong></h6>
                   <ul class="d-flex gap-4 flex-wrap">

                         @forelse ($apartment->services as $service)
                             <li> {{ $service->name }}</li>
                         @empty
                             <div><strong>Service:</strong> n/a</div>
                         @endforelse
                    <ul>
               </div>



            </div>

        </div>
    </div>
@endsection
