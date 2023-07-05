@extends('layouts.app')

@section('javascript')
    @vite(['/resources/js/validations/apartment_validation.js'])
@endsection

@section('content')
    <div class="container py-5">
        @include('partials.validation_errors')
        <form action="{{ route('user.apartments.update', $apartment) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control  @error('title') is-invalid @enderror" name="title" id="title"
                    aria-describedby="helpId" placeholder="" value="{{ $apartment->title }}">
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
                    aria-describedby="helpId" placeholder="" value="{{ $apartment->rooms }}">
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
                    name="beds" id="beds" aria-describedby="helpId" placeholder="" value="{{ $apartment->beds }}">
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
                    id="square_meters" aria-describedby="helpId" placeholder="" value="{{ $apartment->square_meters }}">
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
                    class="form-control @error('bathrooms') is-invalid @enderror" name="bathrooms" id="bathrooms"
                    aria-describedby="helpId" placeholder="" value="{{ $apartment->bathrooms }}">
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
            <div class="d-flex gap-3 mb-3">
                <div class="img-wrapper">
                    @if ($apartment?->image)
                        <img class="img-fluid" src="{{ asset('/storage/uploads/' . $apartment->image) }}" alt="">
                    @else
                        <img class="img-fluid" src="{{ asset('/storage/internal/missing_image_replacement.webp') }}"
                            alt="Image Not Uploaded">
                    @endif

                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                        id="image" aria-describedby="imageHelper">
                    <div>
                        <small id="helpId" class="form-text text-muted">Insert the image here</small>
                    </div>
                </div>
            </div>
            {{-- full address --}}
            <div class="mb-3">
                <label for="full_address" class="form-label">Full address</label>
                <input type="text" class="form-control @error('full_address') is-invalid @enderror"
                    name="full_address" id="full_address" aria-describedby="helpId" placeholder=""
                    value="{{ $apartment->full_address }}" />
                <div>
                    <small id="helpId" class="form-text text-muted">Full address required, maximum 255
                        characters</small>
                </div>
                <div id="full_address_error" class="alert alert-danger border-0 my-1 d-none">
                    <strong class="fw-semibold">Error! </strong>
                    <span class="fw-lighter">Please insert a valid text (min length 1 char, max lenght 255 chars)</span>
                </div>
            </div>
            {{-- visibility --}}
            <div>
                <label for="services" class="form-label">Visibility</label>
            </div>
            <div class="form-check d-flex flex-column align-items-start">
                {{-- <input class="form-check-input @error('visibility') is-invalid @enderror" type="checkbox" value="true"
                    id="visibility" @if ($apartment->visibility == '1') checked @endif>
                <label class="form-check-label" for="visibility">
                    Is visible
                </label> --}}
                <div>
                    <input class="form-check-input" type="radio" name="visibility" id="visibility-true"
                        value="1" @if ($apartment->visibility == '1') checked @endif>
                    <label class="form-check-label" for="visibility-true">
                        Visible
                    </label>
                </div>
                <div>
                    <input class="form-check-input" type="radio" name="visibility" id="visibility-false"
                        value="0" @if ($apartment->visibility == '0') checked @endif>
                    <label class="form-check-label" for="visibility-false">
                        Not visible
                    </label>
                </div>
            </div>
            <small class="form-text text-muted d-inline-block mb-3">
                Select if you want apartment to be visible in search (default: true)
            </small>
            {{-- services --}}
            <div>
                <label for="services" class="form-label">Services</label>
            </div>
            <div class="d-flex justify-content-start align-items-center flex-wrap gap-3 mb-5">
                @forelse ($services as $index => $service)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $service->id }}"
                            id="{{ 'service' . $index }}" name="services[]"
                            {{ $apartment->services->contains($service) ? 'checked' : '' }}>
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
