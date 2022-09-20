$(document).ready(function () {

    var servidor = window.location.origin + '/';
    var URLactual = servidor + 'productos/';
    var dataProducto = null;

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
        // 'serverSide': true,
        // 'scrollY': '300px',
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
            },
            {
                'data': 'name',
                'name': 'name',
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
        document.getElementById('formularioProducto').setAttribute('action', URLactual + 'actualizar/' + data.id_productos);
        document.getElementById('nombreProducto').value = data.nombre;
        document.getElementById('codigoProducto').value = data.codigo;
        document.getElementById('unidadProducto').value = data.unidad;
        document.getElementById('proveedorProducto').value = data.id_proveedor;
        document.getElementById('totalProducto').value = data.total;
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
        })
    }

    document.getElementById('btnOcultar').addEventListener('click', function () {
        document.getElementById('formEditarProducto').style.display = 'none';
    });

    $('#formularioProducto').validate({
        rules: {
            nombre: {
                required: true,
                maxlength: 40,
                minlength: 5
            },
            codigo: {
                required: true,
                digits: true,
                maxlength: 10,
                minlength: 5,
            },
            id_proveedor: {
                required: true,
            },
            unidad: {
                required: true,
            },
            total: {
                required: true,
                digits: true,
            },
        },
        messages: {
            nombre: {
                required: 'Se requiere que ingrese el nombre del producto',
                maxlength: 'El nombre debe tener máximo 40 caracteres',
                minlength: 'El nombre debe tener mínimo 5 caracteres',
            },
            codigo: {
                required: 'Se requiere que ingrese el codigo o identificador del producto',
                digits: 'El codigo debe ser un valor númerico y no debe contener espacios',
                maxlength: 'El codigo debe tener máximo 10 digitos',
                minlength: 'El codigo debe tener mínimo 5 digitos',
            },
            id_proveedor: {
                required: 'Se requiere que elija el nombre del proveedor del producto',
            },
            unidad: {
                required: 'Se requiere que ingrese la unidad del producto',

            },
            total: {
                required: 'Se requiere que ingrese el total inicial del producto',
                digits: 'El codigo debe ser un valor númerico y no debe contener espacios',
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

});