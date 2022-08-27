@extends('adminlte::page')

@section('title', 'Inventario')

@section('content_header')
@stop

@section('content')
    <section class="content-header mt-n2">
        <div class="card card-primary mx-n3">
            <div class="card-header">
                <h3 class="card-title">Alimentar inventario</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <h1>Ingrese el producto</h1>
                <form action="" method="POST">
                    <table>
                        <tr>
                            <td>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Estado del producto</label>
                                    <input type="text" class="formulario form-control">
                                </div>
                            </td>
                            <td>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Nombre del producto</label>
                                    <input type="text" class="formulario form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">cantidad</label>
                                    <input type="text" class="formulario form-control">
                                </div>
                            </td>
                            <td>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">costo</label>
                                    <input type="text" class="formulario form-control">
                                </div>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                <div class="mb-3">
                                    <select class="formulario form-select" formControlName="Ingresado por">
                                    <option disabled selected>Selecione un usuario</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                        <a href="" class="btn btn-primary">Registrar</a>
                </form>
    
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
                            <th>Producto</th>
                            <th>Fecha y hora</th>
                            <th>Cantidad</th>
                            <th>Costo</th>
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
    <script src="{{ asset('js/inventario/inventarioMostrar.js') }}"></script>
@stop