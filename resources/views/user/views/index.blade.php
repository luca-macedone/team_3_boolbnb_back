@extends('layouts.app')

@section('content')
@section('content')
    <div class="container p-4 bg-light rounded-5 mt-4" id="viewsContainer">
        <a href="{{ route('user.apartments.show', $slug) }}" role="button"><i
                class="fa-solid fa-circle-arrow-left fs-3 me-2 mt-2 btn-hover" style="color: #3FA9F5"></i></a>
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
