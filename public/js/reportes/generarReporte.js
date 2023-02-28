$(document).ready(function () {

    $('#selectTipoReporte').select2({
        theme: 'bootstrap4',
        placeholder: 'Seleccione el tipo de reporte',
        width: '100%',
        language: {
            noResults: function () {
                return 'No hay resultado';
            }
        }
    });

    $('#btnExcel').click(function() {
        if(validarInputs()){
            $('#inputFormato').val('excel');
            document.getElementById('formulario').submit();
        }
    });

    $('#btnPdf').click(function() {
        if(validarInputs()){
            $('#inputFormato').val('pdf');
            document.getElementById('formulario').submit();
        }
    });

});