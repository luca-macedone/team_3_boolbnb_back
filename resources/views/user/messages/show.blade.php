@extends('layouts.app')

@section('content')
    <div class="container">
        @include('partials.session_message')

        <div class="p-5 mb-4 rounded-3 shadow mt-3 dashboard_jumbotron">
            <div class="container-fluid d-flex flex-column justify-content-between gap-5">
                <div class="pb-5">
                    <h1 class="display-5 fw-bold">
                        Message
                    </h1>
                    <p class="col-md-8 fs-5">
                        {{ __('Here you can view the individual message received and delete it.') }}
                    </p>
                </div>
                <div class="pt-5 d-flex justify-content-between align-items-center">
                    <a type="button" class="btn back_btn d-flex align-items-center gap-2 shadow"
                        href="{{ route('user.messages.index', $message->apartment->slug) }}">
                        <i class="fa-solid fa-arrow-left-long"></i>
                        Back
                    </a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                Message Details
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea readonly class="form-control" id="message" rows="4">{{ $message->message }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input readonly type="text" class="form-control" id="email" value="{{ $message->email }}">
                </div>
                <div class="d-flex justify-content-end">
                    <button class="action_btn action_delete p-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel"><i class="fa-solid fa-trash"></i></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this message?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{ route('user.messages.destroy', $message) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
