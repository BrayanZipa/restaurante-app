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
            estado: {
                required: true,
            },
            id_producto: {
                required: true,
            },
            cantidad: {
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
            }
        },
        messages: {
            estado: {
                required: 'Se requiere que ingrese el estado del registro',
            },
            id_producto: {
                required: 'Se requiere que ingrese el nombre del producto',
            },
            cantidad: {
                required: 'Se requiere que ingrese la cantidad de unidades del producto',
                digits: 'La cantidad debe ser un valor númerico entero',
                number: 'La cantidad debe ser un valor númerico entero'
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
        }
    });

    $('select.inventario').change(function (event) {
        $(this).removeClass('is-invalid');
    });

    $('#estadoInventario').change(function (event) {
        console.log(event);
        let valor = event.target.value;
        if (valor == 1) {
            $('.oculto').css('display', '');
        } else {
            $('.oculto').css('display', 'none');
        }
    });
});