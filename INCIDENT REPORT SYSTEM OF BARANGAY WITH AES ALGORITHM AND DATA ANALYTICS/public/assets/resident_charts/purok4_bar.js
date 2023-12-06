// setup 
const dataPr4Bar = {
    labels: type_PRK4,
    datasets: [{
        label: 'occurrence(s)',
        data: type_count_PRK4,
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
const configPr4Bar = {
    type: 'bar',
    data: dataPr4Bar,
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
const barChartPr4 = new Chart(
    document.getElementById('barChartPurok4'),
    configPr4Bar
);