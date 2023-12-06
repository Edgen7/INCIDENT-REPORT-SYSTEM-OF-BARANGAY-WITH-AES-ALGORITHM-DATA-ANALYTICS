
function dataofIncidents() {
    const dataIncidents = [];
    for (let i = 0; i < 144; i++) {
        dataIncidents.push({
            x: _monthX[i],
            y: _streetY[i],
            value: numberArray[i],
        });
    }

    //console.log(dataIncidents);
    return dataIncidents;
}

// setup 
const dataMatrixAll = {
    // labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
    datasets: [{
        label: 'Street',
        data: dataofIncidents(),

        backgroundColor({ raw }) {
            //console.log(raw)
            //console.log(_streetY)
            const alpha = (5 + raw.value) / 10;
            return `rgba(220, 53, 53, ${alpha})`;
        },
        borderColor: 'white',
        borderWidth: 1,
        width: ({ chart }) => (chart.chartArea || {}).width / 12 - 1,
        height: ({ chart }) => (chart.chartArea || {}).height / 16 - 1,
    }]
};

// config 
const configMatrixAll = {
    type: 'matrix',
    data: dataMatrixAll,
    options: {
        maintainAspectRatio: false,
        scaleShowValues: true,
        scales: {

            x: {
                display: true,
                min: 0.5,
                max: 12.6,
                offset: false,
                ticks: {
                    maxTicksLimit: 100,
                    callback: function (label, index, labels) {
                        //console.log(label)
                        switch (label) {
                            case 1:
                                return 'JAN';
                            case 2:
                                return 'FEB';
                            case 3:
                                return 'MAR';
                            case 4:
                                return 'APR';
                            case 5:
                                return 'MAY';
                            case 6:
                                return 'JUN';
                            case 7:
                                return 'JUL';
                            case 8:
                                return 'AUG';
                            case 9:
                                return 'SEP';
                            case 10:
                                return 'OCT';
                            case 11:
                                return 'NOV';
                            case 12:
                                return 'DEC';
                        }
                    }
                }

            },
            y: {
                display: true,
                min: 0.5,
                max: 12.6,
                ticks: {
                    maxTicksLimit: 100,

                    callback: function (label, index, labels) {
                        //console.log(label)
                        switch (label) {
                            case 1:
                                return 'Caldozo Compound';
                            case 2:
                                return 'Dimson Compound';
                            case 3:
                                return 'Perpetual Village';
                            case 4:
                                return 'Purok 1';
                            case 5:
                                return 'Purok 2';
                            case 6:
                                return 'Purok 3';
                            case 7:
                                return 'Purok 4';
                            case 8:
                                return 'Purok 5';
                            case 9:
                                return 'Purok 7';
                            case 10:
                                return 'Purok 8';
                            case 11:
                                return 'Purok 9';
                            case 12:
                                return 'Sta Teresa';
                        }
                    }
                }
            }
        },
        plugins: {
            legend: false,
            tooltip: {
                callbacks: {
                    title: function (context) {
                        return `${context[0].raw.value} reports`;
                    },
                    label(context) {
                        console.log(context);
                        const v = context.dataset.data[context.dataIndex];
                        //return ['x: ' + v.x, 'y: ' + v.y, 'v: ' + v.value];
                        switch (v.y) {
                            case 1:
                                return 'Caldozo Compound';
                            case 2:
                                return 'Dimson Compound';
                            case 3:
                                return 'Perpetual Village';
                            case 4:
                                return 'Purok 1';
                            case 5:
                                return 'Purok 2';
                            case 6:
                                return 'Purok 3';
                            case 7:
                                return 'Purok 4';
                            case 8:
                                return 'Purok 5';
                            case 9:
                                return 'Purok 7';
                            case 10:
                                return 'Purok 8';
                            case 11:
                                return 'Purok 9';
                            case 12:
                                return 'Sta Teresa';
                        }
                    }
                }
            }
        }
    }
};

// render init block
const matrixAll = new Chart(
    document.getElementById('matrixAll'),
    configMatrixAll
);