@extends('layouts.app')

@section('content')
    <div class="container p-4 card_show card_shadow " id="viewsContainer">
        <a type="button" class="btn back_btn gap-2 shadow" href="{{ route('user.apartments.show', $slug) }}">
            <i class="fa-solid fa-arrow-left-long"></i>
            Back
        </a>

        <h2 class="text-center">Views over time</h2>
        <canvas id="myChart"></canvas>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="text/javascript">
    const views = @JSON($views);
    const apartments = @JSON($apartments);
    const slug = @JSON($slug);
    console.log(views);
</script>
