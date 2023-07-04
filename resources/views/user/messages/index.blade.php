@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>My Messages</h1>
        @include('partials.session_message')
        <table class="table">
            <thead>
                <tr>
                    <th>Message</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Lastname</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr>
                        <td>
                            <textarea readonly rows="4" style="resize: none; width: 100%">{{ $message->message }}</textarea>
                        </td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->lastname }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No messages found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
