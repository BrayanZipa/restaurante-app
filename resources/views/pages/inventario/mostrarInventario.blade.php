@extends('adminlte::page')

@section('title', '| Inventario')

@section('content_header')
@stop

@section('content')
    <section class="content-header mt-n2">
        <div id="formEditarInventario" style="display: none">
            <form id="formularioInventario" action="" method="post">
                @csrf
                @method('put')
                <div class="card card-primary mx-n3">
                    <div class="card-header">
                        <h3 class="card-title">Alimentar inventario</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" id="btnOcultar" class="btn btn-tool"><i
                                    class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="estadoInventario">Estado</label>
                                    <select id="estadoInventario" class="form-control">
                                        <option disabled selected>Seleccione el estado</option>
                                        <option value="1">Entrada</option>
                                        <option value="0">Salida</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="productoInventario">Ingrese el producto</label>
                                    <select id="productoInventario" class="form-control">
                                        <option disabled selected>Seleccione el producto</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="cantidadInventario">Ingrese la cantidad de unidades</label>
                                    <input type="number" id="cantidadInventario" class="form-control"
                                        placeholder="Cantidad">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="costoInventario">Ingrese el costo de las unidades</label>
                                    <input type="number" id="costoInventario" class="form-control" placeholder="Costo">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Actualizar</button>
                        <button type="button" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>
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
                            <th>Cantidad</th>
                            <th>Última existencia</th>
                            <th>Costo</th>
                            <th>Costo unitario</th>
                            <th>Fecha vencimiento</th>
                            <th>Fecha registro</th>
                            <th>Hora registro</th>
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
@section('plugins.Moment', true)

@section('js')
    <script src="{{ asset('js/inventario/inventarioMostrar.js') }}"></script>
@stop
