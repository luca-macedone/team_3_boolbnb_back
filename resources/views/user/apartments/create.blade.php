@extends('layouts.app')

@section('content')
    <div class="container py-5">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <strong>Error</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('user.apartments.store') }}" method="post">
            @csrf
            {{-- title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId"
                    placeholder="">
                <small id="helpId" class="form-text text-muted">Help text</small>
            </div>
            {{-- rooms --}}
            <div class="mb-3">
                <label for="rooms" class="form-label">Rooms</label>
                <input type="number" min="1" step="1" class="form-control" name="rooms" id="rooms"
                    aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Help text</small>
            </div>
            {{-- beds --}}
            <div class="mb-3">
                <label for="beds" class="form-label">Beds</label>
                <input type="number" min="1" step="1" class="form-control" name="beds" id="beds"
                    aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Help text</small>
            </div>
            {{-- square meters --}}
            <div class="mb-3">
                <label for="square_meters" class="form-label">Square meters</label>
                <input type="number" min="8" step="10" class="form-control" name="square_meters"
                    id="square_meters" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Help text</small>
            </div>
            {{-- bathrooms --}}
            <div class="mb-3">
                <label for="bathrooms" class="form-label">Bathrooms</label>
                <input type="number" min="1" step="1" class="form-control" name="bathrooms" id="bathrooms"
                    aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-muted">Help text</small>
            </div>
            {{-- image --}}
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" name="image" id="image" aria-describedby="helpId"
                    placeholder="">
                <small id="helpId" class="form-text text-muted">Help text</small>
            </div>
            {{-- full address --}}
            <div class="mb-3">
                <label for="full_address" class="form-label">Full address</label>
                <input type="text" class="form-control" name="full_address" id="full_address" aria-describedby="helpId"
                    placeholder="">
                <small id="helpId" class="form-text text-muted">Help text</small>
            </div>
            {{-- visibility --}}
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="true" id="visibility" checked>
                <label class="form-check-label" for="visibility">
                    Is visible
                </label>
            </div>
            {{-- services --}}
            <label for="services" class="form-label">Services</label>
            <div class="d-flex justify-content-start align-items-center flex-wrap gap-3 mb-5">
                @forelse ($services as $index => $service)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $service->id }}" name="services[]"
                            id="{{ 'service' . $index }}"
                            {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ 'service' . $index }}">
                            {{ $service->name }}
                        </label>
                    </div>
                @empty
                @endforelse

            </div>

            <a type="button" href="{{ route('user.apartments.index') }}" class="btn btn-primary">Back</a>
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
@endsection
