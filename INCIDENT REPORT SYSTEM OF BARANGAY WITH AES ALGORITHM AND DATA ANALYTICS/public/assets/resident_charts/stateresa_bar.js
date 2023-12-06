// setup 
const dataStaBar = {
    labels: type_STA,
    datasets: [{
        label: 'occurrence(s)',
        data: type_count_STA,
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
const configStaBar = {
    type: 'bar',
    data: dataStaBar,
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
const barChartSta = new Chart(
    document.getElementById('barChartSta'),
    configStaBar
);