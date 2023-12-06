// setup 
const dataPr3Bar = {
    labels: type_PRK3,
    datasets: [{
        label: 'occurrence(s)',
        data: type_count_PRK3,
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
const configPr3Bar = {
    type: 'bar',
    data: dataPr3Bar,
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
const barChartPr3 = new Chart(
    document.getElementById('barChartPurok3'),
    configPr3Bar
);