@extends('layouts.app')

@section('javascript')
    @vite(['/resources/js/validations/apartment_validation.js'])
@endsection

@section('content')
    <div class="container py-5">
        @include('partials.validation_errors')
        <form action="{{ route('user.apartments.store') }}" method="post" enctype="multipart/form-data"
            id="apartment_creation_form">
            @csrf
            {{-- title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    aria-describedby="helpId" placeholder="Type the name of the apartment here" value="{{ old('title') }}">
                <div>
                    <small id="helpId" class="form-text text-muted">Name required, maximum 255 characters</small>
                </div>
                <div id="title_error" class="alert alert-danger border-0 my-1 d-none">
                    <strong class="fw-semibold">Error! </strong>
                    <span class="fw-lighter">
                        Please insert a valid text (min lenght 1 char, max lenght 255 chars)
                    </span>
                </div>

            </div>
            {{-- rooms --}}
            <div class="mb-3">
                <label for="rooms" class="form-label">Rooms</label>
                <input type="number" min="1" step="1"
                    class="form-control @error('rooms') is-invalid @enderror" name="rooms" id="rooms"
                    aria-describedby="helpId" placeholder="Enter the number of rooms" value="{{ old('rooms') }}">
                <div>
                    <small id="helpId" class="form-text text-muted">Insert a numerical value</small>
                </div>
                <div id="rooms_error" class="alert alert-danger border-0 my-1 d-none">
                    <strong class="fw-semibold">Error! </strong>
                    <span class="fw-lighter">
                        Please insert a valid number (minimum number is 1)
                    </span>
                </div>
            </div>
            {{-- beds --}}
            <div class="mb-3">
                <label for="beds" class="form-label">Beds</label>
                <input type="number" min="1" step="1" class="form-control @error('beds') is-invalid @enderror"
                    name="beds" id="beds" aria-describedby="helpId" placeholder="Enter the number of beds"
                    value="{{ old('beds') }}">
                <div>
                    <small id="helpId" class="form-text text-muted">Insert a numerical value</small>
                </div>
                <div id="beds_error" class="alert alert-danger border-0 my-1 d-none">
                    <strong class="fw-semibold">Error! </strong>
                    <span class="fw-lighter">
                        Please insert a valid number (minimum number is 1)
                    </span>
                </div>
            </div>
            {{-- square meters --}}
            <div class="mb-3">
                <label for="square_meters" class="form-label">Square meters</label>
                <input type="number" min="8" step="1"
                    class="form-control @error('square_meters') is-invalid @enderror" name="square_meters"
                    id="square_meters" aria-describedby="helpId" placeholder="Enter the number of square meters"
                    value="{{ old('square_meters') }}">
                <div>
                    <small id="helpId" class="form-text text-muted">Insert a numerical value, minimum 8 square
                        meters</small>
                </div>
                <div id="square_meters_error" class="alert alert-danger border-0 my-1 d-none">
                    <strong class="fw-semibold">Error! </strong>
                    <span class="fw-lighter">
                        Please insert a valid number (minimum number is 8)
                    </span>
                </div>
            </div>
            {{-- bathrooms --}}
            <div class="mb-3">
                <label for="bathrooms" class="form-label">Bathrooms</label>
                <input type="number" min="1" step="1"
                    class="form-control  @error('bathrooms') is-invalid @enderror" name="bathrooms" id="bathrooms"
                    aria-describedby="helpId" placeholder="Enter the number of bathrooms" value="{{ old('bathrooms') }}">
                <div>
                    <small id="helpId" class="form-text text-muted">Insert a numerical value</small>
                </div>
                <div id="bathrooms_error" class="alert alert-danger border-0 my-1 d-none">
                    <strong class="fw-semibold">Error! </strong>
                    <span class="fw-lighter">
                        Please insert a valid number (minimum number is 1)
                    </span>
                </div>
            </div>
            {{-- image --}}
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                    id="image" aria-describedby="helpId" placeholder="Insert the image here"
                    value="{{ old('image') }}">
                <div>
                    <small id="helpId" class="form-text text-muted">Insert the image here</small>
                </div>
            </div>
            {{-- full address --}}
            <div class="mb-3">
                <label for="full_address" class="form-label">Full address</label>
                <input type="text" class="form-control @error('full_address') is-invalid @enderror"
                    name="full_address" id="full_address" aria-describedby="helpId"
                    placeholder="Insert the full address here" value="{{ old('full_address') }}">
                <div>
                    <small id="helpId" class="form-text text-muted">Full address required, maximum 255
                        characters</small>
                </div>
                <div id="full_address_error" class="alert alert-danger border-0 my-1 d-none">
                    <strong class="fw-semibold">Error! </strong>
                    <span class="fw-lighter">Please insert a valid text (min lenght 1 char, max lenght 255 chars)</span>
                </div>
            </div>
            {{-- visibility --}}
            <div class="form-check pb-3">
                <input class="form-check-input @error('visibility') is-invalid @enderror" type="checkbox" value="true"
                    id="visibility" checked>
                <label class="form-check-label" for="visibility" value="{{ old('visibility') }}">
                    Is visible
                </label>
            </div>
            {{-- services --}}
            <label for="services" class="form-label">Services</label>
            <div class="d-flex justify-content-start align-items-center flex-wrap gap-3">
                @forelse ($services as $index => $service)
                    <div class="form-check">
                        <input class="services_input form-check-input @error('service') is-invalid @enderror"
                            type="checkbox" value="{{ $service->id }}" name="services[]" id="{{ 'service' . $index }}"
                            {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ 'service' . $index }}">
                            {{ $service->name }}
                        </label>
                    </div>
                @empty
                @endforelse
            </div>
            <div id="services_error" class="alert alert-danger border-0 my-1 d-none">
                <strong class="fw-semibold">Error! </strong>
                <span class="fw-lighter">Please select at least 1 service</span>
            </div>

            <div class="mt-3">
                <a type="button" href="{{ route('user.apartments.index') }}" class="btn btn-primary">Back</a>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>
@endsection
