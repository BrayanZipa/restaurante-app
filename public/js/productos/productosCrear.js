$(document).ready(function () {

    $('#proveedorProducto').select2({
        theme: 'bootstrap4',
        placeholder: 'Seleccione el proveedor',
        width: '100%',
        language: {
            noResults: function () {
                return 'No hay resultado';
            }
        }
    });

    $('#unidadProducto').select2({
        theme: 'bootstrap4',
        placeholder: 'Seleccione la unidad',
        width: '100%',
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
            peso: {
                required: true,
                digits: true,
            },
            id_unidad: {
                required: true,
            },
            id_proveedor: {
                required: true,
            },
            total: {
                required: true,
                digits: true,
                min: 1,
            },
            costo: {
                required: true,
                digits: true,
                maxlength: 15,
                minlength: 4,
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
            peso: {
                required: 'Se requiere que ingrese el peso del producto',
                digits: 'El peso debe ser un valor númerico entero',
                number: 'El peso debe ser un valor númerico entero'
            },
            id_unidad: {
                required: 'Se requiere que ingrese la unidad de medida del producto',
            },
            id_proveedor: {
                required: 'Se requiere que ingrese el proveedor del producto',
            },
            total: {
                required: 'Se requiere que ingrese el total inicial del producto',
                digits: 'El total inicial debe ser un valor númerico entero',
                number: 'El total inicial debe ser un valor númerico entero',
                min: 'El total inicial debe ser mayor a cero',
            },
            costo: {
                required: 'Se requiere que ingrese el costo del producto',
                digits: 'El costo debe ser un valor númerico entero',
                maxlength: 'El costo debe tener máximo 15 caracteres',
                minlength: 'El costo debe tener mínimo 4 caracteres',
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