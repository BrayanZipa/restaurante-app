$(document).ready(function () {

    var options = {
        series: [],
        chart: {
            type: 'bar',
            height: 450,
            stacked: true,
            redrawOnParentResize: true,
            redrawOnWindowResize: true,
            toolbar: {
                show: false
            }
        },
        title: {
            text: 'Ingresos individuales por mes',
            align: 'center',
            margin: 20,
            style: {
                fontSize: '16px',
                fontWeight: 'bold',
                color: '#787878'
            },
        },
        responsive: [{
            breakpoint: 480,
            options: {
                legend: {
                    position: 'bottom',
                    offsetX: -10,
                    offsetY: 0
                }
            }
        }],
        plotOptions: {
            bar: {
                horizontal: false,
                borderRadius: 10
            },
        },
        dataLabels: {
            enabled: true,
            offsetY: 2,
            style: {
                fontSize: '14px',
                colors: ['#fff']
            }
        },
        legend: {
            position: 'right',
            offsetY: 50
        },
        fill: {
            opacity: 1
        }
    };
    var grafico1 = new ApexCharts(document.querySelector('#grafico1'), options);
    grafico1.render();

    //Opciones del gráfico de ingreso de visitantes por empresa
    var options2 = {
        series: [],
        chart: {
            type: 'bar',
            height: 450,
            redrawOnParentResize: true,
            redrawOnWindowResize: true,
            toolbar: {
                show: false
            },
        },
        title: {
            text: 'Ingreso de visitantes por empresa',
            align: 'center',
            margin: 20,
            style: {
                fontSize: '16px',
                fontWeight: 'bold',
                color: '#787878'
            },
        },
        colors: ['#008FFB', '#FF9800', '#00E396'],
        plotOptions: {
            bar: {
                horizontal: true,
                dataLabels: {
                    position: 'top',
                },
            }
        },
        dataLabels: {
            enabled: true,
            offsetX: -6,
            style: {
                fontSize: '14px',
                colors: ['#fff']
            }
        },
        tooltip: {
            shared: true,
            intersect: false
        }
    };
    var grafico2 = new ApexCharts(document.querySelector("#grafico2"), options2);
    grafico2.render();

});