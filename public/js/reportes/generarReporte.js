$(document).ready(function () {

    const fecha = new Date();

    for (let i = 2023; i <= fecha.getFullYear(); i++) {
        $('#selectAnio').append(`<option value="${i}">${i}</option>`);
    }

    function establecerAnioMes() {
        $('#selectAnio').val(fecha.getFullYear());
        $('#selectMes').val(fecha.getMonth() + 1);
    }

    $('#selectTipoReporte').select2({
        theme: 'bootstrap4',
        placeholder: 'Tipo de reporte',
        minimumResultsForSearch: -1,
        width: '100%'
    });

    $('#selectAnio').select2({
        theme: 'bootstrap4',
        placeholder: 'Año',
        minimumResultsForSearch: -1,
        width: '100%'
    });

    $('#selectMes').select2({
        theme: 'bootstrap4',
        placeholder: 'Mes',
        minimumResultsForSearch: -1,
        width: '100%'
    });

    $('#selectEstadoProducto').select2({
        theme: 'bootstrap4',
        placeholder: 'Estado producto',
        minimumResultsForSearch: -1,
        width: '100%'
    });

    $('#selectEstado').select2({
        theme: 'bootstrap4',
        placeholder: 'Estado',
        minimumResultsForSearch: -1,
        width: '100%'
    });

    $('#selectProveedor').select2({
        theme: 'bootstrap4',
        placeholder: 'Proveedor',
        width: '100%'
    });

    $('#selectProducto').select2({
        theme: 'bootstrap4',
        placeholder: 'Producto',
        width: '100%'
    });

    function parametrosReporteElegido(tipoReporte) {
        if ($('.filtros').is(':visible')) {
            $('.filtros').css('display', 'none');
        }
        if (tipoReporte == 2) {
            if ($('#filtroAnio').is(':hidden')) {
                $('#filtroAnio').css('display', '');
            }
            if ($('#filtroProveedor').is(':hidden')) {
                $('#filtroProveedor').css('display', '');
            }     
        } 
        else if (tipoReporte == 3) {
            if ($('#filtroEstadoProducto').is(':hidden')) {
                $('#filtroEstadoProducto').css('display', '');
            }  
        }
        else if (tipoReporte == 4) {
            if ($('#filtroAnio').is(':hidden')) {
                $('#filtroAnio').css('display', '');
            }
            if ($('#filtroProducto').is(':hidden')) {
                $('#filtroProducto').css('display', '');
            }
        } 
        else if (tipoReporte == 5) {
            if ($('#filtroAnio').is(':hidden')) {
                $('#filtroAnio').css('display', '');
            }
            if ($('#filtroMes').is(':hidden')) {
                $('#filtroMes').css('display', '');
            }
            if ($('#filtroEstado').is(':hidden')) {
                $('#filtroEstado').css('display', '');
            }
        }
    }

    $('#selectTipoReporte').on('change', function () {
        if ($(this).hasClass('is-invalid')) {
            $(this).removeClass('is-invalid');
        }
        $('.filtro-select').val('');
        establecerAnioMes();
        $('.filtro-select').trigger('change');
        
        parametrosReporteElegido(this.value);
    });

    $('#formReportes').validate({
        rules: {
            tipoReporte: {
                required: true,
            },
            anio: {
                required: {
                    depends: function (element) {
                        if ($('#selectTipoReporte').val() != 1 || 3) {
                            return true;
                        } 
                        return false;
                    }
                },
            },
            mes: {
                required: {
                    depends: function (element) {
                        if ($('#selectTipoReporte').val() == 5) {
                            return true;
                        } 
                        return false;
                    }
                },
            },
            estadoProducto: {
                required: {
                    depends: function (element) {
                        if ($('#selectTipoReporte').val() == 3) {
                            return true;
                        } 
                        return false;
                    }
                },
            },
            estado: {
                required: {
                    depends: function (element) {
                        if ($('#selectTipoReporte').val() == 5) {
                            return true;
                        } 
                        return false;
                    }
                },
            },
            proveedorId: {
                required: {
                    depends: function (element) {
                        if ($('#selectTipoReporte').val() == 2) {
                            return true;
                        } 
                        return false;
                    }
                },
            },
            productoId: {
                required: {
                    depends: function (element) {
                        if ($('#selectTipoReporte').val() == 4) {
                            return true;
                        } 
                        return false;
                    }
                },
            }
        },
        messages: {
            tipoReporte: {
                required: 'Se requiere que seleccione un tipo de reporte',
            },
            anio: {
                required: 'Se requiere que seleccione el año',
            },
            mes: {
                required: 'Se requiere que seleccione el mes',
            },
            estadoProducto: {
                required: 'Se requiere que seleccione el estado del producto',
            },
            estado: {
                required: 'Se requiere que seleccione el estado',
            },
            proveedorId: {
                required: 'Se requiere que seleccione el proveedor',
            },
            productoId: {
                required: 'Se requiere que seleccione el producto',
            }
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

    $('select.filtro-select').change(function (event) {
        if ($(this).hasClass('is-invalid')) {
            $(this).removeClass('is-invalid');
        }
    });

    $('#btnExcel').click(function () {
        if($('#formReportes').valid()){
            $('#inputFormato').val('excel');
            document.getElementById('formReportes').submit();
        }
    });

    $('#btnPdf').click(function () {
        if($('#formReportes').valid()){
            $('#inputFormato').val('pdf');
            document.getElementById('formReportes').submit();
        }
    });

});