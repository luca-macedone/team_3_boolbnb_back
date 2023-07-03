@extends('layouts.app')

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
                <small id="helpId" class="form-text text-muted">Name required, maximum 255 characters</small>
            </div>
            {{-- rooms --}}
            <div class="mb-3">
                <label for="rooms" class="form-label">Rooms</label>
                <input type="number" min="1" step="1"
                    class="form-control @error('rooms') is-invalid @enderror" name="rooms" id="rooms"
                    aria-describedby="helpId" placeholder="" value="{{ $apartment->rooms }}">
                <small id="helpId" class="form-text text-muted">Insert a numerical value</small>
            </div>
            {{-- beds --}}
            <div class="mb-3">
                <label for="beds" class="form-label">Beds</label>
                <input type="number" min="1" step="1" class="form-control @error('beds') is-invalid @enderror"
                    name="beds" id="beds" aria-describedby="helpId" placeholder="" value="{{ $apartment->beds }}">
                <small id="helpId" class="form-text text-muted">Insert a numerical value</small>
            </div>
            {{-- square meters --}}
            <div class="mb-3">
                <label for="square_meters" class="form-label">Square meters</label>
                <input type="number" min="8" step="10"
                    class="form-control @error('square_meters') is-invalid @enderror" name="square_meters"
                    id="square_meters" aria-describedby="helpId" placeholder="" value="{{ $apartment->square_meters }}">
                <small id="helpId" class="form-text text-muted">Insert a numerical value, minimum 8 square meters</small>
            </div>
            {{-- bathrooms --}}
            <div class="mb-3">
                <label for="bathrooms" class="form-label">Bathrooms</label>
                <input type="number" min="1" step="1"
                    class="form-control @error('bathrooms') is-invalid @enderror" name="bathrooms" id="bathrooms"
                    aria-describedby="helpId" placeholder="" value="{{ $apartment->bathrooms }}">
                <small id="helpId" class="form-text text-muted">Insert a numerical value</small>
            </div>
            {{-- image --}}
            <div class="d-flex gap-3 mb-3">
                <img width="100" src="{{ asset('storage/' . $apartment->image) }}" alt="">
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image"
                        id="image" aria-describedby="imageHelper">
                    <small id="imageHelper" class="form-text text-muted">
                        Insert the image here
                    </small>
                </div>
            </div>
            {{-- full address --}}
            <div class="mb-3">
                <label for="full_address" class="form-label">Full address</label>
                <input type="text" class="form-control @error('full_address') is-invalid @enderror" name="full_address"
                    id="full_address" aria-describedby="helpId" placeholder="" value="{{ $apartment->full_address }}" />
                <small id="helpId" class="form-text text-muted">Full address required, maximum 255 characters</small>
            </div>
            {{-- visibility --}}
            <div class="form-check pb-3">
                <input class="form-check-input @error('visibility') is-invalid @enderror" type="checkbox" value="true"
                    id="visibility" @if ($apartment->visibility == '1') checked @endif>
                <label class="form-check-label" for="visibility">
                    Is visible
                </label>
            </div>
            {{-- services --}}
            <label for="services" class="form-label">Services</label>
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
            <a type="button" href="{{ route('user.apartments.index') }}" class="btn btn-primary">Back</a>
            <button type="reset" class="btn btn-primary">Reset</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
