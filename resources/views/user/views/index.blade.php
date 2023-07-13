@extends('layouts.app')

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
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
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
