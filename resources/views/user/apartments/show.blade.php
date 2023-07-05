@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row py-5">
            <div class="col ">

                <img src="{{ asset('/storage/uploads/' . $apartment->image) }}" class="img-fluid"
                    alt="{{ $apartment->title }}">

            </div>

            <div class="col">
                <h1>{{ $apartment->title }}</h1>
                <div> <strong>rooms: </strong>{{ $apartment->rooms }}</div>
                <div> <strong>beds: </strong>{{ $apartment->beds }}</div>
                <div> <strong>square meters: </strong>{{ $apartment->square_meters }}</div>
                <div> <strong>bathrooms: </strong>{{ $apartment->bathrooms }}</div>
                <div> <strong>full address: </strong>{{ $apartment->full_address }}</div>



                <h6><strong>Service:</strong></h6>
                <ul>

                    @forelse ($apartment->services as $service)
                        <li> {{ $service->name }}</li>
                    @empty
                        <div><strong>Service:</strong> n/a</div>
                    @endforelse
                    <ul>



            </div>

        </div>
    </div>
@endsection
