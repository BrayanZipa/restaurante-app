@extends('adminlte::page')

@section('title', '| Productos')

@section('content_header')
@stop

@section('content')
    <section class="content-header mt-n2">
        <div id="formEditarProducto" style="display: none">
            <form id="formularioProducto" action="" method="post">
                @csrf
                @method('put')
                <div class="card card-orange mx-n3">
                    <div class="card-header">
                        <h3 class="card-title">Consultar producto</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" id="btnOcultar" class="btn btn-tool"><i
                                    class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" id="idProducto" name="id" value="{{ old('id') }}">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group" >
                                    <label>Total unidades en existencia</label><br>
                                    <input type="text" id="total" class="form-control" name="total" value="{{ old('total') }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Precio unitario actual</label><br>
                                    <input type="text" id="precioUnitario" class="form-control" name="precioUnitario" value="{{ old('precioUnitario') }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Fecha de la última compra</label><br>
                                    <input type="text" id="fechaUltimaCompra" class="form-control" name="fechaUltimaCompra" value="{{ old('fechaUltimaCompra') }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Fecha de vencimiento del último pedido</label><br>
                                    <input type="text" id="fechaVencimiento" class="form-control" name="fechaVencimiento" value="{{ old('fechaVencimiento') }}" readonly>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="nombreProducto">Nombre</label>
                                    <input type="text" id="nombreProducto"
                                        class="producto form-control @error('nombre') is-invalid @enderror" name="nombre"
                                        value="{{ old('nombre') }}" autocomplete="off" placeholder="Nombre">
                                    @error('nombre')
                                        <span class="errorServidor invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="codigoProducto">Código</label>
                                    <input type="text" id="codigoProducto"
                                        class="producto form-control @error('codigo') is-invalid @enderror" name="codigo"
                                        value="{{ old('codigo') }}" autocomplete="off" placeholder="Código">
                                    @error('codigo')
                                        <span class="errorServidor invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="proveedorProducto">Proveedor</label>
                                    <select id="proveedorProducto"
                                        class="producto form-control @error('id_proveedor') is-invalid @enderror"
                                        name="id_proveedor">
                                        <option value="" disabled selected>Seleccione el proveedor</option>
                                        @foreach ($proveedores as $proveedor)
                                            <option value="{{ $proveedor->id_proveedores }}"
                                                {{ $proveedor->id_proveedores == old('id_proveedor') ? 'selected' : '' }}>
                                                {{ $proveedor->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_proveedor')
                                        <span class="errorServidor invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="unidadProducto">Unidad de medida</label>
                                    <select id="unidadProducto"
                                        class="producto form-control @error('id_unidad') is-invalid @enderror"
                                        name="id_unidad">
                                        <option value="" disabled selected>Seleccione la unidad</option>
                                        @foreach ($unidades as $unidad)
                                            <option value="{{ $unidad->id_unidades }}"
                                                {{ $unidad->id_unidades == old('id_unidad') ? 'selected' : '' }}>
                                                {{ $unidad->unidad }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_unidad')
                                        <span class="errorServidor invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Actualizar</button>
                        <button type="button" id="eliminar_producto2" class="btn btn-danger">Eliminar</button>
                        <button type="button" id="historial_producto" class="btn btn-dark" data-toggle="modal" data-target="#modal-producto">Historial</button>
                    </div>
                </div>
            </form>
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
                            <th>Estado</th>
                            <th>Ingresado por</th>
                            <th>última actualización</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
    
    @include('pages.productos.mostrarRegistrosProducto')
@stop

@section('css')
    <!-- Token de Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
@stop

@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@section('plugins.jQueryValidation', true)
@section('plugins.Moment', true)

@section('js')
    <script src="{{ asset('js/productos/productosMostrar.js') }}"></script>

    @if (session('producto_actualizado'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'El producto <b>{{ session('producto_actualizado') }}</b> se ha actualizado exitosamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif
@stop
