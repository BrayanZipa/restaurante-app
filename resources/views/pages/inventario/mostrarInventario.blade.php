@extends('adminlte::page')

@section('title', '| Inventario')

@section('content_header')
@stop

@section('content')
    <section class="content-header mt-n2">
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
                            <th>Código</th>
                            <th>Producto</th>
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

@section('css')
@stop

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Moment', true)

@section('js')
    <script src="{{ asset('js/inventario/inventarioMostrar.js') }}"></script>
@stop
