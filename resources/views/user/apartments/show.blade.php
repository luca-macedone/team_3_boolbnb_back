@extends('layouts.app')

@section('content')
    @include('partials.session_message')

    <div class="container" id="apartment_show">
        <div class="row align-items-start justify-content-center g-4">
            <div class="col-12 d-flex justify-content-between">

                <h1 class="text-center apartment_show_title">{{ $apartment->title }}</h1>

                <a type="button" class="btn back_btn d-flex align-items-center gap-2 shadow h-50 mt-1"
                    href="{{ route('user.apartments.index') }}">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    Back
                </a>

            </div>

            <div class="col-12 col-xl-8">
                <div class="apartment_show_img_wrapper">
                    <img src="{{ asset('/storage/' . $apartment->image) }}" class="apartment_show_img card_shadow"
                        alt="{{ $apartment->title }}">
                </div>
            </div>

            <div class="col-12 col-xl-4 d-flex flex-column gap-3">
                <div class="d-flex flex-column justify-content-center align-items-start gap-3 p-4 card_show">
                    <div class="d-flex justify-content-between align-items-center gap-4 w-100">
                        <div class="d-flex flex-column w-100 justify-content-center align-items-center"><span
                                class="fs-2">{{ $apartment->rooms }}</span>
                            <span>rooms</span>
                        </div>
                        <div class="d-flex flex-column w-100 justify-content-center align-items-center"><span
                                class="fs-2">{{ $apartment->beds }}</span>
                            <span>beds</span>
                        </div>
                        <div class="d-flex flex-column w-100 justify-content-center align-items-center"><span
                                class="fs-2">{{ $apartment->bathrooms }}</span>
                            <span>bathrooms</span>
                        </div>
                        <div class="d-flex flex-column w-100 justify-content-center align-items-center"><span
                                class="fs-2">{{ $apartment->square_meters }}</span>
                            <span>mq</span>
                        </div>
                    </div>
                    <div class="text-center w-100 py-3">{{ $apartment->full_address }}</div>
                    <ul class="d-flex flex-row align-items-start gap-3 flex-wrap list-unstyled">
                        @forelse ($apartment->services as $service)
                            <li> {{ $service->name }}</li>
                        @empty
                            <li>
                                <div>No services yet!</div>
                            </li>
                        @endforelse
                        <ul>
                </div>
                <div class="d-flex flex-column card_show p-4">
                    <div class="d-flex justify-content-center w-100 align-self-end gap-3 pt-3">
                        {{-- sponsor --}}
                        <a class="action_btn action_sponsor p-2" title="Show details"
                            href="{{ route('user.sponsorships.index', ['slug' => $apartment->slug]) }}">
                            <i class="fa-solid fa-star"></i>
                        </a>
                        {{-- show --}}
                        <a class="action_btn action_show p-2" title="Show details"
                            href="{{ route('user.apartments.show', $apartment->slug) }}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        {{-- messages --}}
                        <a class="action_btn action_messages p-2" title="Show messages"
                            href="{{ route('user.messages.index', $apartment->slug) }}">
                            <i class="fa-regular fa-comments"></i>
                        </a>
                        {{-- stats --}}
                        <a class="action_btn action_stats p-2" title="Stats apartment"
                            href="{{ route('user.views.index', $apartment->slug) }}">
                            <i class="fa-solid fa-chart-simple"></i>
                        </a>
                        {{-- edit --}}
                        <a class="action_btn action_edit p-2" title="Edit apartment"
                            href="{{ route('user.apartments.edit', $apartment->slug) }}">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        {{-- delete --}}
                        <button class="action_btn action_delete p-2" title="Delete apartment" data-bs-toggle="modal"
                            data-bs-target="{{ '#modal' . $apartment->id }}" title="{{ __('Delete') }}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        {{-- delete modal --}}
                        <div class="modal fade" id="{{ 'modal' . $apartment->id }}" tabindex="-1" data-bs-backdrop="false"
                            data-bs-keyboard="false" role="dialog" aria-labelledby="{{ 'modalTitle' . $apartment->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                role="document">
                                <div class="modal-content rounded-0">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger" id="{{ 'modalTitle' . $apartment->id }}">
                                            {{ __('Danger Zone') }}
                                        </h5>
                                        <button type="button" class="btn-close rounded-0" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>{{ __('This operation is irreversible.') }}</div>
                                        <div class="fw-semibold">{{ __('Are you sure?') }}</div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between gap-1">
                                        <button type="button" class="rounded btn btn-outline-dark"
                                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                                        <form action="{{ route('user.apartments.destroy', $apartment) }}" method="post"
                                            class="">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded btn btn-outline-danger">
                                                {{-- <i class="fa-solid fa-trash me-1"></i> --}}
                                                {{ __('Delete permanently') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
