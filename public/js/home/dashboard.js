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
    // grafico1.render();

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
    // grafico2.render();



    var options3 = {
        series: [{
        name: 'Net Profit',
        data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
      }, {
        name: 'Revenue',
        data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
      }, {
        name: 'Free Cash Flow',
        data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
      }],
        chart: {
        type: 'bar',
        height: 350
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '55%',
          endingShape: 'rounded'
        },
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      xaxis: {
        categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
      },
      yaxis: {
        title: {
          text: '$ (thousands)'
        }
      },
      fill: {
        opacity: 1
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return "$ " + val + " thousands"
          }
        }
      }
      };

      var grafico3 = new ApexCharts(document.querySelector("#grafico3"), options3);
      grafico3.render();




      var options4 = {
        series: [{
        name: 'PRODUCT A',
        data: [44, 55, 41, 67, 22, 43]
      }, {
        name: 'PRODUCT B',
        data: [13, 23, 20, 8, 13, 27]
      }, {
        name: 'PRODUCT C',
        data: [11, 17, 15, 15, 21, 14]
      }, {
        name: 'PRODUCT D',
        data: [21, 7, 25, 13, 22, 8]
      }],
        chart: {
        type: 'bar',
        height: 350,
        stacked: true,
        toolbar: {
          show: true
        },
        zoom: {
          enabled: true
        }
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
          borderRadius: 10,
          dataLabels: {
            total: {
              enabled: true,
              style: {
                fontSize: '13px',
                fontWeight: 900
              }
            }
          }
        },
      },
      xaxis: {
        type: 'datetime',
        categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT',
          '01/05/2011 GMT', '01/06/2011 GMT'
        ],
      },
      legend: {
        position: 'right',
        offsetY: 40
      },
      fill: {
        opacity: 1
      }
      };

      var grafico4 = new ApexCharts(document.querySelector("#grafico4"), options4);
      grafico4.render();

});