$(document).ready(function () {

  var servidor = window.location.origin + '/';
  var URLactual = servidor + 'dashboard/';

  var options = {
    series: [],
    chart: {
      height: 350,
      type: 'area',
      redrawOnParentResize: true,
      redrawOnWindowResize: true,
      toolbar: {
        show: false
      }
    },
    colors: ['#20c997', '#FD1A39'],
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth'
    },
    xaxis: {}
  };

  var grafico1 = new ApexCharts(document.querySelector("#grafico1"), options);
  grafico1.render();


  var options2 = {
    series: [],
    chart: {
      height: 350,
      type: 'bar',
      redrawOnParentResize: true,
      redrawOnWindowResize: true,
      toolbar: {
        show: false
      }
    },
    colors: ['#FD1A39', '#FFB100', '#00E396'],
    plotOptions: {
      bar: {
        columnWidth: '50%',
        distributed: true,
      }
    },
    dataLabels: {
      enabled: true
    },
    legend: {
      show: false
    },
    xaxis: {
      categories: [
        'Escaso',
        'Bajo',
        'Alto'
      ],
      labels: {
        style: {
          fontSize: '12px'
        }
      }
    }
  };

  var grafico2 = new ApexCharts(document.querySelector("#grafico2"), options2);
  grafico2.render();




  var options3 = {
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
  var grafico3 = new ApexCharts(document.querySelector('#grafico3'), options3);
  // grafico1.render();

  
  var options4 = {
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
  var grafico4 = new ApexCharts(document.querySelector("#grafico4"), options4);
  // grafico2.render();


  var options5 = {
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

  var grafico5 = new ApexCharts(document.querySelector("#grafico5"), options5);
  grafico5.render();


  var options6 = {
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

  var grafico6 = new ApexCharts(document.querySelector("#grafico6"), options6);
  grafico6.render();

  function contar(elemento, totalRegistros) {
    var cantidad = 0;
    var tiempo = setInterval(() => {
      if (totalRegistros === 0) {
        $(elemento).text(cantidad);
        clearInterval(tiempo);
      } else {
        cantidad += 1;
        $(elemento).text(cantidad);
        if (cantidad === totalRegistros) {
          clearInterval(tiempo);
        }
      }
    },80);
  }

  function obtenerTotalDatos() {
    $.ajax({
      url: URLactual + 'total_datos',
      type: 'GET',
      dataType: 'json',
      success: function (res) {
        contar('#cantidadReferencias', res[0]);
        contar('#cantidadProveedores', res[1]);
        $('#totalUnidadesI').text( res[2]);
        $('#valorTotalI').text( res[3].toLocaleString('es-CO',{ style: 'currency', currency: 'COP', minimumFractionDigits: 0}));
      },
      error: function () {
        console.log('Error obteniendo los datos de la base de datos');
      }
    });
  }
  obtenerTotalDatos();

  function registrosInventarioPorDia() {
    $.ajax({
      url: URLactual + 'registros_inventario_dia',
      type: 'GET',
      dataType: 'json',
      success: function (res) {
        grafico1.updateOptions({
          series: [{
            name: 'Ingresos',
            data: res.ingresos
          }, {
            name: 'Salidas',
            data: res.salidas
          }],           
          xaxis: {
            categories: res.dias
          }
        });
      },
      error: function () {
        console.log('Error obteniendo los datos de la base de datos');
      }
    });
  }
  registrosInventarioPorDia();

  function totalEstadoProducto() {
    $.ajax({
      url: URLactual + 'total_estado_productos',
      type: 'GET',
      dataType: 'json',
      success: function (res) {
        grafico2.updateOptions({
          series: [{
            name: 'Total',
            data: [res.escaso, res.bajo, res.alto]
          }]
        });
      },
      error: function () {
        console.log('Error obteniendo los datos de la base de datos');
      }
    });
  }
  totalEstadoProducto();

});