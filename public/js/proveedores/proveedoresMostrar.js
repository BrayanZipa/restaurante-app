console.log('Hi!');
// Swal.fire('Any fool can use a computer');

var servidor = window.location.origin + '/';
var URLactual = servidor + 'proveedores/';

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
                    '<a href="proveedores/eliminar" class="btn btn-danger btn-icon btn-sm">' +
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

    $('div.dataTables_filter input', $('#tabla_proveedores').DataTable().table().container()).focus();


    $('#tabla_proveedores tbody').on('click', '.editar_proveedor', function () {
        let data = $('#tabla_proveedores').DataTable().row(this).data();
        document.getElementById('formularioProveedor').setAttribute('action', URLactual + 'actualizar/' + data.id_proveedores);
        document.getElementById('nombreProveedor').value = data.nombre;
        document.getElementById('nitProveedor').value = data.nit;
        document.getElementById('telefonoProveedor').value = data.telefono;
        document.getElementById('correoProveedor').value = data.correo;
        document.getElementById('direccionProveedor').value = data.direccion;
        document.getElementById('formEditarProveedor').style.display = '';
    });
});