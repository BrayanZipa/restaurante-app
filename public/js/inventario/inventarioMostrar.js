$(document).ready(function () {

    var servidor = window.location.origin + '/';
    var URLactual = servidor + 'inventario/';

    var tablaInventarios = $('#tabla_inventarios').DataTable({
        'ajax': URLactual + 'lista_inventarios',
        'type': 'GET',
        'destroy': true,
        'processing': true,
        'responsive': true,
        'autoWidth': false,
        'dataType': 'json',
        'columns': [
            {
                'data': 'id_inventario',
                'name': 'id_inventario'
            },
            {
                'data': 'estado',
                'name': 'estado',
                render: function (data) {
                    if (data == true) {
                        return '<span class="badge badge-success">Ingreso</span>';
                    }
                    return '<span class="badge badge-danger">Salida</span>';
                }
            },
            {
                'data': 'producto',
                'name': 'producto',
            },
            {
                'data': 'cantidad',
                'name': 'cantidad',
                render: function (data,type,row) {
                    if (row.estado == true) {
                        return '<span class="badge badge-success">+ </span>'+ data;
                    }  
                        return '<span class="badge badge-danger">- </span>'+ data;
                }
            },
            {
                'data': 'cantidad_producto',
                'name': 'cantidad_producto',
            },
            {
                'data': 'costo',
                'name': 'costo',
                render: function (data) {
                    if (data != null) {
                        return data.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 });
                    } else {
                        return '';
                    }
                }
            },
            {
                'data': 'costo_unitario',
                'name': 'costo_unitario',
                render: function (data) {
                    if (data != null) {
                        return data.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 });
                    }
                        return '';
                }
            },
            {
                'data': 'fecha_vencimiento',
                'name': 'fecha_vencimiento',
                render: function (data) {
                    if (data != null) {
                        return moment(data).format('DD-MM-YYYY');
                    } else {
                        return '';
                    }
                }
            },
            {
                'data': 'fecha',
                'name': 'fecha',
                render: function (data) {
                    return moment(data).format('DD-MM-YYYY');
                }
            },
            {
                'data': 'fecha',
                'name': 'fecha',
                render: function (data) {
                    return moment(data).format('h:mm:ss a');
                }
            },
            {
                'data': 'name',
                'name': 'name',
            },
            {
                'class': 'editar_inventario',
                'orderable': false,
                'data': null,
                'defaultContent': '<td>' +
                    '<div class="action-buttons text-center">' +
                    '<a href="#" class="btn btn-primary btn-icon btn-sm">' +
                    '<i class="fas fa-edit"></i>' +
                    '</a>' +
                    '</div>' +
                    '</td>',
            },
            {
                'class': 'eliminar_inventario',
                'orderable': false,
                'data': null,
                'defaultContent': '<td>' +
                    '<div class="action-buttons text-center">' +
                    '<a href="#" class="btn btn-danger btn-icon btn-sm">' +
                    '<i class="fas fa-trash-alt"></i>' +
                    '</a>' +
                    '</div>' +
                    '</td>',
            }
        ],
        'order': [[0, 'desc']],
        'lengthChange': true,
        'lengthMenu': [
            [6, 10, 25, 50, 75, 100, -1],
            [6, 10, 25, 50, 75, 100, 'ALL']
        ],
        'language': {
            'lengthMenu': 'Mostrar _MENU_ registros por página',
            'zeroRecords': 'No hay registros',
            'info': 'Mostrando página _PAGE_ de _PAGES_',
            'infoEmpty': 'No hay registros disponibles',
            'infoFiltered': '(filtrado de _MAX_ registros totales)',
            'search': 'Buscar:',
            'paginate': {
                'next': 'Siguiente',
                'previous': 'Anterior'
            }
        },
    });

    $('div.dataTables_filter input', $('#tabla_inventarios').DataTable().table().container()).focus();

    $('#tabla_inventarios tbody').on('click', '.editar_inventario', function () {
        let data = $('#tabla_inventarios').DataTable().row(this).data();
        document.getElementById('formularioInventario').setAttribute('action', URLactual + 'actualizar/' + data.id_inventario);
        document.getElementById('estadoInventario').value = data.estado;
        document.getElementById('productoInventario').value = data.id_producto;
        document.getElementById('cantidadInventario').value = data.cantidad;
        document.getElementById('costoInventario').value = data.costo;
        document.getElementById('formEditarInventario').style.display = '';
    });

    document.getElementById('btnOcultar').addEventListener('click', function () {
        document.getElementById('formEditarInventario').style.display = 'none';
    });
});
