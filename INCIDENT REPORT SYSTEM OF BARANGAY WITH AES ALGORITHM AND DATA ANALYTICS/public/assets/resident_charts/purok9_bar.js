// setup 
const dataPr9Bar = {
    labels: type_PRK9,
    datasets: [{
        label: 'occurrence(s)',
        data: type_count_PRK9,
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
const configPr9Bar = {
    type: 'bar',
    data: dataPr9Bar,
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
const barChartPr9 = new Chart(
    document.getElementById('barChartPurok9'),
    configPr9Bar
);