$(document).ready(function () {

  var servidor = window.location.origin + '/';
  var URLactual = servidor + 'dashboard/';

  var options = {
    series: [],
    chart: {
      height: 380,
      type: 'area',
      redrawOnParentResize: true,
      redrawOnWindowResize: true,
      toolbar: {
        show: false
      }
    },
    title: {
      text: 'Ingresos y salidas de inventario diarias',
      align: 'center',
      style: {
        fontSize: '15px',
        fontWeight: 'bold',
        color: '#000'
      },
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
      height: 380,
      type: 'bar',
      redrawOnParentResize: true,
      redrawOnWindowResize: true,
      toolbar: {
        show: false
      }
    },
    title: {
      text: 'Ingresos y salidas de inventario mensuales',
      align: 'center',
      margin: 10,
      style: {
        fontSize: '15px',
        fontWeight: 'bold',
        color: '#000'
      },
    },
    colors: ['#20c997', '#FD1A39'],
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '50%',
        endingShape: 'rounded'
      },
    },
    dataLabels: {
      enabled: true,
    },
    stroke: {
      show: true,
      width: 1,
      colors: ['transparent']
    },
    xaxis: {
      categories: [],
    },
    yaxis: {
      title: {
        text: 'Total número de registros'
      }
    }
  };

  var grafico2 = new ApexCharts(document.querySelector("#grafico2"), options2);
  grafico2.render();

  var options3 = {
    series: [],
    chart: {
      height: 380,
      type: 'bar',
      redrawOnParentResize: true,
      redrawOnWindowResize: true,
      toolbar: {
        show: false
      }
    },
    title: {
      text: 'Total productos por estado',
      align: 'center',
      margin: 10,
      style: {
        fontSize: '15px',
        fontWeight: 'bold',
        color: '#000'
      },
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
    },
    yaxis: {
      title: {
        text: 'Total productos'
      }
    }
  };

  var grafico3 = new ApexCharts(document.querySelector("#grafico3"), options3);
  grafico3.render();

  var options4 = {
    series: [],
    chart: {
    height: 380,
    type: 'bar',
    redrawOnParentResize: true,
    redrawOnWindowResize: true,
    toolbar: {
      show: false
    }
  },
  title: {
    text: 'Productos con mas ingresos',
    align: 'center',
    margin: 10,
    style: {
      fontSize: '15px',
      fontWeight: 'bold',
      color: '#000'
    },
  },
  plotOptions: {
    bar: {
      columnWidth: '35%',
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
    categories: [],
    labels: {
      style: {
        fontSize: '12px'
      }
    }
  },
  yaxis: {
    title: {
      text: 'Total registros de ingreso'
    }
  },
  };

  var grafico4 = new ApexCharts(document.querySelector("#grafico4"), options4);
  grafico4.render();

  
  
  var options5 ={
    series: [14, 23, 21, 17, 15, 34],
    chart: {
      height: 380,
      type: 'polarArea',
      redrawOnParentResize: true,
      redrawOnWindowResize: true,
      toolbar: {
        show: false
      }
    },
    title: {
      text: 'Últimos productos ingresados',
      align: 'center',
      margin: 10,
      style: {
        fontSize: '15px',
        fontWeight: 'bold',
        color: '#000'
      },
    },
  }
  var grafico5 = new ApexCharts(document.querySelector("#grafico5"), options5);
  grafico5.render();




  // var options3 = {
  //   series: [],
  //   chart: {
  //     type: 'bar',
  //     height: 450,
  //     stacked: true,
  //     redrawOnParentResize: true,
  //     redrawOnWindowResize: true,
  //     toolbar: {
  //       show: false
  //     }
  //   },
  //   title: {
  //     text: 'Ingresos individuales por mes',
  //     align: 'center',
  //     margin: 20,
  //     style: {
  //       fontSize: '16px',
  //       fontWeight: 'bold',
  //       color: '#787878'
  //     },
  //   },
  //   responsive: [{
  //     breakpoint: 480,
  //     options: {
  //       legend: {
  //         position: 'bottom',
  //         offsetX: -10,
  //         offsetY: 0
  //       }
  //     }
  //   }],
  //   plotOptions: {
  //     bar: {
  //       horizontal: false,
  //       borderRadius: 10
  //     },
  //   },
  //   dataLabels: {
  //     enabled: true,
  //     offsetY: 2,
  //     style: {
  //       fontSize: '14px',
  //       colors: ['#fff']
  //     }
  //   },
  //   legend: {
  //     position: 'right',
  //     offsetY: 50
  //   },
  //   fill: {
  //     opacity: 1
  //   }
  // };
  // var grafico3 = new ApexCharts(document.querySelector('#grafico3'), options3);
  // grafico1.render();

  
  // var options4 = {
  //   series: [],
  //   chart: {
  //     type: 'bar',
  //     height: 450,
  //     redrawOnParentResize: true,
  //     redrawOnWindowResize: true,
  //     toolbar: {
  //       show: false
  //     },
  //   },
  //   title: {
  //     text: 'Ingreso de visitantes por empresa',
  //     align: 'center',
  //     margin: 20,
  //     style: {
  //       fontSize: '16px',
  //       fontWeight: 'bold',
  //       color: '#787878'
  //     },
  //   },
  //   colors: ['#008FFB', '#FF9800', '#00E396'],
  //   plotOptions: {
  //     bar: {
  //       horizontal: true,
  //       dataLabels: {
  //         position: 'top',
  //       },
  //     }
  //   },
  //   dataLabels: {
  //     enabled: true,
  //     offsetX: -6,
  //     style: {
  //       fontSize: '14px',
  //       colors: ['#fff']
  //     }
  //   },
  //   tooltip: {
  //     shared: true,
  //     intersect: false
  //   }
  // };
  // var grafico4 = new ApexCharts(document.querySelector("#grafico4"), options4);
  // grafico2.render();


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
        contar('#cantidadProductos', res[0]);
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

  function registrosInventarioPorMes() {
    $.ajax({
      url: URLactual + 'registros_inventario_mes',
      type: 'GET',
      dataType: 'json',
      success: function (res) {
        grafico2.updateOptions({
          series: [{
            name: 'Ingresos',
            data: res.ingresos
          }, {
            name: 'Salidas',
            data: res.salidas
          }], 
          xaxis: {
            categories: res.meses
          }
        });
      },
      error: function () {
        console.log('Error obteniendo los datos de la base de datos');
      }
    });
  }
  registrosInventarioPorMes();

  function totalEstadoProducto() {
    $.ajax({
      url: URLactual + 'total_estado_productos',
      type: 'GET',
      dataType: 'json',
      success: function (res) {
        grafico3.updateOptions({
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

  function totalIngresosPoductos() {
    $.ajax({
      url: URLactual + 'total_ingresos_productos',
      type: 'GET',
      dataType: 'json',
      success: function (res) {
        grafico4.updateOptions({
          series: [{
            name: 'Total registros',
            data: res.ingresos
          }],
          xaxis: {
            categories: res.productos
          }
        });
      },
      error: function () {
        console.log('Error obteniendo los datos de la base de datos');
      }
    });
  }
  totalIngresosPoductos();

});