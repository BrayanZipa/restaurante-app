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

});