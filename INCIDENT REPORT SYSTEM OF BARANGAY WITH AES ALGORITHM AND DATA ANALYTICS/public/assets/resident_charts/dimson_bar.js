// setup 
const dataDimsonBar = {
    labels: type_DIMSON,
    datasets: [{
        label: 'occurrence(s)',
        data: type_count_DIMSON,
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
const configDimsonBar = {
    type: 'bar',
    data: dataDimsonBar,
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
const barChartDimson = new Chart(
    document.getElementById('barChartDimson'),
    configDimsonBar
);