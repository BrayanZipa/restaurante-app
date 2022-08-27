var servidor = window.location.origin + '/';
var URLactual = servidor + 'inventario/';

$(document).ready( function () {
    var tablaInventarios = $('#tabla_inventarios').DataTable({
        'ajax': URLactual + 'lista_inventarios',
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
                'data': 'id_inventario',
                'name': 'id_inventario'
            },
            {
                'data': 'estado',
                'name': 'estado'
            },
            {
                'data': 'producto',
                'name': 'producto',
            },
            {
                'data': 'fecha',
                'name': 'fecha',
            },
            {
                'data': 'cantidad',
                'name': 'cantidad',
            },
            {
                'data': 'costo',
                'name': 'costo',
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
});
// var servidor = window.location.origin + '/';
// var URLactual = servidor + 'inventarios/';

// $(document).ready( function () {
//     var tablaInventarios = $('#tabla_inventarios').DataTable({
//         'ajax': URLactual + 'lista_inventarios',
//         'type': 'GET',
//         'destroy': true,
//         'processing': true,
//         'responsive': true,
//         'autoWidth': false,
//         'dataType': 'json',
//         // 'serverSide': true,
//         // 'scrollY': '300px',
//         'columns': [
//             {
//                 'data': 'id_inventario',
//                 'name': 'id_inventario'
//             },
//             {
//                 'data': 'nombre',
//                 'name': 'nombre'
//             },
//             {
//                 'data': 'codigo',
//                 'name': 'codigo',
//             },
//             {
//                 'data': 'unidad',
//                 'name': 'unidad',
//             },
//             {
//                 'data': 'proveedor',
//                 'name': 'proveedor',
//             },
//             {
//                 'data': 'total',
//                 'name': 'total',
//             },
//             {
//                 'data': 'name',
//                 'name': 'name',
//             },
//             {
//                 'class': 'editar_producto',
//                 'orderable': false,
//                 'data': null,
//                 'defaultContent': '<td>' +
//                     '<div class="action-buttons text-center">' +
//                     '<a href="#" class="btn btn-primary btn-icon btn-sm">' +
//                     '<i class="fas fa-edit"></i>' +
//                     '</a>' +
//                     '</div>' +
//                     '</td>',
//             },
//             {
//                 'class': 'eliminar_producto',
//                 'orderable': false,
//                 'data': null,
//                 'defaultContent': '<td>' +
//                     '<div class="action-buttons text-center">' +
//                     '<a href="#" class="btn btn-danger btn-icon btn-sm">' +
//                     '<i class="fas fa-trash-alt"></i>' +
//                     '</a>' +
//                     '</div>' +
//                     '</td>',
//             }
//         ],
//         'order': [[0, 'desc']],
//         'lengthChange': true,
//         'lengthMenu': [
//             [6, 10, 25, 50, 75, 100, -1],
//             [6, 10, 25, 50, 75, 100, 'ALL']
//         ],
//         'language': {
//             'lengthMenu': 'Mostrar _MENU_ registros por página',
//             'zeroRecords': 'No hay registros',
//             'info': 'Mostrando página _PAGE_ de _PAGES_',
//             'infoEmpty': 'No hay registros disponibles',
//             'infoFiltered': '(filtrado de _MAX_ registros totales)',
//             'search': 'Buscar:',
//             'paginate': {
//                 'next': 'Siguiente',
//                 'previous': 'Anterior'
//             }
//         }, 
//     });

//     $('div.dataTables_filter input', $('#tabla_productos').DataTable().table().container()).focus();
// });