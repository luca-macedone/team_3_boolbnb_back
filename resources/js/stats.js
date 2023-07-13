import axios from 'axios';

let myChart = document.getElementById('myChart').getContext('2d');
//console.log(views);
//console.log(slug);
axios.get(`http://127.0.0.1:8000/api/apartments/${slug}`)
    .then((response) => {
        // il risultato lo assegno ad una variabile
        let apartment = response.data.result[0];
        // salvo l'id dell'appartamento
        let apartmentId = apartment.id;
        // array delle date ( asse x)
        let datesArray = [];
        // array delle views per appartamento
        let countsArray = [];

        // ciclo le views
        for (let i = 0; i < views.length; i++) {
            // salvo la data della view ciclata
            let date = views[i].date;
            // transofromo la stringa in formato 'dd/mm/yyyy'
            let yymmdd = date.split("-");
            yymmdd[2] = yymmdd[2].slice(0, 2);
            yymmdd = yymmdd.reverse();
            yymmdd = yymmdd.join('/');

            // console.log(yymmdd);
            // contatore views
            let count = 1;

            // se l'apartment id della view ciclata è = all'id dell'apartment attuale...
            if (views[i].apartment_id == apartmentId) {
                // se la data della view attuale non è presente nell'array delle date...
                if (!datesArray.includes(yymmdd)) {
                    // ...pusho il contatore nell'array
                    countsArray.push(count);
                    // ...pusho la data nell'array
                    datesArray.push(yymmdd);
                } else { // altrimenti...
                    // ...aumento contatore views nella posizione attuale di 1
                    countsArray[countsArray.length - 1]++;
                }
            }
        };

        let totalviews = 0;
        // calcolo il totale delle views dell'array count
        for (let i = 0; i < countsArray.length; i++) {
            totalviews = totalviews + countsArray[i]
        }
        // calcolo la media delle views
        let media = totalviews / countsArray.length;
        // massimo due decimali
        let md = media.toFixed(2);

        datesArray.sort((a, b) => {
            let date1 = new Date(a);
            let date2 = new Date(b);
            return date1 - date2;
        });

        //datesArray.push('average views by day');
        countsArray.push(md);

        console.log(datesArray);
        const chart = new Chart(myChart, {
            type: 'line',
            data: {
                labels: datesArray,
                datasets: [{
                    label: '',
                    data: countsArray,
                    borderWidth: 2,
                    borderColor: '#8cc0de',
                    backgroundColor: '#8cc0de',
                    pointBackgroundColor: '#8cc0de',
                    pointBorderColor: '#8cc0de',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointHoverBorderColor: '#FFF',
                    tension: 0.3,
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.1)',
                            borderWidth: 1,
                            borderColor: 'rgba(0, 0, 0, 0.1)',
                        },
                    },
                    x: {
                        grid: {
                            display: false,
                        },
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        enabled: true,
                        backgroundColor: '#FFF',
                        titleColor: '#000',
                        bodyColor: '#000',
                        borderColor: '#F8D07C',
                        borderWidth: 1,
                        displayColors: false,
                        callbacks: {
                            label: function (context) {
                                return 'Views: ' + context.parsed.y;
                            },
                        },
                    },
                },
            },
        });

    })

