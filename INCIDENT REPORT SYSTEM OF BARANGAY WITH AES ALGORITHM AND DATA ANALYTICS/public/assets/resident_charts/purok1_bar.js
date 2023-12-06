// setup 
const dataPr1Bar = {
    labels: type_PRK1,
    datasets: [{
        label: 'occurrence(s)',
        data: type_count_PRK1,
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
const configPr1Bar = {
    type: 'bar',
    data: dataPr1Bar,
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
const barChartPr1 = new Chart(
    document.getElementById('barChartPurok1'),
    configPr1Bar
);