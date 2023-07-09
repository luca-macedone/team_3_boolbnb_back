@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.session_message')
        <div class="p-5 mb-4 rounded-3 shadow mt-3 dashboard_jumbotron">
            <div class="container-fluid d-flex flex-column justify-content-between gap-5">
                <div class="pb-5">
                    <h1 class="display-5 fw-bold">
                        Messages received from my apartment
                    </h1>
                    <p class="col-md-8 fs-5">
                        {{ __('Here you can view the received messages of your apartment and delete them.') }}
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

        <table class="table">
            <thead>
                <tr>
                    <th>Message</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr>
                        <td>
                            <textarea readonly rows="1" style="resize: none; width: 100%">{{ $message->message }}</textarea>
                        </td>
                        <td>{{ $message->email }}</td>

                        <td class="d-flex gap-2">
                            <a class="action_btn action_edit p-2" title="Edit apartment"
                                href="{{ route('user.messages.show', $message) }}">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <button class="action_btn action_delete p-2" title="Delete apartment" data-bs-toggle="modal"
                                data-bs-target="{{ '#modal' . $message->id }}" title="{{ __('Delete') }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            {{-- delete modal --}}
                            <div class="modal fade" id="{{ 'modal' . $message->id }}" tabindex="-1"
                                data-bs-backdrop="false" data-bs-keyboard="false" role="dialog"
                                aria-labelledby="{{ 'modalTitle' . $message->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                    role="document">
                                    <div class="modal-content rounded-0">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger" id="{{ 'modalTitle' . $message->id }}">
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
                                            <form action="{{ route('user.messages.destroy', $message) }}" method="post"
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
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No messages found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
