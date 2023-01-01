$(document).ready(function () {

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

    document.getElementById('nombreProducto').addEventListener('keyup', function (evento) {
        let input = evento.target.value;
        document.getElementById('nombreProducto').value = input.charAt(0).toUpperCase() + input.slice(1).toLowerCase();
    });

    $('#formCrearProducto').validate({
        rules: {
            nombre: {
                required: true,
                maxlength: 50,
                minlength: 4,
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
            total: {
                required: true,
                digits: true,
            },
            costo: {
                required: true,
                digits: true,
            },
            fecha_vencimiento: {
                required: true,
                date: true,
            },
        },
        messages: {
            nombre: {
                required: 'Se requiere que ingrese el nombre del producto',
                maxlength: 'El nombre debe tener máximo 50 caracteres',
                minlength: 'El nombre debe tener mínimo 5 caracteres',
            },
            codigo: {
                required: 'Se requiere que ingrese el código o identificador del producto',
                maxlength: 'El código debe tener máximo 15 digitos',
                minlength: 'El código debe tener mínimo 5 digitos',
            },
            id_proveedor: {
                required: 'Se requiere que ingrese el proveedor del producto',
            },
            id_unidad: {
                required: 'Se requiere que ingrese la unidad de medida del producto',
            },
            total: {
                required: 'Se requiere que ingrese el total inicial del producto',
                digits: 'El total inicial debe ser un valor númerico entero',
                number: 'El total inicial debe ser un valor númerico entero'
            },
            costo: {
                required: 'Se requiere que ingrese el costo del producto',
                digits: 'El costo debe ser un valor númerico entero',
                number: 'El costo debe ser un valor númerico entero',
            },
            fecha_vencimiento: {
                required: 'Se requiere que ingrese la fecha de vencimiento del producto',
                date: 'La fecha de vencimiento debe tener un formato válido',
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

});