@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        @include('partials.session_message')
        <div class="p-5 mb-4 rounded-3 shadow mt-3 dashboard_jumbotron">
            <div class="container-fluid d-flex flex-column justify-content-between gap-5">
                <div class="pb-2">
                    <h1 class="display-6 fw-bold">
                        Messages received for your apartment
                    </h1>
                    <p class="col-md-8 fs-6">
                        {{ __('Here you can view the messages received for your apartment.') }}
                    </p>
                </div>
                <div class="pt-5 d-flex justify-content-between align-items-center">
                    <a type="button" class="btn back_btn d-flex align-items-center gap-2 shadow"
                        href="{{ route('user.apartments.index') }}">
                        <i class="fa-solid fa-arrow-left-long"></i>
                        Back
                    </a>
                </div>
            </div>
        </div>
        <div class="row gap-2">
            @forelse ($messages as $message)
                <div class="col-12">
                    <div
                        class="card message_card d-flex flex-row justify-content-between align-items-start gap-2 border-0 shadow p-3">
                        <div class="me-3">
                            <div class="fw-semibold text_italic">
                                {{ $message->email }}
                            </div>
                            <hr class="my-1">

                            <div class="@if ($message->is_read == 0) fw-bold @endif message_box" readonly>
                                {{ $message->message }}
                            </div>

                        </div>
                        <div class="action_box d-flex">
                            {{-- show btn --}}
                            <a onclick="{{ $message->mark_messages($message) }}" class="me-3 action_btn action_show p-2"
                                href="{{ route('user.messages.show', $message) }}" title="Show Message">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
@endsection
