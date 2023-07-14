@extends('layouts.app')
@php
    $currentMonth = date('m');
@endphp

@section('content')
    <div class="container mt-3">
        <div class="row mb-3">
            <div class="col p-0 mb-3">
                <div class="card p-3 d-flex justify-content-center">
                    <h4 class="m-0"> {{ $apartment->title }} </h4>
                </div>
            </div>

            <div class="container p-4 card_show_stats card_shadow " id="viewsContainer">
                <div class="d-flex justify-content-between align-items-center flex-wrap pb-5">
                    <a type="button" class="btn back_btn gap-2 shadow" href="{{ route('user.apartments.show', $slug) }}">
                        <i class="fa-solid fa-arrow-left-long"></i>
                        Back
                    </a>
                    <h2 class="text-center m-0">Views over time</h2>
                    <div>
                        <select class="form-select form-select-lg" name="monthSelect" id="monthSelect">
                            <option selected>Select month</option>
                            <option value="01" {{ $currentMonth === '01' ? 'selected' : '' }}>January</option>
                            <option value="02" {{ $currentMonth === '02' ? 'selected' : '' }}>February</option>
                            <option value="03" {{ $currentMonth === '03' ? 'selected' : '' }}>March</option>
                            <option value="04" {{ $currentMonth === '04' ? 'selected' : '' }}>April</option>
                            <option value="05" {{ $currentMonth === '05' ? 'selected' : '' }}>May</option>
                            <option value="06" {{ $currentMonth === '06' ? 'selected' : '' }}>June</option>
                            <option value="07" {{ $currentMonth === '07' ? 'selected' : '' }}>July</option>
                            <option value="08" {{ $currentMonth === '08' ? 'selected' : '' }}>August</option>
                            <option value="09" {{ $currentMonth === '09' ? 'selected' : '' }}>September</option>
                            <option value="10" {{ $currentMonth === '10' ? 'selected' : '' }}>October</option>
                            <option value="11" {{ $currentMonth === '11' ? 'selected' : '' }}>November</option>
                            <option value="12" {{ $currentMonth === '12' ? 'selected' : '' }}>December</option>
                        </select>
                    </div>
                </div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="text/javascript">
    const views = @JSON($views);
    const apartments = @JSON($apartments);
    const slug = @JSON($slug);
    console.log(views);


    document.getElementById('monthSelect').addEventListener('change', function() {
        const selectedMonth = this.value;
        const filteredViews = views.filter(function(view) {
            // Estrai il mese dalla data della visualizzazione
            const viewMonth = view.date.split('-')[1];
            return viewMonth === selectedMonth;
        });
        console.log(selectedMonth);
        // Passa le visualizzazioni filtrate al metodo per aggiornare il grafico
        updateChart(filteredViews);
    });
</script>
