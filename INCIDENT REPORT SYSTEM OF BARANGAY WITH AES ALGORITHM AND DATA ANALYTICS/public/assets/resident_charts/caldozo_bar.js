// setup 
const dataCaldozoBar = {
    labels: type_CALDOZO,
    datasets: [{
        label: 'occurrence(s)',
        data: type_count_CALDOZO,
        backgroundColor: [

            '#C23B21',


        ],
        borderColor: [

            '#333333',
        ],
        borderWidth: 1
    }]
};

// config 
const configCaldozoBar = {
    type: 'bar',
    data: dataCaldozoBar,
    options: {
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                min: 0,
                beginAtZero: true,
                ticks: {
                    precision: 0
                }
            },
        },
        aspectRatio: 2
    }
};

// render init block
const barChartCaldozo = new Chart(
    document.getElementById('barChartCaldozo'),
    configCaldozoBar
);