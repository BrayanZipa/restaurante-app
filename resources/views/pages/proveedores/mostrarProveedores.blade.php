@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
@stop

@section('content')
<section class="content-header mt-n2">
    <div id="tarjetaProveedores" class="card card-dark mx-n3">
        <div class="card-header">
            <h3 class="card-title">Proveedores</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            {{-- Formulario --}}
        </div>
    </div>

    <div class="card card-dark mt-n1 mx-n3">
        <div class="card-header">
            <h3 class="card-title">Listado de proveedores</h3>
        </div>
        <div class="card-body">
            <table id="tabla_proveedores" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Nit</th>
                        <th>Teléfono</th>
                        <th>Correo electrónico</th>
                        <th>Dirección</th>
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

@section('css')
@stop

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)

@section('js')
    <script src="{{ asset('js/proveedores/proveedoresMostrar.js') }}"></script>
@stop
