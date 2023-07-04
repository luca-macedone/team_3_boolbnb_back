@extends('layouts.app')

@section('content')
    <div class="container">

                 @if (session('message'))
                    <div class="col-12 pt-3">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Success! </strong>
                            {{ session('message') }}
                        </div>
                    </div>
                @endif
                <div class="col d-flex justify-content-end p-3">
                    <a type="button" class="btn btn-outline-dark" href="{{ route('user.apartments.create') }}">Add</a>
                </div>
            
        
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
          
        
        
                   
                    

                        @forelse ($apartments as $apartment)

                        
                        <div class="card mb-3" >
                            <div class="row g-0">
                              <div class="col-md-4">
                              <img src="{{asset('storage/' . $apartment->image)}}" class="img-fluid" alt="{{$apartment->title}}">
                              </div>
                              <div class="col-md-8">
                                <div class="card-body">
                                  <h5 class="card-title">{{$apartment->title}}</h5>
                                  <p class="card-text">{{$apartment->full_address}}</p>
                                  <p class="card-text"><small class="text-muted">You have 3 message!</small></p>
                                </div>
                           


                    <!-- action -->
                       
                                <div class="d-flex align-items-center gap-2">
                                    <a type="button" class="btn btn-outline-dark"
                                        href="{{ route('user.apartments.show', $apartment->slug) }}">watch</a>
                                    <a type="button" class="btn btn-outline-dark"
                                        href="{{ route('user.apartments.edit', $apartment->slug) }}">edit</a>
                                    <button type="button" class="btn btn-outline-danger d-flex align-items-center gap-1"
                                        data-bs-toggle="modal" data-bs-target="{{ '#modal' . $apartment->id }}"
                                        title="{{ __('Delete') }}">
                                        delete
                                    </button>

            <!-- delete modal -->

                                    <div class="modal fade" id="{{ 'modal' . $apartment->id }}" tabindex="-1"
                                        data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                        aria-labelledby="{{ 'modalTitle' . $apartment->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                            role="document">
                                            <div class="modal-content rounded-0">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-danger"
                                                        id="{{ 'modalTitle' . $apartment->id }}">{{ __('Danger Zone') }}
                                                    </h5>
                                                    <button type="button" class="btn-close rounded-0"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div>{{ __('This operation is irreversible.') }}</div>
                                                    <div class="fw-semibold">{{ __('Are you sure?') }}</div>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-between">
                                                    <button type="button" class="rounded-0 btn btn-outline-dark"
                                                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                    <form action="{{ route('user.apartments.destroy', $apartment) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="rounded-0 btn btn-outline-danger">
                                                            <i class="fa-solid fa-trash me-1"></i>
                                                            {{ __('Delete permanently') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

        <!-- / delete modal -->


                                </div>

                                </div>
                            </div>
                          </div>
                         
                    @empty
                        
                    @endforelse
             
        </div>

        </div>
        <div class="px-3 py-2">
            {{ $apartments->links('pagination::bootstrap-5') }}
        </div>
        
@endsection
