@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 m-auto">

                <div class="card">
                    <div class="card-header">
                        Stats Views
                    </div>
                    <div class="card-body">
                        <p>Total number of views: {{ count($views) }}</p>
                        {{-- altre statistiche --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
