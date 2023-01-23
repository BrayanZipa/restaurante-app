<div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Extra Large Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


        {{-- <div class="card card-primary mt-n1 "> --}}
            {{-- <div class="card-header">
                <h3 class="card-title">Listado de registros</h3>
            </div> --}}
            {{-- <div class="card-body"> --}}
                <table id="tabla_inventario" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Estado</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Última existencia</th>
                            <th>Costo</th>
                            <th>Costo unitario</th>
                            <th>Fecha vencimiento</th>
                            <th>Fecha registro</th>
                            <th>Hora registro</th>
                            <th>Ingresado por</th>
                        </tr>
                    </thead>
                </table>
            {{-- </div>
        </div> --}}











                
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal-dialog modal-xl">...</div>

<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-xl">
    Launch Extra Large Modal
</button>
