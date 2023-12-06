// setup 
const dataPr5Bar = {
    labels: type_PRK5,
    datasets: [{
        label: 'occurrence(s)',
        data: type_count_PRK5,
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
const configPr5Bar = {
    type: 'bar',
    data: dataPr5Bar,
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
const barChartPr5 = new Chart(
    document.getElementById('barChartPurok5'),
    configPr5Bar
);