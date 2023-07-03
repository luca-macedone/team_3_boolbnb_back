@extends('layouts.app')

@section('content')


        
        <!-- right -->

        <div class="">
            <div class="container">

                

                <div class="user_name">{{ Auth::user()->name }}</div>

                <div class="">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection