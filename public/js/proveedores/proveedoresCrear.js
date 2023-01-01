$(document).ready(function () {

    document.getElementById('nombreProveedor').addEventListener('keyup', function (evento) {
        let input = evento.target.value;
        document.getElementById('nombreProveedor').value = input.charAt(0).toUpperCase() + input.slice(1);
    });

    document.getElementById('correoProveedor').addEventListener('keyup', function (evento) {
        let input = evento.target.value;
        document.getElementById('correoProveedor').value = input.slice(0).toLowerCase();
    });

    document.getElementById('direccionProveedor').addEventListener('keyup', function (evento) {
        let input = evento.target.value;
        document.getElementById('direccionProveedor').value = input.charAt(0).toUpperCase() + input.slice(1).toLowerCase();
    });

    $('#formCrearProveedor').validate({
        rules: {
            nombre: {
                required: true,
                maxlength: 50,
                minlength: 5
            },
            nit: {
                required: true,
                digits: true,
                maxlength: 15,
                minlength: 6,
            },
            telefono: {
                required: true,
                digits: true,
                maxlength: 10,
                minlength: 7,
            },
            correo: {
                email: true,
                maxlength: 50,
            },
            direccion: {
                maxlength: 50,
                minlength: 5
            },
        },
        messages: {
            nombre: {
                required: 'Se requiere que ingrese el nombre del proveedor',
                maxlength: 'El nombre debe tener máximo 50 caracteres',
                minlength: 'El nombre debe tener mínimo 5 caracteres',
            },
            nit: {
                required: 'Se requiere que ingrese el nit o identificador del proveedor',
                digits: 'El nit debe ser un valor númerico y no debe contener espacios',
                maxlength: 'El nit debe tener máximo 15 digitos',
                minlength: 'El nit debe tener mínimo 6 digitos',
            },
            telefono: {
                required: 'Se requiere que ingrese el teléfono del proveedor',
                digits: 'El teléfono debe ser un valor númerico y no debe contener espacios',
                maxlength: 'El teléfono debe tener máximo 10 digitos',
                minlength: 'El teléfono debe tener mínimo 7 digitos',
            },
            correo: {
                email: 'Ingrese una dirección de correo electrónico válida',
                maxlength: 'El correo debe tener máximo 50 caracteres',
            },
            direccion: {
                maxlength: 'La dirección debe tener máximo 50 caracteres',
                minlength: 'La dirección debe tener mínimo 5 caracteres',
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

    $('input.proveedor').keydown(function (event) {
        let divPadre = $(this).closest('.form-group');
        if (divPadre.find('.errorServidor').length) {
            $(this).removeClass('is-invalid');
            divPadre.find('.errorServidor').text('');
            divPadre.find('.errorServidor').removeClass('errorServidor');
        }
    });

});