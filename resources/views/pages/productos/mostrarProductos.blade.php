@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
@stop

@section('content')
<section class="content-header mt-n2">
    <div class="card card-orange mx-n3">
        <div class="card-header">
            <h3 class="card-title">Productos</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            {{-- Formulario --}}
        </div>
    </div>

    <div class="card card-orange mt-n1 mx-n3">
        <div class="card-header">
            <h3 class="card-title">Listado de productos</h3>
        </div>
        <div class="card-body">
            <table id="tabla_productos" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Unidad</th>
                        <th>Proveedor</th>
                        <th>Total en exitencia</th>
                        <th>Ingresado por</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>
@stop

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('css')
@stop

@section('js')
    <script src="{{ asset('js/productos/productosMostrar.js') }}"></script>
@stop