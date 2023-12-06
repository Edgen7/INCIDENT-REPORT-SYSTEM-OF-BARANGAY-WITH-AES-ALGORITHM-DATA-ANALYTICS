// setup 
const dataPerpBar = {
    labels: type_PERPETUAL,
    datasets: [{
        label: 'occurrence(s)',
        data: type_count_PERPETUAL,
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
const configPerpBar = {
    type: 'bar',
    data: dataPerpBar,
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
const barChartPerp = new Chart(
    document.getElementById('barChartPerpetual'),
    configPerpBar
);