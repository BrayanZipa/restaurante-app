$(document).ready(function () {

    var servidor = window.location.origin + '/';
    var URLactual = servidor + 'unidades/';
    var dataUnidad = {};

    document.getElementById('nombreUnidad').focus();

    // Token de Laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var tablaUnidades = $('#tabla_unidades').DataTable({
        'ajax': URLactual + 'lista_unidades',
        'type': 'GET',
        'destroy': true,

        'processing': true,
        'responsive': true,
        'autoWidth': false,
        'dataType': 'json',
        'columns': [
            {
                'data': 'id_unidades',
                'name': 'id_unidades'
            },
            {
                'data': 'unidad',
                'name': 'unidad'
            },
            {
                'data': 'abreviacion',
                'name': 'abreviacion'
            },

            {
                'data': 'updated_at',
                'name': 'updated_at',
                render: function (data) {
                    return moment(data).format('DD-MM-YYYY - h:mm a');
                }
            },
            {
                'class': 'editar_unidad',
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
                'class': 'eliminar_unidad',
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

    document.getElementById('nombreUnidad').addEventListener('keyup', function (evento) {
        let input = evento.target.value;
        document.getElementById('nombreUnidad').value = input.charAt(0).toUpperCase() + input.slice(1).toLowerCase();
    });

    document.getElementById('abreviacionUnidad').addEventListener('keyup', function (evento) {
        let input = evento.target.value;
        document.getElementById('abreviacionUnidad').value = input.charAt(0).toUpperCase() + input.slice(1).toLowerCase();
    });

    $('#tabla_unidades tbody').on('click', '.editar_unidad', function () {
        let inputUnidad = document.getElementById('nombreUnidad');
        let inputAbreviacion = document.getElementById('abreviacionUnidad');
        dataUnidad = tablaUnidades.row(this).data();
        inputUnidad.value = dataUnidad.unidad;
        inputAbreviacion.value = dataUnidad.abreviacion;
        document.getElementById('btnActualizar').disabled = false;
        if (inputUnidad.classList.contains('is-invalid')) {
            inputUnidad.classList.remove('is-invalid');
        }
        if (inputAbreviacion.classList.contains('is-invalid')) {
            inputAbreviacion.classList.remove('is-invalid');
        }
    });

    $('#btnActualizar').on('click', function () {
        if ($('#formCrearUnidad').valid()) {
            $.ajax({
                url: URLactual + 'actualizar/' + dataUnidad.id_unidades,
                type: 'put',
                data: {
                    unidad: document.getElementById('nombreUnidad').value,
                    abreviacion: document.getElementById('abreviacionUnidad').value,
                },
                dataType: 'json',
                success: function (response) {
                    tablaUnidades.ajax.reload();
                    Swal.fire({
                        icon: 'success',
                        title: 'Unidad <b>' + response.unidad + '</b> actualizada exitosamente',
                        showConfirmButton: false,
                        timer: 2000
                    })
                },
                error: function (error) {
                    if ('errors' in error.responseJSON) {
                        if ($('.errorServidor').length) {
                            $('.errorServidor').remove();
                        }
                        if('unidad' in error.responseJSON.errors){
                            $('#nombreUnidad').addClass('is-invalid');
                            $('#nombreUnidad').after(`<span class="errorServidor invalid-feedback">${error.responseJSON.errors.unidad}</span>`);
                        } 
                        if('abreviacion' in error.responseJSON.errors) {
                            $('#abreviacionUnidad').addClass('is-invalid');
                            $('#abreviacionUnidad').after(`<span class="errorServidor invalid-feedback">${error.responseJSON.errors.abreviacion}</span>`);
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Algo salió mal',
                            text: 'Error al tratar de actualizar la unidad en el sistema',
                        })
                    }
                }
            });
        }
    });

    $('#tabla_unidades tbody').on('click', '.eliminar_unidad', function () {
        let data = tablaUnidades.row(this).data();
        Swal.fire({
            title: '¿Desea eliminar la unidad de medida <b>' + data.unidad + '</b> ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: URLactual + 'eliminar/' + data.id_unidades,
                    type: 'delete',
                    success: function () {
                        tablaUnidades.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Unidad <b>' + data.unidad + '</b> eliminada exitosamente',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'No es posible eliminar la unidad de medida <b>' + data.unidad + '</b>',
                            text: 'No se puede eliminar la unidad del sistema debido a que esta asociada a otros registros',
                            confirmButtonText: 'Confirmar',
                        })
                    }
                });
            }
        })
    });

    $('#formCrearUnidad').validate({
        rules: {
            unidad: {
                required: true,
                maxlength: 15,
                minlength: 2
            },
            abreviacion: {
                required: true,
                maxlength: 3,
                minlength: 1
            },
        },
        messages: {
            unidad: {
                required: 'Se requiere que ingrese el nombre de la unidad',
                maxlength: 'El nombre debe tener máximo 15 caracteres',
                minlength: 'El nombre debe tener mínimo 2 caracteres',
            },
            abreviacion: {
                required: 'Se requiere que ingrese la abreviacion de la unidad',
                maxlength: 'La abreviacion debe tener máximo 3 caracteres',
                minlength: 'La abreviacion debe tener mínimo 1 caracter',
            },
        
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            error.insertAfter(element);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });

    $('#nombreUnidad, #abreviacionUnidad').keydown(function (event) {
        let divPadre = $(this).closest('.col-12');
        if (divPadre.find('.errorServidor').length) {
            $(this).removeClass('is-invalid');
            divPadre.find('.errorServidor').text('');
            divPadre.find('.errorServidor').removeClass('errorServidor');
        }
    });

});