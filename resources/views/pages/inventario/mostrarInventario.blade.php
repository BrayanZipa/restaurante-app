@extends('adminlte::page')

@section('title', '| Inventario')

@section('content_header')
@stop

@section('content')
    <section class="content-header mt-n2">
        <div class="card card-primary mx-n3">
            <div class="card-header">
                <h3 class="card-title">Filtros de información</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="filtroBuscar">Buscador</label>
                            <input type="text" id="filtroBuscar" class="form-control filtros" autocomplete="off" placeholder="Buscar">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="filtroFechaV">Fecha de vencimiento</label>
                            <input type="text" id="filtroFechaV" class="form-control filtros" autocomplete="off" placeholder="Fecha vencimiento">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="form-group">
                            <label for="filtroFecha">Fecha de registro</label>
                            <input type="text" id="filtroFecha" class="form-control filtros" autocomplete="off" placeholder="Fecha registro">
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="form-group">
                            <label for="filtroEstado">Estado</label>
                            <select id="filtroEstado" class="form-control filtros">
                                <option disabled selected></option>
                                <option value=" ">---</option>
                                <option value="Ingreso">Ingreso</option>
                                <option value="Salida">Salida</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1 col-sm-12 d-flex align-items-end">
                        <div class="form-group">
                            <button id="btnFiltros" type="button" class="btn btn-primary" >Limpiar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-primary mt-n1 mx-n3">
            <div class="card-header">
                <h3 class="card-title">Listado de registros</h3>
            </div>
            <div class="card-body">
                <table id="tabla_inventarios" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Estado</th>
                            <th>Proveedor</th>
                            <th>Producto</th>
                            <th>Código</th>
                            <th>Cantidad</th>
                            <th>Última existencia</th>
                            <th>Costo</th>
                            <th>Costo unitario</th>
                            <th>Fecha vencimiento</th>
                            <th>Fecha registro</th>
                            <th>Hora registro</th>
                            <th>Ingresado por</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
@stop

@section('footer')
    @include('pages.footer')
@stop

@section('css')
@stop

@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Moment', true)
@section('plugins.DateRangePicker', true)

@section('js')
    <script src="{{ asset('js/inventario/inventarioMostrar.js') }}"></script>
@stop
