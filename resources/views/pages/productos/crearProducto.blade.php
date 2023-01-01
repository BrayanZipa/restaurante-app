@extends('adminlte::page')

@section('title', '| Nuevo producto')

@section('content_header')
@stop

@section('content')
    <section class="content-header mt-n2">
        <div id="tarjetaProductos" class="card card-orange mx-n3">
            <div class="card-header">
                <h3 class="card-title">Registrar nuevo producto</h3>
            </div>
            <form id="formCrearProducto" action="{{ route('guardarProducto') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="nombreProducto">Ingrese el nombre del producto</label>
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
                                <label for="codigoProducto">Ingrese el código del producto</label>
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
                                <label for="proveedorProducto">Ingrese el proveedor del producto</label>
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
                                <label for="unidadProducto">Ingrese la unidad de medida del producto</label>
                                <select id="unidadProducto"
                                    class="producto form-control @error('id_unidad') is-invalid @enderror" name="id_unidad">
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
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="totalProducto">Ingrese el total inicial de unidades del producto</label>
                                <input type="number" id="totalProducto"
                                    class="producto form-control @error('total') is-invalid @enderror" name="total"
                                    value="{{ old('total') }}" autocomplete="off" placeholder="Total inicial">
                                @error('total')
                                    <span class="errorServidor invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="costoProducto">Ingrese el costo del producto</label>
                                <input type="number" id="costoProducto"
                                    class="producto form-control @error('costo') is-invalid @enderror" name="costo"
                                    value="{{ old('costo') }}" autocomplete="off" placeholder="Costo">
                                @error('costo')
                                    <span class="errorServidor invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="fechaProducto">Ingrese la fecha de vencimiento del producto</label>
                                <input type="date" id="fechaProducto"
                                    class="producto form-control @error('fecha_vencimiento') is-invalid @enderror"
                                    name="fecha_vencimiento" value="{{ old('fecha_vencimiento') }}"
                                    placeholder="Fecha vencimiento">
                                @error('fecha_vencimiento')
                                    <span class="errorServidor invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
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

@section('css')
@stop

@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@section('plugins.jQueryValidation', true)

@section('js')
    <script src="{{ asset('js/productos/productosCrear.js') }}"></script>

    @if (session('producto_creado'))
        <script>
            Swal.fire({
                title: 'El producto <b>{{ session('producto_creado') }}</b> se ha ingresado exitosamente',
                text: '¿Desea ingresar otro producto?',
                showDenyButton: true,
                confirmButtonText: 'Sí, ingresar',
                denyButtonText: 'No, continuar',
            }).then((result) => {
                if (result.isDenied) {
                    window.location.href = window.location.origin + '/productos';
                }
            })
        </script>
    @endif
@stop
