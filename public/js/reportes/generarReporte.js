$(document).ready(function () {

    const fecha = new Date();

    for (let i= 2023; i <= fecha.getFullYear(); i++) {
        $('#selectAnio').append(`<option value="${i}">${i}</option>`);
    }

    function establecerAnioMes() {
        $('#selectAnio').val(fecha.getFullYear());
        $('#selectMes').val(fecha.getMonth() + 1);
    }
    establecerAnioMes();  

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

    $('#selectEstado').select2({
        theme: 'bootstrap4',
        placeholder: 'Estado',
        minimumResultsForSearch: -1,
        width: '100%'
    });

    function parametrosReporteElegido(tipoReporte) {
        if(tipoReporte == 1){
            if ($('#filtroProveedor').is(':hidden')) {
                $('#filtroProveedor').css('display', '');
            }
            if ($('#filtroProducto').is(':visible')) {
                $('#filtroProducto').css('display', 'none');
            }
            if ($('#filtroAnio').is(':visible')) {
                $('#filtroAnio').css('display', 'none');
            }
            if ($('#filtroMes').is(':visible')) {
                $('#filtroMes').css('display', 'none');
            }
            if ($('#filtroEstado').is(':visible')) {
                $('#filtroEstado').css('display', 'none');
            }
        }
        else if(tipoReporte == 2){
            if ($('#filtroProducto').is(':hidden')) {
                $('#filtroProducto').css('display', '');
            }
            if ($('#filtroProveedor').is(':visible')) {
                $('#filtroProveedor').css('display', 'none');
            }
            if ($('#filtroAnio').is(':visible')) {
                $('#filtroAnio').css('display', 'none');
            }
            if ($('#filtroMes').is(':visible')) {
                $('#filtroMes').css('display', 'none');
            }
            if ($('#filtroEstado').is(':visible')) {
                $('#filtroEstado').css('display', 'none');
            }   
        }
        else if (tipoReporte == 3) {
            // $('#selectAnio').prop('required', true);
            // $('#selectMes').prop('required', true);

            if ($('#filtroAnio').is(':hidden')) {
                $('#filtroAnio').css('display', '');
            }
            if ($('#filtroMes').is(':hidden')) {
                $('#filtroMes').css('display', '');
            }
            if ($('#filtroEstado').is(':hidden')) {
                $('#filtroEstado').css('display', '');
            }
            if ($('#filtroProveedor').is(':visible')) {
                $('#filtroProveedor').css('display', 'none');
            }
            if ($('#filtroProducto').is(':visible')) {
                $('#filtroProducto').css('display', 'none');
            }
        }
    }

    $('#selectTipoReporte').on('change', function () { 
        // if ($('#botones').is(':hidden')) {
        //     $('#botones').css('display', '');
        // }
        // if ($('#columnaBoton').is(':hidden')) {
        //     $('#columnaBoton').css('display', '');
        // }
        // $('.requerido').prop('required', false);
        // $('#btnLimpiar').trigger('click');
        parametrosReporteElegido(this.value);
    });




        $('#btnExcel').click(function () {
            // if(validarInputs()){
            $('#inputFormato').val('excel');
            document.getElementById('formReportes').submit();
            // }
        });

        $('#btnPdf').click(function () {
            // if(validarInputs()){
            $('#inputFormato').val('pdf');
            document.getElementById('formReportes').submit();
            // }
        });

    });