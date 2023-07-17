@extends('layouts.app')

@section('content')
    @include('partials.session_message')
    @include('partials.validation_errors')
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

            <div class="col-12 col-xl-7">
                <div class="apartment_show_img_wrapper">
                    <img src="{{ asset('/storage/' . $apartment->image) }}"
                        onerror="this.src='{{ asset('/storage/internal/missing_img_v2.svg') }}'"
                        class="apartment_show_img card_shadow" alt="{{ $apartment->title }}" />
                </div>
            </div>

            <div class="col-12 col-xl-5 d-flex flex-column gap-3">
                <div class="d-flex flex-column justify-content-center align-items-start gap-3 p-4 card_show">
                    <div class="d-flex justify-content-between align-items-center gap-2 w-100">
                        @if ($apartment->rooms)
                            <div class="d-flex flex-column w-100 justify-content-center align-items-center"><span
                                    class="fs-2">{{ $apartment->rooms }}</span>
                                <span>rooms</span>
                            </div>
                        @endif
                        @if ($apartment->beds)
                            <div class="d-flex flex-column w-100 justify-content-center align-items-center"><span
                                    class="fs-2">{{ $apartment->beds }}</span>
                                <span>beds</span>
                            </div>
                        @endif
                        @if ($apartment->bathrooms)
                            <div class="d-flex flex-column w-100 justify-content-center align-items-center"><span
                                    class="fs-2">{{ $apartment->bathrooms }}</span>
                                <span>bathrooms</span>
                            </div>
                        @endif
                        @if ($apartment->square_meters)
                            <div class="d-flex flex-column w-100 justify-content-center align-items-center"><span
                                    class="fs-2">{{ $apartment->square_meters }}</span>
                                <span>mq</span>
                            </div>
                        @endif
                    </div>
                    @if ($apartment->full_address)
                        <div class="text-center w-100 py-3">{{ $apartment->full_address }}</div>
                    @endif
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
                <div class="d-flex flex-column card_show p-4 mb-5">
                    <div class="d-flex justify-content-center w-100 align-self-end gap-2 ">
                        {{-- sponsor --}}
                        <a class="action_btn action_sponsor p-2" title="Show details"
                            href="{{ route('user.sponsorships.index', ['slug' => $apartment->slug]) }}">
                            <i class="fa-solid fa-star"></i>
                        </a>
                        {{-- show --}}
                        <a class="action_btn action_show p-2" title="Show public page"
                            href="{{ "http://localhost:5174/search/$apartment->slug" }}">
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
                        <button class="action_btn action_delete p-2" id="open_modal_btn" title="Delete apartment"
                            title="{{ __('Delete') }}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        {{-- delete modal --}}
                        {{-- <div class="modal" id="{{ 'modal_' . $apartment->id }}" tabindex="-1" data-bs-backdrop="false"
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

                        {{ __('Delete permanently') }}
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}




                    </div>
                </div>
            </div>

        </div>
        <div class="d-none delete_modal shadow" id="delete_apartment_modal">
            <div class="h-100 w-100 d-flex flex-column justify-content-center align-items-center gap-5 p-5">
                <div class="d-flex flex-column gap-2">
                    <strong class="text-danger">This operation is irreversible!</strong>
                    <span>Are you sure you want to proceed?</span>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-outline-dark" id="close_modal_btn">
                        close
                    </button>

                    <form action="{{ route('user.apartments.destroy', $apartment) }}" method="post" class="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded btn btn-outline-danger">

                            {{ __('Delete permanently') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const open_modal_bnt = document.getElementById('open_modal_btn');
        const close_modal_bnt = document.getElementById('close_modal_btn');
        const modal_el = document.querySelector('#delete_apartment_modal');

        open_modal_bnt.addEventListener('click', e => {
            // console.log('open')
            modal_el.classList.toggle('d-none');

        })

        close_modal_bnt.addEventListener('click', e => {
            // console.log('close')
            modal_el.classList.toggle('d-none');
        })
    </script>
@endsection
