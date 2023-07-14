@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.session_message')

        <div class="px-5 py-3 mb-4 rounded-3 shadow mt-3 dashboard_jumbotron">
            <div class="container-fluid d-flex flex-column justify-content-between gap-2">
                <div class="pb-3">
                    <h1 class="fs-1 fw-semibold">
                        Message
                    </h1>
                    <p class="col-md-8 fs-5">
                        {{ __('Here you can view the individual message received and delete it.') }}
                    </p>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <a type="button" class="btn back_btn d-flex align-items-center gap-2 shadow"
                        href="{{ route('user.messages.index', $message->apartment->slug) }}">
                        <i class="fa-solid fa-arrow-left-long"></i>
                        Back
                    </a>
                </div>
            </div>
        </div>

        <div class="card message_card border-0 shadow">
            <div class="card_header p-3 pb-2 border-bottom d-flex justify-content-between">
                <span>Message Details</span>
                @if ($message->name && $message->lastname)
                    <span> from </span>
                    <strong class="fw-semibold"> {{ $message->name . ' ' . $message->lastname }}</strong>
                @else
                @endif
                <span>Email: <span class="text_italic">{{ $message->email }}</span></span>
            </div>
            <div class="card-body d-flex justify-content-between align-items-start">
                <div class="me-3">
                    <div>{{ $message->message }}</div>
                </div>
                {{-- delete btn --}}
                <button class="action_btn action_delete p-2" title="Delete apartment" title="{{ __('Delete') }}"
                    id="open_modal_btn">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </div>




        {{-- delete modal --}}
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

                    <form action="{{ route('user.messages.destroy', $message) }}" method="post" class="">
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
