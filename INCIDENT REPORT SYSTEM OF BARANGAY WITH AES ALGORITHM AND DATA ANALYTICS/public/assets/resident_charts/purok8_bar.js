// setup 
const dataPr8Bar = {
    labels: type_PRK8,
    datasets: [{
        label: 'occurrence(s)',
        data: type_count_PRK8,
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
const configPr8Bar = {
    type: 'bar',
    data: dataPr8Bar,
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
const barChartPr8 = new Chart(
    document.getElementById('barChartPurok8'),
    configPr8Bar
);