@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
@stop

@section('content')
    <section class="content-header mt-n2">
        <form action="" method="POST">
            @csrf
            <div class="card card-orange mx-n3">
                <div class="card-header">
                    <h3 class="card-title">Consultar producto</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nombreProducto">Ingrese el nombre del producto</label>
                                <input type="text" id="nombreProducto" class="form-control" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="codigoProducto">Ingrese el código del producto</label>
                                <input type="text" id="codigoProducto" class="form-control" placeholder="Código">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="unidadProducto">Ingrese la unidad del producto</label>
                                <input type="text" id="unidadProducto" class="form-control" placeholder="Unidad">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="proveedorProducto">Ingrese el proveedor del producto</label>
                                <select id="proveedorProducto" class="form-control">
                                    <option disabled selected>Seleccione el proveedor</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="totalProducto">Ingrese el total inicial de unidades  del producto</label>
                                <input type="number" id="totalProducto" class="form-control" placeholder="Total inicial">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-success">Actualizar</button>
                    <button type="button" class="btn btn-danger">Eliminar</button>
                </div>   
            </div>
        </form>


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