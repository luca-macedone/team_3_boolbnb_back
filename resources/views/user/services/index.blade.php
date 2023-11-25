@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <h1 class="mb-3">Services</h1>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-6 g-3">
            {{-- <div class="col-12 d-flex justify-content-end align-items-center">
                <a type="button" class="btn btn-outline-info" href="{{ route('user.services.create') }}">Add new Service</a>
            </div> --}}
            @forelse ($services as $service)
                <div class="col">
                    <div class="card p-3 h-100">
                        <div class="card-title mb-0">
                            {{ $service->name }}
                        </div>
                        @if ($service?->description)
                            <div class="card-body">
                                {{ $service->description }}
                            </div>
                        @endif
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
@endsection
