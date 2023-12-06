// setup 
const dataPr2Bar = {
    labels: type_PRK2,
    datasets: [{
        label: 'occurrence(s)',
        data: type_count_PRK2,
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
const configPr2Bar = {
    type: 'bar',
    data: dataPr2Bar,
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
const barChartPr2 = new Chart(
    document.getElementById('barChartPurok2'),
    configPr2Bar
);