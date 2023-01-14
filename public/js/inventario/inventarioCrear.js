$(document).ready(function () {

    $('#estadoInventario').select2({
        theme: 'bootstrap4',
        placeholder: 'Seleccione el estado',
        minimumResultsForSearch: -1,
        language: {
            noResults: function () {
                return 'No hay resultado';
            }
        }
    });

    $('#productoInventario').select2({
        theme: 'bootstrap4',
        placeholder: 'Seleccione el producto',
        language: {
            noResults: function () {
                return 'No hay resultado';
            }
        }
    });
    

    $('#formCrearInventario').validate({
        rules: {
            estado:{
                required: true,
            },
            id_producto:{
                required: true,
            },
            cantidad:{
                required: true,
                maxlength: 15,
                minlength: 1,
                digits: true,
            },
            costo: {
                required: true,
                digits: true,
            },
            fecha_vencimiento:{
                required: true,
                date: true,
            }
            
        },
        messages: {
            estado:{
                required: 'Se requiere que ingrese el estado del registro',
            },
            id_producto:{
                required: 'Se requiere que ingrese el id del producto',
            },
            cantidad:{
                required: 'Se requiere que ingrese la cantidad de unidades del producto',
                maxlength: 'La cantidad de unidades del producto debe tener maximo 15 digitos',
                minlength: 'La cantidad de unidades del producto debe tener mínimo 1 digito',
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
});