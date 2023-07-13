@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @if (session('message'))
            <div class="col-12 pt-3">
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Success! </strong>
                    {{ session('message') }}
                </div>
            </div>
        @endif
        <div class="p-5 mb-4 rounded-3 shadow mt-3 dashboard_jumbotron">
            <div class="container-fluid d-flex flex-column justify-content-between gap-5">
                <div class="pb-5">
                    <h1 class="display-5 fw-bold">
                        Apartments
                    </h1>
                    <p class="col-md-8 fs-5">
                        {{ __('You can easily create, view, edit, and delete your rentals.') }}
                    </p>
                </div>
                <div class="pt-5 d-flex justify-content-between align-items-center">
                    <a type="button" class="btn back_btn d-flex align-items-center gap-2 shadow"
                        href="{{ route('user.dashboard') }}">
                        <i class="fa-solid fa-arrow-left-long"></i>
                        Back
                    </a>
                    <a type="button" class="btn new_apartment_btn d-flex align-items-center gap-2 shadow"
                        href="{{ route('user.apartments.create') }}">
                        <i class="fa-solid fa-house-medical"></i>
                        Add a new apartment
                    </a>
                </div>
            </div>
        </div>
        <div class="col d-flex justify-content-between py-3">
            {{-- <a type="button" class="btn back_btn d-flex align-items-center gap-2 shadow"
                href="{{ route('user.dashboard') }}">
                <i class="fa-solid fa-arrow-left-long"></i>
                Back
            </a> --}}

            {{-- <a type="button" class="btn new_apartment_btn d-flex align-items-center gap-2 shadow"
                href="{{ route('user.apartments.create') }}">
                <i class="fa-solid fa-house-medical"></i>
                Add a new apartment
            </a> --}}
        </div>


        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3">
            @forelse ($apartments as $index => $apartment)
                <div class="col">
                    <div class="card h-100 mb-3 p-3 card_shadow">
                        <div class="h-100 w-100 d-flex flex-column">
                            <div class="d-flex flex-column flex-md-row justify-content-between gap-3 p-1 h-100">
                                <div class="list_img_wrapper">
                                    {{-- img --}}
                                    <img src="{{ asset('/storage/' . $apartment->image) }}"
                                        onerror="this.src='{{ asset('/storage/internal/missing_img_v2.svg') }}'"
                                        class="" alt="{{ $apartment->title }}" />
                                </div>
                                <div>
                                    {{-- title, address --}}
                                    <div class="fw-semibold">
                                        {{ $apartment->title }}
                                    </div>

                                    <hr class="hr_margin_apartment justify-content-center">

                                    <div class="fst-italic">
                                        {{ $apartment->full_address }}
                                    </div>
                                </div>
                            </div>
                            {{-- actions --}}
                            <div class="d-flex justify-content-center align-self-end gap-3 pt-3">
                                {{-- show --}}
                                <a class="action_btn action_show p-2" title="Show details"
                                    href="{{ route('user.apartments.show', $apartment->slug) }}">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                {{-- messages --}}
                                <a class="action_btn action_messages p-2" title="Show messages"
                                    href="{{ route('user.messages.index', $apartment->slug) }}">
                                    <i class="fa-regular fa-comments">
                                    </i>
                                    @if ($messages_count[$index] > 0)
                                        <span class="badge">{{ $messages_count[$index] }}</span>
                                    @endif
                                </a>
                                {{-- edit --}}
                                <a class="action_btn action_edit p-2" title="Edit apartment"
                                    href="{{ route('user.apartments.edit', $apartment->slug) }}">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                {{-- sponsor --}}
                                <a class="action_btn action_sponsor p-2" title="Show details"
                                    href="{{ route('user.sponsorships.index', ['slug' => $apartment->slug]) }}">
                                    <i class="fa-solid fa-star"></i>
                                </a>
                                {{-- stats --}}
                                <a class="action_btn action_stats p-2" title="Stats apartment"
                                    href="{{ route('user.views.index', $apartment->slug) }}">
                                    <i class="fa-solid fa-chart-simple"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
    <div class="my-5">
        {{ $apartments->links('pagination::bootstrap-5') }}
    </div>
@endsection
