@extends('adminlte::page')

@section('title', 'Nuevo producto')

@section('content_header')
@stop

@section('content')
    <section class="content-header mt-n2">
        <div class="card card-orange mx-n3">
            <div class="card-header">
                <h3 class="card-title">Registrar nuevo producto</h3>
            </div>
            <form action="" method="POST">
                @csrf
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
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            </form>
        </div>
    </section>
@stop

@section('plugins.Sweetalert2', true)

@section('css')
@stop

@section('js')
    {{-- <script src="{{ asset('js/productos/productosMostrar.js') }}"></script> --}}
@stop