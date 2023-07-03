@if (session('message'))
    <div class="alert alert-primary" role="alert">
        <strong>{{ session('message') }}</strong>
    </div>
@endif
