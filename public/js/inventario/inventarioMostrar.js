$(document).ready(function () {

    var servidor = window.location.origin + '/';
    var URLactual = servidor + 'inventario/';

    // Token de Laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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
                'name': 'id_inventario',
                'width': '3%'
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
                'data': 'codigo',
                'name': 'codigo',
            },
            {
                'data': 'producto',
                'name': 'producto',
            },
            {
                'data': 'cantidad',
                'name': 'cantidad',
                'class': 'text-center',
                'width': '5%',
                render: function (data, type, row) {
                    if (row.estado == true) {
                        return '<span class="text-success font-weight-bold" style="font-size: 18px">+</span>' + data;
                    }
                    return '<span class="text-danger font-weight-bold" style="font-size: 18px">-</span>' + data;
                }
            },
            {
                'data': 'cantidad_producto',
                'name': 'cantidad_producto',
                'class': 'text-center',
                'width': '5%'
            },
            {
                'data': 'costo',
                'name': 'costo',
                render: function (data) {
                    if (data != null) {
                        return data.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 });
                    }
                    return '-';
                }
            },
            {
                'data': 'costo_unitario',
                'name': 'costo_unitario',
                render: function (data) {
                    if (data != null) {
                        return data.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 });
                    }
                    return '-';
                }
            },
            {
                'data': 'fecha_vencimiento',
                'name': 'fecha_vencimiento',
                'width': '10%',
                render: function (data) {
                    if (data != null) {
                        return moment(data).format('DD-MM-YYYY');
                    }
                    return '-';
                }
            },
            {
                'data': 'fecha',
                'name': 'fecha',
                'width': '10%',
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

    $('#tabla_inventarios tbody').on('click', '.eliminar_inventario', function () {
        let data = $('#tabla_inventarios').DataTable().row(this).data();

        Swal.fire({
            title: '¿Desea eliminar el registro de inventario del producto <b>' + data.producto + '</b> ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: URLactual + 'eliminar/' + data.id_inventario,
                    type: 'delete',
                    dataType: 'json',
                    success: function (res) {
                        tablaInventarios.ajax.reload();
                        if(res.message){
                            Swal.fire({
                                icon: 'success',
                                title: 'Registro eliminado exitosamente',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                iconColor: 'red',
                                title: 'No es posible eliminar el registro debido a que no fue ingresado en la fecha actual',
                                text: 'Los registros solo se pueden eliminar el mismo día que se ingresan al sistema',
                                allowOutsideClick: false,
                                confirmButtonText: 'Confirmar'
                            })
                        }    
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Algo salió mal',
                            text: 'Error al tratar de eliminar el registro del sistema',
                        })
                    }
                });
            }
        })
    });

    // $('#tabla_inventarios tbody').on('click', '.editar_inventario', function () {
    //     let data = $('#tabla_inventarios').DataTable().row(this).data();
    //     document.getElementById('formularioInventario').setAttribute('action', URLactual + 'actualizar/' + data.id_inventario);
    //     document.getElementById('estadoInventario').value = data.estado;
    //     document.getElementById('productoInventario').value = data.id_producto;
    //     document.getElementById('cantidadInventario').value = data.cantidad;
    //     document.getElementById('costoInventario').value = data.costo;
    //     document.getElementById('formEditarInventario').style.display = '';
    // });

    // document.getElementById('btnOcultar').addEventListener('click', function () {
    //     document.getElementById('formEditarInventario').style.display = 'none';
    // });
});
