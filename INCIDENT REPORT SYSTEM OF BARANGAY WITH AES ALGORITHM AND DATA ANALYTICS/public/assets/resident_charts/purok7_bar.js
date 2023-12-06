// setup 
const dataPr7Bar = {
    labels: type_PRK7,
    datasets: [{
        label: 'occurrence(s)',
        data: type_count_PRK7,
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
const configPr7Bar = {
    type: 'bar',
    data: dataPr7Bar,
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
const barChartPr7 = new Chart(
    document.getElementById('barChartPurok7'),
    configPr7Bar
);