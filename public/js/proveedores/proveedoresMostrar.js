console.log('Hi!');
Swal.fire('Any fool can use a computer');

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

    $('div.dataTables_filter input', $('#tabla_proveedores').DataTable().table().container()).focus();
});

// console.log($('#tarjetaProveedores').css('display', 'none'));

// $('#boton').click(function () {
//     alert($('#inputHola').val());
// });

// function datatableRegistrosSalida(){
//     $('#tabla_registros_salida').DataTable({
//         'destroy': true,
//         'processing': true,
//         'responsive': true,
//         'autoWidth': false,
//         // 'serverSide': true,
//         // 'scrollY': '300px',
//         'ajax': 'informacion_sin_salida',
//         'dataType': 'json',
//         'type': 'GET',
//         'columns': [
//             {
//                 'data': 'id_registros',
//                 'name': 'id_registros'
//             },
//             {
//                 'data': 'tipopersona',
//                 'name': 'tipopersona'
//             },
//             {  
//                 'data': null, 
//                 'name': 'nombre',
//                 render: function ( data, type, row ) {
//                     return data.nombre+' '+data.apellido;
//                 }
//             },
//             {
//                 'data': 'identificacion',
//                 'name': 'identificacion',
//             },
//             {
//                 'data': 'tel_contacto',
//                 'name': 'tel_contacto',
//             },  
//             {
//                 'data': 'ingreso_persona',
//                 render: function (data) {
//                     return moment(data).format('DD-MM-YYYY');
//                 } 
//             },
//             {
//                 'data': 'ingreso_persona',
//                 render: function (data) {
//                     return moment(data).format('h:mm:ss a');
//                 } 
//             },
//             {
//                 'data': 'ingreso_activo',
//                 render: function (data, type, row) {
//                     if(data != null){ return row.codigo_activo; }
//                     return 'No';
//                 } 
//             },
//             {
//                 'data': 'ingreso_vehiculo',
//                 render: function (data, type, row ) {
//                     if(data != null){ return row.identificador; }
//                     return 'No';
//                 }
//             },     
//             {
//                 'data': 'name',
//                 'name': 'name',
//                 // 'searchable': false,
//                 // 'orderable': false
//             },
//             {
//                 'class': 'registrar_salida',
//                 'orderable': false,
//                 'data': null,
//                 'defaultContent': '<td>' +
//                     '<div class="action-buttons text-center">' +
//                     '<a href="#" class="btn btn-primary btn-icon btn-sm">' +
//                     '<i class="fa-solid fa-arrow-right-from-bracket"></i>' +
//                     '</a>' +
//                     '</div>' +
//                     '</td>',
//             }],
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
//     $('div.dataTables_filter input', $('#tabla_registros_salida').DataTable().table().container()).focus();
// }
// datatableRegistrosSalida();
