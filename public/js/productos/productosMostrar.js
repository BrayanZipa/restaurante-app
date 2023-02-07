$(document).ready(function () {

    var servidor = window.location.origin + '/';
    var URLactual = servidor + 'productos/';
    var dataProducto = {};

    // Token de Laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var tablaProductos = $('#tabla_productos').DataTable({
        'ajax': URLactual + 'lista_productos',
        'type': 'GET',
        'destroy': true,
        'processing': true,
        'responsive': true,
        'autoWidth': false,
        'dataType': 'json',
        'columns': [
            {
                'data': 'id_productos',
                'name': 'id_productos'
            },
            {
                'data': 'nombre',
                'name': 'nombre'
            },
            {
                'data': 'codigo',
                'name': 'codigo',
            },
            {
                'data': 'unidad',
                'name': 'unidad',
            },
            {
                'data': 'proveedor',
                'name': 'proveedor',
            },
            {
                'data': 'total',
                'name': 'total',
                'class': 'text-center',
                'width': '10%'
            },
            {
                'data': 'total',
                'name': 'total',
                'class': 'text-center',
                render: function (data, type, row) {
                    if (data >= 100) {
                        return '<span class="badge badge-success" style="font-size: 15px">Alto</span>';
                    }
                    else if (data > 20 && data < 100) {
                        return '<span class="badge badge-warning" style="font-size: 15px">Bajo</span>';
                    }
                    return '<span class="badge badge-danger" style="font-size: 15px">Excaso</span>';
                }
            },
            {
                'data': 'name',
                'name': 'name',
            },
            {
                'data': 'updated_at',
                'name': 'updated_at',
                render: function (data) {
                    return moment(data).format('DD-MM-YYYY - h:mm a');
                }
            },
            {
                'class': 'editar_producto',
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
                'class': 'eliminar_producto',
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

    $('div.dataTables_filter input', tablaProductos.table().container()).focus();

    $('#tabla_productos tbody').on('click', '.editar_producto', function () {
        let data = tablaProductos.row(this).data();
        dataProducto = data;
        let formulario = document.forms['formularioProducto'];
        for (let elemento of formulario) {
            if (elemento.classList.contains('is-invalid')) {
                elemento.classList.remove('is-invalid');
            }
        }
        document.getElementById('formularioProducto').setAttribute('action', URLactual + 'actualizar/' + data.id_productos);
        document.getElementById('idProducto').value = data.id_productos;
        document.getElementById('nombreProducto').value = data.nombre;
        document.getElementById('codigoProducto').value = data.codigo;
        document.getElementById('proveedorProducto').value = data.id_proveedor;
        document.getElementById('unidadProducto').value = data.id_unidad;
        document.getElementById('total').value = data.total;
        document.getElementById('precioUnitario').value = data.costo_unitario.toLocaleString('es-CO', { style: 'currency', currency: 'COP', minimumFractionDigits: 0 });
        document.getElementById('fechaUltimaCompra').value = moment(data.fecha).format('DD-MM-YYYY');
        document.getElementById('fechaVencimiento').value = moment(data.fecha_vencimiento).format('DD-MM-YYYY');

        activarSelect2();
        document.getElementById('formEditarProducto').style.display = '';
    });

    $('#tabla_productos tbody').on('click', '.eliminar_producto', function () {
        let data = tablaProductos.row(this).data();
        eliminarProducto(data.id_productos, data.nombre);
    });

    document.getElementById('eliminar_producto2').addEventListener('click', function () {
        eliminarProducto(dataProducto.id_productos, dataProducto.nombre);
    });

    function eliminarProducto(id, nombre) {
        Swal.fire({
            title: '¿Desea eliminar el producto <b>' + nombre + '</b> ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: URLactual + 'eliminar/' + id,
                    type: 'delete',
                    success: function () {
                        let tarjetaForm = document.getElementById('formEditarProducto');
                        if (tarjetaForm.style.display != 'none') {
                            tarjetaForm.style.display = 'none';
                        }
                        tablaProductos.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Producto <b>' + nombre + '</b> eliminado exitosamente',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Algo salió mal',
                            text: 'Error al tratar de eliminar el producto del sistema',
                        })
                    }
                });
            }
        })
    }

    function activarSelect2() {
        $('#proveedorProducto').select2({
            theme: 'bootstrap4',
            placeholder: 'Seleccione el proveedor',
            language: {
                noResults: function () {
                    return 'No hay resultado';
                }
            }
        });

        $('#unidadProducto').select2({
            theme: 'bootstrap4',
            placeholder: 'Seleccione la unidad',
            language: {
                noResults: function () {
                    return 'No hay resultado';
                }
            }
        });
    }

    document.getElementById('btnOcultar').addEventListener('click', function () {
        document.getElementById('formEditarProducto').style.display = 'none';
    });

    document.getElementById('nombreProducto').addEventListener('keyup', function (evento) {
        let input = evento.target.value;
        document.getElementById('nombreProducto').value = input.charAt(0).toUpperCase() + input.slice(1).toLowerCase();
    });

    $('#formularioProducto').validate({
        rules: {
            nombre: {
                required: true,
                maxlength: 50,
                minlength: 5
            },
            codigo: {
                required: true,
                maxlength: 15,
                minlength: 5,
            },
            id_proveedor: {
                required: true,
            },
            id_unidad: {
                required: true,
            },
        },
        messages: {
            nombre: {
                required: 'Se requiere que ingrese el nombre del producto',
                maxlength: 'El nombre debe tener máximo 50 caracteres',
                minlength: 'El nombre debe tener mínimo 5 caracteres',
            },
            codigo: {
                required: 'Se requiere que ingrese el codigo o identificador del producto',
                maxlength: 'El codigo debe tener máximo 15 digitos',
                minlength: 'El codigo debe tener mínimo 5 digitos',
            },
            id_proveedor: {
                required: 'Se requiere que ingrese el proveedor del producto',
            },
            id_unidad: {
                required: 'Se requiere que ingrese la unidad de medida del producto',
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });

    $('input.producto').keydown(function (event) {
        let divPadre = $(this).closest('.form-group');
        if (divPadre.find('.errorServidor').length) {
            $(this).removeClass('is-invalid');
            divPadre.find('.errorServidor').text('');
            divPadre.find('.errorServidor').removeClass('errorServidor');
        }
    });

    $('select.producto').change(function (event) {
        $(this).removeClass('is-invalid');
    });

    function cargarInventarioIndividual() {
        $('#tabla_inventario').DataTable({
            'ajax': servidor + 'inventario/lista_inventario/' + dataProducto.id_productos,
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
                    'width': '3%',
                },
                {
                    'data': 'estado',
                    'name': 'estado',
                    'width': '5%',
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
                    'width': '10%',
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
                    'width': '8%',
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
                    'width': '8%',
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
                    'width': '8%',
                    render: function (data) {
                        return moment(data).format('h:mm:ss a');
                    }
                },
                {
                    'data': 'name',
                    'name': 'name',
                }
            ],
            'order': [[0, 'desc']],
            'lengthChange': true,
            'lengthMenu': [
                [5, 10, 25, 50, 75, 100, -1],
                [5, 10, 25, 50, 75, 100, 'ALL']
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
    }

    document.getElementById('historial_producto').addEventListener('click', function (evento) {
        document.getElementById('tituloModal').textContent = 'Historial del producto ' + dataProducto.nombre;
        cargarInventarioIndividual();
    });

    (function () {
        let id_producto = document.getElementById('idProducto').value;
        if (id_producto != '') {
            dataProducto.id_productos = id_producto;
            dataProducto.nombre = document.getElementById('nombreProducto').value;
            document.getElementById('formularioProducto').setAttribute('action', URLactual + 'actualizar/' + id_producto);
            activarSelect2();
            document.getElementById('formEditarProducto').style.display = '';
        }
    })();

});