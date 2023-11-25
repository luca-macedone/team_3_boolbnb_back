@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <ul>
            @foreach ($errors->all() as $error)
                <strong>Error! </strong>
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
