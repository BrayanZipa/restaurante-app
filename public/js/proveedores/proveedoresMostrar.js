var servidor = window.location.origin + '/';
var URLactual = servidor + 'proveedores/';
var dataProveedor = null;

// Token de Laravel
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready( function () {
    var tablaProveedores = $('#tabla_proveedores').DataTable({
        'ajax': URLactual + 'lista_proveedores',
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
                'data': 'id_proveedores',
                'name': 'id_proveedores'
            },
            {
                'data': 'nombre',
                'name': 'nombre'
            },
            {
                'data': 'nit',
                'name': 'nit',
            },
            {
                'data': 'telefono',
                'name': 'telefono',
            },
            {
                'data': 'correo',
                'name': 'correo',
            },
            {
                'data': 'direccion',
                'name': 'direccion',
            },
            {
                'data': 'name',
                'name': 'name',
            },
            {
                'class': 'editar_proveedor',
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
                'class': 'eliminar_proveedor',
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

    $('div.dataTables_filter input', tablaProveedores.table().container()).focus();

    $('#tabla_proveedores tbody').on('click', '.editar_proveedor', function () {
        let data = tablaProveedores.row(this).data();
        dataProveedor = data;
        document.getElementById('formularioProveedor').setAttribute('action', URLactual + 'actualizar/' + data.id_proveedores);
        document.getElementById('nombreProveedor').value = data.nombre;
        document.getElementById('nitProveedor').value = data.nit;
        document.getElementById('telefonoProveedor').value = data.telefono;
        document.getElementById('correoProveedor').value = data.correo;
        document.getElementById('direccionProveedor').value = data.direccion;
        document.getElementById('formEditarProveedor').style.display = '';
    });

    $('#tabla_proveedores tbody').on('click', '.eliminar_proveedor', function () {
        let data = tablaProveedores.row(this).data();
        eliminarProveedor(data.id_proveedores, data.nombre);
    });

    document.getElementById('eliminar_proveedor2').addEventListener('click', function () {
        eliminarProveedor(dataProveedor.id_proveedores, dataProveedor.nombre);
    });

    function eliminarProveedor(id, nombre) {
        Swal.fire({
            title: '¿Desea eliminar al proveedor <b>' + nombre + '</b> ?',
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
                    success: function() {
                        let tarjetaForm = document.getElementById('formEditarProveedor');
                        if (tarjetaForm.style.display != 'none'){
                            tarjetaForm.style.display = 'none'; 
                        }
                        tablaProveedores.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Proveedor <b>' + nombre + '</b> eliminado exitosamente',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Algo salió mal',
                            text: 'Error al tratar de eliminar el proveedor del sistema',
                        })
                    }
                });
            }
        })
    }

    document.getElementById('btnOcultar').addEventListener('click', function () {
        document.getElementById('formEditarProveedor').style.display = 'none';
    });


    // document.getElementById('formCrearProveedor').addEventListener('submit', function (e) {
        // e.preventDefault();
    //     document.getElementById('formEditarProveedor').style.display = 'none';
    // });
});